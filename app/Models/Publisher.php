<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $hidden = ['created_at','updated_at'];

    protected $appends = ['book_count'];

    public function books()
    {
        return $this->hasMany(Book::class, 'id_publisher');
    }

    public function getBookByCount()
    {
        return $this->books->count();
    }
}
