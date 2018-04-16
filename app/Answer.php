<?php

namespace Kolekta;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $primaryKey = 'id';
    protected $fillable = [
        "question", "answer", "point", "correct"
    ];

    public function logic() {
        return $this->hasOne("Kolekta\Logic", "answer", "id");
    }
}