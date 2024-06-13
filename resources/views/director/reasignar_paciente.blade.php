<x-app-layout>
    <style>
        .agregar-alumno {
            background-color: #618ef2;
            border: none;
            border-radius: 15px;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .pacientes {
            display: flex;
            flex-wrap: wrap;
            /* border: #618ef2 1px solid; */
        }

        .paciente {
            width: 30%;
            margin: 10px;
            padding: 10px;
            border: #618ef2 1px solid;
            border-radius: 10px;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('REASIGNAR PACIENTE') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="pacientes">
                        {{-- aquí mostrar con un select todos los nutriologos --}}
                        <form action="">
                            <select name="" id="">
                                <option value="" selected disabled>Selecciona un nutriologo</option>
                                @foreach ($nutriologos as $nutriologo)
                                    <option value="{{ $nutriologo->id_nutriologo }}">{{ $nutriologo->nombre }}</option>
                                @endforeach
                            </select>
                            <button type="submit">Reasignar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
