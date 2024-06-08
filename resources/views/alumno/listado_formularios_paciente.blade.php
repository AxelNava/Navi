<x-app-layout>
    <style>
        .button_blue {
            background-color: rgb(0, 29, 133);
            color: white;
            border-radius: 8px;
            padding-inline: 1rem;
            padding-block: 0.5rem;
        }

        .max-width-form {
            max-width: 12rem;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de formularios de') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <label>Total: <span>3</span></label>
                    <article class="">
                        <form action="" method="get" class="flex flex-col max-width-form">
                            <input type="hidden" name="id_paciente" value="">
                            <label for="">Número de registro</label>
                            <label for="">Fecha de registro</label>
                            <x-button-submit class="button_blue">Revisar formulario</x-button-submit>
                        </form>
                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    let id = {{ $id_paciente }};
    let nombre = document.querySelector('.nombre');
    const url = `/registro-formularios/${id}`;
    const datos_control_citas = document.querySelector('.datos_control_citas');

    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data)
            nombre.innerHTML = `Nombre: ${data.data[0].nombre}`;
            data.data.forEach(dato => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>${dato.fecha_cita}</td>
                <td>${dato.peso}</td>
                <td>${dato.IMC}</td>
                <td>${dato.masa_grasa_corporal}</td>
                <td>${dato.porcentaje_grasa_corporal}</td>
                <td>${dato.masa_muscular_kg}</td>
                <td>${dato.agua_corpolar}</td>
                <td>${dato.circunferencia_cintura}</td>
                <td>${dato.circunferencia_cadera}</td>
                <td>${dato.fecha_prox_cita}</td>
            `;
                datos_control_citas.appendChild(tr);
            });
        });
</script>
