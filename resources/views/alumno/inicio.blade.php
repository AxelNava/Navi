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

        #alumnos {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: center;
            padding: 20px;
        }

        #alumno {
            background-color:#f4f4f4;
            margin: 10px;
            padding: 10px;
            border-radius: 10px;
            border: rgb(102, 164, 76) 2px solid;
            width: 300px;
        }

        .button1 {
            border: solid 2px black;
        }

        .align-section {
            margin-left: 20px;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de pacientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="align-section">
                        <a href="agregar-paciente"><x-button-submit>Agregar paciente</x-button-submit></a>
                    </section>
                    <div id="alumnos">
                        @foreach ($data['Datos_pacientes_persona'] as $id => $datos)
                            <div id="alumno">
                                <h2>Nombre: {{ $datos->nombre }}</h2>
                                <h2>Sexo: {{ $datos->genero->value === 'M' ? 'Masculino' : 'Femenino' }}</h2>

                                <div class='mt-2 grid gap-1'>
                                    <form
                                        action="{{ route('alumno-paciente-control-citas', $data['Datos_paciente'][$id]) }}">
                                        <x-button-submit type="submit">Revisar datos paciente</x-button-submit>
                                    </form>
                                    <form action="{{ route('listado_formularios', $data['Datos_paciente'][$id]) }}">
                                        <button type="submit" class="button1">Ver formularios paciente</button>
                                    </form>
                                    <form
                                        action="{{ route('registrar-consulta-paciente', $data['Datos_paciente'][$id]) }}">
                                        <x-button-blue-sky type="submit" class="agregar-alumno">Agregar nueva
                                            consulta</x-button-blue-sky>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
