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
        <h2 class="font-lato-bold text-xl text-gray-800 leading-tight">
            Status del alumno
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status_alumno" id="">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                        <button type="submit" class="agregar-alumno">Modificar status del alumno</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
