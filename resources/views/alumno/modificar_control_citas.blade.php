<x-app-layout>
    <style>
        .datos_control_citas {
            padding: unset;
        }

        .datos_control_citas tr {
            border-collapse: collapse;
            border: solid 2px #333;
            padding: unset;
        }

        .datos_control_citas td {
            border-collapse: collapse;
            border: solid 2px #333;
            width: 10em;
        }

        .datos_control_citas td>input {
            margin: unset;
            border: unset;
            width: 100%;
        }
        .button1 {
            border: solid 2px black;
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
                    <h2 class="nombre"></h2>
                    <br>
                    <form action="{{ route('control_citas_actualizar', $data[0]->id_paciente) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <table>
                            <thead>
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
                            </thead>
                            <tbody class="datos_control_citas" id='control_citas_body'>
                                @foreach ($data as $rows)
                                
                                    <tr>
                                        <input type="hidden" name="id_registro[]"
                                            value="{{ $rows->id_registro_consulta }}">
                                        <input type="hidden" name="id_cita[]" value="{{$rows->id_cita}}">
                                        <td class="input_container">
                                            <input type="date" name="fecha_cita[]" value="{{ $rows->fecha_cita }}">
                                        </td>
                                        <td class="input_container">
                                            <input type="text" name="peso[]" value="{{ $rows->peso }}">
                                        </td>
                                        <td class="input_container">
                                            <input type="text" name="IMC[]" value="{{ $rows->IMC }}">
                                        </td>
                                        <td class="input_container">
                                            <input type="text" name="masa_grasa_corporal[]"
                                                value="{{ $rows->masa_grasa_corporal }}">
                                        </td>
                                        <td class="input_container">
                                            <input type="text" name="porcentaje_grasa_corporal[]"
                                                value="{{ $rows->porcentaje_grasa_corporal }}">
                                        </td>
                                        <td class="input_container">
                                            <input type="text" name="masa_muscular_kg[]"
                                                value="{{ $rows->masa_muscular_kg }}">
                                        </td>
                                        <td class="input_container">
                                            <input type="text" name="agua_corpolar[]"
                                                value="{{ $rows->agua_corpolar }}">
                                        </td>
                                        <td class="input_container">
                                            <input type="text" name="circunferencia_cintura[]"
                                                value="{{ $rows->circunferencia_cintura }}">
                                        </td>
                                        <td class="input_container">
                                            <input type="text" name="circunferencia_cadera[]"
                                                value="{{ $rows->circunferencia_cadera }}">
                                        </td>
                                        <td class="input_container">
                                            <input type="date" name="fecha_prox_cita[]"
                                                value="{{ $rows->fecha_prox_cita ?? '' }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <x-button-green>Guardar datos modificados</x-button-green>
                    </form>
                    <button id="cita_button" class="button1" type="submit">Añadir nueva cita</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const cita_button = document.getElementById("cita_button");
    const body_table = document.getElementById("control_citas_body");
    cita_button.addEventListener("click", () => {
        const fragment = document.createDocumentFragment();
        const tr = document.createElement("tr");
        const ultimo_registro = {{ $data[count($data) - 1]->id_registro_consulta }}
        tr.innerHTML = `
         <input type="hidden" name="id_registro_to_create[]" value="${ultimo_registro}">
        <td class="input_container">
            <input type="date" name="fecha_cita[]" value="">
        </td>
        <td class="input_container">
            <input type="text" name="peso[]" value="">
        </td>
        <td class="input_container">
            <input type="text" name="IMC[]" value="">
        </td>
        <td class="input_container">
            <input type="text" name="masa_grasa_corporal[]"
                value="">
        </td>
        <td class="input_container">
            <input type="text" name="porcentaje_grasa_corporal[]"
                value="">
        </td>
        <td class="input_container">
            <input type="text" name="masa_muscular_kg[]"
                value="">
        </td>
        <td class="input_container">
            <input type="text" name="agua_corpolar[]"
                value="">
        </td>
        <td class="input_container">
            <input type="text" name="circunferencia_cintura[]"
                value="">
        </td>
        <td class="input_container">
            <input type="text" name="circunferencia_cadera[]"
                value="">
        </td>
        <td class="input_container">
            <input type="date" name="fecha_prox_cita[]"
                value="">
        </td>
        `;
        fragment.appendChild(tr);
        body_table.appendChild(fragment);
    });
</script>
