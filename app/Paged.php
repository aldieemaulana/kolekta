<?php

namespace Kolekta;

use Illuminate\Database\Eloquent\Model;

class Paged extends Model
{
    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $fillable = [
        "survey", "name", "description"
    ];

    public function questions() {
        return $this->hasMany("Kolekta\Question", "page", "id");
    }

}
