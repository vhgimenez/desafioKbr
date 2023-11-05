<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'specie', 'breed', 'age', 'weight', 'size', 'local', 'about', 'status', 'image1', 'image2', 'image3', 'image4', 'image5', 'gender'];

}
