@extends('templates.admin.frame')
@section('title', 'Welcome to Kolekta!')
@section('description')
    -
@endsection
@section('button')
    {{--<a href="{{ url('admin/beranda/about/edit') }}" class="btn btn-primary pull-right btn-rounded btn-xs" type="button" style="width:28px;height:28px;margin-top:-15px;"><i class="fa fa-pencil" style="width:8px;"></i></a>--}}
@endsection


@section('content')
<div class="page-content-wrapper m-b-50">
    <div class="content sm-gutter">
        <div class="bg-white">
            <div class="container">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item active">
                        <a href="#">Home</a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="container sm-padding-20 padding-20 m-t-min-10">
            <div class="row m-t-15">
                <div class="col-lg-12 padding-5">
                    <h4 class="m-b-5">Welcome Back, <a href="#" class="btn-link text-primary">{{ explode(" ", Auth::User()->name)[0] }}</a>!</h4>
                    <p class="fs-13"><i class="fa fa-check-circle text-primary"></i> 2 You've completed 2 of 6 tasks. <a href="#" class="btn-link text-primary">Explore your account</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12 d-flex flex-column">
                    <div class="row">
                        <div class="col-sm-6 col-6 d-flex flex-column">
                            <div class="card social-card share unhover full-width m-b-10 b-grey-transparent text-center" data-social="item">
                                <div class="card-header border-bottom-0 m-b-0 p-b-0">
                                    <h5 class="text-gray-dark fs-14 light no-margin">Open <i class="fa fa-info-circle text-gray-dark fs-13" data-toggle="tooltip" data-placement="top" data-html="true"
                                                                                             title="<div class='text-left fs-10 p-b-5 '><label class='m-b-5 fs-11 bold b-b'>Open Surveys</label><br/>Surveys in your account with activity within the last 90 days. Surveys are considered 'open' if they have an active collector and are ready to receive responses. This includes surveys shared with you.</div>"></i>
                                    </h5>
                                </div>
                                <div class="card-description p-t-0">
                                    <h4 class="no-margin">0</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-6 d-flex flex-column">
                            <div class="card social-card share unhover full-width m-b-10 b-grey-transparent text-center" data-social="item">
                                <div class="card-header border-bottom-0 m-b-0 p-b-0">
                                    <h5 class="text-gray-dark fs-14 light no-margin">Draft <i class="fa fa-info-circle text-gray-dark fs-13" data-toggle="tooltip" data-placement="top" data-html="true"
                                                                                              title="<div class='text-left fs-10 p-b-5 '><label class='m-b-5 fs-11 bold b-b'>Draft Surveys</label><br/>Surveys in your account that have been created or modified in the last 90 days but do not have a collector configured just yet. This includes surveys shared with you.</div>"></i>
                                    </h5>
                                </div>
                                <div class="card-description p-t-0">
                                    <h4 class="no-margin">3</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-6 d-flex flex-column">
                    <div class="card social-card share unhover full-width m-b-10 b-grey-transparent text-center" data-social="item">
                        <div class="card-header border-bottom-0 m-b-0 p-b-0">
                            <h5 class="text-gray-dark fs-14 light no-margin">Total Response</h5>
                        </div>
                        <div class="card-description p-t-0">
                            <h4 class="no-margin">0 <i class="fa fa-info-circle text-gray-dark fs-13" data-toggle="tooltip" data-placement="bottom" data-html="true"
                                                       title="<div class='text-left fs-10 p-b-5 '><label class='m-b-5 fs-11 bold b-b'>Total Responses</label><br/>The total number of responses received from surveys in your account with activity over the last 90 days. Excludes surveys shared with you that you have No Access permissions to Analyze.</div>"></i></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-6 d-flex flex-column">
                    <div class="card social-card share unhover full-width m-b-10 b-grey-transparent text-center" data-social="item">
                        <div class="card-header border-bottom-0 m-b-0 p-b-0">
                            <h5 class="text-gray-dark fs-14 light no-margin">Average completion rate</h5>
                        </div>
                        <div class="card-description p-t-0">
                            <h4 class="no-margin">0 <i class="fa fa-info-circle text-gray-dark fs-13" data-toggle="tooltip" data-placement="bottom" data-html="true"
                                                       title="<div class='text-left fs-10 p-b-5 '><label class='m-b-5 fs-11 bold b-b'>Average completion rate</label><br/>The average percentage of respondents that completed your survey across all surveys in your account modified in the last 90 days. Excludes surveys shared with you that you have No Access permissions to Analyze.</div>"></i></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 d-flex flex-column">
                    <div class="card social-card share unhover full-width m-b-10 b-grey-transparent text-center" data-social="item">
                        <div class="card-header border-bottom-0 m-b-0 p-b-0">
                            <h5 class="text-gray-dark fs-14 light no-margin">Typical time spent
                            </h5>
                        </div>
                        <div class="card-description p-t-0">
                            <h4 class="no-margin">0 <i class="fa fa-info-circle text-gray-dark fs-13" data-toggle="tooltip" data-placement="bottom" data-html="true"
                                                       title="<div class='text-left fs-10 p-b-5 '><label class='m-b-5 fs-11 bold b-b'>Typical time spent</label><br/>The median amount of time respondents spent answering each survey, averaged across all surveys in your account with activity from the last 90 days. Excludes surveys shared with you that you have No Access permissions to Analyze.</div>"></i></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-t-10">
                <div class="col-lg-12 padding-5">
                    <a href="{{ url('survey') }}" class="pull-right text-primary fs-12 m-t-15">Manage all surveys <i class="fa fa-angle-double-right"></i> </a>
                    <h4 class="m-b-5">Recent surveys</h4>
                </div>
                @for($i=0;$i<3;$i++)
                    <div class="col-lg-12 d-flex flex-column">
                        <div class="card card-default m-b-10 survey-list b-rad-sm">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-7">
                                        <button class="btn btn-danger btn-animated btn-xs fs-10 from-top fa fa-clock-o all-caps btn-top" type="button">
                                            <span class="bold">Draft</span>
                                        </button>
                                        <div class="clearfix"></div>
                                        <h4 class="m-t-0 m-b-0 fs-16 semi-bold m-t-10">University Instructor Evaluation Template</h4>
                                        <h6 class="m-t-0 fs-12 font-weight-normal text-muted m-t-5">Created: 03.11.2018 <span class="m-r-5 m-l-5 fs-11 semi-bold">|</span> Modified: 03.11.2018</h6>
                                    </div>
                                    <div class="col-md-5 no-padding">
                                        <div class="btn-group btn-group-justified row survey-action">
                                            <div class="btn-group col-3 p-0 p-t-15">
                                                <button class="btn btn-default no-border w-100" type="button"><span class="p-t-5 p-b-5"><i class="fa fa-pencil fs-15"></i></span><br>
                                                    <span class="fs-11 font-montserrat text-uppercase">Edit Survey</span></button>
                                            </div>
                                            <div class="btn-group col-3 p-0 p-t-15">
                                                <button class="btn btn-default no-border w-100" type="button"><span class="p-t-5 p-b-5"><i class="fa fa-send fs-15"></i></span><br>
                                                    <span class="fs-11 font-montserrat text-uppercase">Send Survey</span></button>
                                            </div>
                                            <div class="btn-group col-3 p-0 p-t-15">
                                                <button class="btn btn-default no-border w-100" type="button"><span class="p-t-5 p-b-5"><i class="fa fa-share fs-15"></i></span><br>
                                                    <span class="fs-11 font-montserrat text-uppercase">Share Survey</span></button>
                                            </div>
                                            <div class="btn-group col-3 p-0 p-t-15">
                                                <button class="btn btn-default no-border w-100" type="button"><span class="p-t-5 p-b-5"><i class="fa fa-power-off fs-15"></i></span><br>
                                                    <span class="fs-11 font-montserrat text-uppercase">Disable</span></button>
                                            </div>
                                        </div>
                                        <div class="row m-t-15 survey-description">
                                            <div class="col-sm-4 col-4 text-center b-r b-grey p-l-15 p-r-15 p-b-0">
                                                <h4 class="m-t-0 m-b-0 font-weight-normal fs-16">10</h4>
                                                <h6 class="m-t-0 fs-12 font-weight-normal text-muted">Questions</h6>
                                            </div>
                                            <div class="col-sm-4 col-4 text-center p-l-15 p-r-15 p-b-0">
                                                <h4 class="m-t-0 m-b-0 font-weight-normal fs-16">2 mins</h4>
                                                <h6 class="m-t-0 fs-12 font-weight-normal text-muted">Estimated time to complete</h6>
                                            </div>
                                            <div class="col-sm-4 col-4 text-center b-l b-grey p-l-15 p-r-15 p-b-0">
                                                <h4 class="m-t-0 m-b-0 font-weight-normal fs-16">0</h4>
                                                <h6 class="m-t-0 fs-12 font-weight-normal text-muted">Collectors</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
                <div class="col-lg-12 fs-13 m-t-15">
                    <a href="#" class="pull-right btn btn-primary btn-sm bold all-caps m-t-min-5">Create Survey</a>
                    Showing 2 of 2 recent survey
                </div>
            </div>


            <div class="row m-t-25">
                <div class="col-lg-3 col-md-4">
                    <div class="p-l-0 p-r-0">
                        <h4 class="m-b-10">Your Profile <i class="fa fa-info-circle text-gray-dark fs-14" data-toggle="tooltip" data-placement="right" data-html="true"
                                                           title="<div class='text-left fs-10 p-b-5 '><label class='m-b-5 fs-11 bold b-b'>Your Profile</label><br/>Keep your profile up-to-date to enjoy a more personalized SurveyMonkey experience.</div>"></i></h4>
                    </div>
                    <div class="widget-bottom card card-default b-rad-sm">
                        <div class="card-block text-center p-t-40">
                            <div class="progress-label"><h4>45%</h4>Complete</div>
                            <input class="progress-circle" data-pages-progress="circle" value="45" type="hidden" data-color="primary" data-thick="true">
                            <br/>
                            <h5 class="fs-16 semi-bold m-b-0 m-t-0">{{ Auth::User()->name }}</h5>
                            <h5 class="fs-14 m-t-0 m-b-0">{{ Auth::User()->email }}</h5>
                            <a href="#" class="fs-13 m-t-0 semi-bold btn-link text-primary">Phone Number</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-8">
                    <div class="p-l-0 p-r-0">
                        <h4 class="m-b-10">Quick Poll <i class="fa fa-info-circle text-gray-dark fs-14" data-toggle="tooltip" data-placement="right" data-html="true"
                                                         title="<div class='text-left fs-10 p-b-5 '><label class='m-b-5 fs-11 bold b-b'>Quick Poll</label><br/>Quick Poll Answer questions on a variety of topics and get instant feedback! Who knows—maybe you’ll even learn a thing or two.</div>"></i></h4>
                    </div>
                    <div class="widget-bottom card card-default b-rad-sm">
                        <div class="card-block text-left">
                            <form class="form">
                                <p class="fs-12 m-b-5">Benchmarks add a ton of context to your results. How can you make sure you’re taking advantage of them?</p>
                                <div class="radio radio-primary">
                                    <input type="radio" name="answer" value="1" id="checkbox1">
                                    <label for="checkbox1" class="p-l-25 fs-10">Write your own question</label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio" name="answer" value="2" id="checkbox2">
                                    <label for="checkbox2" class="p-l-25 fs-10">Use expert-written survey templates</label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio" name="answer" value="3" id="checkbox3">
                                    <label for="checkbox3" class="p-l-25 fs-10">Use questions with a Bencmark icon</label>
                                </div>
                            </form>
                            <br/>
                            <p class="fs-8 no-line m-b-0 p-r-15"><b><i class="fa fa-question-circle"></i> What is this?</b> We’re generally curious about all sorts of topics and like to ask questions to gather data. Don’t worry, your personal data will never be shared.</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="p-l-0 p-r-0">
                        <h4 class="m-b-10">Survey Tips</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="widget-bottom card social-card share full-width b-rad-sm">
                                <div class="card-content b-rad-sm" style="border-bottom-left-radius: 0;border-bottom-right-radius: 0;background-image: url('https://cdn.smassets.net/assets/cms/cc/uploads/mag.png');height: 150px;background-size: cover">
                                    <ul class="buttons">
                                        <li>
                                            <a href="#"><i class="fa fa-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-heart-o"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="bg-overlay" style="opacity: 0;"></div>
                                </div>
                                <div class="card-description">
                                    <a href="https://www.surveymonkey.com/curiosity/how-to-spot-survey-writing-errors-in-your-survey-results/" target="_blank" class="text-black fs-12 semi-bold">How to spot survey writing errors ..</a>
                                    <p class="p-t-10 fs-10 sm-vh-10">
                                        The insights you get from them can help you make your next business decision or learn more about the people you’re most interested in. by <u>Jon Gitlin</u>
                                        <br/>

                                        <a href="https://www.surveymonkey.com/curiosity/how-to-spot-survey-writing-errors-in-your-survey-results/" target="_blank" class="btn-link text-primary m-b-10">Learn More <i class="fa fa-angle-double-right"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="widget-bottom card social-card share full-width b-rad-sm">
                                <div class="card-content b-rad-sm" style="border-bottom-left-radius: 0;border-bottom-right-radius: 0;background-image: url('https://cdn.smassets.net/assets/cms/cc/uploads/2017/05/stack-of-books-with-glasses-1024x683.png');height: 150px;background-size: cover">
                                    <ul class="buttons">
                                        <li>
                                            <a href="#"><i class="fa fa-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-heart-o"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="bg-overlay" style="opacity: 0;"></div>
                                </div>
                                <div class="card-description">
                                    <a href="https://www.surveymonkey.com/curiosity/3-tips-make-quiz-pretty-much-anything/" target="_blank" class="text-black fs-12 semi-bold">3 tips to make a quiz for pretty ..</a>
                                    <p class="p-t-10 fs-10 sm-vh-10">
                                        It’s quiz time. How easy is it to turn a simple survey into an engaging quiz? Answer: so easy. by <u>Suha Saya</u>
                                        <br/>

                                        <a href="https://www.surveymonkey.com/curiosity/3-tips-make-quiz-pretty-much-anything/" target="_blank" class="btn-link text-primary m-b-10">Learn More <i class="fa fa-angle-double-right"></i></a>
                                    </p>
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
