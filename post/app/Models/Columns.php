<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Columns extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'id',
        'title',
    ];
    public function card(){
        return $this->hasMany(Cards::class,'column_id','id');
    }
}
