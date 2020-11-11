<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($question) {
           $question->tags->each->delete();
           $question->replies->each->delete();
        });

    }
    
    protected $fillable = ['title','slug','body','user_id','tag_id'];

    protected $with = ['replies'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->latest();
    }
    
    public function tags()
    {
        return $this->hasMany(TagsQuestion::class);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPathAttribute()
    {
        return "/question/$this->slug";
    }
    
}
