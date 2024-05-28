<x-app-layout>
	<style>
    .inputs-form label, -inputs-form input{
        margin: 5px;
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
    .formulario{
      display: flex;
      flex-wrap: wrap;
      gap: 25px;
      flex-direction: column;
      border:1px solid rgb(0, 0, 0);
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
    .motivaciones{
    display: flex;
    border:black solid 1px;
    border-radius: 10px;
    justify-content: center;
    align-items: center;
    }
    .motivaciones .motivacion-item{
    display: flex;
    flex-direction: column;
    border:1px green solid;
    border-left: none;
    justify-content: center;
    align-items: center;
    padding: 10px;
    }
    .quinta-parte{
    display: flex;
    flex-direction: column;
    }
    .tabla {
    flex-wrap: wrap;
    display: flex;
    border: 1px solid #000;
    border-radius: 10px; /* Ajusta este valor para cambiar cuán redondeados son los bordos */
    overflow: hidden; /* Esto es necesario para que el borde redondeado se aplique a toda la tabla */
  }

  .tabla-izquierda {
    display: flex;
    flex: 1; /* Esto hace que la columna izquierda ocupe todo el espacio disponible */
    padding: 10px; /* Añade un poco de espacio entre el contenido y el borde */
  }
  .tabla-derecha {
    display: flex;
    flex: 1; /* Esto hace que la columna derecha ocupe todo el espacio disponible */
    padding: 10px; /* Añade un poco de espacio entre el contenido y el borde */
  } 
  .valor{
    display: flex;
    flex-direction: column;
    gap: 5px;
  }
  .mediciones{
    display: flex;
    flex-direction: column;
    gap: 12px;
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
                        <input type="text" name="nombre" id="nombre" style="width:300px">
                        <label for="nombre">EDAD</label>
                        <input type="number" name="edad" id="edad">
                        <label for="nombre">HORA</label>
                        <input type="time" name="hora" id="hora">
                      </div>
                      <div class="segunda-parte">
                        <label for="genero">GÉNERO</label>
                        <input type="text" name="genero" id="genero">
                        <label for="expediente">NO. EXPEDIENTE</label>
                        <input type="text" name="expediente" id="expediente">
                        <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento">
                        <label for="no_consulta_paciente">CONSULTA NO.</label>
                        <input type="text" name="no_consulta_paciente" id="no_consulta_paciente">
                      </div>
                      <div class="tercera-parte">
                        <label for="motivo_consulta">MOTIVO DE CONSULTA:</label>
                        <input type="text" name="motivo_consulta" id="motivo_consulta" style="width: 500px">
                        {{-- revisar aqui --}}
                        <label for="sintomas">SÍNTOMAS GASTROINTESTINALES:</label>
                        <label for="bristol">BRISTOL:</label>
                        <input type="radio" value="bristol">
                        <label for="estreñimiento">ESTREÑIMIENTO:</label>
                        <input type="radio" value="estreñimiento">
                        <label for="diarrea">DIARREA:</label>
                        <input type="radio" value="diarrea">
                        <label for="reflujo">REFLUJO:</label>
                        <input type="radio" value="reflujo">
                        <label for="gastritis">GASTRITIS:</label>
                        <input type="radio" value="gastritis">
                        <label for="saciedad">SACIEDAD:</label>
                        <input type="radio" value="saciedad">
                        <label for="temprana">TEMPRANA:</label>
                        <input type="radio" value="temprana">
                        <label for="apetito">APETITO:</label>
                        <input type="radio" value="apetito">
                        <label for="flatulencia">FLATULENCIA:</label>
                        <input type="radio" value="flatulencia">
                      </div>
                      <div class="cuarta-parte">
                        <label for="otros">OTROS</label>
                        <input type="text" style="width:300px" name="otros">
                        <label for="apego_plan_anterior_barr_apego">APEGO A PLAN ANTERIOR</label>
                        <input type="text" style="width:300px" name="apego_plan_anterior_barr_apego">
                        <label for="motivacion">MOTIVACIÓN En una escala, ¿qué tan motivado se siente de mejorar sus hábitos de alimentación?</label>
                        <div class="motivaciones">
                          <div class="motivacion-item">
                            <p>Extremadamente desmotivado</p>
                            <input type="radio" value="extramadamente_desmotivado" name="motivacion">
                          </div>
                          <div class="motivacion-item">
                            <p>Muy desmotivado</p>
                            <input type="radio" value="muy_desmotivado" name="motivacion">
                          </div>
                          <div class="motivacion-item">
                            <p>Algo desmotivado</p>
                            <input type="radio" value="algo_desmotivado" name="motivacion">
                          </div>
                          <div class="motivacion-item">
                            <p>Ligeramente desmotivado</p>
                            <input type="radio" value="ligeramente_desmotivado" name="motivacion">
                          </div>
                          <div class="motivacion-item">
                            <p>Motivación neutral</p>
                            <input type="radio" value="ni_motivado_ni_desmotivado" name="motivacion">
                          </div>
                          <div class="motivacion-item">
                            <p>Ligeramente motivado</p>
                            <input type="radio" value="ligeramente_motivado" name="motivacion">
                          </div>
                          <div class="motivacion-item">
                            <p>Algo motivado</p>
                            <input type="radio" value="algo_motivado" name="motivacion">
                          </div>
                          <div class="motivacion-item">
                            <p>Muy motivado</p>
                            <input type="radio" value="muy_motivado" name="motivacion">
                          </div>
                          <div class="motivacion-item">
                            <p>Altamente motivado</p>
                            <input type="radio" value="altamente_motivado" name="motivacion">
                          </div>
                          <div class="motivacion-item">
                            <p>Extremadamente motivado</p>
                            <input type="radio" value="extremadamente_motivado" name="motivacion">
                          </div>
                        </div>
                      </div>
                      <div class="quinta-parte">
                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">Hidratación</h2>
                        <label for="agua">Agua simple (en mililitros)</label>
                        <input type="number" name="agua" id="agua" style="width:100px;">
                        <label for="sintomas_generales">Síntomas generales</label>
                        <input type="text" name="sintomas_generales" id="">
                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">Exploración física centrada en hallazgos de nutrición</h2>
                        <label for="pelo">Pelo y uñas</label>
                        <input type="text" name="pelo_unias" id="pelo">
                        <label for="piel">Piel</label>
                        <input type="text" name="piel" id="piel">
                        <label for="ojos">Ojos</label>
                        <input type="text" name="ojos" id="ojos">
                        <label for="musculo">Musculo</label>
                        <input type="text" name="musculo" id="musculo">
                        <label for="otros">Otros</label>
                        <input type="text" name="otros" id="otros">
                        <h2 style="font-size: 20px; font-weight:900">Intolerancia a alimentos</h2>
                        <label for="no">No</label>
                        <input type="radio" name="intolerancia_alimentos" id="intolerancia" value="no">
                        <label for="si">Si</label>
                        <input type="radio" name="intolerancia_alimentos" id="intolerancia" value="si">
                        <label for="cuales">Cuales</label>
                        <input type="text" name="cuales" id="cuales">
                        <label  for="actividad" style="font-size: 20px; font-weight:900">Actividad fisica actual (frecuencia/intensidad/tiempo)</label>
                        <input type="text" name="actividad_fis_actual" id="actividad">
                        <label  for="cambios_pos_estilo_vida" style="font-size: 20px; font-weight:900">Cambios positivos en el estilo de vida</label>
                        <input type="text" name="cambios_pos_estilo_vida" id="cambios_pos_estilo_vida">
                        {{-- TABLA DE ANTROPOMÉTRICOS --}}
                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">ANTROPOMÉTRICOS</h2>
                        <div class="tabla">
                          <div class="tabla-izquierda">
                            <div class="mediciones">
                              <h2>Mediciones</h2>
                              <h2>Peso actual</h2>
                              <h2>Circunferencia cintura</h2>
                              <h2>Circunferencia cadera</h2>
                              <h2>Masa músculo (kg)</h2>
                              <h2>Masa grasa corporal (kg)</h2>
                              <h2>Masa libre de grasa (kg)</h2>
                              <h2>Agua corporal total (kg)</h2>
                            </div>
                            <div class="valor">
                              <input type="text" style="height: 30px">
                              <input type="text" style="height: 30px">
                              <input type="text" style="height: 30px">
                              <input type="text" style="height: 30px">
                              <input type="text" style="height: 30px">
                              <input type="text" style="height: 30px">
                              <input type="text" style="height: 30px">
                              <input type="text" style="height: 30px">
                            </div>
                          </div>
                          <div class="tabla-derecha">
                            <div class="mediciones">
                              <h2>Mediciones</h2>
                              <h2>Peso actual</h2>
                              <h2>Circunferencia cintura</h2>
                              <h2>Circunferencia cadera</h2>
                              <h2>Masa músculo (kg)</h2>
                              <h2>Masa grasa corporal (kg)</h2>
                              <h2>Masa libre de grasa (kg)</h2>
                              <h2>Agua corporal total (kg)</h2>
                            </div>
                            <div class="valor">
                              <input type="text">
                              <input type="text">
                              <input type="text">
                              <input type="text">
                              <input type="text">
                              <input type="text">
                              <input type="text">
                              <input type="text">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
