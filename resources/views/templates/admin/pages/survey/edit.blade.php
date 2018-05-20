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
                        <li class="menu-bar-al">
                            <a class="title-bar p-l-0 m-t-0 open active" href="#"><span class="icon-thumbnail"><i data-feather="fa fa-inbox"></i></span> <span class="title all-caps">Builder</span> <span class="arrow open active"></span></a>
                            <ul class="sub-menu open">
                                @foreach($builders as $builder)
                                    <li>
                                        <a class="cursor"><span class="bold m-r-10 fs-12">
                                            <i class="fa fa-circle"></i></span> <span class="title">{{ ucwords($builder) }}</span>
                                            <button onclick="addQuestionDialog('{{$builder}}')" class="btn btn-rounded btn-xs"><i class="fa fa-plus-circle"></i></button>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="menu-bar-al open active">
                            <a class="title-bar p-l-0 m-t-0" href="#"><span class="icon-thumbnail"><i data-feather="fa fa-inbox"></i></span> <span class="title all-caps">Option</span> <span class="arrow"></span></a>
                            <ul class="sub-menu">
                                @foreach($options as $option)
                                    <li>
                                        <a><span class="bold m-r-10 fs-10"><i class="fa fa-circle"></i></span> <span class="title">{{ $option["name"] }}</span>
                                            <input type="checkbox" onchange="surveyChangeOption({{$survey->id}}, '{{$option["id"]}}')" data-init-plugin="switchery" data-size="small" data-color="primary" {{ ($survey[$option["id"]] == "1") ? 'checked' : 'unchecked' }}>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="inner-content full-height p-r-25 p-l-10 p-b-35">
                    <div class="row">
                        <div class="card card-default padding-25">
                            <div class="card-block p-l-0 p-r-0 p-t-0 p-b-5" id="surveyPage">
                                <a class="btn btn-primary m-t-10 btn-xs pull-right m-l-5" href="{{ url("survey") }}"><i class="fa fa-close text-white"></i></a>
                                <a class="btn btn-info m-t-10 btn-xs pull-right" onclick="editSurvey({{ $survey->id }})"><i class="fa fa-pencil text-white"></i></a>
                                <h3 class="m-0">{{$survey->name}}</h3>
                                <p class="m-0">{{$survey->description}}</p>
                            </div>
                            @foreach($survey->pages as $page)
                                <div class="card-block no-padding card-ded bg-primary p-l-15 p-r-15 p-t-5 p-b-5 card-button" id="page{{ $page->id."XIX" }}">
                                    <a class="btn btn-info btn-edit btn-meuh btn-xs" onclick="editTitle('page{{ $page->id."XIX"}}', {{ $page->id }})"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-edit btn-meuh btn-xs" onclick="deletePage({{ $page->id }})"><i class="fa fa-trash"></i></a>
                                    <a class="btn btn-warning btn-edit btn-meuh btn-xs m-l-10" onclick="moveTitle('page{{ $page->id."XIX"}}', {{ $page->id }})">MOVE</a>

                                    <small class="pull-right m-t-10 text-white">{{ $page->description }}</small>
                                    <h3 class="fs-16 all-caps font-weight-normal no-margin text-white">
                                        {{ $page->name }}
                                    </h3>
                                </div>
                                <div class="card-block no-padding hidden card-question p-l-15 p-r-15 p-t-15 p-b-20 card-button">
                                    <textarea id="activeValue" class="form-control" style="min-height: 100px"></textarea>
                                </div>
                                <div id="listQuestions{{ $page->id }}">
                                    @foreach($page->questions as $question)
                                        <div class="card-block no-padding card-question p-l-15 p-r-15 p-t-5 p-b-5 card-button" id="question{{ $page->id."0X0".$question->id }}">
                                            <a class="btn btn-danger btn-edit btn-meuh btn-xs" onclick="deleteQuestion({{ $question->id }})"><i class="fa fa-trash"></i></a>
                                            <a class="btn btn-info btn-edit btn-meuh btn-xs" onclick="editQuestion('question{{ $page->id."0X0".$question->id }}', {{ $question->id }})"><i class="fa fa-pencil"></i></a>
                                            <h4 class="question">{{ ($survey->question_number) ? $question->position . ". "  : "" }} {{ $question->question}} {{ ($survey->required_asterik) ? (($question->required == "1") ? "*" : "" )  : "" }}</h4>
                                            <div class="answer @if($question->type >= 3) p-b-15 @endif">
                                                @if($question->type == 2)
                                                        @foreach($question->answers as $answer)
                                                        <div class="checkbox check-info">
                                                            <input type="checkbox" value="{{ $answer->id }}" name="{{ $question->id }}" id="{{ $answer->id }}">
                                                            <label for="{{ $answer->id }}">{{ $answer->answer }}</label>
                                                        </div>
                                                        @endforeach
                                                @elseif($question->type == 1)
                                                        @foreach($question->answers as $answer)
                                                        <div class="radio radio-info">
                                                            <input type="radio" value="{{ $answer->id }}" name="{{ $question->id }}" id="{{ $answer->id }}">
                                                            <label for="{{ $answer->id }}">{{ $answer->answer }}</label>
                                                        </div>
                                                        @endforeach
                                                @elseif($question->type == 3)
                                                    <select class="select2 full-width" data-init-plugin="select2">
                                                        @foreach($question->answers as $answer)
                                                            <option value="{{ $answer->id }}">{{ $answer->answer }}</option>
                                                        @endforeach
                                                    </select>
                                                @elseif($question->type == 10)
                                                    <div>
                                                        <input type="text" class="form-control text" value="" placeholder="{{ $question->answer->answer }}"/>
                                                    </div>
                                                @elseif($question->type == 13)
                                                    <div>
                                                        <input type="text" class="form-control date-picker" value="" placeholder="{{ $question->answer->answer }}"/>
                                                    </div>
                                                @elseif($question->type == 6)
                                                    <div>
                                                        <input type="file" class="form-control" value="" placeholder="{{ $question->answer->answer }}"/>
                                                    </div>
                                                @elseif($question->type == 14)
                                                    <div>
                                                        <textarea class="form-control text" placeholder="{{ $question->answer->answer }}"></textarea>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="card-block card-question text-center padding-15 card-adding">
                                    <a class="btn btn-primary btn-flat btn-sm m-l-10 text-white" onclick="newQuestion({{ count($page->questions) + 1 }}, {{ $page->id }}, 'radio')"><i class="fa fa-plus-circle"></i> NEW QUESTION</a>
                                </div>
                            @endforeach
                        </div>
                        <div class="card card-default padding-25 p-l-15 p-r-15">
                            <a class="btn btn-primary btn-sm text-white" onclick="newPage({{ $survey->id }}, {{ count($survey->pages) + 1 }})"><i class="fa fa-plus-circle"></i> NEW PAGE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('templates.admin.pages.survey.components.edit')
    @include('templates.admin.pages.survey.components.dialog.add_question')
    @include('templates.admin.pages.survey.components.dialog.edit_survey')
@endsection


@push("script")
    <script src="{{ url('js/survey/edit.js') }}" type="text/javascript"></script>
@endpush
