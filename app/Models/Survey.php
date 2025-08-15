<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'survey_question')->withTimestamps();
    }
}
