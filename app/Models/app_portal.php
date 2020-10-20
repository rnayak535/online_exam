<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class app_portal extends Model
{
    use HasFactory;
    protected $table="app_portals";
    protected $primaryKey="id";
    protected $fillable=['name','email','mobile_no','password','status'];
}
