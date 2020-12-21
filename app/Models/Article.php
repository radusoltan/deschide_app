<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Article extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $guarded = [];
    protected $attributes = [
        'status' => 'N',
        'type' => 'news',
        'is_breaking' => false,
        'is_flash' => false,
        'is_alert' => false,
    ];

    public $translatedAttributes = [
        'title','slug','lead','content'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeNew($query){
        return $query->where('status','N');
    }

    public function scopeSubmited($query){
        return $query->where('status', 'S');
    }

    public function scopePublished($query){
        return $query->where('status', 'Y')
            ->orderBy('created_at','desc')
            ;
    }

    public function scopeNews($query){
        return $query->where('type','news');
    }

    public function scopeVideo($query)
    {
        return $query->where('type','video');
    }

    public function scopeFlash($query){
        return $query->where('type','flash');
    }

    public function typeOptions(){
        return [
            'news' => 'stire',
            'video' => 'video',
            'flash' => 'flash'
        ];
    }

    public function statusOptions(){
        return [
            'N' => 'New',
            'S' => 'Submitted',
            'Y' => 'Published'
        ];
    }

    public function vzt()
    {
        return visits($this);
    }
}
