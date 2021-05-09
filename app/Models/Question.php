<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'slug', 'quiz_id'];
    private $limit = 10;
    private $order = 'DESC';

    public function setQuestionAttribute($value)
    {
        $this->attributes['question'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function answers()
    {
    	return $this->hasMany(Answer::class);
    }

    public function quiz()
    {
    	return $this->belongsTo(Quiz::class);
    }

    public function getQuestions()
    {
        return Question::orderBy('created_at', $this->order)->with('quiz')->paginate($this->limit);
    }
}
