var url_base = $('#datbaseurl').val();
var tab = "";
var answerIndex = 0;
var listSerialize;
var idLoc = [];
var pagesQuestions;

function editTitle(title, id) {
    getTitle(id, true);

    var target = document.getElementById('titleDynamic');
    var wrap = document.createElement('div');
    wrap.appendChild(target.cloneNode(true));
    $('#'+title).html(wrap.innerHTML);
    $('#'+title).removeClass(function (index, className) {
        return (className.match (/\bp-\S+/g) || []).join(' ');
    });
    $('#'+title).addClass("edit card-question");
    $('#'+title).removeClass("bg-primary");
    $('.btn-meuh').addClass("hidden");
    $('#activeForm').val(title+","+id);
}

function editSurvey(id) {
    $('#modalStickUpEditSurvey').modal('show');
}

function moveTitle(title, id) {
    getMove(id, true);

    var target = document.getElementById('positionDynamic');
    var wrap = document.createElement('div');
    wrap.appendChild(target.cloneNode(true));
    $('#'+title).html(wrap.innerHTML);
    $('#'+title).removeClass(function (index, className) {
        return (className.match (/\bp-\S+/g) || []).join(' ');
    });
    $('#'+title).addClass("edit card-question");
    $('#'+title).removeClass("bg-primary");
    $('.btn-meuh').addClass("hidden");
    $('#activeForm').val(title+","+id);
}

function editQuestion(question, id) {
    getQuestion(id, true);

    var target = document.getElementById('tabDynamic');
    var wrap = document.createElement('div');
    wrap.appendChild(target.cloneNode(true));
    $('#'+question).html(wrap.innerHTML);
    $('#'+question).removeClass(function (index, className) {
        return (className.match (/\bp-\S+/g) || []).join(' ');
    });
    $('#'+question).addClass("edit");
    $('.btn-meuh').addClass("hidden");
    $('#activeForm').val(question+","+id);

}

function closeQuestion() {
    var activeForm = $('#activeForm').val().split(",");
    $('#activeValue').text("");

    if($('#questionInput').val() === "") {
        deleteQuestion(activeForm[1]);
    }else{
        getQuestion(activeForm[1], false);
        $('.btn-meuh').removeClass("hidden");
    }

}

function closeTitle() {
    var activeForm = $('#activeForm').val().split(",");
    $('#activeValue').text("");
    getTitle(activeForm[1], false);
    $('.btn-meuh').removeClass("hidden");
}

function getQuestion(id, edit) {
    $(".special-cover").removeClass("hidden");

    $.ajax({
        type:'GET',
        url:url_base + "api/v1/question/" + id,
        contentType: 'application/json; charset=utf-8',
        success:function(json){
            var data = json.data;

            if(edit) {
                $('#questionLabel').html("Q" + data.position);
                $('#questionInput').val(data.question);
                $('#questionInput').bind("keyup", function() {
                    showButton("questionButton", $(this).val(),data.question)
                });

                $('#questionId').val(data.id);
                appendAnswer(data);
            }else{
                var activeForm = $('#activeForm').val().split(",");
                var question = activeForm[0];
                appendQuestion(question, data);

                $('#activeForm').val("");
            }

            $(".special-cover").addClass("hidden");
        },
        error:function (json) {
            console.log("failed to get question detail");
            $(".special-cover").addClass("hidden");
        }
    });
}

function getTitle(id, edit) {
    $(".special-cover").removeClass("hidden");

    $.ajax({
        type:'GET',
        url:url_base +"api/v1/page/" + id,
        contentType: 'application/json; charset=utf-8',
        success:function(json){
            var data = json.data;

            if(edit){
                $('#pageTitle').val(data.name);
                $('#pageDescription').val(data.description);
                $('#pageId').val(data.id);
            }else{
                var activeForm = $('#activeForm').val().split(",");
                var title = activeForm[0];
                appendPage(title, data);

                $('#activeForm').val("");
            }

            $(".special-cover").addClass("hidden");
        },
        error:function (json) {
            console.log("failed to get page detail");
            $(".special-cover").addClass("hidden");
        }
    });
}

function getMove(id, edit) {
    $(".special-cover").removeClass("hidden");

    $.ajax({
        type:'GET',
        url:url_base +"api/v1/page/" + id,
        contentType: 'application/json; charset=utf-8',
        success:function(json){
            var data = json.data;

            if(edit){
                var pages = "";
                $.each(data.pages, function(ind, val) {
                    if(val.id !== data.id)
                        pages += '<option value="'+val.id+'">'+val.name+'</option>\n';
                });

                var movePages =
                    '   <select class="select2 full-width" data-init-plugin="select2" data-selected-id="0" id="movePageEd'+data.id+'">' +
                    '       <option value="0">-- Choose page --</option>\n' + pages +
                    '   </select>';
                $('#pageMoveList').html(movePages);
                $('#movePageEd'+data.id).select2();
                $('#pageMovePosition').select2();
                $('#moveButtonAction').attr('onClick', "updatePosition("+data.id+")");

            }else{
                var activeForm = $('#activeForm').val().split(",");
                var title = activeForm[0];
                appendPage(title, data);

                $('#activeForm').val("");
            }

            $(".special-cover").addClass("hidden");
        },
        error:function (json) {
            console.log("failed to get page detail");
            $(".special-cover").addClass("hidden");
        }
    });
}

function saveQuestion() {
    $.ajax({
        type:'POST',
        url:url_base +"api/v1/question/" + id,
        contentType: 'application/json; charset=utf-8',
        data:  formData,
        mimeType:"multipart/form-data",
        cache: false,
        processData:false,
        success: function(data, textStatus, jqXHR) {
            $("#tipePemasok").select2('val', '0');
            $("#savePemasok").trigger('reset');
            $('#modalAddPemasok').modal('hide');
            loadPemasok();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#modalAddPemasok').modal('hide');
            $('#modalFailedPemasok').modal('show');
        }
    });
}

function appendAnswer(data) {
    var answer = "";
    var logic = "";
    var positiond = 0;
    var positionPublic = 0;

    var current = [];
    var answers = [];

    var pages = "";
    pagesQuestions = [];

    $.each(data.paged.pages, function(ind, val) {
        pages += '<option value="'+val.id+'">'+val.name+'</option>\n';
        pagesQuestions[val.id] = [];
        $.each(val.questions, function(inde, valu) {
            if(valu.id !== data.id) {
                pagesQuestions[val.id].push({"id": valu.id, "text": valu.position + ". " + valu.question})
            }
        });
    });

    $.each(data.answers, function(i, value) {
        var logics = [];

        logics.push({
            "skip_to": value.logics.skip_to,
            "skip_to_question": value.logics.skip_to_question,
            "unique_state": value.logics.unique_state
        });

        answers.push({
            "answer": value.answer,
            "position": value.position,
            "point": value.point,
            "correct": value.correct,
            "logic": logics
        });

        var selectedPage = 0;
        if(value.logics.unique_state === "disqualification"){
            selectedPage = -2;
        } else if(value.logics.unique_state === "exit") {
            selectedPage = -1;
        } else {
            var a = value.logics.skip_to;
            if (a > 0)
                selectedPage = a;
            else
                selectedPage = 0;
        }

        logic += '\n' +
            '<div class="row m-b-10">\n' +
            '    <div class="col-3 no-padding fs-13 p-t-5">\n' +
            value.answer +'\n' +
            '    </div>\n' +
            '    <div class="col-3 no-padding fs-13">\n' +
            '        <select class="select2 full-width" data-init-plugin="select21" data-selected-id="'+selectedPage+'" onchange="getQuestionList(this.value, '+value.id+', '+selectedPage+')" id="SELECTEDVAL'+value.id+'">\n' +
            '            <option value="0">-- Choose page --</option>\n' +
            pages +
            '            <option value="-1">End of Surveys</option>\n' +
            '            <option value="-2">Disqualification Page</option>\n' +
            '        </select>\n' +
            '    </div>\n' +
            '    <div class="col-5 no-padding fs-13">\n' +
            '        <select class="select2 full-width disabled" data-init-plugin="select21" data-selected-id="'+value.logics.skip_to_question+'" disabled id="logicQuestionList'+value.id+'">\n' +
            '        </select>\n' +
            '    </div>\n' +
            '    <div class="col-1 no-padding text-right p-t-5 fs-13">\n' +
            '        <a class="button-link button" onclick="getQuestionList(0, '+value.id+', '+selectedPage+')">Clear</a>\n' +
            '    </div>\n' +
            '</div>';


        if(data.typed.name == "radio" || data.typed.name == "checkbox" || data.typed.name == "dropdown") {
            answer += '\n' +
                '<li class="m-t-min-10 row dd-item p-b-10 p-t-10 DO-'+ positiond++ +'" id="X'+ value.id +'DO" data-id="'+ value.id +'" data-position="'+ value.position +'">\n' +
                '<div class="dd-content row">\n' +
                '<div class="col-10 no-padding">\n' +
                '    <div class="input-group transparent">\n' +
                '        <span class="input-group-addon dd-handle">\n' +
                '            <i class="fa fa-bars m-t-min-5"></i>' +
                '        </span>\n' +
                '        <input type="text" value="'+ value.answer +'" class="form-control" id="X'+ value.id +'DCEDV" onkeyup="showButton(\'X'+ value.id +'A\', this.value, \''+value.answer+'\')">' +
                '       <div class="input-group-append hidden" id="X'+ value.id +'A">\n' +
                '           <button type="button" onclick="updateAnswer(\'X'+ value.id +'DCEDV\', '+ value.id +')" class="btn btn-primary w-100 btn-flat"><i class="fa fa-check"></i></button>\n' +
                '       </div>\n' +
                '    </div>\n' +
                '</div>\n' +
                '<div class="col-2 text-right">\n' +
                '    <div class="btn-group btn-group-justified row w-100">\n';

                if(data.answers.length > 1) {
                 answer +=  '        <div class="btn-group col-6 p-0">\n' +
                     '            <button type="button" class="btn btn-default w-100" onclick="removeAnswer(\'X'+ value.id +'DO\','+ value.id +')">\n' +
                     '                <span class="fs-11 font-montserrat text-uppercase"><i class="fa fa-minus"></i></span>\n' +
                     '            </button>\n' +
                     '        </div>\n' +
                     '        <div class="btn-group col-6 p-0">\n';
                }else{
                answer += '<div class="btn-group col-12 p-0">\n';
                }

                answer += '            <button type="button" class="btn btn-default w-100" onclick="addAnswer(\'X'+ value.id +'DO\', '+ value.position
                +',\''+data.typed.name+'\')">\n' +
                '                <span class="fs-11 font-montserrat text-uppercase"><i class="fa fa-plus"></i></span>\n' +
                '            </button>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '</div>\n' +
                '</div>\n' +
                '</li>';
        }else if(data.typed.name == "singletextbox" || data.typed.name == "text" || data.typed.name == "date/time" || data.typed.name == "fileupload"){
            answer += '\n' +
                '<li class="m-t-min-10 row dd-item p-b-10 p-t-10 DO-'+ positiond++ +'" id="X'+ value.id +'DO" data-id="'+ value.id +'" data-position="'+ value.position +'">\n' +
                '<div class="dd-content row">\n' +
                '<div class="col-12 no-padding">\n' +
                '    <div class="input-group transparent">\n' +
                '        <span class="input-group-addon dd-handle">\n' +
                '            <i class="fa fa-bars m-t-min-5"></i>' +
                '        </span>\n' +
                '        <input type="text" placeholder="Placeholder" value="'+ value.answer +'" class="form-control" id="X'+ value.id +'DCEDV" onkeyup="showButton(\'X'+ value.id +'A\', this.value, \''+value.answer+'\')">' +
                '       <div class="input-group-append hidden" id="X'+ value.id +'A">\n' +
                '           <button type="button" onclick="updateAnswer(\'X'+ value.id +'DCEDV\', '+ value.id +')" class="btn btn-primary w-100 btn-flat"><i class="fa fa-check"></i></button>\n' +
                '       </div>\n' +
                '    </div>\n' +
                '</div>\n' +
                '</div>\n' +
                '</li>';
        }
    });


    var movePages =
        '   <select class="select2 full-width" data-init-plugin="select21" data-selected-id="0" onchange="getQuestionListMove(this.value, '+data.id+')" id="movePage'+data.id+'">' +
        '       <option value="0">-- Choose page --</option>\n' + pages +
        '   </select>';

    var movePosition =
        '   <select class="select2 full-width" id="qMovePosition" data-init-plugin="select21" data-selected-id="after">\n' +
        '       <option value="first">At the first</option>\n' +
        '       <option value="after">After</option>\n' +
        '       <option value="before">Before</option>\n' +
        '   </select>';

    var moveQuestion =
        '   <select class="select2 w-100 disabled" id="qMoveQuestion" style="max-width: 100%;" data-init-plugin="select21" data-selected-id="0" disabled>\n' +
        '   </select>' +
        '   <div class="input-group-append">\n' +
        '       <button type="button" id="moveButtonDone'+ data.id +'"onclick="updatePositionOfQuestion('+ data.id +')" class="btn btn-primary w-100 btn-flat"><i class="fa fa-check"></i></button>\n' +
        '   </div>\n';

    $('#moveSelectPage').html(movePages);
    $('#moveSelectPosition').html(movePosition);
    $('#moveSelectQuestion').html(moveQuestion);

    current.push({
        "page": data.page,
        "position": data.position,
        "unique": data.unique,
        "question": data.question,
        "type": data.type,
        "add_other": data.add_other,
        "required": data.required,
        "answer": answers
    });

    $('#activeValue').text(JSON.stringify(current));
    $('#activeCurrent').text(JSON.stringify(current));

    $('#logicList').html(logic);
    $(document).find('[data-init-plugin="select21"]').select2()
        .val(function() {
            return $(this).attr("data-selected-id");
        }).trigger("change");

    $('.dd-list').html(answer);
    $('#answerList').nestable({
        group: 1,
        maxDepth: 1
    }).on('change', function(e) {
        var list = $('#answerList').nestable('serialize');
        var newe = [];

        $.each(list, function(x, v) {
            newe.push(v.id);
        });

        if(newe.length > 0)
            changeLocation(idLoc, newe, data.id);
    });

    listSerialize = $('#answerList').nestable('serialize');
    idLoc = [];
    $.each(listSerialize, function(x, v) {
        idLoc.push(v.id);
    });

    $('#sc2').attr('onClick', "requiredQuestion("+data.id+")");
    if(data.required === "1") {
        $("#sc2").attr("checked", true);
    }else{
        $("#sc2").attr("checked", false);
    }


}

function getQuestionList(val, id, selectedPage) {
    updateLogic(id, val, null);

    if(val < 1) {
        if(val === 0) {
            $("#SELECTEDVAL"+id).val(0).trigger("change");
        }
        $("#logicQuestionList"+id).empty().trigger("change").prop('disabled', true);
    } else {
        $("#logicQuestionList"+id).empty().select2({
            data: pagesQuestions[val]
        }).prop('disabled', false).val(function() {
            selectedPageQuestion = $(this).attr("data-selected-id");
            return selectedPageQuestion;
        }).trigger("change").attr("onChange", "updateLogicQuestion(this.value, "+id+")");
    }
}

function getQuestionListMove(val, id) {
    if(val > 0) {
        $("#moveButtonDone"+id).removeClass("hidden");
        $("#qMoveQuestion").empty().select2({
            data: pagesQuestions[val]
        }).prop('disabled', false).val(function() {
            selectedPageQuestion = $(this).attr("data-selected-id");
            return selectedPageQuestion;
        }).trigger("change");
    }else{
        $("#moveButtonDone"+id).addClass("hidden");
        $("#qMoveQuestion").empty().prop('disabled', true).trigger("change");
    }
}

function appendQuestion(question, data) {
    var target = document.getElementById('questionDynamic');
    var wrap = document.createElement('div');

    wrap.appendChild(target.cloneNode(true));
    $('#'+question).html(wrap.innerHTML);
    $('#'+question).addClass("p-l-15 p-r-15 p-t-5 p-b-5");
    $('#'+question).removeClass("edit");
    var asterik = "";
    if($("#asterikIs").val() === "1") {
        if(data.required === "1")
            asterik = "*";
    }

    $('#questionEdit').attr('onClick', "editQuestion('"+question+"',"+data.id+")");
    $('#questionDelete').attr('onClick', "deleteQuestion("+data.id+")");
    if($("#numberIs").val() === "1") {
        $('#questionAsk').html(data.position + ". ");
    }else{
        $('#questionAsk').html("");
    }
    $('#questionAsk').append(  data.question + " " + asterik);

    var answer = "";

    if(data.type == 3) {
        answer += '<select class="select2 full-width m-b-15">';
    }else{
        answer += "<div>";
    }

    $.each(data.answers, function(i, value) {
        if(data.type == 1) {
            answer += '<div class="radio radio-info"><input type="radio" value="' + value.id + '" name="' + data.id + '" id="' + value.id + '">\n' +
                '<label for="' + value.id + '">' + value.answer + '</label></div> ';
        }else if(data.type == 2) {
            answer += '<div class="checkbox check-info"><input type="checkbox" value="' + value.id + '" name="' + data.id + '" id="' + value.id + '">\n' +
                '<label for="' + value.id + '">' + value.answer + '</label></div> ';
        }else if(data.type == 3) {
            answer += '<option value="' + value.id + '">' + value.answer + '</option>';
        }else if(data.type == 13) {
            answer += '<input type="text" class="form-control date-picker" placeholder="' + value.answer + '"/>';
        }else if(data.type == 10) {
            answer += '<input type="text" class="form-control text" placeholder="' + value.answer + '"/>';
        }else if(data.type == 6) {
            answer += '<input type="file" class="form-control" placeholder="' + value.answer + '"/>';
        }else if(data.type == 14) {
            answer += '<textarea class="form-control text" placeholder="' + value.answer + '"></textarea>';
        }
    });

    if(data.type == 3) {
        answer += '</select>';
    }else{
        answer += '</div>';
    }

    $('#questionAnswer').html(answer);

    if(data.type == 3) {
        $('.select2').select2();
    }else if(data.type == 13) {
        $('.date-picker').datepicker();
    }

    if(data.type >= 3) {
        $('#questionAnswer').attr('class', "p-b-15");
    }

    $('#questionDynamic').attr('id', "");
    $('#questionEdit').attr('id', "");
    $('#questionDelete').attr('id', "");
    $('#questionAsk').attr('id', "");
    $('#questionAnswer').attr('id', "");
}

function appendPage(title, data) {
    var target = document.getElementById('pageDynamic');
    var wrap = document.createElement('div');

    wrap.appendChild(target.cloneNode(true));
    $('#'+title).html(wrap.innerHTML);
    $('#'+title).addClass("p-l-15 p-r-15 p-t-5 p-b-5 bg-primary");
    $('#'+title).removeClass("edit card-question");
    $('#titleEdit').attr('onClick', "editTitle('"+title+"',"+data.id+")");
    $('#titleDelete').attr('onClick', "deletePage("+data.id+")");
    $('#titleMove').attr('onClick', "moveTitle('"+title+"',"+data.id+")");
    $('#pageTitleShow').html(data.name);
    $('#pageDescriptionShow').html(data.description);

    $('#titleEdit').attr('id', "");
    $('#titleDelete').attr('id', "");
    $('#titleMove').attr('id', "");
    $('#pageTitleShow').attr('id', "");
    $('#pageDescriptionShow').attr('id', "");
    $('#pageDynamic').attr('id', "");
}

function addAnswer(answer, position, typed) {
    console.log("position:" + position);
    answerIndex++;
    var row = '<div class="row m-b-10" id="X'+ answerIndex +'DOED">\n' +
        '<div class="col-10 no-padding">\n' +
        '    <div class="input-group transparent">\n' +
        '        <input type="text" class="form-control" id="X'+ answerIndex +'DOEDV" onkeyup="showButton(\'X'+ answerIndex +'DOEDVB\', this.value, \'\')">' +
        '       <div class="input-group-append hidden" id="X'+ answerIndex +'DOEDVB">\n' +
        '           <button type="button" onclick="valueAnswer(\'X'+ answerIndex +'DOEDV\', '+ position +')" class="btn btn-primary w-100 btn-flat"><i class="fa fa-check"></i></button>\n' +
        '       </div>\n' +
        '    </div>\n' +
        '</div>\n' +
        '<div class="col-2 text-right">\n' +
        '    <div class="btn-group btn-group-justified row w-100">\n' +
        '        <div class="btn-group col-6 p-0">\n' +
        '            <button type="button" class="btn btn-default w-100" onclick="removeAnswer(\'X'+ answerIndex +'DOED\', 0)">\n' +
        '                <span class="fs-11 font-montserrat text-uppercase"><i class="fa fa-minus"></i></span>\n' +
        '            </button>\n' +
        '        </div>\n' +
        '        <div class="btn-group col-6 p-0">\n' +
        '            <button type="button" class="btn btn-default w-100" onclick="addAnswer(\'X'+ answerIndex +'DOED\', '+ 0 +', \''+typed+'\')">\n' +
        '                <span class="fs-11 font-montserrat text-uppercase"><i class="fa fa-plus"></i></span>\n' +
        '            </button>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '</div>\n' +
        '</div>';
    $(row).insertAfter("#"+answer);
}

function removeAnswer(answer, id) {
    if(id > 0){
        $.ajax({
            type:'POST',
            url:url_base +"api/v1/answer/" + id + '/delete',
            contentType: 'application/json; charset=utf-8',
            mimeType:"multipart/form-data",
            cache: false,
            processData:false,
            success: function(json) {
                var data = JSON.parse(json);
                getQuestion(data.question, true);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("failed to get question detail");
            }
        });
    }else{
        $("#"+answer).remove();
    }
}

function deleteQuestion(id) {
    if(id > 0){
        $(".special-cover").removeClass("hidden");
        $.ajax({
            type:'POST',
            url:url_base +"api/v1/question/" + id + '/delete',
            contentType: 'application/json; charset=utf-8',
            mimeType:"multipart/form-data",
            cache: false,
            processData:false,
            success: function(json) {
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("failed to delete question detail");
                $(".special-cover").addClass("hidden");
            }
        });
    }else{
        $("#"+answer).remove();
    }
}

function valueAnswer(val, position) {
    var current = JSON.parse($("#activeValue").text());
    current = current[0];
    var answers = current.answer;

    var logics = {
        "skip_to": null,
        "skip_to_question": null,
        "unique_state": null
    };

    var answer = {
        "answer": $("#"+val).val(),
        "position": position,
        "point": 0,
        "correct": 0,
        "logic": logics
    };

    $.ajax({
        type:'POST',
        url:url_base +"api/v1/answer/" + current.unique + '/store',
        contentType: 'application/json; charset=utf-8',
        data: JSON.stringify(answer),
        mimeType:"multipart/form-data",
        cache: false,
        processData:false,
        success: function(json) {
            var data = JSON.parse(json);
            //getQuestion(data.question, false);
            //$('.btn-meuh').removeClass("hidden");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("failed to add answer to the question detail");
            //$('.btn-meuh').removeClass("hidden");
        }
    });

    answers.splice(position, 0, answer);
}

function updateAnswer(val, id) {
    var logics = {
        "skip_to": null,
        "skip_to_question": null,
        "unique_state": null
    };

    var answer = {
        "answer": $("#"+val).val(),
        "point": 0,
        "correct": 0,
        "logic": logics
    };

    $.ajax({
        type:'POST',
        url:url_base +"api/v1/answer/" + id + '/update',
        contentType: 'application/json; charset=utf-8',
        data: JSON.stringify(answer),
        mimeType:"multipart/form-data",
        cache: false,
        processData:false,
        success: function(json) {
            var data = JSON.parse(json);
            getQuestion(data.question, true);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("failed to add answer to the question detail");
        }
    });

}

function updateTitle() {
    var data = {
        "name": $("#pageTitle").val(),
        "description": $("#pageDescription").val()
    };

    var id = $("#pageId").val();
    $.ajax({
        type:'POST',
        url:url_base +"api/v1/page/" + id + '/update',
        contentType: 'application/json; charset=utf-8',
        data: JSON.stringify(data),
        mimeType:"multipart/form-data",
        cache: false,
        processData:false,
        success: function(json) {
            var data = JSON.parse(json);
            getTitle(data.title, false);
            $('.btn-meuh').removeClass("hidden");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("failed to update page detail");
        }
    });

}

function updateLogic(id, skip_to, skip_page) {

    if(skip_to >= 0)
        skip_to = null;

    var data = {
        "skip_to": null,
        "skip_to_question": null,
        "unique_state": skip_to
    };

    if(skip_to <= 0) {
        $(".special-cover").removeClass("hidden");
        $.ajax({
            type: 'POST',
            url: url_base +"api/v1/answer/" + id + '/update/logic',
            contentType: 'application/json; charset=utf-8',
            data: JSON.stringify(data),
            mimeType: "multipart/form-data",
            cache: false,
            processData: false,
            success: function (json) {
                $(".special-cover").addClass("hidden");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("failed to update page logic");
                $(".special-cover").addClass("hidden");
            }
        });
    }

}

function updateLogicQuestion(id, idAnswer) {
    if(id > 0) {
        $(".special-cover").removeClass("hidden");

        $.ajax({
            type: 'POST',
            url: url_base +"api/v1/answer/" + id + '/update/logic/question',
            contentType: 'application/json; charset=utf-8',
            data: JSON.stringify({"answer": idAnswer}),
            mimeType: "multipart/form-data",
            cache: false,
            processData: false,
            success: function (json) {
                $(".special-cover").addClass("hidden");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("failed to update page logic question");
                $(".special-cover").addClass("hidden");
            }
        });
    }
}

function updateQuestion() {
    var question = $('#questionInput').val();
    var id = $('#questionId').val();

    $.ajax({
        type:'POST',
        url:url_base +"api/v1/question/" + id + '/update',
        contentType: 'application/json; charset=utf-8',
        data: JSON.stringify({"question": question}),
        mimeType:"multipart/form-data",
        cache: false,
        processData:false,
        success: function(json) {
            $("#questionButton").addClass("hidden");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("failed to change question");
        }
    });
}

function changeLocation(idLocation, newLocation, id) {

    if(idLocation !== newLocation) {
        var data = {
            "id": idLocation,
            "new": newLocation
        };

        $.ajax({
            type:'POST',
            url:url_base +"api/v1/answer/" + id + '/update/location',
            contentType: 'application/json; charset=utf-8',
            data: JSON.stringify(data),
            mimeType:"multipart/form-data",
            cache: false,
            processData:false,
            success: function(json) {
                var data = JSON.parse(json);
                getQuestion(data.question, true);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("failed to change answer locatin to the question detail");
            }
        });
    }

}

function updatePositionOfQuestion(id) {
    var data = {
        "page": $("#movePage"+id).val() ? $("#movePage"+id).val() : 0,
        "question": $("#qMoveQuestion").val() ? $("#qMoveQuestion").val() : 0,
        "pos": $("#qMovePosition").val()
    };

    $(".special-cover").removeClass("hidden");

    $.ajax({
        type:'POST',
        url:url_base +"api/v1/question/" + id + '/update/position',
        contentType: 'application/json; charset=utf-8',
        data: JSON.stringify(data),
        mimeType:"multipart/form-data",
        cache: false,
        processData:false,
        success: function(json) {
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $(".special-cover").addClass("hidden");
            console.log("failed to change locatin to the question detail");
        }
    });

}

function updatePosition(id) {
    var data = {
        "page": $("#movePageEd"+id).val(),
        "pos": $("#pageMovePosition").val()
    };

    $(".special-cover").removeClass("hidden");

    $.ajax({
        type:'POST',
        url: url_base +"api/v1/page/" + id + '/update/position',
        contentType: 'application/json; charset=utf-8',
        data: JSON.stringify(data),
        mimeType:"multipart/form-data",
        cache: false,
        processData:false,
        success: function(json) {
            location.reload();
            $(".special-cover").addClass("hidden");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $(".special-cover").addClass("hidden");
            console.log("failed to change page location to the question detail");
        }
    });
}

function requiredQuestion(id) {
    $(".special-cover").removeClass("hidden");

    $.ajax({
        type:'POST',
        url: url_base +"api/v1/question/" + id + '/update/required',
        contentType: 'application/json; charset=utf-8',
        mimeType:"multipart/form-data",
        data: JSON.stringify({"required": $("#sc2").prop('checked')}),
        cache: false,
        processData:false,
        success: function(json) {
            $(".special-cover").addClass("hidden");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $(".special-cover").addClass("hidden");
            console.log("failed to change question required detail");
        }
    });
}

function surveyChangeOption(id, option) {
    $(".special-cover").removeClass("hidden");

    $.ajax({
        type:'POST',
        url: url_base +"api/v1/survey/" + id + '/update/option/' + option,
        contentType: 'application/json; charset=utf-8',
        mimeType:"multipart/form-data",
        cache: false,
        processData:false,
        success: function(json) {
            $(".special-cover").addClass("hidden");
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $(".special-cover").addClass("hidden");
            console.log("failed to change question required detail");
        }
    });
}

function showButton(btn, val, oldVal) {
    if(val != "" && val != oldVal) {
        $("#"+btn).removeClass("hidden");
    }
    else {

        $("#"+btn).addClass("hidden");
    }
}

$('.date-picker').datepicker();
var url_base = $('#datbaseurl').val() + "/";

function addQuestionDialog(type) {
    $('#pageListDialog').select2().val("0").trigger("change");
    $('#modalStickUpAddQuestion').modal('show');
    $("#selectedTypeDialog").val(type);
}

function selectedQuestion() {
    var selectedTypeDialog = $("#selectedTypeDialog").val();
    var selectedPageDialog = $("#pageListDialog").val();

    $('#modalStickUpAddQuestion').modal('hide');

    newQuestion(0, selectedPageDialog, selectedTypeDialog);
}

function newQuestion(position, page, type) {
    if($('#activeForm').val() !== "")
        closeQuestion();

    var data = {
        "position": position,
        "type": type,
        "page": page
    };

    $(".special-cover").removeClass("hidden");

    $.ajax({
        type:'POST',
        url: url_base + "api/v1/question/store",
        contentType: 'application/json; charset=utf-8',
        mimeType:"multipart/form-data",
        data: JSON.stringify(data),
        cache: false,
        processData:false,
        success: function(json) {
            var data = JSON.parse(json);
            $(".special-cover").addClass("hidden");
            parseQuestionByData(data.data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $(".special-cover").addClass("hidden");
            console.log("failed to create new question detail");
        }
    });
}

function updateSurvey() {
    $('#modalStickUpEditSurvey').modal('hide');
    if($('#selectedSurveyName').val() !== "") {
        var data = {
            "name": $('#selectedSurveyName').val(),
            "id": $('#selectedSurveyId').val(),
            "description": $('#selectedSurveyDescription').val()
        };

        $(".special-cover").removeClass("hidden");

        $.ajax({
            type:'POST',
            url: url_base + "api/v1/survey/store",
            contentType: 'application/json; charset=utf-8',
            mimeType:"multipart/form-data",
            data: JSON.stringify(data),
            cache: false,
            processData:false,
            success: function(json) {
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $(".special-cover").addClass("hidden");
                console.log("failed to update survey detail");
            }
        });
    }
}

function newPage(survey, position) {
    var data = {
        "survey": survey,
        "position": position,
    };

    $(".special-cover").removeClass("hidden");

    $.ajax({
        type:'POST',
        url: url_base + "api/v1/page/store",
        contentType: 'application/json; charset=utf-8',
        mimeType:"multipart/form-data",
        data: JSON.stringify(data),
        cache: false,
        processData:false,
        success: function(json) {
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $(".special-cover").addClass("hidden");
            console.log("failed to create new page detail");
        }
    });
}

function deletePage(id) {
    $(".special-cover").removeClass("hidden");

    $.ajax({
        type:'POST',
        url: url_base + "api/v1/page/" + id + "/delete",
        contentType: 'application/json; charset=utf-8',
        mimeType:"multipart/form-data",
        cache: false,
        processData:false,
        success: function(json) {
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("failed to delete page");
            $(".special-cover").addClass("hidden");
        }
    });
}

function parseQuestionByData(data) {
    var idComponent = "question"+data.page+"0X0"+data.id;
    console.log(idComponent);
    var newComponent = '<div class="card-block no-padding card-question p-l-15 p-r-15 p-t-5 p-b-5 card-button" id="'+idComponent+'"></div>';

    $('#listQuestions' + data.page).append(newComponent);
    editQuestion(idComponent, data.id);
}