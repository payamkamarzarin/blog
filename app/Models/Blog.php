<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = array(
        'title' ,
        'title_description' ,
        'image' ,
        'some_text' ,
        'text',
    );
}
