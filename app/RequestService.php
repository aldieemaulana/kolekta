<?php

namespace Kolekta;

use Illuminate\Database\Eloquent\Model;

class RequestService extends Model
{
    protected $table = 'requests';
    protected $primaryKey = 'id';
    protected $fillable = [
        "user", "name", "survey_category", "descriptions", "type", "status"
    ];
}
