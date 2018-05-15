<?php

namespace Kolekta\Http\Controllers\Api;

use Kolekta\Answer;
use Kolekta\Logic;
use Kolekta\Question;
use DB;
use Kolekta\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    /**
     * @return Question
     */
    public function removeAnswer($id)
    {
        $information = Answer::findOrFail($id);
        $question_id = $information->question;

        Answer::whereQuestion($question_id)
            ->where('position', '>', $information->position)
            ->decrement('position');

        $information->logics()->delete();
        $information->delete();


        $data['message'] = "Success";
        $data['status'] = 200;
        $data['question'] = $question_id;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function storeAnswer($unique, Request $request)
    {
        $logic = $request->logic;
        $information = Question::whereUnique($unique)->firstOrFail();
        $question_id = $information->id;
        $request['question'] = $question_id;
        $request['position'] = $request->position + 1;

        Answer::whereQuestion($question_id)
            ->where('position', '>=', $request->position)
            ->increment('position');

        $question = Answer::create($request->except(['logic']));

        $logic["answer"] = $question->id;
        Logic::create($logic);

        $data['message'] = "Success";
        $data['status'] = 200;
        $data['question'] = $question_id;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function updateAnswer($id, Request $request)
    {
        $logic = $request->logic;
        $information = Answer::findOrFail($id);

        $information->update($request->except(['logic']));

        Logic::whereAnswer($id)->update($logic);

        $data['message'] = "Success";
        $data['status'] = 200;
        $data['question'] = $information->question;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */

    public function updateAnswerLocation($ide, Request $request)
    {
        $ids = $request->id;
        $news = $request->new;
        $in=0;
        foreach ($news as $new) {
            $answer = Answer::findOrFail($ids[$in]);
            $position = array_search($ids[$in], $news) + 1;
            $data["position"] = $position;
            $answer->update($data);
            $in++;
        }

        $data['message'] = "Success";
        $data['status'] = 200;
        $data['question'] = $ide;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function updateAnswerLogic($id, Request $request)
    {
        if($request->unique_state != null)
            $request["unique_state"] = ($request->unique_state == -1) ? 'exit' : 'disqualification';

        if($request->skip_to == 0) {
            $request["skip_to"] = null;
            $request["skip_to_question"] = null;
        }

        $answer = Answer::findOrFail($id);
        Logic::whereAnswer($id)->update($request->except(["id"]));

        $data['message'] = "Success";
        $data['status'] = 200;
        $data['question'] = $answer->question;

        return response()->json($data, 200);
    }

    /**
     * @return Question
     */
    public function updateAnswerLogicQuestion($id, Request $request)
    {
        $question = Question::findOrFail($id);
        Logic::whereAnswer($request->answer)->update(["skip_to"=>$question->page,
            "skip_to_question"=>$question->id,
            "unique_state"=>null]);

        $data['message'] = "Success";
        $data['status'] = 200;

        return response()->json($data, 200);
    }
}