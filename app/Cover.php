<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Rorecek\Ulid\HasUlid;

class Cover extends Model
{
    use HasUlid;


    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'votes' => 'integer',
        'ratio' => 'integer',
    ];


    protected $attributes = [
        'votes' => 0,
        'ratio' => 0,
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function upper_concept()
    {
        return $this->belongsTo('App\Concept', 'upper_concept_id');
    }
    public function lower_concept()
    {
        return $this->belongsTo('App\Concept', 'lower_concept_id');
    }
}
