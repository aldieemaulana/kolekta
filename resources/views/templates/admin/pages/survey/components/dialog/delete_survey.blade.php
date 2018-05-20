<div class="modal fade stick-up" id="modalStickUpDeleteSurvey" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                    </button>
                    <input type="hidden" id="selectedSurveyIdDelete"/>
                </div>
                <div class="modal-body p-t-10 whitsmoke">
                    <div class="row">
                        <div class="col-md-12">
                        <h4 class="m-b-0 fs-10 text-black bold">Are you sure you want to delete this survey?</h4>
                        <p class="p-0 error alert fs-15">This is a permanent action and cannot be undone.</p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer p-t-25">
                    <button type="button" class="btn btn-danger btn-cons  pull-left inline" onclick="dropSurvey()">Delete</button>
                    <button type="button" class="btn btn-default btn-cons no-margin pull-left inline" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>

    </div>
</div>