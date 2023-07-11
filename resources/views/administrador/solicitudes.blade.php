@extends('administrador.admin')
@section('contenido_administrador')
    <h1 class="text-center text-2xl font-extrabold">Solicitudes</h1>

    @if (session()->has('messagesoli'))
        <div class="alert alert-success alert-dismissible fade show bg-lime-800 text-white" role="alert">
            {{ session('messagesoli') }}
            <button type="button" class="btn-close bg-red-900 text-white font-extrabold" data-bs-dismiss="alert"
                aria-label="Close">x</button>
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-1">
        <form class="flex items-center py-4" method="get" action="{{ route('mostrar_solicitudes') }}">
            <label for="voice-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input value="{{ $texto ?? null }}" type="search" name="texto"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-800 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Buscar datos" list="buscar">
            </div>
            <button type="submit"
                class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>Search
            </button>
        </form>
        {{--! OPCIONES DE BUSQUEDA DE datoOS --}}
        <datalist id="buscar">
            <option value="Anulada">
            <option value="Renovada">
            <option value="Nueva">
        </datalist>
        {{-- !FIN OPCIONES DE BUSQUEDA DE datoOS --}}
        <div class="relative overflow-x-auto ">
            <table class="min-w-full text-center table-fixed md-fixed sm:px-6 lg:px-8">
                <thead class="border-b bg-gray-800">
                    <tr>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">#</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">Nombre</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">Fecha</th>
                        <th scope="col" class="text-sm font-medium text-white px-6 py-4">Estado</th>
                    </tr>
                </thead class="border-b">
                @foreach ($datos as $dato)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $dato->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-900 font-extrabold"><a
                                href="{{ route('mostrar_una_solicitud', $dato->id) }}">{{ $dato->nombres_solicitante . ' ' . $dato->apellidos_solicitante }}</a>
                        </td>
                        <td>{{ date_format($dato->created_at, 'd/M/Y') }}</td>
                        @if ($dato->estado_solicitud == 'Anulada')
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $dato->estado_solicitud }} <p class="text-red-900">{{ $dato->comentario }}</p>
                            </td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $dato->estado_solicitud }}</td>
                        @endif

                    </tr>
                @endforeach
            </table>
        </div>
        {{ $datos->links() }}
    </div>
@endsection
