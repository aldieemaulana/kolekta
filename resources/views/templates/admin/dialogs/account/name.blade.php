<div class="modal fade slide-up disable-scroll" data-keyboard="true" id="modalAccountName" tabindex="-1" role="dialog" aria-labelledby="modalSlideUp" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-header clearfix text-left b-b b-grey p-b-10">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-content="close">
                        <i class="pg-close fs-18"></i>
                    </button>
                    <div class="panel-title bold text-uppercase fs-12">Change your name</div>
                    <p class="fs-12">We respect your privacy</p>
                </div>
                <form action="{{ url('') }}" id="saveSatuan">
                    <div class="modal-body panel-whitesmoke p-t-25 p-b-25">
                        <div class="form-group-attached">
                            <div class="row">
                                <div class="col-12">
                                    <div aria-required="true" class="form-group form-group-default {{ $errors->has('name') ? 'has-error' : ''}}">
                                        {!! Form::label('name', "name") !!}
                                        {!! Form::text('name', Auth::User()->name, ['class' => 'form-control input-md', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer clearfix text-left b-b b-grey p-t-15 p-b-15">
                        <button class="btn btn-default btn-sm p-l-30 p-r-30 m-r-10" type="reset">RESET</button>
                        {!! Form::submit('CHANGE NAME', ['type' => 'submit', 'class' => 'btn btn-primary bold al-caps btn-sm p-l-30 p-r-30']) !!}
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@push('script')
    <script>
        $("#saveSatuan").submit(function(e) {
            var formURL = $(this).attr("action");
            var formData = new FormData(this);

            $.ajax({
                url: formURL,
                type: 'POST',
                data:  formData,
                mimeType:"multipart/form-data",
                contentType: false,
                cache: false,
                processData:false,
                success: function(data, textStatus, jqXHR) {
                    $("#saveSatuan").trigger('reset');
                    $('#modalAccountName').modal('hide');
                    $('.page-container').pgNotification({
                        style: "circle",
                        title: "Info",
                        message: "Your name has been saved",
                        position: "bottom-right",
                        timeout: 4000,
                        type: "info",
                        thumbnail: '<div class="circle-notification"><i class="fa fa-info-circle"></i></div>'
                    }).show();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#modalAccountName').modal('hide');
                    $('.page-container').pgNotification({
                        style: "circle",
                        title: "Warning",
                        message: "Failed to change your name",
                        position: "bottom-right",
                        timeout: 4000,
                        type: "danger",
                        thumbnail: '<div class="circle-notification"><i class="fa fa-info-circle"></i></div>'
                    }).show();
                }
            });

            e.preventDefault();
        });
    </script>
@endpush