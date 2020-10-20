<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class app_category extends Model
{
    use HasFactory;

    protected $table="app_categories";
    protected $primaryKey="id";
    protected $fillable=['name','status'];
}
