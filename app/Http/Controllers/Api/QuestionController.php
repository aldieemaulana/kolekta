<?php

namespace Kolekta\Http\Controllers\Api;

use Kolekta\Question;
use DB;
use Kolekta\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kolekta\Survey;
use Kolekta\Paged;
use Kolekta\Logic;
use Kolekta\Answer;
use Kolekta\Type;

class QuestionController extends Controller
{

    /**
     * @return Question
    */
    public function getDetail($id)
    {
        $information = Question::with('typed', 'answers', 'answers.logics', 'paged.pages', 'paged.pages.questions')->findOrFail($id);

        $data['message'] = "Success";
        $data['status'] = 200;
        $data['data'] = $information;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function updateQuestion($id, Request $request)
    {
        $information = Question::findOrFail($id);
        $information->update($request->all());

        $data['message'] = "Success";
        $data['status'] = 200;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function updateQuestionRequired($id, Request $request)
    {
        $information = Question::findOrFail($id);
        $information->update(["required" => $request->required]);

        $data['message'] = "Success";
        $data['status'] = 200;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function updateQuestionPosition($id, Request $request)
    {
        $information = Question::findOrFail($id);
        $old_position = $information->position;
        $old_page = $information->page;

        if($request->question > 0) {
            $selectedQuestion = Question::findOrFail($request->question);

            if ($request->page != $old_page) {
                $position = $selectedQuestion->position;
                if($request->pos == "after") {
                    Question::wherePage($selectedQuestion->page)
                        ->where('position', '>', $selectedQuestion->position)
                        ->increment('position');
                    $position += 1;
                }else if($request->pos == "before") {
                    Question::wherePage($selectedQuestion->page)
                        ->where('position', '>=', $selectedQuestion->position)
                        ->increment('position');
                }

                $information->update(["page" => $selectedQuestion->page, "position" => $position]);
            }else{
                $position = $selectedQuestion->position;
                if($request->pos == "after") {
                    Question::wherePage($selectedQuestion->page)
                        ->where('position', '>=', $selectedQuestion->position + 1)
                        ->increment('position');
                    $position += 1;
                }else if($request->pos == "before") {
                    Question::wherePage($selectedQuestion->page)
                        ->where('position', '>=', $selectedQuestion->position)
                        ->increment('position');
                }

                $information->update(["page" => $selectedQuestion->page, "position" => $position]);
            }
        }else{
            Question::wherePage($request->page)
                ->where('position', '>=', 1)
                ->increment('position');
            $information->update(["page" => $request->page, "position" => 1]);
        }

        if ($request->page != $old_page) {
            Question::wherePage($old_page)
                ->where('position', '>', $old_position)
                ->decrement('position');
        }

        $data['message'] = "Success";
        $data['status'] = 200;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function storeDetail(Request $request)
    {
        $question = Question::wherePage($request->page)->count() + 1;
        $type = Type::whereName($request->type)->first();
        $empty_data = '{
                    "page": '.$request->page.',
                    "position": '.$question.',
                    "unique": "'.$this->generateRandomString(10).'",
                    "question": "",
                    "type": '.$type->id.',  
                    "add_other": 0,  
                    "required": 0,  
                    "answer": {
                        "answer": "",
                        "point": 0,
                        "position": 1,
                        "correct": false,
                        "logic": {
                            "skip_to": null,
                            "skip_to_question": null,
                            "unique_state": null
                        }
                    }
                }';

        $data = (json_decode($empty_data));


        $questions = [];
        $question = [];
        foreach ($data as $key => $value) {
            if($key != "answer") {
                $questions[$key] = $value;
            }else{
                $question = Question::create($questions);
                if($question) {
                    $answers = [];
                    $answers["question"] = $question->id;
                    foreach ($value as $x => $item) {
                        if($x != "logic") {
                            $answers[$x] = ($item);
                        }else{
                            $answer = Answer::create($answers);
                            if($answer) {
                                $logics = [];
                                $logics["answer"] = $answer->id;
                                foreach ($item as $y => $i) {
                                    $logics[$y] = ($i);
                                }
                                Logic::create($logics);
                            }
                        }
                    }
                }
            }
        }

        $information = Question::with('typed', 'answers', 'answers.logics', 'paged.pages', 'paged.pages.questions')->findOrFail($question->id);

        $response['message'] = "Success";
        $response['status'] = 200;
        $response['data'] = $information;

        return response()->json($response, 200);
    }

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    /**
     * @return Question
     */
    public function removeQuestion($id)
    {
        $information = Question::findOrFail($id);

        Question::wherePage($information->page)
            ->where('position', '>', $information->position)
            ->decrement('position');

        $answers = $information->answers;
        foreach ($answers as $answer) {
            $answer->logics()->delete();
        }

        $information->answers()->delete();
        $information->delete();

        return $information;


        $data['message'] = "Success";
        $data['status'] = 200;

        return response()->json($data, 200);
    }

}