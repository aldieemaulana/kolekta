<?php

namespace Kolekta\Http\Controllers\Api;

use Kolekta\Question;
use DB;
use Kolekta\Http\Controllers\Controller;

class QuestionController extends Controller
{

    /**
     * @return Question
     */
    public function getDetail($id)
    {
        $information = Question::with('typed', 'answers', 'answers.logics')->findOrFail($id);

        $data['message'] = "Success";
        $data['status'] = 200;
        $data['data'] = $information;

        return response()->json($data, 200);
    }
}