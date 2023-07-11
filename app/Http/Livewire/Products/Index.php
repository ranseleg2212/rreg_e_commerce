<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartManager;
use Illuminate\Http\Request;

class Index extends Component
{
    public function render(Request $request)
    {
        $productsofcnt=null;
        $texto = $request->textoproducto;
        if ($texto == null) {
            return view('livewire.products.index', [
                'products' => Product::where('status', '=', 'ACTIVO')
                    ->orderBy('status', 'desc')->paginate(20),
                'productsof' => Product::where('status', '=', 'OFERTA')->paginate(16),
                'productsofcnt' => Product::where('status', '=', 'OFERTA')->count()
            ])->extends('layouts.app')
                ->section('content');
        } else {
            $products = Product::where('name', 'LIKE', '%' . $texto . '%')
                ->where('status', '=', 'ACTIVO')
                // ->orWhere('status', '=', 'OFERTA')
                ->orderBy('status', 'desc')
                ->paginate(8);
            $productsofcnt = 0;
            $productsof = Product::where('status', '=', 'OFERTA')->paginate(20);
            return view('livewire.products.index', compact('products', 'texto', 'productsofcnt', 'productsof'))
                ->extends('layouts.app')
                ->section('content');
        }
    }

    public function addToCart(CartManager $cart, $productId)
    {
        $cart->addToCart($productId);
        session()->flash('Mensaje', 'Producto agregado al carrito');
        $this->emitTo('cart', 'addToCart');
    }

}




