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
                            <div class="card-block no-padding bg-primary p-l-15 p-r-15 p-t-5 p-b-5 card-button">
                                <a class="btn btn-info btn-edit btn-xs">EDIT</a>
                                <h3 class="fs-16 all-caps font-weight-normal no-margin text-white">
                                    Survey Title
                                </h3>
                            </div>
                            <div class="card-block no-padding card-question edit card-button">
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
                                <div class="tab-content">
                                    <div class="tab-pane active p-l-5 p-r-5" id="tabEdit" aria-expanded="true">
                                        <form class="form">
                                            <label>Q1</label>
                                            <input type="text" class="form-control" value="Do you currently have a working mobile or cell phone, or not?"/>
                                            <hr/>
                                            <div class="row m-b-10">
                                                <div class="col-10 no-padding">
                                                    <div class="input-group transparent">
                                                        <span class="input-group-addon">
                                                            <input type="radio" disabled>
                                                        </span>
                                                        <input type="text" value="Yes, I do" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-2 text-right">
                                                    <div class="btn-group btn-group-justified row w-100">
                                                        <div class="btn-group col-6 p-0">
                                                            <button type="button" class="btn btn-default w-100">
                                                                <span class="fs-11 font-montserrat text-uppercase"><i class="fa fa-minus"></i></span>
                                                            </button>
                                                        </div>
                                                        <div class="btn-group col-6 p-0">
                                                            <button type="button" class="btn btn-default w-100">
                                                                <span class="fs-11 font-montserrat text-uppercase"><i class="fa fa-plus"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-b-10">

                                                <div class="col-10 no-padding">
                                                    <div class="input-group transparent">
                                                        <span class="input-group-addon">
                                                            <input type="radio" disabled>
                                                        </span>
                                                        <input type="text" value="No, I do not" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-2 text-right">
                                                    <div class="btn-group btn-group-justified row w-100">
                                                        <div class="btn-group col-6 p-0">
                                                            <button type="button" class="btn btn-default w-100">
                                                                <span class="fs-11 font-montserrat text-uppercase"><i class="fa fa-minus"></i></span>
                                                            </button>
                                                        </div>
                                                        <div class="btn-group col-6 p-0">
                                                            <button type="button" class="btn btn-default w-100">
                                                                <span class="fs-11 font-montserrat text-uppercase"><i class="fa fa-plus"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-b-10">
                                                <div class="col-10 no-padding text-right">
                                                    <button class="btn btn-xs btn-transparent background-transparent btn-flat"><i class="fa fa-plus-circle"></i> BULK ANSWER</button>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row m-b-10">
                                                <div class="col-12 no-padding">
                                                    <div class="checkbox check-primary no-padding no-margin">
                                                        <input type="checkbox" value="1" id="sc1">
                                                        <label for="sc1">Add an "Other" Answer Option or Comment Field</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row m-b-10">
                                                <div class="col-12 no-padding">
                                                    <div class="checkbox check-primary no-padding no-margin">
                                                        <input type="checkbox" value="1" id="sc2">
                                                        <label for="sc2">Require an Answer to This Question</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane p-l-5 p-r-5" id="tabLogic" aria-expanded="false">
                                        <form class="form">
                                            <div class="row m-b-10">
                                                <div class="col-3 no-padding fs-13">
                                                    If answer is ..
                                                </div>
                                                <div class="col-6 no-padding fs-13">
                                                    Then skip to ..
                                                </div>
                                                <div class="col-3 no-padding text-right fs-13">
                                                    Clear all
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row m-b-10">
                                                <div class="col-3 no-padding fs-13">
                                                    Yes, I do
                                                </div>
                                                <div class="col-3 no-padding fs-13">
                                                    <select class="select2 full-width" data-init-plugin="select2">
                                                        <option value="">-- Choose page --</option>
                                                        <option value="Web-safe">P1</option>
                                                        <option value="Helvetica">End Of Survey</option>
                                                        <option value="SegeoUI">Disqualification Page</option>
                                                    </select>
                                                </div>
                                                <div class="col-5 no-padding fs-13">
                                                    <select class="select2 full-width" data-init-plugin="select2">
                                                        <option value=""></option>
                                                        <option value="Web-safe">Top Of Page</option>
                                                        <option value="Helvetica">2. Which of the following mobile or  ...</option>
                                                        <option value="SegeoUI">3. How many working mobile or cell ...</option>
                                                    </select>
                                                </div>
                                                <div class="col-1 no-padding text-right fs-13">
                                                    <a class="button-link button">Clear</a>
                                                </div>
                                            </div>
                                            <div class="row m-b-10">
                                                <div class="col-3 no-padding fs-13">
                                                    No, I do not
                                                </div>
                                                <div class="col-3 no-padding fs-13">
                                                    <select class="select2 full-width" data-init-plugin="select2">
                                                        <option value="">-- Choose page --</option>
                                                        <option value="Web-safe">P1</option>
                                                        <option value="Helvetica">End Of Survey</option>
                                                        <option value="SegeoUI">Disqualification Page</option>
                                                    </select>
                                                </div>
                                                <div class="col-5 no-padding fs-13">
                                                    <select class="select2 full-width" data-init-plugin="select2">
                                                        <option value=""></option>
                                                        <option value="Web-safe">Top Of Page</option>
                                                        <option value="Helvetica">2. Which of the following mobile or  ...</option>
                                                        <option value="SegeoUI">3. How many working mobile or cell ...</option>
                                                    </select>
                                                </div>
                                                <div class="col-1 no-padding text-right fs-13">
                                                    <a class="button-link button">Clear</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane p-l-5 p-r-5" id="tabMove" aria-expanded="false">
                                        <form class="form">
                                            <div class="row m-b-10">
                                                <div class="col-12 no-padding fs-13">
                                                    Move this question to ..
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row m-b-10">
                                                <div class="col-md-1 col-2 no-padding fs-13">
                                                    Page<br/>
                                                    <select class="select2 full-width" data-init-plugin="select2">
                                                        <option value="">1</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 col-3 no-padding fs-13">
                                                    Position<br/>
                                                    <select class="select2 full-width" data-init-plugin="select2">
                                                        <option value="">Before</option>
                                                        <option value="">After</option>
                                                    </select>
                                                </div>
                                                <div class="col-5 no-padding fs-13">
                                                    Question<br/>
                                                    <select class="select2 full-width" data-init-plugin="select2">
                                                        <option value="Helvetica">2. Which of the following mobile or  ...</option>
                                                        <option value="SegeoUI">3. How many working mobile or cell ...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div class="row bg-white p-b-15 p-t-15">
                                    <div class="col-4">
                                        <button class="btn btn-xs btn-primary btn-flat"><i class="fa fa-plus-circle"></i> NEXT QUESTION</button>
                                    </div>
                                    <div class="col-8 text-right">
                                        <button class="btn btn-xs btn-outline-info btn-flat">CANCEL</button>
                                        <button class="btn btn-primary btn-xs btn-flat" type="submit">SAVE</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block no-padding card-question p-l-15 p-r-15 p-t-5 p-b-5 card-button">
                                <a class="btn btn-info btn-edit btn-xs">EDIT</a>
                                <h4 class="question">2. Which of the following mobile or cell phone service providers do you use? (Please select all that apply.)</h4>
                                <div class="answer">
                                    <div class="checkbox check-info">
                                        <input type="checkbox" value="1" name="che1" id="che1">
                                        <label for="che1">AT&T</label>
                                        <input type="checkbox" value="2" name="che1" id="che2">
                                        <label for="che2">Boost Mobile</label>
                                        <input type="checkbox" value="3" name="che1" id="che3">
                                        <label for="che3">Cricket</label>
                                        <input type="checkbox" value="4" name="che1" id="che4">
                                        <label for="che4">MetroPCS</label>
                                        <input type="checkbox" value="5" name="che1" id="che5">
                                        <label for="che5">Sprint</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block no-padding card-question p-l-15 p-r-15 p-t-5 p-b-5 card-button">
                                <a class="btn btn-info btn-edit btn-xs">EDIT</a>
                                <h4 class="question">3. How many working mobile or cell phones do you currently have?</h4>
                                <div class="answer">
                                    <input type="text" class="form-control text">
                                </div>
                            </div>
                            <div class="card-block no-padding card-question p-l-15 p-r-15 p-t-5 p-b-5 card-button">
                                <a class="btn btn-info btn-edit btn-xs">EDIT</a>
                                <h4 class="question">4. In a typical weekday, about how much time, in total, do you spend using your mobile or cell phone?</h4>
                                <div class="answer">
                                    <textarea class="form-control text"></textarea>
                                </div>
                            </div>
                            <div class="card-block no-padding card-question p-l-15 p-r-15 p-t-5 p-b-5 card-button">
                                <a class="btn btn-info btn-edit btn-xs">EDIT</a>
                                <h4 class="question">5. In a typical weekday, about how much time, in total, do you spend using your mobile or cell phone?</h4>
                                <div class="answer">
                                    <div class="radio radio-info">
                                        <input type="radio" value="yes" name="radio4" id="radio4Yes">
                                        <label for="radio4Yes">Yes, I do</label>
                                        <input type="radio" value="no" name="radio4" id="radio4No">
                                        <label for="radio4No">No, I do not</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block no-padding card-question p-l-15 p-r-15 p-t-5 p-b-5 card-button">
                                <a class="btn btn-info btn-edit btn-xs">EDIT</a>
                                <h4 class="question">6. Which of the following activities do you do on your mobile or cell phone? (Check all that apply)</h4>
                                <div class="answer">
                                    <div class="checkbox check-info">
                                        <input type="checkbox" value="1" name="che1" id="che1">
                                        <label for="che1">AT&T</label>
                                        <input type="checkbox" value="2" name="che1" id="che2">
                                        <label for="che2">Boost Mobile</label>
                                        <input type="checkbox" value="3" name="che1" id="che3">
                                        <label for="che3">Cricket</label>
                                        <input type="checkbox" value="4" name="che1" id="che4">
                                        <label for="che4">MetroPCS</label>
                                        <input type="checkbox" value="5" name="che1" id="che5">
                                        <label for="che5">Sprint</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push("script")
    <script>

    </script>
@endpush
