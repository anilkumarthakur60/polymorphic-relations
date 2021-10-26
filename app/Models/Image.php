<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['imagefile', 'imagable_id', 'imagabletype'];

    public function imagable()
    {
        return $this->morphTo();
    }
}