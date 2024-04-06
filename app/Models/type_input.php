<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_input extends Model
{
    use HasFactory;
    protected $fillable = ['id_type_input', 'name','created_at','updated_at'];
    protected $primaryKey = 'id_type_input';
}
