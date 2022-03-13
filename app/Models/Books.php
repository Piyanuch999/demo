<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = ['title' , 'typebooks_id' , 'price' , 'image_url'];

    public function typebooks()
    {
        return $this->belongsTo(TypeBooks::class);
    }
}
