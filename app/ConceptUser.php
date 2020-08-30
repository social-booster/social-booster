<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Rorecek\Ulid\HasUlid;

class ConceptUser extends Model
{
    use HasUlid;

    public $incrementing = false;
  	protected $keyType = 'string';

    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function concept()
    {
        return $this->belongsTo('App\Concept');
    }
}
