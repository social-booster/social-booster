<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Rorecek\Ulid\HasUlid;

class Watch extends Model
{
    use HasUlid;

    public $incrementing = false;
  	protected $keyType = 'string';

    protected $guarded = [
        'id'
    ];
}
