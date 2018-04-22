@extends('templates.admin.frame')
@section('title', 'Kolekta : Change Account Detail')
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
                        <li class="breadcrumb-item"><a href="{{ route('user.account') }}">User</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
            <div class="container sm-padding-20 padding-20 m-t-min-10">
                <div class="row m-t-20">
                    <div class="col-md-8">
                        <div class="card card-default b-rad-sm background-transparent">
                            <div class="card-block no-padding">


                                {!! Form::model($user, [
                                  'method' => 'PATCH',
                                  'url' => ['/user/account/detail/edit'],
                                  'files' => true,
                                  'id' => 'formValidate',
                                  'class' => '',
                                ]) !!}
                                <div class="p-l-0 p-r-0">
                                    <h4 class="m-b-10">Information</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default {{ $errors->has('name') ? ' error' : '' }}">
                                            <label>Full Name</label>
                                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => "John Maulana"]) !!}
                                        </div>
                                        @if ($errors->has('name'))
                                            <label class="error small-text">
                                                {{ $errors->first('name') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default {{ $errors->has('email') ? ' error' : '' }}">
                                            <label>Email</label>
                                            {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => "Mail Identify"]) !!}
                                        </div>
                                        @if ($errors->has('email'))
                                            <label class="error small-text">
                                                {{ $errors->first('email') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>

                                <div class="m-t-10 p-l-0 p-r-0">
                                    <h4 class="m-b-10">Change Password</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default {{ $errors->has('password') ? ' error' : '' }}">
                                            <label>Password</label> <input class="form-control" name="password" placeholder="Minimum of 6 Characters" type="password">
                                        </div>
                                        @if ($errors->has('password'))
                                            <label class="error small-text">
                                                {{ $errors->first('password') }}
                                            </label>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Confirm Password</label> <input class="form-control" name="password_confirmation" placeholder="Minimum of 6 Characters" type="password">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-t-10 p-l-0 p-r-0">
                                    <h4 class="m-b-10">Change Category</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default form-group-default-select2 {{ $errors->has('password') ? ' error' : '' }}">
                                            <label>Category</label>
                                            {{ Form::select('category', $categories, $user->category, ["class" => "full-width", "id" => "category", "data-init-plugin" => "select2", "required"]) }}
                                        </div>
                                        @if ($errors->has('category'))
                                            <label class="error small-text">
                                                {{ $errors->first('category') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>

                                <a href="{{ url('user/account') }}" class="btn btn-outline-info m-t-20 m-r-5 btn-flat fs-12">CANCEL</a>
                                <button class="btn btn-primary m-t-20 bold all-caps fs-12" type="submit"><i class="fa fa-check"></i> Update account</button>

                                {!! Form::close() !!}
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
