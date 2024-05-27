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
    .formulario{
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        flex-direction: column;
        border:1px solid green;
        border-radius:10px;
        padding:20px;
    }
    .inputs-form{
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        flex-direction: column;
    }
    input[type="text"], input[type="password"], input[type="radio"] , input[type="email"], input[type="number"] {
        border-radius: 15px;
    }
		</style>
		<x-slot name="header">
				<h2 class="font-semibold text-xl text-gray-800 leading-tight">
						{{ __('Agregar paciente') }}
				</h2>
		</x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                <h2>Bienvenido {{Auth::user()->nombre}}</h2>
                <div class="formulario">
                  <b style="font-size: 20px">Nota de nutrición</b>
                  <form action="">
                    <div class="inputs-form">
                      <div class="primera-parte">
                        <label for="nombre">NOMBRE</label>
                        <input type="text" name="nombre" id="nombre">
                        <label for="nombre">EDAD</label>
                        <input type="text" name="nombre" id="nombre">
                        <label for="nombre">HORA</label>
                        <input type="text" name="nombre" id="nombre">
                      </div>
                      <div class="primera-parte">
                        <label for="nombre">GÉNERO</label>
                        <input type="text" name="nombre" id="nombre">
                        <label for="nombre">NO. EXPEDIENTE</label>
                        <input type="text" name="nombre" id="nombre">
                        <label for="nombre">FECHA DE NACIMIENTO</label>
                        <input type="text" name="nombre" id="nombre">
                        <label for="nombre">CONSULTA NO.</label>
                        <input type="text" name="nombre" id="nombre">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
