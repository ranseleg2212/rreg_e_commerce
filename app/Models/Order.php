<?php

namespace App\Models;

use App\Mail\ConfirmationShopping;
use App\Mail\NotificacionMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'shopping_cart_id',
        'total',
        'email',
        'name',
        'address',
        'tel',
        'id_user',
        'status',
        'token'
    ];

    public function shoppingCart(): BelongsTo
    {
        return $this->belongsTo(ShoppingCart::class);
    }


    public function isFromStripe(): bool
    {
        return $this->name == null ? true : false;
    }

    protected static function booted()
    {

    }
}
