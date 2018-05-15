<?php

namespace Kolekta;

use Illuminate\Database\Eloquent\Model;

class Logic extends Model
{
    protected $table = 'logics';
    protected $primaryKey = 'id';
    protected $fillable = [
        "answer", "skip_to", "skip_to_question", "unique_state"
    ];
}
