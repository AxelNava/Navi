<x-app-layout>
	<style>
		.agregar-alumno{
			background-color: #618ef2;
			border: none;
			border-radius:15px;
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
                <h2>Bienvenido {{Auth::user()->nombre}}</h2>
								<a href="agregar-paciente"><button class="agregar-alumno">Agregar paciente</button></a>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
