<?php

namespace Axilweb\PreOrder\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock'];

    // Add any other fields your product needs
}
