<?php

namespace Kolekta\Http\Controllers\Api;

use Kolekta\Paged;
use Kolekta\Question;
use DB;
use Kolekta\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{

    /**
     * @return Question
     */
    public function getDetail($id)
    {
        $information = Paged::with('pages')->findOrFail($id);

        $data['message'] = "Success";
        $data['status'] = 200;
        $data['data'] = $information;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function updateDetail($id, Request $request)
    {
        $information = Paged::findOrFail($id);
        $information->update($request->all());

        $data['message'] = "Success";
        $data['status'] = 200;
        $data['title'] = $information->id;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function updatePosition($id, Request $request)
    {
        $information = Paged::findOrFail($id);
        $selectedQuestion = Paged::findOrFail($request->page);

        $position = $selectedQuestion->position;
        if($request->pos == "after") {
            Paged::whereSurvey($information->survey)
                ->where('id', '!=', $id)
                ->where('position', '<=', $selectedQuestion->position)
                ->decrement('position');
        }else if($request->pos == "before") {
            Paged::whereSurvey($information->survey)
                ->where('id', '!=', $id)
                ->where('position', '>=', $selectedQuestion->position)
                ->increment('position');
        }

        $information->update(["position" => $position]);

        $data['message'] = "Success";
        $data['status'] = 200;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function store(Request $request)
    {
        $page["name"] = "P" . $request->position;
        $page["position"] = $request->position;
        $page["survey"] = $request->survey;
        Paged::create($page);

        $data['message'] = "Success";
        $data['status'] = 200;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function removePage($id)
    {
        $information = Paged::findOrFail($id);

        Paged::whereSurvey($information->survey)
            ->where('position', '>', $information->position)
            ->decrement('position');

        $questions = $information->questions;
        foreach ($questions as $question) {
            $answers = $question->answers;
            foreach ($answers as $answer) {
                $answer->logics()->delete();
            }

            $question->answers()->delete();
        }

        $information->questions()->delete();
        $information->delete();

        $data['message'] = "Success";
        $data['status'] = 200;

        return response()->json($data, 200);
    }
}