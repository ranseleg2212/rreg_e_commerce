<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShoppingCart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Mail\ConfirmationShopping;
use App\Mail\NotificacionMail;
use App\Mail\ProductoCMail;
use Illuminate\Support\Facades\Mail;
use App\Models\CartManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


use Illuminate\Http\Request;

class PedidoController extends Controller
{
    private string $sessionName = 'shopping_cart_id';
    // !ADMINISTRADOR
    public function pedidos_inicio()
    {
        return view('administrador.inicio', [
            'pedidostt' => Order::all()->count(),
            'pedidosep' => Order::all()->where('status', '=', 'En proceso')->count(),
            'pedidosre' => Order::all()->where('status', '=', 'Registrado')->count(),
            'pedidosen' => Order::all()->where('status', '=', 'Entregado')->count(),
            'pedidosca' => Order::all()->where('status', '=', 'Cancelado')->count(),
            'productac' => Product::all()->where('status', '=', 'ACTIVO')->count(),
            'productin' => Product::all()->where('status', '=', 'INACTIVO')->count(),
            'productof' => Product::all()->where('status', '=', 'OFERTA')->count(),
            'producttt' => Product::all()->count(),
            'neworders' => Order::where('status', '=', 'Registrado')->paginate(10),
            'neworderscount' => Order::where('status', '=', 'Registrado')->count()
        ]);
    }

    public function mostrar_pedidos(Request $request)
    {
        $texto = $request->texto;
        $pedido = null;
        if ($texto == null) {
                $pedidos = Order::latest()->paginate(10);
                $pedidosnuevos = Order::all()->where('status', '=', 'Registrado')->sortByDesc('created_at');
                return view('administrador.pedidos', compact('pedidos', 'pedidosnuevos'));
        } else {
            $pedidos = DB::table('orders')
                ->where('name', 'LIKE', '%' . $texto . '%')
                ->orWhere('email', 'LIKE', '%' . $texto . '%')
                ->orWhere('status', '=',  $texto)
                ->orWhere('id', '=', $texto)
                ->paginate(10);
            $pedidosnuevos = Order::where('status', '=', 'Registrado')->paginate(10);
            return view('administrador.pedidos', compact('pedidos', 'texto', 'pedidosnuevos'));
        }
    }

    public function detalle_pedido($id)
    {
        $order = Order::find($id);
        return view('administrador.detalle_pedido', compact('order'));
    }

    public function estado(Request $estado, Order $pedido)
    {

        if($estado->estado_seli == 'Cancelado'){
            $pedido->status = $estado->estado_seli;
            $pedido->comentario = $estado->razon_cancelacion;
            $pedido->lugar_entrega = "";
            $pedido->hora_entrega = "";
            $pedido->persona_entrega = "";
            $pedido->recibido_entrega = "";
            $pedido->save();
        } else if($estado->estado_seli == 'Entregado'){
            $pedido->status = $estado->estado_seli;
            $pedido->lugar_entrega = $estado->lugar_entrega;
            $pedido->hora_entrega = $estado->hora_entrega;
            $pedido->persona_entrega = $estado->persona_entrega;
            $pedido->recibido_entrega = $estado->aquien_entrega;
            $pedido->comentario = " ";
            $pedido->save();
        } else{
            $pedido->status = $estado->estado_seli;
            $pedido->save();
        }

        return view('administrador.pedidos', [
            'pedidos' => Order::orderBy('created_at', 'desc')->paginate(10),
            'pedidosnuevos' => Order::where('status', '=', 'Registrado')->paginate(10),
            session()->flash('messagepedido', 'Se cambio el estado al pedido '.$pedido->id)
        ]);
    }

    // !USUARIO
    public function guardar(ShoppingCart $cart, $id, $total, Request $request)
    {
        $order = Order::create([
            'shopping_cart_id' => $cart->id,
            'id_user' => $id,
            'total' => $total,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->direccion,
            'tel' => $request->tel,
            'token' => Str::random(50)
        ]);
        $inactivos = array();
        foreach ($cart->products as $product) {
            $product->decrement('cantidad_disponible', $product->pivot->cantidad);
            $product->save();
            if ($product->cantidad_disponible < 2) {
                $product->status = 'INACTIVO';
                $product->save();
                $inactivos[] = ['id' => $product->id,
                'nombre' => $product->name,
                'cantidad_disponible' => $product->cantidad_disponible];
            }
        }
        if(!empty($inactivos)){
            Mail::to('marlenyshome1@gmail.com')->send(new ProductoCMail($inactivos));
            Mail::to('yceballosinverliz@gmail.com')->send(new ProductoCMail($inactivos));
        }
        $shoppingCart = ShoppingCart::find($cart->id);
        $shoppingCart->status = 1;
        $shoppingCart->save();

        Mail::to($order->email)->send(new ConfirmationShopping($order));
        Mail::to('ranseleg2212@gmail.com')->send(new NotificacionMail($order));
        //Mail::to('marlenyshome1@gmail.com')->send(new NotificacionMail($order));
        session()->flash('message', 'Gracias por tu compra, te estaremos contactando');
        //(app(CartManager::class))->deleteSession();
        Session::forget($this->sessionName);
        return redirect('/');

    }

    public function mostrar_pedidos_usuario($usuario)
    {
        $pedmost = Order::all()->where('id_user', '=', $usuario)->sortByDesc('created_at');
        $pedidot = Order::all()->where('id_user', '=', $usuario)->first();
        if ($pedidot->id_user !== auth()->id()) {
            abort(403, 'No tiene permisos para acceder a este pedido.');
        }else{
        return view('livewire.compra', compact('pedmost'));
    }
    }

    public function detalle($token)
    {
        return view('livewire.products.detalle_compra', [
            'order' => Order::where('token', $token)->firstOrFail()
        ]);
    }
}
