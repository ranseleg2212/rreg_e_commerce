@extends('layouts.app')
@section('content')
    <h1 class="text-center text-2xl font-extrabold">Control de Pedidos</h1>
    <div class="shadow-md sm:rounded-lg p-5">
        <div class="relative overflow-x-auto ">
            <table class="min-w-full text-center table-fixed md-fixed sm:px-6 lg:px-8">
                <thead class="border-b bg-gray-800">
                    <tr>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">Codigo</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">Total</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">Fecha</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">Estado</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">_____</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedmost as $pedido)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pedido->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">RD$
                                {{ number_format($pedido->total, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ date_format($pedido->created_at, 'd/M/Y') }}</td>
                            @if ($pedido->status == 'Entregado')
                                <td class="font-extrabold px-6 py-4 whitespace-nowrap text-sm text-green-900">
                                    {{ $pedido->status }}</td>
                            @elseif ($pedido->status == 'Cancelado')
                                <td class="font-extrabold px-6 py-4 whitespace-nowrap text-sm text-red-900">
                                    {{ $pedido->status }}</td>
                            @elseif ($pedido->status == 'En Proceso')
                                <td class="font-extrabold px-6 py-4 whitespace-nowrap text-sm text-yellow-600">
                                    {{ $pedido->status }}</td>
                            @else
                                <td class="font-extrabold px-6 py-4 whitespace-nowrap text-sm text-blue-700">
                                    {{ $pedido->status }}</td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><a
                                    href="{{ route('detalle_pedido_cliente', $pedido->token) }}"
                                    class="">Detalles</a>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h1 class="text-center text-base font-extrabold">Control de Pedidos</h1>
        <ul class="list-outside max-w-md space-y-1 text-gray-500 list-disc dark:text-gray-400">
            <li class="text-black"><strong class="text-blue-700">Registrado</strong> Tu pedido se registró en nuestro
                sistema</li>
            <li class="text-black"><strong class="text-yellow-600">En Proceso</strong> Nuestro personal ya está trabajando
                con tu pedido</li>
            <li class="text-black"><strong class="text-green-900">Entregado</strong> Tu pedido ya fue entregado</li>
            <li class="text-black"><strong class="text-red-900">Cancelado</strong> Tu pedido fue cancelado</li>
        </ul>
    </div>
@endsection
<style>
    /* td{
        padding: 10px
    } */
</style>
@push('scripts')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush
