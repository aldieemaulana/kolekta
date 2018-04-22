@extends('templates.admin.frame')
@section('title', 'Kolekta : New Request')
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
                        <li class="breadcrumb-item">
                            <a href="{{ url('request-service') }}">Request Services</a>
                        </li>
                        <li class="breadcrumb-item">New</li>
                    </ol>
                </div>
            </div>
            <div class="container padding-20">
                <div class="card card-default">
                    <div class="card-block no-padding bg-primary p-l-15 p-r-15 p-t-5 p-b-5 card-button">
                        <h3 class="fs-16 all-caps font-weight-normal no-margin text-white">
                            New Request
                        </h3>
                    </div>
                    <div class="card-block">
                        <form class="form" method="post" action="store">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="name" required />
                            </div>
                            <div class="form-group">
                                <label>Survey Category</label>
                                <select class="form-control" name="survey_category" required>
                                    <option value=""> -- Choose Survey Category -- </option>
                                    @foreach($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Descriptions</label>
                                <textarea class="form-control" style="height:auto" rows="4" name="descriptions" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" name="type" required>
                                    <option value=""> -- Choose Type -- </option>
                                    <option value="public">Public</option>
                                    <option value="targeting">Targeting</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push("script")
    <script>
        $('select').select2();
    </script>
@endpush