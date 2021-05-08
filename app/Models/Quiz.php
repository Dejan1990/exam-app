<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'minutes'];

    public function questions()
    {
    	return $this->hasMany(Question::class);
    }

    public function users()
    {
        //return $this->belongsToMany(User::class,'quiz_user');
        return $this->belongsToMany(User::class,'quiz_user');
    }
}
