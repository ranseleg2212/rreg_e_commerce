@extends('administrador.admin')
@section('contenido_administrador')
    <div class=" bg-neutral-900 border border-gray-200 rounded-lg shadow dark:bg-white dark:border-gray-700 relative overflow-x-auto shadow-md sm:rounded-lg"
        style="padding: 10px">
        <h1 class="text-center text-2xl font-extrabold">Datos del Pedidos</h1>
        {{-- DETALLES DEL CLIENTE --}}
        <div class="relative overflow-x-auto ">
            <table class="w-full table-auto">
                @if ($order->status == 'Cancelado')
                    <tr class="border-b">
                        <td colspan="2" class="px-4 py-2 whitespace-nowrap text-sm text-white bg-red-800 font-bold">PEDIDO
                            CANCELADO: {{ $order->comentario }}</td>
                    </tr>
                    @elseif ($order->status == 'Entregado')
                    <td colspan="2" class="px-4 py-2 whitespace-nowrap text-sm text-white bg-green-700 font-bold">Pedido entregado por: {{ $order->persona_entrega }}, en {{$order->lugar_entrega}} a las {{$order->hora_entrega}}. Lo recibió {{$order->recibido_entrega}}</td>
                @endif
                <tr class="border-b">
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-white bg-gray-800">Codigo:</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-800">{{ $order->id }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-white bg-gray-800">Direccion:</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-800">{{ $order->address }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-white bg-gray-800">Fecha:</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-800">
                        {{ date_format($order->created_at, 'd/M/Y') }}</td>
                </tr>
            </table>
        </div>
        <div class="relative overflow-x-auto ">
            {{-- FIN DETALLE DEL CLIENTE --}}
            <table style="width: 100%" class="min-w-full text-center table-auto">
                <thead class="border-b bg-gray-800">
                    <tr>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">Nombre</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">Email</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">Tel</th>
                    </tr>
                </thead>
                <tr class="bg-white border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->tel }}</td>
                </tr>
            </table>
        </div>
        <br>
        <h1 class="text-center text-2xl font-extrabold">Productos</h1>
        <div class="relative overflow-x-auto ">
            <table style="width: 100%" class="min-w-full text-center table-auto">
                <thead class="border-b bg-gray-800">
                    <tr>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">Id</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">Nombre</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">Precio</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">Cantidad</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-1">Subtotal</th>


                    </tr>
                </thead>
                @foreach ($order->shoppingCart->products as $product)
                    @php
                        $subtotal = $product->pivot->cantidad * $product->precio_oferta;
                    @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            RD${{ number_format($product->precio_oferta, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $product->pivot->cantidad }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            RD${{ number_format($subtotal, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="bg-gray-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">Total:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                        RD${{ number_format($order->total, 2) }}</td>
                </tr>

            </table>
        </div>
        <button type="button" class="my-1 btn btn btn-modal text-blue-900 hover:font-bold" data-bs-toggle="modal"
            data-bs-target="#estadopedidomodal{{ $order->id }}">
            Estado
        </button>
        {{-- !MODAL --}}
        <div class="modal fade" id="estadopedidomodal{{ $order->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar estado</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('editar_estado_pedido', ['pedido' => $order]) }}" method="POST"
                            role="form" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <label for="id">Id pedido</label>
                            <input type="text" name="id" id="" value="{{ $order->id }}" readonly
                                class="form-control">
                            <label for="estado_sel" class="block text-gray-700 text-sm font-bold mb-2">Estado</label>
                            <select id="estado_sel" name="estado_seli"
                                class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="Pendente" @if ($order->status == 'Registrado') selected @endif>Registrado
                                </option>
                                <option value="En proceso" @if ($order->status == 'En proceso') selected @endif>En proceso
                                </option>
                                <option value="Entregado" @if ($order->status == 'Entregado') selected @endif>Entregado
                                </option>
                                <option value="Cancelado" @if ($order->status == 'Cancelado') selected @endif>Cancelado
                                </option>
                            </select>
                            <div id="razon_cancelacion" style="display: none">
                                <label for="razon_cancelacion_txt"
                                    class="block text-gray-700 text-sm font-bold mb-2">Motivo</label>
                                <input type="text" name="razon_cancelacion_txt" id="rzcn"
                                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Razón de cancelación">
                            </div>
                            <div id="lugar_persona_hora_entrega" style="display: none">
                                <label for="lugar_entrega" class="block text-gray-700 text-sm font-bold mb-2">Lugar de
                                    entrega</label>
                                <input type="text" name="lugar_entrega" id="lgen"
                                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Lugar de entrega">
                                <label for="hora_entrega" class="block text-gray-700 text-sm font-bold mb-2">Hora de
                                    entrega</label>
                                <input type="text" name="hora_entrega" id="hren"
                                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Hora de entrega">
                                <label for="persona_entrega" class="block text-gray-700 text-sm font-bold mb-2">Entregado
                                    por:</label>
                                <input type="text" name="persona_entrega" id="psen"
                                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Persona quien entrega">
                                <label for="aquien_entrega" class="block text-gray-700 text-sm font-bold mb-2">Recibido
                                    por:</label>
                                <input type="text" name="aquien_entrega" id="rcen"
                                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Recibido por">
                            </div>


                            <button type="submit"
                                class="my-2 btn block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-red-700 text-white font-extrabold hover:bg-red-900 w-full"
                            data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // 1. Crear una función con el código que deseas ejecutar
            function actualizarInputs() {
                const estadoSel = document.querySelector('#estado_sel');
                const razonCancelacionDiv = document.querySelector('#razon_cancelacion');
                const razonCancelacionInp = document.querySelector('#rzcn');
                const lugarHorapersonaEntregaDiv = document.querySelector('#lugar_persona_hora_entrega');
                const lugarEntrega = document.querySelector('#lgen');
                const horaEntrega = document.querySelector('#hren');
                const entregadoEntrega = document.querySelector('#psen');
                const recibidoEntrega = document.querySelector('#rcen');

                const selectedOption = estadoSel.value;

                if (selectedOption == "Cancelado") {
                    razonCancelacionDiv.style.display = 'block';
                    razonCancelacionInp.value = "{{ $order->comentario }}";
                    lugarHorapersonaEntregaDiv.style.display = 'none';
                } else if (selectedOption == "Entregado") {
                    razonCancelacionDiv.style.display = 'none';
                    lugarHorapersonaEntregaDiv.style.display = 'block';
                    lugarEntrega.value = "{{ $order->lugar_entrega ?? null }}";
                    horaEntrega.value = "{{ $order->hora_entrega ?? null }}";
                    entregadoEntrega.value = "{{ $order->persona_entrega ?? null }}";
                    recibidoEntrega.value = "{{ $order->recibido_entrega ?? null }}";
                } else {
                    razonCancelacionDiv.style.display = 'none';
                    lugarHorapersonaEntregaDiv.style.display = 'none';
                }
            }

            // 2. Llamar a la función para que se ejecute inmediatamente
            actualizarInputs();

            // 3. Agregar la función como manejador de eventos para el evento "change" del elemento select
            const estadoSel = document.querySelector('#estado_sel');
            estadoSel.addEventListener('change', actualizarInputs);
        </script>
        {{-- !FIN MODAL --}}
    </div>
@endsection
