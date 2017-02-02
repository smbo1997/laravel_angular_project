<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable =[
        'from_user','to_user','content','readed'
    ];
}
