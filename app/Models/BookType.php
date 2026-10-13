<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
    protected $table = 'tblBookType';
    protected $primaryKey = 'BookTypeID';
    protected $guarded = [];

    public function books()
    {
        return $this->hasMany(Book::class, 'BookTypeID', 'BookTypeID');
    }
}
