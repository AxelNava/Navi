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

        table {
            border-spacing: 0;
            border-collapse: separate;
            border-radius: 10px;
            border: 1px solid black;
        }

        table th,
        table td {
            border: 1px solid black;
        }

        table th,
        table td {
            padding-inline: 1em;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Control de citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table>
                        <tr>
                            <th class='header_title'>Fecha Paciente</th>
                            <th class='header_title'>Peso</th>
                            <th class='header_title'>IMC</th>
                            <th class='header_title'>Masa grasa corporal (kg)</th>
                            <th class='header_title'>% grasa corporal</th>
                            <th class='header_title'>Masa muscular (kg)</th>
                            <th class='header_title'>Agua corporal</th>
                            <th class='header_title'>Circunferencia de cintura</th>
                            <th class='header_title'>Circunferencia de cadera</th>
                            <th class='header_title'>Fecha próxima cita</th>
                        </tr>
                        <tbody class="datos_control_citas">
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

