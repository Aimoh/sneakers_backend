<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'status'
    ];
    public const ORDER_COMPLETED = 'issued';
    public const ORDER_PAID = 'paid';
    public const ORDER_GOING = 'in_transit';
    public const ORDER_DELIVERED = 'delivered';


    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
