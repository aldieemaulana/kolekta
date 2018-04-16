@extends('templates.admin.frame')
@section('title', 'Kolekta : My Account')
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
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
            <div class="container sm-padding-20 padding-20 m-t-min-10">
                <div class="row m-t-20">
                    <div class="col-md-6 d-flex flex-column">
                        <div class="p-l-0 p-r-0">
                            <h4 class="m-b-10">Linked Accounts</h4>
                        </div>
                        <div class="card social-card share unhover full-width m-b-10 b-grey-transparent" data-social="item">
                            <div class="card-description">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="text-gray-dark fs-12 no-margin bold">Facebook</h5>
                                        <h4 class="no-margin fs-14 m-t-min-5"><a class="text-link text-primary fs-12 font-weight-normal">Link Account</a></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-gray-dark fs-12 no-margin bold">LinkedIn</h5>
                                        <h4 class="no-margin fs-14 m-t-min-5"><a class="text-link text-primary fs-12 font-weight-normal">Link Account</a></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-gray-dark fs-12 no-margin bold">Microsoft</h5>
                                        <h4 class="no-margin fs-14 m-t-min-5"><a class="text-link text-primary fs-12 font-weight-normal">Link Account</a></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-gray-dark fs-12 no-margin bold">Google</h5>
                                        <h4 class="no-margin fs-14 m-t-min-5"><a class="text-link text-primary fs-12 font-weight-normal">Link Account</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-t-10 p-l-0 p-r-0">
                            <h4 class="m-b-10">General Preferences <a class="pull-right m-t-5 text-link text-primary fs-12 m-l-5 font-weight-normal"><i class="fa fa-pencil"></i> Edit</a></h4>
                        </div>
                        <div class="card social-card share unhover full-width m-b-10 b-grey-transparent" data-social="item">
                            <div class="card-description">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="text-gray-dark fs-12 no-margin bold">Language</h5>
                                        <h4 class="no-margin fs-14 m-t-min-5">English</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-gray-dark fs-12 no-margin bold">Time Zone</h5>
                                        <h4 class="no-margin fs-11 m-t-min-5">(UTC-08:00) Pacific Time (US & Canada)</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-gray-dark fs-12 no-margin bold">Response Alerts</h5>
                                        <h4 class="no-margin fs-14 m-t-min-5"><b>ON</b> for existing surveys</h4>
                                        <h4 class="no-margin fs-14 m-t-min-10"><b>ON</b> for all new surveys</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-gray-dark fs-12 no-margin bold">Kolekta Newsletter</h5>
                                        <h4 class="no-margin fs-14 m-t-min-5">Subscribed</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-t-10 p-l-0 p-r-0">
                            <h4 class="m-b-10">Account Details</h4>
                        </div>
                        <div class="card social-card share unhover full-width m-b-10 b-grey-transparent" data-social="item">
                            <div class="card-description">
                                <a href="" class="pull-right btn btn-complete btn-xs bold fs-10 all-caps m-t-10">UPGRADE</a>
                                <h5 class="text-gray-dark fs-12 no-margin bold">Plan Type</h5>
                                <h4 class="no-margin fs-14 m-t-min-5">BASIC (Free) Account</h4>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex flex-column">
                        <div class="p-l-0 p-r-0">
                            <h4 class="m-b-10">Login Details <a href="{{ route('user.account.login.edit') }}" class="pull-right m-t-5 text-link text-primary fs-12 m-l-5 font-weight-normal"><i class="fa fa-pencil"></i> Edit</a></h4>
                        </div>
                        <div class="card social-card share unhover full-width m-b-10 b-grey-transparent" data-social="item">
                            <div class="card-description">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="text-gray-dark fs-12 no-margin bold">Name</h5>
                                        <h4 class="no-margin fs-14 m-t-min-5">{{ $user->name }}</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-gray-dark fs-12 no-margin bold">Password</h5>
                                        <h4 class="no-margin fs-11 m-t-min-5"><i class="fa fa-circle small"></i> <i class="fa fa-circle small"></i> <i class="fa fa-circle small"></i> <i class="fa fa-circle small"></i> <i class="fa fa-circle small"></i></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-gray-dark fs-12 no-margin bold">Email <a class="m-l-5 font-weight-normal text-danger fs-12">{{ (!$user->verified) ? 'Unverified' : '' }}</a></h5>
                                        <h4 class="no-margin fs-14 m-t-min-5">{{ $user->email }}</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-gray-dark fs-12 no-margin bold">Category</h5>
                                        <h4 class="no-margin fs-14 m-t-min-5">{{ $user->categoryDetail->name }}</h4>
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
