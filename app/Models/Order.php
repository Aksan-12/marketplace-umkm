<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'invoice_number',
        'total_amount',
        'status',
        'customer_name',
        'shipping_address',
        'phone_number',
        'payment_method',
    ];

    /**
     * Get all of the items for the Order
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
