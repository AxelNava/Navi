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
										<button type="button" style="display:none" id='trigger' data-idNutriologo="{{ $id_nutriologo }}"></button>                    <div id="pacientes">
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
	let trigger = document.getElementById('trigger');

	trigger.addEventListener('click', () => {
		fetch(`/director/lista_pacientes_alumno_data/${idNutriologo}`)
			.then(response => response.json())
			.then(data => {
				console.log(data);
				nombreNutriologo.innerHTML = `ESTUDIANTE: ${data['Datos del alumno'].nombre}`;
			});
	});

	// Simulate a click on the trigger button
	trigger.click();
});
</script>
