<?php

namespace Kolekta\Http\Controllers\Api;

use Kolekta\Answer;
use Kolekta\Logic;
use Kolekta\Paged;
use Kolekta\Question;
use DB;
use Kolekta\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kolekta\Survey;
use Auth;

class SurveyController extends Controller
{

    /**
     * @return Question
     */
    public function updateOption($id, $option)
    {
        $information = Survey::findOrFail($id);
        $detchange[$option] = !$information[$option];

        $information->update($detchange);


        $data['message'] = "Success";
        $data['status'] = 200;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function updateSurvey(Request $request)
    {
        $information = Survey::findOrFail($request->id);

        $information->update($request->except(['id']));


        $data['message'] = "Success";
        $data['status'] = 200;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function createSurvey(Request $request)
    {
        $request["open_time"] = Date("Y-m-d H:i:s");
        $information = Survey::create($request->except(['id']));

        $page["name"] = "P" . $request->position;
        $page["position"] = $request->position;
        $page["survey"] = $information->id;
        Paged::create($page);

        $data['message'] = "Success";
        $data['status'] = 200;
        $data['data'] = $information;

        return response()->json($data, 200);
    }

    public function removeSurvey($id)
    {
        $information = Survey::findOrFail($id);

        $pages = $information->pages;
        foreach ($pages as $page) {
            foreach ($page->questions as $question) {
                $answers = $question->answers;
                foreach ($answers as $answer) {
                    $answer->logics()->delete();
                }

                $question->answers()->delete();
            }
            $page->questions()->delete();
        }

        $information->pages()->delete();
        $information->delete();

        $data['message'] = "Success";
        $data['status'] = 200;

        return response()->json($data, 200);
    }

}