<?php

namespace Kolekta;

use Illuminate\Database\Eloquent\Model;

class SurveyCategory extends Model
{
    protected $table = 'survey_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        "name"
    ];
}
