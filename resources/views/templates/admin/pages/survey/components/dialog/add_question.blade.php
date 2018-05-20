<div class="modal fade stick-up" id="modalStickUpAddQuestion" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                    </button>
                    <h5>Add New Question</h5>
                    <input type="hidden" id="selectedTypeDialog"/>
                    <input type="hidden" id="selectedPageDialog"/>
                </div>
                <div class="modal-body p-t-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default form-group-default-select2 {{ $errors->has('password') ? ' error' : '' }}">
                                <label>Choose a page</label>
                                {{ Form::select('category', $pages, null, ["class" => "full-width", "id" => "pageListDialog"]) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-cons  pull-left inline" onclick="selectedQuestion()">Add</button>
                    <button type="button" class="btn btn-default btn-cons no-margin pull-left inline" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>

    </div>
</div>