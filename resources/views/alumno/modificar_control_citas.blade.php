<x-app-layout>
    <style>

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
                    <h2 class="nombre"></h2>
                    <br>
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
                    <form action="">
                        <input type="submit" value="Guardar datos modificados" class="agregar-alumno" />
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
