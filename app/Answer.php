<?php

namespace Kolekta;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $primaryKey = 'id';
    protected $fillable = [
        "position", "question", "answer", "point", "correct"
    ];

    public function logics() {
        return $this->hasOne("Kolekta\Logic", "answer", "id");
    }

    public function question() {
        return $this->hasOne("Kolekta\Question", "question", "id");
    }
}
