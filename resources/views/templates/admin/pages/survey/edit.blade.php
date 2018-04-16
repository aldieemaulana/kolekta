@extends('templates.admin.frame')
@section('title', 'Kolekta : New Survey')
@section('description')
    -
@endsection


@section('content')
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
                            <div class="card-block no-padding bg-primary p-l-15 p-r-15 p-t-5 p-b-5 card-button">
                                <a class="btn btn-info btn-edit btn-xs">EDIT</a>
                                <h3 class="fs-16 all-caps font-weight-normal no-margin text-white">
                                    {{ $page->name }}
                                </h3>
                            </div>
                                @foreach($page->questions as $question)
                                <div class="card-block no-padding card-question p-l-15 p-r-15 p-t-5 p-b-5 card-button" id="question{{ $page->id."0X0".$question->id }}">
                                    <a class="btn btn-info btn-edit btn-xs" onclick="editQuestion('question{{ $page->id."0X0".$question->id }}', {{ $question->id }})">EDIT</a>
                                    <h4 class="question">{{ $question->position . "." . $question->question}}</h4>
                                    <div class="answer">
                                            @if($question->type == 1)
<div class="checkbox check-info">
@foreach($question->answers as $answer)
    <input type="checkbox" value="{{ $answer->id }}" name="{{ $question->id }}" id="{{ $answer->id }}">
    <label for="{{ $answer->id }}">{{ $answer->answer }}</label>
@endforeach
</div>
                                            @elseif($question->type == 2)
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
                    <form class="form m-t-10">
                        <label id="questionLabel"></label>
                        <input type="hidden" class="hidden" value="" id="questionId"/>
                        <input type="text" class="form-control" value="" id="questionInput"/>
                        <hr/>
                        <div id="answerList"></div>
                    </form>
                </div>
                <div class="tab-pane p-l-5 p-r-5" id="tabLogic" aria-expanded="false">
                    We could be forever
                </div>
                <div class="tab-pane p-l-5 p-r-5" id="tabMove" aria-expanded="false">
                    Together
                </div>
            </div>
            <div id="tabFooter">
                <div class="row bg-white p-b-15 p-t-15">
                    <div class="col-4">
                        <button class="btn btn-xs btn-primary btn-flat"><i class="fa fa-plus-circle"></i> NEXT QUESTION</button>
                    </div>
                    <div class="col-8 text-right">
                        <button class="btn btn-xs btn-outline-info btn-flat" onclick="closeQuestion()">CANCEL</button>
                        <button class="btn btn-primary btn-xs btn-flat" type="submit"onclick="saveQuestion()">SAVE</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="questionDynamic">
            <a class="btn btn-info btn-edit btn-xs" id="questionEdit">EDIT</a>
            <h4 class="question" id="questionAsk">-</h4>
            <div class="answer" id="questionAnswer">

            </div>
        </div>
    </div>

    <input type="hidden" id="activeForm"/>


@endsection


@push("script")
    <script>
        $tab = "";
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
            $('#activeForm').val(question+","+id);
        }

        function closeQuestion() {
            var activeForm = $('#activeForm').val().split(",");
            getQuestion(activeForm[1], false);
        }

        function getQuestion(id, edit) {
            $.ajax({
                type:'GET',
                url:'{{ url("api/v1/question") }}/' + id,
                contentType: 'application/json; charset=utf-8',
                success:function(json){
                    var data = json.data;

                    if(edit) {
                        $('#questionLabel').html("Q" + data.position);
                        $('#questionInput').val(data.question);
                        $('#questionId').val(data.id);
                        appendAnswer(data);
                    }else{
                        var activeForm = $('#activeForm').val().split(",");
                        var question = activeForm[0];
                        appendQuestion(question, data);

                        $('#activeForm').val("");
                    }
                },
                error:function (json) {
                    console.log("failed to get question detail");
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
            $.each(data.answers, function(i, value) {
                if(data.typed.name == "radio" || data.typed.name == "checkbox") {
                    answer += '<div class="row m-b-10" id="X'+ value.id +'DO">\n' +
                        '<div class="col-10 no-padding">\n' +
                        '    <div class="input-group transparent">\n' +
                        '        <span class="input-group-addon">\n' +
                        '            <input type="'+data.typed.name+'" disabled>\n' +
                        '        </span>\n' +
                        '        <input type="text" value="'+ value.answer +'" name="'+ value.id +'" class="form-control">\n' +
                        '    </div>\n' +
                        '</div>\n' +
                        '<div class="col-2 text-right">\n' +
                        '    <div class="btn-group btn-group-justified row w-100">\n' +
                        '        <div class="btn-group col-6 p-0">\n' +
                        '            <button type="button" class="btn btn-default w-100">\n' +
                        '                <span class="fs-11 font-montserrat text-uppercase" onclick="removeAnswer(\'X'+ value.id +'DO\','+ value.id +')"><i class="fa fa-minus"></i></span>\n' +
                        '            </button>\n' +
                        '        </div>\n' +
                        '        <div class="btn-group col-6 p-0">\n' +
                        '            <button type="button" class="btn btn-default w-100">\n' +
                        '                <span class="fs-11 font-montserrat text-uppercase"><i class="fa fa-plus"></i></span>\n' +
                        '            </button>\n' +
                        '        </div>\n' +
                        '    </div>\n' +
                        '</div>\n' +
                        '</div>';
                }
            });

            $('#answerList').html(answer);
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
                answer += '<div class="checkbox check-info">';
            }else if(data.type == 2) {
                answer += '<div class="radio radio-info">';
            }

            $.each(data.answers, function(i, value) {
                if(data.type == 1) {
                    answer += '<input type="checkbox" value="' + value.id + '" name="' + data.id + '" id="' + value.id + '">\n' +
                        '<label for="' + value.id + '">' + value.answer + '</label> ';
                }else if(data.type == 2) {
                    answer += '<input type="radio" value="' + value.id + '" name="' + data.id + '" id="' + value.id + '">\n' +
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

        function addAnswer(answer, position) {
            
        }

        function removeAnswer(answer, id) {
            $.ajax({
                type:'POST',
                url:'{{ url("api/v1/answer") }}/' + id + '/delete',
                contentType: 'application/json; charset=utf-8',
                mimeType:"multipart/form-data",
                cache: false,
                processData:false,
                success: function(data, textStatus, jqXHR) {
                    $("#"+answer).remove();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("failed to get question detail");
                }
            });
        }

    </script>
@endpush
