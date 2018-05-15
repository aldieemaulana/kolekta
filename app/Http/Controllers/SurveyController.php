<?php

namespace Kolekta\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kolekta\Answer;
use Kolekta\Question;
use Kolekta\Survey;
use Kolekta\Paged;
use Kolekta\Logic;

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
        $surveys = Survey::whereUser(Auth::User()->id)->paginate(25);
        return view('templates.admin.pages.survey.index', compact('surveys'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datas = '{
            "survey": {
                "name": "Survey Title",
                "user": '.Auth::User()->id.',
                "description": "",
                "open_time": "2018-04-01 00:00:00",
                "close_time": "2018-05-31 00:00:00",
                "public": 1
            },
            "pages": [
                {
                    "name": "P1",
                    "description": ""
                },
                {
                    "name": "P2",
                    "description": ""
                }
            ],
            "datas": [
                {
                    "page": 1,
                    "position": 1,
                    "unique": "0m11n5stjq",
                    "question": "Do you currently have a working mobile or cell phone, or not?",
                    "type": 1,  
                    "add_other": 0,  
                    "required": 0,  
                    "answer": [
                        {
                            "answer": "Yes, I do",
                            "point": 0,
                            "correct": false,
                            "logic": [
                                {
                                    "skip_to": "",
                                    "skip_to_question": ""
                                }
                            ]
                        },
                        {
                            "answer": "No, I do not",
                            "point": 0,
                            "correct": false,
                            "logic": [
                                {
                                    "skip_to": "",
                                    "skip_to_question": ""
                                }
                            ]
                        }
                    ]
                },{
                    "page": 1,
                    "position": 2,
                    "unique": "0m21n5s1jq",
                    "question": "Which of the following mobile or cell phone service providers do you use? (Please select all that apply.)",
                    "type": 2,  
                    "add_other": 0,  
                    "required": 0,  
                    "answer": [
                        {
                            "answer": "AT&T",
                            "point": 0,
                            "correct": false,
                            "logic": [
                                {
                                    "skip_to": "",
                                    "skip_to_question": ""
                                }
                            ]
                        },
                        {
                            "answer": "Boost Mobile",
                            "point": 0,
                            "correct": false,
                            "logic": [
                                {
                                    "skip_to": "",
                                    "skip_to_question": ""
                                }
                            ]
                        },
                        {
                            "answer": "Cricket",
                            "point": 0,
                            "correct": false,
                            "logic": [
                                {
                                    "skip_to": "",
                                    "skip_to_question": ""
                                }
                            ]
                        },
                        {
                            "answer": "MetroPCS",
                            "point": 0,
                            "correct": false,
                            "logic": [
                                {
                                    "skip_to": "",
                                    "skip_to_question": ""
                                }
                            ]
                        },
                        {
                            "answer": "Sprint",
                            "point": 0,
                            "correct": false,
                            "logic": [
                                {
                                    "skip_to": "",
                                    "skip_to_question": ""
                                }
                            ]
                        }
                    ]
                }
            ]
        }';

        $datas = (json_decode($datas));

        $survey_result = array();
        foreach ($datas as $index => $data) {
            if($index == "survey") {
                $survey = [];
                foreach ($data as $key => $value) {
                    $survey[$key] = $value;
                }
                $survey_result = Survey::create($survey);
            }else if($index == "pages"){
                foreach ($data as $key => $value) {
                    $page = [];
                    foreach ($value as $x => $y) {
                        if($x == "name") {
                            $page["survey"] = $survey_result->id;
                        }
                        $page[$x] = $y;
                    }

                    Paged::create($page);
                }
            }else{
                foreach ($data as $data) {
                    $questions = [];
                    foreach ($data as $key => $value) {
                        if(count($value) == 1) {
                            $questions[$key] = $value;
                        }else{
                            $question = Question::create($questions);
                            foreach ($value as $item) {
                                $answers = [];
                                $answers["question"] = $question->id;
                                foreach ($item as $x => $u) {
                                    if($x != "logic") {
                                        $answers[$x] = ($u);
                                    }else{
                                        $answer = Answer::create($answers);
                                        $logics = [];
                                        $logics["answer"] = $answer->id;
                                        foreach ($u as $y => $i) {
                                            $logics[$y] = ($i);
                                        }
                                        Logic::create($logics);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

    }

    public function edit($id) {
        $survey = Survey::findOrFail($id);
        $builders = ["Multiple Choice", "Checkboxes", "Dropdown", "Star Rating", "Matrix / Rating Scale", "File Upload", "Rangking", "Image Choice", "Slider", "Single Textbox", "Multiple Textboxes", "Comment Box", "Date / Time", "Text", "Image"];
        $options = ["Required Asterisks", "Question Numbers", "Logo", "Quiz", "One Question at a Time", "Survey Title", "Footer"];
        return view('templates.admin.pages.survey.edit', compact('survey', 'builders', 'options'));
    }

}
