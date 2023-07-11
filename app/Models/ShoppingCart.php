<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario'
    ];

    public function productCount()
    {

    }

    public function amount()
    {
        $productCount = $this->products->sum('pivot.cantidad') ?? 0;
        return $productCount;


    }

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('id', 'cantidad');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario');
    }

    public function decreaseProductQuantity($productId)
    {
        $this->products()->updateExistingPivot($productId, [
            'cantidad' => max(1, $this->products()->where('product_id', $productId)->first()->pivot->cantidad - 1)
        ]);
    }





}
