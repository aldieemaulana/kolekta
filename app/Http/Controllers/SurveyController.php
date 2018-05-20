<?php

namespace Kolekta\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kolekta\Answer;
use Kolekta\Question;
use Kolekta\Survey;
use Kolekta\Paged;
use Kolekta\Logic;
use Kolekta\Type;

class SurveyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $surveys = Survey::whereUser(Auth::User()->id)->paginate(2);
        return view('templates.admin.pages.survey.index', compact('surveys'));
    }

    public function show($id) {
        $survey = Survey::with("pages", "pages.questions")->findOrFail($id);

        $questions = 0;
        foreach($survey->pages as $page){
            $questions += count($page->questions);
        }
        return view('templates.admin.pages.survey.show', compact('survey', 'questions'));
    }

    public function edit($id) {
        $survey = Survey::findOrFail($id);
        $pages = Paged::whereSurvey($id)->pluck("name", "id");
        $builders = Type::pluck('name');
        $options = [
            [
                "name" => "Required Asterisks",
                "id" => "required_asterik"
            ],
            [
                "name" => "Question Numbers",
                "id" => "question_number"
            ],
            [
                "name" => "Public",
                "id" => "public"
            ]];
        return view('templates.admin.pages.survey.edit', compact('survey', 'builders', 'options', 'pages'));
    }

}
