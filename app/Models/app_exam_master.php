<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class app_exam_master extends Model
{
    use HasFactory;
    protected $table="app_exam_masters";
    protected $primaryKey="id";
    protected $fillable=['title','category','exam_date','status'];
}
