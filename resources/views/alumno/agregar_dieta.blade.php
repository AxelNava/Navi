



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
        #alumnos {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: center;
            padding: 20px;
        }
        #alumno {
            margin: 10px;
            padding: 10px;
            border-radius: 10px;
            border: black 1px solid;
            width: 300px;
        }
				input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="number"],
				input[type="time"] {
            border-radius: 15px;
						margin-bottom: 10px;
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
									<h1 style="color:black;font-size:21px;font-weight:900;margin-bottom:20px">Dieta de paciente</h1>
        
									<form action="{{route('dieta-paciente_crear')}}" method="POST">
											@csrf
											{{-- <input type="hidden" name="id_registro" value="{{$id_registro}}"> --}}
											<h3>Dietéticos</h3>
											<label>Tipo de instrumentos:</label>
												<input type="radio" name="instrumento" id="hrs" value="Recordar 24/h">24 hrs
												<input type="radio" name="instrumento" id="semi" value="Dieta habitual semicuantitativa">Semicuantitativa
												<input type="radio" name="instrumento" id="diario" value="Diario de alimentos">Diario
											<br>
											<label>Desayuno hora: </label>
												<input type="time" name="desayuno_hora">
											<br>
											<label>
													Colación:
													<input type="text" name="colacion1">
											</label>
											<br>
											<label>
													Comida hora:
													<input type="time" name="comida_hora">
											</label>
											<br>
											<label>
													Colación:
													<input type="text" name="colacion2">
											</label>
											<br>
											<label>
													Cena hora:
													<input type="time" name="cena_hora">
											</label>
											<br>
											<label>
													Colación:
													<input type="text" name="colacion3">
											</label>
											<br><br>
											<label>
													Total EQ: <br>
													Verduras:<input type="text" name="verduras">
													Frutas:<input type="text" name="frutas">
													Cereales:<input type="text" name="cereales">
													Leguminosas:<input type="text" name="leguminosas">
													Carnes:<input type="text" name="carnes">
													Leche:<input type="text" name="leche">
													Grasa:<input type="text" name="grasa">
													Azúcar:<input type="text" name="azucar">
											</label>
											<br><br>
											<label>
													TOTAL:<br>
													Kcal:<input type="text" name="total_kcal">
													Prot:<input type="text" name="total_prot">(<input type="text" name="prot_g">) 
													Lip:<input type="text" name="total_lip">(<input type="text" name="lip_g">) 
													Hco:<input type="text" name="total_hco">(<input type="text" name="hco_g">)
											</label>
											<br><br>
											<label>
													% ADECUACIÓN:<br>
													Energia:<input type="text" name="adecuacion_porcen_ene">
													Kcal:<input type="text" name="adecuacion_porcen_ener_kcal">
													Prot:<input type="text" name="adecuacion_porcen_prot"> 
													Lip:<input type="text" name="adecuacion_porcen_lip">
													Hco:<input type="text" name="adecuacion_porcen_hco"><br>
													Aspectos cualitativos de dieta habitual:<input type="text" name="aspectos_cualita_dieta_habitual">
											</label>
											<br><br>
											<label>
													REQUERIMIENTOS:<br>
													Energia:<input type="text" name="reque_ener">
													Proteina total:<input type="text" name="reque_proteina">(<input type="text" name="reque_kg_dia">)
											</label>
											<br><br>
											<label>
													DX:NUTRICIO:<br>
													<input type="text" name="dx_nutricio">
											</label>
											<br>
											<label>
													OBJETIVOS:<br>
													<input type="text" name="objetivos_dieta">
											</label>
											<br>
											<label>
													PLAN DE ALIMENTACIÓN:<br>
													Dieta <input type="text" name="tipo_dieta"> de <input type="text" name="kcal_dieta">
													Prot:<input type="text" name="prot_porcent_dieta">(<input type="text" name="prot_kg_dia_dieta">)
													Lip:<input type="text" name="lip_porcen_dieta">(<input type="text" name="lip_g_dieta">)
													Hco:<input type="text" name="hco_porcen_dieta">(<input type="text" name="hco_g_dieta">)
											</label>
											<br>
											<label>
													SUPLEMENTOS:<br>
													<input type="text" name="suplementos">
											</label>
											<br>
											<label>
													METAS SMART:<br>
													<input type="text" name="metas_smart">
											</label>
											<br>
											<label>
													PARAMETROS META:<br>
													Peso:<input type="text" name="meta_peso">
													%Grasa:<input type="text" name="meta_grasa">
													Músculo:<input type="text" name="meta_musculo"> 
													C. Cintura:<input type="text" name="meta_cintura">
													<br>
													Horarios:<input type="text" name="meta_horario">
													Mejorar hábitos:<input type="text" name="meta_mejorar"> 
													Selección de alimentos:<input type="text" name="meta_alimentos">
											</label>
											<br>
											<label>
													EDUCACIÓN:<br>
													<input type="text" name="educacion">
											</label>
											<br>
											<label>
													MONITOREO:<br>
													<input type="text" name="monitoreo">
											</label>
											<br>
											<label>
													PENDIENTES:<br>
													<input type="text" name="pendientes">
											</label>
											<br>
											<label>
													NOMBRE COMPLETO, FIRMA Y CÉDULA PROFESIONAL DE QUIEN ELABORÓ LA HISTORIA CLINICA NUTRICIA:<br>
													<input type="text" name="datos_elaborador">
											</label>
											<br>
											<label>
													NOMBRE COMPLETO, FIRMA Y CÉDULA PROFESIONAL DE NUTRIÓLOG() RESPONSABLE:<br>
													<input type="text" name="datos_nutriologo">
											</label>
											
											<button type="submit" class="agregar-alumno">Crear</button>
									</form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
