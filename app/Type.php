<?php

namespace Kolekta;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';
    protected $primaryKey = 'id';
    protected $fillable = [
        "name"
    ];
}
