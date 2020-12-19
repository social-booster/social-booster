<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Rorecek\Ulid\HasUlid;

class CoverRealVote extends Model
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

    public function cover()
    {
        return $this->belongsTo('App\Cover');
    }
}
