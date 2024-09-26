<?php

namespace Axilweb\PreOrder\Models;

use App\Traits\SoftDeletesWithUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreOrder extends Model
{
    use SoftDeletes, SoftDeletesWithUser,HasFactory; // Use the SoftDeletesWithUser trait
    protected $fillable = ['name', 'email', 'phone', 'product_id'];


    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s')
        );
    }
}


