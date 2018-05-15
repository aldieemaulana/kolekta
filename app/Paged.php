<?php

namespace Kolekta;

use Illuminate\Database\Eloquent\Model;

class Paged extends Model
{
    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $fillable = [
        "survey", "name", "description", 'position'
    ];

    public function questions() {
        return $this->hasMany("Kolekta\Question", "page", "id")->orderBy('position');
    }

    public function pages() {
        return $this->hasMany("Kolekta\Paged", "survey", "survey");
    }

}
