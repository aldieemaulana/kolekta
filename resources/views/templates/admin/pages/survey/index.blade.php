@extends('templates.admin.frame')
@section('title', 'Kolekta : My Survey')
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
                        <li class="breadcrumb-item active">Survey</li>
                    </ol>
                </div>
            </div>
            <div class="container sm-padding-20 padding-20 m-t-min-10">
                <div class="row m-t-35">
                    <div class="col-lg-12">
                        <div class="dropdown dropdown-default m-b-10">
                            <button class="btn btn-secondary btn-lg dropdown-toggle dropdown-custom fs-15" id="dropdown-button" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 200px;">
                                All Surveys
                            </button>
                            <div class="dropdown-menu dropdown-custom" style="width: 200px;">
                                <a class="dropdown-item" onclick="dropdownChange('Helvetica', this, 20)"><h3>20</h3> Helvetica</a>
                                <a class="dropdown-item" onclick="dropdownChange('Segeo', this, 1)" id="1111"><h3>1</h3> Segeo</a>
                                <a class="dropdown-item" onclick="dropdownChange('Roboto', this, 2)"><h3>2</h3> Roboto </a>
                                <a class="dropdown-item" onclick="dropdownChange('Arial', this, 0)"><h3>0</h3> Arial</a>
                                <a class="dropdown-item" onclick="dropdownChange('Calibri', this, 0)"><h3>0</h3> Calibri </a>
                                <a class="dropdown-item" onclick="dropdownChange('Comics', this, 0)"><h3>0</h3> Comics</a>
                            </div>
                        </div>
                        <button class="btn btn-secondary btn-lg fs-15" type="button" data-toggle="tooltip" data-placement="bottom" data-html="true"
                                title="Organize Your Survey">
                            <i class="fa fa-folder-o"></i>
                        </button>
                        <div class="table-responsive">
                            <table class="table table-default">
                                <tr>
                                    <td width="350px" class="p-l-20">Title</td>
                                    <td width="120px" class="text-center">Modified</td>
                                    <td width="120px" class="text-center">Responses</td>
                                    <td width="100px" class="text-center">Design</td>
                                    <td width="100px" class="text-center">Collect</td>
                                    <td width="100px" class="text-center">Share</td>
                                    <td width="100px" class="text-center">Remove</td>
                                </tr>
                                @foreach($surveys as $survey)
                                <tr>
                                    <td class="p-l-20 p-t-25 p-r-10 fs-12">
                                        <a href="#" class="btn-link text-primary font-weight-bold fs-14 p-b-5">{{ $survey->name }}</a>
                                        <p class="fs-12 p-t-5">Created {{ date('d, M y H:i', strtotime($survey->created_at)) }}</p>
                                    </td>
                                    <td class="text-center p-l-5 p-r-5 p-t-40">{{ date('d, M y H:i', strtotime($survey->updated_at)) }}</td>
                                    <td class="text-center padding-25 p-t-40">0</td>
                                    <td class="padding-20 p-t-35">
                                        <a href="{{ url('survey/'.$survey->id.'/edit') }}"><button class="btn btn-default no-border w-100" type="button" data-toggle="tooltip" data-placement="bottom" data-html="true"
                                                title="Design Your Survey"><span class="p-t-20 p-b-20"><i class="fa fa-pencil fs-16"></i></span></button></a>
                                    </td>
                                    <td class="padding-20 p-t-35">
                                        <button class="btn btn-default no-border w-100" type="button" data-toggle="tooltip" data-placement="bottom" data-html="true"
                                                title="Collect Responses"><span class="p-t-20 p-b-20"><i class="fa fa-send fs-15"></i></span></button>
                                    </td>
                                    <td class="padding-20 p-t-35">
                                        <button class="btn btn-default no-border w-100" type="button" data-toggle="tooltip" data-placement="bottom" data-html="true"
                                                title="Share Your Survey"><span class="p-t-20 p-b-20"><i class="fa fa-share-alt fs-15"></i></span></button>
                                    </td>
                                    <td class="padding-20 p-t-35">
                                        <button class="btn btn-default no-border w-100" type="button" data-toggle="tooltip" data-placement="bottom" data-html="true"
                                                title="Delete Entire Survey"><span class="p-t-20 p-b-20"><i class="fa fa-trash fs-15"></i></span></button>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="panel-whitesmoke text-right">
                            <a href="{{ url('survey/create') }}" class="btn btn-primary btn-md bold all-caps fs-13 pull-left"><i class="fa fa-plus"></i> Create Survey</a>
                            <div class="clearfix"></div>
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
