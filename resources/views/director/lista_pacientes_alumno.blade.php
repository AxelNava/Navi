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
            {{ __('Lista de pacientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="nutriologo-nombre"></h1>
                    <h1 class="nutriologo-pacientes"></h1>
                    <button type="button" style="display:none" id='trigger' data-idNutriologo="{{ $id_nutriologo }}"
                        data-urlBase="{{ route('director-paciente-control-citas', '') }}"></button>
                    <input type="hidden" data-url-base-registro="{{ route('director-formularios-paciente', '') }}"
                        id="input-url-formularios">
                    <div id="pacientes">
                        <div class="pacientes">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let idNutriologo = {!! json_encode($id_nutriologo) !!};
        let nombreNutriologo = document.querySelector('.nutriologo-nombre');
        let pacientesNutriologo = document.querySelector('.nutriologo-pacientes');
        let pacientes = [];
        let trigger = document.getElementById('trigger');
        let urlBase = trigger.getAttribute('data-urlBase');
        const input_url_container = document.getElementById('input-url-formularios');
        const url_base_formularios = input_url_container.getAttribute('data-url-base-registro');
        // la urlBase es director-paciente-control-citas

        let pacientesContainer = document.querySelector('.pacientes');
        trigger.addEventListener('click', () => {
            fetch(`/director/lista_pacientes_alumno_data/${idNutriologo}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    let datosPacientes = data['Datos de sus pacientes'];
                    nombreNutriologo.innerHTML = `ESTUDIANTE: ${data['Datos del alumno'].nombre}`;
                    pacientesNutriologo.innerHTML =
                        `PACIENTES: ${data['Cantidad de pacientes del alumno']}`;
                    datosPacientes.map(paciente => {
                        let html = `
							<div class="paciente">
								<b style="font-size:20px;font-weight:900">${paciente.nombre}</b>
								<p>Género: ${paciente.genero}</p>
								<p>Edad:${paciente.edad}</p>
								<form action="${urlBase}/${paciente.persona_id}">
									<button type="submit" class="agregar-alumno">Revisar datos paciente</button>
								</form>
                                <form action="${url_base_formularios}/${paciente.persona_id}">
									<button type="submit" class="agregar-alumno">Revisar formularios</button>
								</form>
							</div>
						`;
                        pacientesContainer.innerHTML += html;
                    });
                });
        });

        // Simulate a click on the trigger button
        trigger.click();
    });
</script>
