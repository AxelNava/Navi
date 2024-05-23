<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Inicio') }}
      </h2>
  </x-slot>
  <style>
form {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
    flex-direction: row;
}
.first-part {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    flex-direction: column;
}
.second-part {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    flex-direction: column;
}
.sexo{
		display: flex;
		gap: 10px;

}
input[type="text"], input[type="password"], input[type="radio"] , input[type="email"], input[type="number"] {
    border-radius: 15px;
}
.formulario > div {
    flex-basis: calc(50% - 20px);
}
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
		/*Efecto*/
.modalmask {
    position: fixed;
    font-family: Arial, sans-serif;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0,0,0,0.8);
    z-index: 99999;
    opacity:0;
    -webkit-transition: opacity 400ms ease-in;
    -moz-transition: opacity 400ms ease-in;
    transition: opacity 400ms ease-in;
    pointer-events: none;
}
.modalmask:target {
    opacity:1;
    pointer-events: auto;
}

/*Formato de la ventana*/
.modalbox{
    width: 400px;
    position: relative;
    padding: 5px 20px 13px 20px;
    background: #fff;
    border-radius:3px;
    -webkit-transition: all 500ms ease-in;
    -moz-transition: all 500ms ease-in;
    transition: all 500ms ease-in;
     
}

/*Movimientos*/
.movedown {
    margin: 0 auto;
}
.rotate {
    margin: 10% auto;
    -webkit-transform: scale(-5,-5);
    transform: scale(-5,-5);
}
.resize {
    margin: 10% auto;
    width:0;
    height:0;
 
}
.modalmask:target .movedown{       
    margin:10% auto;
}
.modalmask:target .rotate{     
    transform: rotate(360deg) scale(1,1);
        -webkit-transform: rotate(360deg) scale(1,1);
}
 
.modalmask:target .resize{
    width:600px;
    height:350px;
}

/*Boton de cerrar*/
.close {
    background: #606061;
    color: #FFFFFF;
    line-height: 25px;
    position: absolute;
    right: 1px;
    text-align: center;
    top: 1px;
    width: 24px;
    text-decoration: none;
    font-weight: bold;
    border-radius:3px;
 
}
 
.close:hover {
    background: #FAAC58;
    color:#222;
}
	</style>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  <h1 style="font-size: 26px;"><b>Lista de alumnos registrados</b></h1>
                  @if (session('success'))
										<div class="alert alert-success">
												{{ session('success') }}
										</div>
									@endif
                   <a href="#modal3"><button type="submit" class="agregar-alumno" href="">Agregar alumno</button></a> 
									<ul>
								</ul>

								<div id="modal3" class="modalmask">
									<div class="modalbox resize">
										<a href="#close" title="Close" class="close">X</a>
										<h1 style="margin:10px"><b>REGISTRO DEL ALUMNO</b></h1>
										<div class="formulario">
											<form action="{{route('registrar.alumno')}}" method="POST">
												@csrf
												<div class="first-part">
													<label for="nombre" class="nombre">Nombre</label>
													<input type="text" name="nombre" id="nombre" required>
													<label for="edad">Edad:</label>
													<input type="number" name="edad" id="edad" required>
													<label for="email">Correo:</label>
													<input type="email" name="email" id="email" required>
												</div>
                        <div class="second-part">
												<label for="apellido">Apellido:</label>
													<input type="text" name="apellido" id="apellido" required>
													{{-- <label for="grupo">Cuatrimestre y grupo:</label>
													<input type="text" name="grupo" id="grupo" required> --}}
													<label for="sexo">Sexo:</label>
													<div class="sexo">
															<label for="sexo_masculino">Masculino</label>
															<input type="radio" name="sexo" id="sexo_masculino" value="Masculino">
															<label for="sexo_femenino">Femenino</label>
															<input type="radio" name="sexo" id="sexo_femenino" value="Femenino">
													</div>
													<label for="password">Contraseña:</label>
													<input type="password" name="password" id="password" required>

												</div>
												<input type="submit" value="Registrar" class="agregar-alumno">
											</form>
										</div>
									</div>
								</div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
