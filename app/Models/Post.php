<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'color',
        'image',
        'body',
        'tags',
        'published',
        'published_at'
    ]; //data yang bisa diupate/diisi

    protected $casts = [
        'tags' => 'array',
        'published' => 'boolean',
        'published_at' => 'datetime',
    ];
    //fungsi casting Json->array, boolean->true/false, datetime->carbon

    public function category()
    {
        return $this->belongsTo(Category::class);
    } //Setiap post memiliki satu kategori, relasi belongsTo
}
