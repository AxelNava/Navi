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
        .form-container{
            border: solid 2px var(--green-lines);
            padding: 0.5rem;
            margin: 0.5rem 0.5rem;
            border-radius: 15px;
            gap: 0.5rem;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-lato-bold text-xl text-gray-800 leading-tight">
            <span id="titulo_historial"></span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <label>Total: <span id='num_registros'></span></label>
                    <input type="hidden" id="route_get_formularios"
                        base-url-route="{{ route('formulario_validation_paciente', '') }}">
                    <article class="forms mt-2 flex flex-row" id="forms_container">

                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    let id = {{ $id_persona }};
    const forms_container = document.getElementById('forms_container');
    const url = '{{ route('listado-registros-paciente-alumno', $id_persona) }}';
    const base_url_formularios = document.getElementById('route_get_formularios').getAttribute('base-url-route');

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const titulo = document.getElementById('titulo_historial');
            titulo.innerHTML = `Historial de registros del paciente: ${data.data['persona'].nombre}`;
            const num_registros = document.getElementById('num_registros');
            num_registros.innerHTML = `${data.data['registros'].length}`;
            const forms = document.createDocumentFragment();
            let counter = 1;
            data.data['registros'].forEach((dato, index) => {
                const form = document.createElement('form');
                form.method = 'get';
                form.action = `${base_url_formularios}/${dato}`;
                form.classList.add('flex');
                form.classList.add('flex-col');
                form.classList.add('max-width-form');
                form.classList.add('bg-gray-50');
                form.classList.add('form-container');
                form.innerHTML = `
                <label for="">Número de registro: ${counter}</label>
                    <label for="">Fecha de registro: ${data.data['fechas_citas'][index]}</label>
                    <x-button-submit class="button_blue mt-1">Revisar formulario</x-button-submit>
                `;
                counter++;
                forms.appendChild(form);
            });
            forms_container.appendChild(forms);
        });
</script>
