<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class input extends Model
{
    use HasFactory;
    protected $fillable = ['x', 'y', 'id_type', 'created_at', 'updated_at'];
    protected $primaryKey = 'id_input';
    public $timestamps = true;
}
