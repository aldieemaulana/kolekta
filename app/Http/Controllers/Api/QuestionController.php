<?php

namespace Kolekta\Http\Controllers\Api;

use Kolekta\Question;
use DB;
use Kolekta\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
                if($request->pos == "after") {
                    Question::wherePage($selectedQuestion->page)
                        ->where('position', '>', $information->position)
                        ->decrement('position');
                }else if($request->pos == "before") {
                    Question::wherePage($selectedQuestion->page)
                        ->where('position', '<=', $selectedQuestion->position)
                        ->increment('position');
                }

                $information->update(["page" => $selectedQuestion->page, "position" => $selectedQuestion->position]);
            }
        }else{
            Question::wherePage($request->page)
                ->where('position', '>', 1)
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

}