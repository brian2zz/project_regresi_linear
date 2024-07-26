<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class input extends Model
{
    use HasFactory;
    protected $fillable = ['hasil', 'luas_lahan', 'id_type', 'created_at', 'updated_at'];
    protected $primaryKey = 'id_input';
    public $timestamps = true;
    protected $table = 'hasil_forecasting';

    public function type()
    {
        return $this->belongsTo(type_input::class, 'id_type', 'id_type_input');
    }
}
