<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TagsQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'question_id', 'created_at', 'updated_at'];
    
    public function question() 
    {
        return $this->belongsTo(Question::class);
    }
    
    public function tag() 
    {
        return $this->belongsTo(Tag::class);
    }

}
