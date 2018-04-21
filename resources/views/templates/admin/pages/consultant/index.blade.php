@extends('templates.admin.frame')
@section('title', 'Kolekta : Consultant')
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
                        <li class="breadcrumb-item">
                            <a href="{{ url('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Consultant</li>
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
                                    <td class="text-center">Requested By</td>
                                    <td class="text-center">Status</td>
                                    <td class="text-center">Action</td>
                                </tr>
                                @foreach($request as $req)
                                <tr>
                                    <td>{{ $req->name }}</td>
                                    <td class="text-center">{{ $category[$req->survey_category] }}</td>
                                    <td>{{ $req->descriptions }}</td>
                                    <td class="text-center">{{ ucwords($req->type) }}</td>
                                    <td class="text-center">{{ $user[$req->user] }}</td>
                                    <td class="text-center">{{ ucwords($req->status) }}</td>
                                    <td class="text-center">
                                        @if($req->status == 'pending')
                                        <a class="btn btn-primary" href="#">Accept Request</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-12 fs-14 p-t-20 text-right">
                        All Surveys: 4 of 4
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection


@push("script")
    <script>
        function dropdownChange(str, obj, v) {
            $(obj).parents(".dropdown-menu").find("i.fa-check").remove();
            $(obj).find("h3").html(v + " <i class=\"fa fa-check fs-10\"></i>");
            $("#dropdown-button").html(str);
        }
    </script>
@endpush
