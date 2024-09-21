<?php

namespace Axilweb\PreOrder\Models;

use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'product_id'];
}
