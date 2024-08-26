<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    // start relationship
        public function user(){
            return $this->belongsTo(User::class,'user_id','id');
        }
        public function comments(){
            return $this->hasMany(Comment::class,'post_id','id');
        }
    // end relationship


    
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('cover');
    }
}
