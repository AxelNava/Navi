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
            <span id="titulo_historial"></span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <label>Total: <span id='num_registros'></span></label>
                    <input type="hidden" id="input_base_url"
                        base-url-form="{{ route('modificar_registro_formulario', '') }}">
                    <article class="forms mt-2" id="forms_container">

                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    let id = {{ $id_paciente }};
    const forms_container = document.getElementById('forms_container');
    // const url = `http://navi.local/alumno/registros-paciente/${id}`;
    const url = '{{ route('listado-registros-paciente', $id_paciente) }}';
    fetch(url)
        .then(response => response.json())
        .then(data => {
            const titulo = document.getElementById('titulo_historial');
            titulo.innerHTML = `Historial de registros del paciente: ${data.data['persona'].nombre}`;
            const num_registros = document.getElementById('num_registros');
            num_registros.innerHTML = `${data.data['registros'].length}`;
            const forms = document.createDocumentFragment();
            const input_url = document.getElementById('input_base_url');
            const base_url = input_url.getAttribute('base-url-form');

            let counter = 1;
            data.data['registros'].forEach((dato, index) => {
                const form = document.createElement('form');
                form.method = 'get';
                form.action = `${base_url}/${dato}`;
                form.classList.add('flex');
                form.classList.add('flex-col');
                form.classList.add('max-width-form');
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
