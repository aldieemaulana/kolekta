
<input type="hidden" id="asterikIs" value="{{ $survey->required_asterik }}"/>
<input type="hidden" id="numberIs" value="{{ $survey->question_number }}"/>
<input type="hidden" id="activeForm"/>
<input type="hidden" id="activeCurrent"/>
<input type="hidden" value="{{ url("/") }}" id="datbaseurl"/>

<div class="hidden">
    <div id="tabDynamic">
        <div class="special-cover hidden"></div>
        <div id="tabHeader">
            <ul class="nav nav-tabs nav-tabs-simple hidden-sm-down bg-white" role="tablist" data-init-reponsive-tabs="dropdownfx">
                <li class="nav-item">
                    <a class="active" data-toggle="tab" role="tab" data-target="#tabEdit" href="#" aria-expanded="true">Edit</a>
                </li>
                <li class="nav-item">
                    <a href="#" data-toggle="tab" role="tab" data-target="#tabLogic" class="" aria-expanded="false">Logic</a>
                </li>
                <li class="nav-item">
                    <a href="#" data-toggle="tab" role="tab" data-target="#tabMove" class="" aria-expanded="false">Move</a>
                </li>
            </ul>
        </div>
        <div class="tab-content padding-10">
            <div class="tab-pane active p-l-5 p-r-5" id="tabEdit" aria-expanded="true">
                <form class="form m-t-10" onsubmit="return false;">
                    <label id="questionLabel"></label>
                    <input type="hidden" class="hidden" value="" id="questionId"/>
                    <div class="input-group transparent">
                        <input type="text" class="form-control" value="" id="questionInput"/>
                        <div class="input-group-append hidden" id="questionButton">
                            <button type="button" onclick="updateQuestion()" class="btn btn-primary w-100 btn-flat"><i class="fa fa-check"></i></button>
                        </div>
                    </div>
                    <hr/>
                    <div class="dd m-t-min-10 m-b-min-10" id="answerList">
                        <ol class="dd-list">

                        </ol>
                    </div>

                    <hr/>
                    <div class="row m-b-10">
                        <div class="col-12 no-padding">
                            <div class="checkbox check-primary no-padding no-margin">
                                <input type="checkbox" value="1" id="sc2">
                                <label for="sc2">Require an Answer to This Question</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane p-l-5 p-r-5" id="tabLogic" aria-expanded="false">
                <form class="form m-t-10" onsubmit="return false;">
                    <div class="row m-b-10">
                        <div class="col-3 no-padding fs-13">
                            If answer is ..
                        </div>
                        <div class="col-6 no-padding fs-13">
                            Then skip to ..
                        </div>
                        <div class="col-3 no-padding text-right fs-13">

                        </div>
                    </div>
                    <hr/>
                    <div id="logicList">

                    </div>
                </form>
            </div>
            <div class="tab-pane p-l-5 p-r-5" id="tabMove" aria-expanded="false">
                <form class="form m-t-10" onsubmit="return false;">
                    <div class="row m-b-10">
                        <div class="col-12 no-padding fs-13">
                            Move this question to ..
                        </div>
                    </div>
                    <hr/>
                    <div class="row m-b-10">
                        <div class="col-3 no-padding fs-13">
                            <div id="moveSelectPage"></div>
                        </div>
                        <div class="col-3 no-padding fs-13">
                            <div id="moveSelectPosition"></div>
                        </div>
                        <div class="col-6 no-padding fs-13">
                            <div class="input-group" id="moveSelectQuestion"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="tabFooter">
            <div class="row bg-white p-b-15 p-t-15">
                <div class="col-4">

                </div>
                <div class="col-8 text-right">
                    <button class="btn btn-xs btn-outline-info btn-flat" onclick="closeQuestion()">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
    <div id="positionDynamic">
        <div class="special-cover hidden"></div>
        <div class="tab-content padding-10">
            <div class="tab-pane active p-l-5 p-r-5 p-b-10" aria-expanded="true">
                <form class="form m-t-10" onsubmit="return false;">
                    <input type="hidden" class="hidden" value="" id="pageId"/>
                    <label class="fs-13">Move this page to</label><br>
                    <div class="row m-b-10">
                        <div class="col-3 no-padding fs-13">
                            <select class="select2 full-width" id="pageMovePosition">
                                <option value="after">After</option>
                                <option value="before">Before</option>
                            </select>
                        </div>
                        <div class="col-6 no-padding fs-13" id="pageMoveList">

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="tabFooter">
            <div class="row bg-white p-b-15 p-t-15">
                <div class="col-12 text-right">
                    <button class="btn btn-xs btn-outline-info btn-flat" onclick="closeTitle()">CLOSE</button>
                    <button class="btn btn-xs btn-primary btn-flat" id="moveButtonAction">SAVE</button>
                </div>
            </div>
        </div>
    </div>
    <div id="titleDynamic">
        <div class="special-cover hidden"></div>
        <div class="tab-content padding-10">
            <div class="tab-pane active p-l-5 p-r-5 p-b-10" aria-expanded="true">
                <form class="form m-t-10" onsubmit="return false;">
                    <input type="hidden" class="hidden" value="" id="pageId"/>
                    <label class="fs-13">Page Title</label>
                    <input type="text" class="form-control" value="" id="pageTitle"/>
                    <small class="p-t-5">You're good up to 250 characters.</small> </br></br>
                    <label class="fs-13">Page Description</label>
                    <div class="answer">
                        <textarea class="form-control text" rows="4" id="pageDescription"></textarea>
                    </div>
                </form>
            </div>
        </div>
        <div id="tabFooter">
            <div class="row bg-white p-b-15 p-t-15">
                <div class="col-12 text-right">
                    <button class="btn btn-xs btn-outline-info btn-flat" onclick="closeTitle()">CLOSE</button>
                    <button class="btn btn-xs btn-primary btn-flat" onclick="updateTitle()">SAVE</button>
                </div>
            </div>
        </div>
    </div>

    <div id="questionDynamic">
        <a class="btn btn-danger btn-edit btn-meuh btn-xs" id="questionDelete"><i class="fa fa-trash"></i></a>
        <a class="btn btn-info btn-edit btn-meuh btn-xs" id="questionEdit"><i class="fa fa-pencil"></i></a>
        <h4 class="question" id="questionAsk">-</h4>
        <div class="answer" id="questionAnswer">

        </div>
    </div>

    <div id="pageDynamic">
        <a class="btn btn-info btn-edit btn-meuh btn-xs" id="titleEdit"><i class="fa fa-pencil"></i></a>
        <a class="btn btn-danger btn-edit btn-meuh btn-xs" id="titleDelete"><i class="fa fa-trash"></i></a>
        <a class="btn btn-warning btn-edit btn-meuh btn-xs m-l-10" id="titleMove">MOVE</a>
        <small class="pull-right m-t-10 text-white" id="pageDescriptionShow"></small>
        <h3 class="fs-16 all-caps font-weight-normal no-margin text-white" id="pageTitleShow">
            {{ $page->name }}
        </h3>
    </div>

</div>