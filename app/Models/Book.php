<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BorrowingRecord;




class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author', 'publication_year', 'isbn'];

    public function borrowingRecords()
    {
        return $this->hasMany(BorrowingRecord::class);
    }
}