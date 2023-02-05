<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['fio', 'birthday', 'interview_date', 'about', 'marital_status'];
}
