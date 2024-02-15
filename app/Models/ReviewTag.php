<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewTag extends Model
{
    use HasFactory;

    protected $table = 'review_tags';
    public $timestamps = true;
}
