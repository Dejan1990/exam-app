<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        return $this->belongsToMany(User::class,'quiz_user')->withTimeStamps();
    }

    public function setNameAttribute($value) 
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getUsersHtmlAttribute() // da drugacide radim ovo bih koristio/blogCms
    {
        $anchors = [];

        foreach ($this->users as $user) {
            $anchors[] = '<span>'.$user->name.'</span>';
        }

        return implode(', ', $anchors);
    }

    /*public function hasQuizAttempted(){
        $attemptQuiz = [];
        $authUser = auth()->user()->id;
        $user = Result::where('user_id', $authUser)->get();
        foreach($user as $u){
            array_push($attemptQuiz, $u->quiz_id);
        }
        return $attemptQuiz;
    }*/
}
