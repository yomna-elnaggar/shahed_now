<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballMatch extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function TeamF(){
        return $this->belongsTo(Team::class,'teamF_id');
    }

    public function TeamS(){
        return $this->belongsTo(Team::class,'teamS_id');
    }
}
