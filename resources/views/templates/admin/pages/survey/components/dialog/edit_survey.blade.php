<div class="modal fade stick-up" id="modalStickUpEditSurvey" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                    </button>
                    <h5>Edit Detail Survey</h5>
                    <input type="hidden" id="selectedSurveyId" value="{{ $survey->id }}"/>
                </div>
                <div class="modal-body p-t-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default {{ $errors->has('name_survey') ? ' error' : '' }}">
                                <label>Name</label>
                                {!! Form::text('name_survey', $survey->name, ['class' => 'form-control', 'id' => 'selectedSurveyName', 'placeholder' => ""]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default {{ $errors->has('description_survey') ? ' error' : '' }}">
                                <label>Description</label>
                                {!! Form::text('description_survey', $survey->description, ['class' => 'form-control', 'id' => 'selectedSurveyDescription', 'placeholder' => ""]) !!}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-cons  pull-left inline" onclick="updateSurvey()">Save</button>
                    <button type="button" class="btn btn-default btn-cons no-margin pull-left inline" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>

    </div>
</div>