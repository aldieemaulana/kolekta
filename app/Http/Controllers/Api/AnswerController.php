<?php

namespace Kolekta\Http\Controllers\Api;

use Kolekta\Answer;
use Kolekta\Question;
use DB;
use Kolekta\Http\Controllers\Controller;

class AnswerController extends Controller
{

    /**
     * @return Question
     */
    public function removeAnswer($id)
    {
        $information = Answer::findOrFail($id);
        $information->logics()->delete();
        $information->delete();


        $data['message'] = "Success";
        $data['status'] = 200;

        return response()->json($data, 200);
    }
}