@extends('templates.admin.frame')
@section('title', 'Kolekta : Request Services')
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
                        <li class="breadcrumb-item active">Request Services</li>
                    </ol>
                </div>
            </div>
            <div class="container sm-padding-20 padding-20 m-t-min-10">
                <div class="row m-t-35">
                    <div class="col-lg-12">
                        <div class="dropdown dropdown-default m-b-10">
                            <button class="btn btn-secondary btn-lg dropdown-toggle dropdown-custom fs-15" id="dropdown-button" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 200px;">
                                All Requests
                            </button>
                            <div class="dropdown-menu dropdown-custom" style="width: 200px;">
                                <a class="dropdown-item">Pending Request</a>
                                <a class="dropdown-item">Doing Request</a>
                                <a class="dropdown-item">Done Request</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-default">
                                <tr>
                                    <td width="25%" class="p-l-20">Title</td>
                                    <td class="text-center">Category</td>
                                    <td width="30%" class="text-center">Descriptions</td>
                                    <td class="text-center">Type</td>
                                    <td class="text-center">Status</td>
                                </tr>
                                @foreach($request as $req)
                                <tr>
                                    <td>{{ $req->name }}</td>
                                    <td class="text-center">{{ $category[$req->survey_category] }}</td>
                                    <td>{{ $req->descriptions }}</td>
                                    <td class="text-center">{{ ucwords($req->type) }}</td>
                                    <td class="text-center">{{ ucwords($req->status) }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="panel-whitesmoke text-right">
                            <a href="{{ url('request-service/create') }}" class="btn btn-primary btn-md bold all-caps fs-13 pull-left"><i class="fa fa-plus"></i> Create Request</a>
                            <div class="clearfix"></div>
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