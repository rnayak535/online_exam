<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class app_student extends Model
{
    use HasFactory;
    protected $table="app_students";
    protected $primaryKey="id";
    protected $fillable=['name','email','mobile_no','category','exam','password','status'];
}
