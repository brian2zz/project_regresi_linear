<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phonska extends Model
{
    use HasFactory;
    protected $fillable = ['x', 'y', 'id', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $timestamps = true;
}
