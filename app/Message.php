<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Rorecek\Ulid\HasUlid;

class Message extends Model
{
    use HasUlid;

    public $incrementing = false;
  	protected $keyType = 'string';

    protected $guarded = [
        'id'
    ];

    protected $with = ['user:id,name'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }
}
