<?php

namespace Kolekta;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'surveys';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "user", "name", "description", "open_time", "close_time", "public", "required_asterik", "logo", "question_number"
    ];

    public function pages() {
        return $this->hasMany("Kolekta\Paged", "survey", "id")->orderBy('position');
    }

}
