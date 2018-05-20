@extends('templates.admin.frame')
@section('title', 'Kolekta : ' . $survey->name)
@section('description')
    -
@endsection


@section('content')

    <div class="page-content-wrapper m-b-50">
        <div class="content sm-gutter">
            <div class="bg-white">
                <div class="container">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a href="{{ url('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url('survey') }}">Survey</a></li>
                        <li class="breadcrumb-item active">Summary</li>
                    </ol>
                </div>
            </div>
            <div class="container sm-padding-20 padding-20 m-t-min-10">
                <div class="row m-t-10">
                    <div class="col-lg-4 col-md-4 padding-5">
                        <h4 class="m-b-5">Survey Design</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card social-card share unhover full-width m-b-10 b-grey-transparent text-left m-t-15" data-social="item">
                                    <div class="card-header border-bottom-0 m-b-0 p-b-0">
                                        <h5 class="text-gray-dark fs-16 light no-margin">{{ $survey->name }}</h5>
                                        <small class="text-gray-dark fs-11 p-r-25 light no-margin">{{ $survey->description ?? "no description" }}</small>
                                    </div>
                                    <div class="card-description p-t-0 m-b-5 p-l-0 p-r-0 p-b-0">
                                        <h4 class="no-margin fs-12 text-black p-l-15 p-r-15">Created on {{ date("d.m.y", strtotime($survey->created_at)) }}</h4>
                                        <div class="row m-t-5 m-b-10">
                                            <div class="col-6 padding-5 text-center">
                                                <div class="bg-faded padding-10 p-t-15">
                                                    Pages
                                                    <h4 class="m-t-5 m-b-0">{{ count($survey->pages) }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-6 padding-5 text-center">
                                                <div class="bg-faded padding-10 p-t-15">
                                                    Questions
                                                    <h4 class="m-t-5 m-b-0">{{ ($questions) }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 al list-item">Required Asterisk <label class="label {{ $survey->required_asterik ? 'label-success' : '' }} pull-right m-b-0">{{ $survey->required_asterik ? "activate" : "deactivate" }}</label></div>
                                        <div class="col-12 al list-item">Question Number <label class="label {{ $survey->question_number ? 'label-success' : '' }} pull-right m-b-0">{{ $survey->question_number ? "activate" : "deactivate" }}</label></div>
                                        <div class="col-12 al list-item">Public <label class="label {{ $survey->public ? 'label-success' : '' }} pull-right m-b-0">{{ $survey->public ? "activate" : "deactivate" }}</label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 d-flex flex-column">
                                <div class="card social-card share full-width m-b-10 b-grey-transparent text-left" data-social="item">
                                    <a href="{{ url("survey/".$survey->id."/edit") }}"><div class="card-description p-t-5 p-b-5">
                                        <h4 class="no-margin fs-14"><i class="fa fa-pencil-square-o m-r-5"></i> Edit Design</h4>
                                    </div></a>
                                </div>
                            </div>
                            <div class="col-6 d-flex flex-column">
                                <div class="card social-card share full-width m-b-10 b-grey-transparent text-left" data-social="item">
                                    <a href="{{ url("survey/".$survey->id."/preview") }}"><div class="card-description p-t-5 p-b-5">
                                        <h4 class="no-margin fs-14"><i class="fa fa-eye-slash m-r-5"></i> Preview Survey</h4>
                                    </div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 padding-5">
                        <h4 class="m-b-5">Responses and Status</h4>
                        <div class="row m-t-20">
                            <div class="col-lg-4 col-sm-4 col-12 d-flex flex-column">
                                <div class="card social-card share unhover full-width m-b-10 b-grey-transparent text-left" data-social="item">
                                    <div class="card-header border-bottom-0 m-b-0 p-b-0">
                                        <h5 class="text-gray-dark fs-10 text-uppercase light no-margin">Total Response</h5>
                                    </div>
                                    <div class="card-description p-t-0  m-t-min-5 m-b-5">
                                        <h4 class="no-margin">0</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-12 d-flex flex-column">
                                <div class="card social-card share unhover full-width m-b-10 b-grey-transparent text-left" data-social="item">
                                    <div class="card-header border-bottom-0 m-b-0 p-b-0">
                                        <h5 class="text-gray-dark fs-10 text-uppercase light no-margin">Survey Status</h5>
                                    </div>
                                    <div class="card-description p-t-0  m-t-min-5 m-b-5">
                                        <h4 class="no-margin text-danger">DRAFT</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-12 d-flex flex-column">
                                <div class="card social-card share unhover full-width m-b-10 b-grey-transparent text-left" data-social="item">
                                    <div class="card-header border-bottom-0 m-b-0 p-b-0">
                                        <h5 class="text-gray-dark fs-10 text-uppercase light no-margin">Response Alert</h5>
                                    </div>
                                    <div class="card-description p-t-0  m-t-min-5 m-b-5">
                                        <h4 class="no-margin">Active</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="m-b-5">Collectors</h4>
                        <div class="row m-t-10">
                            <div class="col-12 d-flex flex-column">
                                <div class="card social-card share unhover full-width m-b-10 b-grey-transparent text-left" data-social="item">
                                    <div class="card-description text-center">
                                        <p class="m-t-10">No collectors added yet What is this?</p>
                                        <a href="#" class="btn btn-primary btn-xs bold all-caps m-t-5 m-b-10">Buy Response</a>
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

@endpush
