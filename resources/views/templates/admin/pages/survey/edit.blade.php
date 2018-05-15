@extends('templates.admin.frame')
@section('title', 'Kolekta : New Survey')
@section('description')
    -
@endsection


@section('content')
    <input type="hidden" id="activeForm"/>
    <input type="hidden" id="activeCurrent"/>
    <div class="page-container">
        <div class="page-content-wrapper full-height">
            <div class="container full-height no-padding p-l-35">
                <div class="secondary-sidebar-toggle bg-master-lighter padding-10 text-center hidden-lg-up">
                    <a data-init="secondary-sidebar-toggle" href="#"><i class="pg pg-more"></i></a>
                </div>
                <div class="secondary-sidebar light p-t-5 overflow-y" data-init="secondary-sidebar">
                    <ul class="main-menu">
                        <li class="menu-bar-al open active">
                            <a class="title-bar p-l-0 m-t-0 open active" href="#"><span class="icon-thumbnail"><i data-feather="fa fa-inbox"></i></span> <span class="title all-caps">Builder</span> <span class="arrow open active"></span></a>
                            <ul class="sub-menu open">
                                @foreach($builders as $builder)
                                    <li>
                                        <a class="cursor"><span class="bold m-r-10 fs-12"><i class="fa fa-circle"></i></span> <span class="title">{{ $builder }}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="menu-bar-al">
                            <a class="title-bar p-l-0 m-t-0" href="#"><span class="icon-thumbnail"><i data-feather="fa fa-inbox"></i></span> <span class="title all-caps">Option</span> <span class="arrow"></span></a>
                            <ul class="sub-menu">
                                @foreach($options as $option)
                                    <li>
                                        <a><span class="bold m-r-10 fs-12"><i class="fa fa-circle"></i></span> <span class="title">{{ $option }}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="inner-content full-height p-r-25 p-l-10 p-b-35">
                    <div class="row">
                        <div class="card card-default padding-25">
                            @foreach($survey->pages as $page)
                                <div class="card-block no-padding card-ded bg-primary p-l-15 p-r-15 p-t-5 p-b-5 card-button" id="page{{ $page->id."XIX" }}">
                                    <a class="btn btn-info btn-edit btn-meuh btn-xs m-l-10" onclick="editTitle('page{{ $page->id."XIX"}}', {{ $page->id }})">EDIT</a>
                                    <a class="btn btn-info btn-edit btn-meuh btn-xs m-l-10" onclick="moveTitle('page{{ $page->id."XIX"}}', {{ $page->id }})">MOVE</a>

                                    <small class="pull-right m-t-10 text-white">{{ $page->description }}</small>
                                    <h3 class="fs-16 all-caps font-weight-normal no-margin text-white">
                                        {{ $page->name }}
                                    </h3>
                                </div>
                                <div class="card-block no-padding hidden card-question p-l-15 p-r-15 p-t-15 p-b-20 card-button">
                                    <textarea id="activeValue" class="form-control" style="min-height: 100px"></textarea>
                                </div>
                                @foreach($page->questions as $question)
                                    <div class="card-block no-padding card-question p-l-15 p-r-15 p-t-5 p-b-5 card-button" id="question{{ $page->id."0X0".$question->id }}">
                                        <a class="btn btn-info btn-edit btn-meuh btn-xs" onclick="editQuestion('question{{ $page->id."0X0".$question->id }}', {{ $question->id }})">EDIT</a>
                                        <h4 class="question">{{ $question->position . "." . $question->question}}</h4>
                                        <div class="answer">
                                            @if($question->type == 2)
                                                <div class="checkbox check-info">
                                                    @foreach($question->answers as $answer)
                                                        <input type="checkbox" value="{{ $answer->id }}" name="{{ $question->id }}" id="{{ $answer->id }}">
                                                        <label for="{{ $answer->id }}">{{ $answer->answer }}</label>
                                                    @endforeach
                                                </div>
                                            @elseif($question->type == 1)
                                                <div class="radio radio-info">
                                                    @foreach($question->answers as $answer)
                                                        <input type="radio" value="{{ $answer->id }}" name="{{ $question->id }}" id="{{ $answer->id }}">
                                                        <label for="{{ $answer->id }}">{{ $answer->answer }}</label>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden">
        <div id="tabDynamic">
            <div class="special-cover hidden"></div>
            <div id="tabHeader">
                <ul class="nav nav-tabs nav-tabs-simple hidden-sm-down bg-white" role="tablist" data-init-reponsive-tabs="dropdownfx">
                    <li class="nav-item">
                        <a class="active" data-toggle="tab" role="tab" data-target="#tabEdit" href="#" aria-expanded="true">Edit</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="tab" role="tab" data-target="#tabLogic" class="" aria-expanded="false">Logic</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="tab" role="tab" data-target="#tabMove" class="" aria-expanded="false">Move</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content padding-10">
                <div class="tab-pane active p-l-5 p-r-5" id="tabEdit" aria-expanded="true">
                    <form class="form m-t-10" onsubmit="return false;">
                        <label id="questionLabel"></label>
                        <input type="hidden" class="hidden" value="" id="questionId"/>
                        <div class="input-group transparent">
                            <input type="text" class="form-control" value="" id="questionInput"/>
                            <div class="input-group-append hidden" id="questionButton">
                                <button type="button" onclick="updateQuestion()" class="btn btn-primary w-100 btn-flat"><i class="fa fa-check"></i></button>
                            </div>
                        </div>
                        <hr/>
                        <div class="dd m-t-min-10 m-b-min-10" id="answerList">
                            <ol class="dd-list">

                            </ol>
                        </div>
                    </form>
                </div>
                <div class="tab-pane p-l-5 p-r-5" id="tabLogic" aria-expanded="false">
                    <form class="form m-t-10" onsubmit="return false;">
                        <div class="row m-b-10">
                            <div class="col-3 no-padding fs-13">
                                If answer is ..
                            </div>
                            <div class="col-6 no-padding fs-13">
                                Then skip to ..
                            </div>
                            <div class="col-3 no-padding text-right fs-13">

                            </div>
                        </div>
                        <hr/>
                        <div id="logicList">

                        </div>
                    </form>
                </div>
                <div class="tab-pane p-l-5 p-r-5" id="tabMove" aria-expanded="false">
                    <form class="form m-t-10" onsubmit="return false;">
                        <div class="row m-b-10">
                            <div class="col-12 no-padding fs-13">
                                Move this question to ..
                            </div>
                        </div>
                        <hr/>
                        <div class="row m-b-10">
                            <div class="col-3 no-padding fs-13">
                                <div id="moveSelectPage"></div>
                            </div>
                            <div class="col-3 no-padding fs-13">
                                <div id="moveSelectPosition"></div>
                            </div>
                            <div class="col-6 no-padding fs-13">
                                <div class="input-group" id="moveSelectQuestion"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="tabFooter">
                <div class="row bg-white p-b-15 p-t-15">
                    <div class="col-4">
                        <button class="btn btn-xs btn-primary btn-flat"><i class="fa fa-plus-circle"></i> NEXT QUESTION</button>
                    </div>
                    <div class="col-8 text-right">
                        <button class="btn btn-xs btn-outline-info btn-flat" onclick="closeQuestion()">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="positionDynamic">
            <div class="special-cover hidden"></div>
            <div class="tab-content padding-10">
                <div class="tab-pane active p-l-5 p-r-5 p-b-10" aria-expanded="true">
                    <form class="form m-t-10" onsubmit="return false;">
                        <input type="hidden" class="hidden" value="" id="pageId"/>
                        <label class="fs-13">Move this page to</label><br>
                        <div class="row m-b-10">
                            <div class="col-3 no-padding fs-13">
                                <select class="select2 full-width" id="pageMovePosition">
                                    <option value="after">After</option>
                                    <option value="before">Before</option>
                                </select>
                            </div>
                            <div class="col-6 no-padding fs-13" id="pageMoveList">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="tabFooter">
                <div class="row bg-white p-b-15 p-t-15">
                    <div class="col-12 text-right">
                        <button class="btn btn-xs btn-outline-info btn-flat" onclick="closeTitle()">CLOSE</button>
                        <button class="btn btn-xs btn-primary btn-flat" id="moveButtonAction">SAVE</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="titleDynamic">
            <div class="special-cover hidden"></div>
            <div class="tab-content padding-10">
                <div class="tab-pane active p-l-5 p-r-5 p-b-10" aria-expanded="true">
                    <form class="form m-t-10" onsubmit="return false;">
                        <input type="hidden" class="hidden" value="" id="pageId"/>
                        <label class="fs-13">Survey Title</label>
                        <input type="text" class="form-control" value="" id="pageTitle"/>
                        <small class="p-t-5">You're good up to 250 characters.</small> </br></br>
                        <label class="fs-13">Survey Description</label>
                        <div class="answer">
                            <textarea class="form-control text" rows="4" id="pageDescription"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div id="tabFooter">
                <div class="row bg-white p-b-15 p-t-15">
                    <div class="col-12 text-right">
                        <button class="btn btn-xs btn-outline-info btn-flat" onclick="closeTitle()">CLOSE</button>
                        <button class="btn btn-xs btn-primary btn-flat" onclick="updateTitle()">SAVE</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="questionDynamic">
            <a class="btn btn-info btn-edit btn-meuh btn-xs" id="questionEdit">EDIT</a>
            <h4 class="question" id="questionAsk">-</h4>
            <div class="answer" id="questionAnswer">

            </div>
        </div>

        <div id="pageDynamic">
            <a class="btn btn-info btn-edit btn-meuh btn-xs m-l-10" id="titleEdit">EDIT</a>
            <a class="btn btn-info btn-edit btn-meuh btn-xs m-l-10" id="titleMove">MOVE</a>
            <small class="pull-right m-t-10 text-white" id="pageDescriptionShow"></small>
            <h3 class="fs-16 all-caps font-weight-normal no-margin text-white" id="pageTitleShow">
                {{ $page->name }}
            </h3>
        </div>

    </div>



@endsection


@push("script")
    <script>
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
            getQuestion(activeForm[1], false);
            $('.btn-meuh').removeClass("hidden");
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
                url:'{{ url("api/v1/question") }}/' + id,
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
                url:'{{ url("api/v1/page") }}/' + id,
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
                url:'{{ url("api/v1/page") }}/' + id,
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
                url:'{{ url("api/v1/question") }}/' + id,
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
                    '        <select class="select2 full-width" data-init-plugin="select2" data-selected-id="'+selectedPage+'" onchange="getQuestionList(this.value, '+value.id+', '+selectedPage+')" id="SELECTEDVAL'+value.id+'">\n' +
                    '            <option value="0">-- Choose page --</option>\n' +
                    pages +
                    '            <option value="-1">End of Surveys</option>\n' +
                    '            <option value="-2">Disqualification Page</option>\n' +
                    '        </select>\n' +
                    '    </div>\n' +
                    '    <div class="col-5 no-padding fs-13">\n' +
                    '        <select class="select2 full-width disabled" data-init-plugin="select2" data-selected-id="'+value.logics.skip_to_question+'" onchange="updateLogicQuestion(this.value, '+value.id+')" disabled id="logicQuestionList'+value.id+'">\n' +
                    '        </select>\n' +
                    '    </div>\n' +
                    '    <div class="col-1 no-padding text-right p-t-5 fs-13">\n' +
                    '        <a class="button-link button" onclick="getQuestionList(0, '+value.id+', '+selectedPage+')">Clear</a>\n' +
                    '    </div>\n' +
                    '</div>';

                if(data.typed.name == "radio" || data.typed.name == "checkbox") {
                    answer += '\n' +
                        '<li class="m-t-min-10 row dd-item p-b-10 p-t-10 DO-'+ positiond++ +'" id="X'+ value.id +'DO" data-id="'+ value.id +'" data-position="'+ value.position +'">\n' +
                        '<div class="dd-content row">\n' +
                            '<div class="col-10 no-padding">\n' +
                            '    <div class="input-group transparent">\n' +
                            '        <span class="input-group-addon dd-handle">\n' +
                            '            <i class="fa fa-bars m-t-min-5"></i>' +
                            '        </span>\n' +
                            '        <span class="input-group-addon">\n' +
                            '            <input type="'+data.typed.name+'" disabled>\n' +
                            '        </span>\n' +
                            '        <input type="text" value="'+ value.answer +'" class="form-control" id="X'+ value.id +'DCEDV" onkeyup="showButton(\'X'+ value.id +'A\', this.value, \''+value.answer+'\')">' +
                            '       <div class="input-group-append hidden" id="X'+ value.id +'A">\n' +
                            '           <button type="button" onclick="updateAnswer(\'X'+ value.id +'DCEDV\', '+ value.id +')" class="btn btn-primary w-100 btn-flat"><i class="fa fa-check"></i></button>\n' +
                            '       </div>\n' +
                            '    </div>\n' +
                            '</div>\n' +
                            '<div class="col-2 text-right">\n' +
                            '    <div class="btn-group btn-group-justified row w-100">\n' +
                            '        <div class="btn-group col-6 p-0">\n' +
                            '            <button type="button" class="btn btn-default w-100" onclick="removeAnswer(\'X'+ value.id +'DO\','+ value.id +')">\n' +
                            '                <span class="fs-11 font-montserrat text-uppercase"><i class="fa fa-minus"></i></span>\n' +
                            '            </button>\n' +
                            '        </div>\n' +
                            '        <div class="btn-group col-6 p-0">\n' +
                            '            <button type="button" class="btn btn-default w-100" onclick="addAnswer(\'X'+ value.id +'DO\', '+ value.position
                            +',\''+data.typed.name+'\')">\n' +
                            '                <span class="fs-11 font-montserrat text-uppercase"><i class="fa fa-plus"></i></span>\n' +
                            '            </button>\n' +
                            '        </div>\n' +
                            '    </div>\n' +
                            '</div>\n' +
                        '</div>\n' +
                    '</li>';
                }
            });


            var movePages =
            '   <select class="select2 full-width" data-init-plugin="select2" data-selected-id="0" onchange="getQuestionListMove(this.value, '+data.id+')" id="movePage'+data.id+'">' +
            '       <option value="0">-- Choose page --</option>\n' + pages +
            '   </select>';

            var movePosition =
            '   <select class="select2 full-width" id="qMovePosition" data-init-plugin="select2" data-selected-id="after">\n' +
            '       <option value="first">At the first</option>\n' +
            '       <option value="after">After</option>\n' +
            '       <option value="before">Before</option>\n' +
            '   </select>';

            var moveQuestion =
            '   <select class="select2 w-100 disabled" id="qMoveQuestion" style="max-width: 100%;" data-init-plugin="select2" data-selected-id="0" disabled>\n' +
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
            $(document).find('[data-init-plugin="select2"]').select2()
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
                }).trigger("change");
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
            $('#questionEdit').attr('onClick', "editQuestion('"+question+"',"+data.id+")");
            $('#questionAsk').html( data.position +" "+ data.question);

            var answer = "";
            if(data.type == 1) {
                answer += '<div class="radio radio-info">';
            }else if(data.type == 2) {
                answer += '<div class="checkbox check-info">';
            }

            $.each(data.answers, function(i, value) {
                if(data.type == 1) {
                    answer += '<input type="radio" value="' + value.id + '" name="' + data.id + '" id="' + value.id + '">\n' +
                        '<label for="' + value.id + '">' + value.answer + '</label> ';
                }else if(data.type == 2) {
                    answer += '<input type="checkbox" value="' + value.id + '" name="' + data.id + '" id="' + value.id + '">\n' +
                        '<label for="' + value.id + '">' + value.answer + '</label> ';
                }
            });

            answer += '</div>';

            $('#questionAnswer').html(answer);

            $('#questionDynamic').attr('id', "");
            $('#questionEdit').attr('id', "");
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
            $('#titleMove').attr('onClick', "moveTitle('"+title+"',"+data.id+")");
            $('#pageTitleShow').html(data.name);
            $('#pageDescriptionShow').html(data.description);

            $('#titleEdit').attr('id', "");
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
                '        <span class="input-group-addon">\n' +
                '            <input type="'+typed+'" disabled>\n' +
                '        </span>\n' +
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
                    url:'{{ url("api/v1/answer") }}/' + id + '/delete',
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
                url:'{{ url("api/v1/answer") }}/' + current.unique + '/store',
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
                url:'{{ url("api/v1/answer") }}/' + id + '/update',
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
                url:'{{ url("api/v1/page") }}/' + id + '/update',
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
                    url: '{{ url("api/v1/answer") }}/' + id + '/update/logic',
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
                    url: '{{ url("api/v1/answer") }}/' + id + '/update/logic/question',
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
                url:'{{ url("api/v1/question") }}/' + id + '/update',
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


            var data = {
                "id": idLocation,
                "new": newLocation
            };

            $.ajax({
                type:'POST',
                url:'{{ url("api/v1/answer") }}/' + id + '/update/location',
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

        function updatePositionOfQuestion(id) {
            var data = {
                "page": $("#movePage"+id).val() ? $("#movePage"+id).val() : 0,
                "question": $("#qMoveQuestion").val() ? $("#qMoveQuestion").val() : 0,
                "pos": $("#qMovePosition").val()
            };

            $(".special-cover").removeClass("hidden");

            $.ajax({
                type:'POST',
                url:'{{ url("api/v1/question") }}/' + id + '/update/position',
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
                url:'{{ url("api/v1/page") }}/' + id + '/update/position',
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

        function showButton(btn, val, oldVal) {
            if(val != "" && val != oldVal)
                $("#"+btn).removeClass("hidden");
            else
                $("#"+btn).addClass("hidden");
        }

    </script>
@endpush
