@use('\App\Models\ApiDatosPaciente')
<x-app-layout>
    <style>
        .inputs-form label,
        -inputs-form input {
            margin: 5px;
        }

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

        .formulario {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            flex-direction: column;
            border: 1px solid rgb(0, 0, 0);
            border-radius: 10px;
            padding: 20px;
        }

        .inputs-form {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            flex-direction: column;
        }

        input[type="text"],
        input[type="password"],
        input[type="radio"],
        input[type="email"],
        input[type="number"] {
            border-radius: 15px;
        }

        .motivaciones {
            display: flex;
            border: black solid 1px;
            border-radius: 10px;
            justify-content: center;
            align-items: center;
        }

        .motivaciones .motivacion-item {
            display: flex;
            flex-direction: column;
            border: 1px black solid;
            border-left: none;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .quinta-parte {
            display: flex;
            flex-direction: column;
        }

        .tabla {
            flex-wrap: wrap;
            display: flex;
            border: 1px solid #000;
            border-radius: 10px;
            /* Ajusta este valor para cambiar cuán redondeados son los bordos */
            overflow: hidden;
            /* Esto es necesario para que el borde redondeado se aplique a toda la tabla */
        }

        .tabla-izquierda {
            display: flex;
            flex: 1;
            /* Esto hace que la columna izquierda ocupe todo el espacio disponible */
            padding: 10px;
            /* Añade un poco de espacio entre el contenido y el borde */
        }

        .tabla-derecha {
            display: flex;
            flex: 1;
            /* Esto hace que la columna derecha ocupe todo el espacio disponible */
            padding: 10px;
            /* Añade un poco de espacio entre el contenido y el borde */
        }

        .valor {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .mediciones {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .tabla-bioquimicos {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            border: 1px solid black;
            border-radius: 15px;
            padding: 10px;
        }

        .tabla-uno,
        .tabla-dos,
        .tabla-tres,
        .tabla-cuatro {
            display: flex;
            flex-direction: column;
            gap: 10px;
            border-right: 1px solid black;
            padding: 15px;
        }

        .bioquimico-formulario1,
        .bioquimico-formulario2,
        .bioquimico-formulario3,
        .bioquimico-formulario4 {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .tabla-bioquimicos .inputs {
            display: flex;
            gap: 10px;
        }

        .tabla-dieteticos {
            display: flex;
            gap: 30px;
            border: solid black 1px;
            border-radius: 15px;
            justify-content: center;
            align-items: center;
            height: 100px;
            flex-direction: column;
            padding: 70px;
        }

        .dieteticos1,
        .dieteticos2 {
            display: flex;
            gap: 10px;
        }

        .btn-guardar {
            background-color: blue;
            padding: 30px;
            color: white;
            border-radius: 10px;
            width: 140px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px auto;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Formulario de
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="formulario">
                        <b style="font-size: 20px">NOTA DE NUTRICIÓN</b>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('nota-nutricion_crear') }}" method="POST">
                            @csrf
                            <div class="primer-form">

                                <div class="inputs-form">
                                    <div class="primera-parte">
                                        <label for="nombre">NOMBRE</label>
                                        <input type="text" name="nombre" id="nombre" style="width:300px"
                                            value="{{ old('nombre', $data['paciente']->nombre) }}">
                                        <label for="nombre">EDAD</label>
                                        <input type="number" name="edad" id="edad"
                                            value="{{ old('edad', $data['paciente']->edad) }}">
                                        <label for="nombre">HORA</label>
                                        <input type="time" name="hora" id="hora"
                                            value="{{ old('hora', $data['control_citas']->hora_cita) }}">
                                    </div>
                                    <div class="segunda-parte">
                                        <br>
                                        <label for="genero">GÉNERO</label>
                                        <select name="genero" id="genero">
                                            <option value="M" @selected(old('genero', $data['paciente']['genero']) == 'M')>Masculino</option>
                                            <option value="F" @selected(old('genero', $data['paciente']['genero']) == 'F')>Femenino</option>
                                        </select>

                                        <label for="expediente">NO. EXPEDIENTE</label>
                                        <label for="">{{ $data['datos_paciente']['expediente'] }}</label>
                                        <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                                        <label for="">{{ $data['datos_paciente']['fecha_nacimiento'] }}</label>
                                        <br>
                                        <br>
                                        <label for="no_consulta_paciente">CONSULTA NO.</label>
                                        <input type="text" name="no_consulta_paciente" id="no_consulta_paciente"
                                            value="{{ old('no_consulta_paciente', $data['registro_consulta']['no_consulta_paciente']) }}">
                                    </div>
                                    <div class="tercera-parte">
                                        <br>
                                        <label for="motivo_consulta">MOTIVO DE CONSULTA:</label>
                                        <br>
                                        <input type="text" name="motivo_consulta" id="motivo_consulta"
                                            style="width: 500px"
                                            value="{{ old('motivo_consulta', $data['registro_consulta']['motivo_consulta']) }}">
                                        <br>
                                        <br>
                                        {{-- revisar aqui --}}
                                        <label for="sintomas">SÍNTOMAS GASTROINTESTINALES:</label>
                                        <label for="bristol">BRISTOL:</label>
                                        <input type="radio" value="bristol" name='sintoma_gastro'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']) == 'bristol')>
                                        <label for="estreñimiento">ESTREÑIMIENTO:</label>
                                        <input type="radio" value="estreñimiento" name='sintoma_gastro'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']) == 'estreñimiento')>
                                        <label for="diarrea">DIARREA:</label>
                                        <input type="radio" value="diarrea" name='sintoma_gastro'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']) == 'diarrea')>
                                        <label for="reflujo">REFLUJO:</label>
                                        <input type="radio" value="reflujo" name='sintoma_gastro'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']) == 'reflujo')>
                                        <label for="gastritis">GASTRITIS:</label>
                                        <input type="radio" value="gastritis" name='sintoma_gastro'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']) == 'Gastritis')>
                                        <label for="saciedad">SACIEDAD:</label>
                                        <input type="radio" value="saciedad" name='sintoma_gastro'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']) == 'saciedad')>
                                        <label for="temprana">TEMPRANA:</label>
                                        <input type="radio" value="temprana" name='sintoma_gastro'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']) == 'temprana')>
                                        <label for="apetito">APETITO:</label>
                                        <input type="radio" value="apetito" name='sintoma_gastro'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']) == 'apetito')>
                                        <label for="flatulencia">FLATULENCIA:</label>
                                        <input type="radio" value="flatulencia" name='sintoma_gastro'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']) == 'flatulencia')>
                                    </div>
                                    <div class="cuarta-parte">
                                        <label for="otros">OTROS</label>
                                        <input type="text" style="width:300px" name="otros"
                                            value="{{ old('otros', $data['registro_consulta']['otros_sintoma_gastro']) }}">
                                        <label for="apego_plan_anterior_barr_apego">APEGO A PLAN ANTERIOR</label>
                                        <input type="text" style="width:300px"
                                            name="apego_plan_anterior_barr_apego"
                                            value="{{ old('apego_plan_anterior_barr_apego', $data['registro_consulta']['apego_plan_anterior_barr_apego']) }}">
                                        <label for="motivacion">MOTIVACIÓN En una escala, ¿qué tan motivado se siente
                                            de
                                            mejorar sus hábitos de alimentación?</label>
                                        <div class="motivaciones">
                                            <div class="motivacion-item">
                                                <p>Extremadamente desmotivado</p>
                                                <input type="radio" value="extramadamente_desmotivado"
                                                    name="motivacion" @checked(old('motivacion', $data['registro_consulta']['motivacion']) == 'extramadamente_desmotivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Muy desmotivado</p>
                                                <input type="radio" value="muy_desmotivado" name="motivacion"
                                                    @checked(old('motivacion', $data['registro_consulta']['motivacion']) == 'muy_desmotivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Algo desmotivado</p>
                                                <input type="radio" value="algo_desmotivado" name="motivacion"
                                                    @checked(old('motivacion', $data['registro_consulta']['motivacion']) == 'algo_desmotivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Ligeramente desmotivado</p>
                                                <input type="radio" value="ligeramente_desmotivado"
                                                    name="motivacion" @checked(old('motivacion', $data['registro_consulta']['motivacion']) == 'ligeramente_desmotivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Motivación neutral</p>
                                                <input type="radio" value="ni_motivado_ni_desmotivado"
                                                    name="motivacion" @checked(old('motivacion', $data['registro_consulta']['motivacion']) == 'ni_motivado_ni_desmotivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Ligeramente motivado</p>
                                                <input type="radio" value="ligeramente_motivado" name="motivacion"
                                                    @checked(old('motivacion', $data['registro_consulta']['motivacion']) == 'ligeramente_motivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Algo motivado</p>
                                                <input type="radio" value="algo_motivado" name="motivacion"
                                                    @checked(old('motivacion', $data['registro_consulta']['motivacion']) == 'algo_motivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Muy motivado</p>
                                                <input type="radio" value="muy_motivado" name="motivacion"
                                                    @checked(old('motivacion', $data['registro_consulta']['motivacion']) == 'muy_motivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Altamente motivado</p>
                                                <input type="radio" value="altamente_motivado" name="motivacion"
                                                    @checked(old('motivacion', $data['registro_consulta']['motivacion']) == 'altamente_motivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Extremadamente motivado</p>
                                                <input type="radio" value="extremadamente_motivado"
                                                    name="motivacion" @checked(old('motivacion', $data['registro_consulta']['motivacion']) == 'extremadamente_motivado')>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="quinta-parte">
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">HIDRATACIÓN</h2>
                                        <article>
                                            <label for="agua">Agua simple (en mililitros)</label>
                                            <input type="number" name="hidratacion" id="agua"
                                                style="width:100px;"
                                                value="{{ old('hidratacion', $data['registro_consulta']['hidratacion']['hidratacion'] ?? '') }}">
                                            <div class="inputs">
                                                <label for="otros_hidratacion">Otras bebidas</label><br>
                                                <textarea name="otras_bebidas" id="otros_hidratacion" cols="30" rows="10">{{ old('otras_bebidas', $data['registro_consulta']['hidratacion']['otros_hidratacion'] ?? '') }}</textarea>
                                            </div>
                                        </article>
                                        <label for="sintomas_generales">Síntomas generales</label>
                                        <input type="text" name="sintomas_generales" id=""
                                            value="{{ old('sintomas_generales', $data['registro_consulta']['sintomas_generales']) }}">
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">EXPLORACIÓN FÍSICA
                                            CENTRADA EN HALLAZGOS DE NUTRICIÓN</h2>
                                        <label for="pelo">Pelo y uñas</label>
                                        <input type="text" name="pelo_unias" id="pelo"
                                            value="{{ old('pelo_unias', $data['explo_fisica']['pelo_unias']) }}">
                                        <label for="piel">Piel</label>
                                        <input type="text" name="piel" id="piel"
                                            value="{{ old('piel', $data['explo_fisica']['piel']) }}">
                                        <label for="ojos">Ojos</label>
                                        <input type="text" name="ojos" id="ojos"
                                            value="{{ old('ojos', $data['explo_fisica']['ojos']) }}">
                                        <label for="musculo">Musculo</label>
                                        <input type="text" name="musculo" id="musculo"
                                            value="{{ old('musculo', $data['explo_fisica']['musculo']) }}">
                                        <label for="otros_explo_fisica">Otros</label>
                                        <input type="text" name="otros_explo_fisica" id="otros_explo_fisica"
                                            value="{{ old('otros_explo_fisica', $data['explo_fisica']['otros']) }}">
                                        <h2 style="font-size: 20px; font-weight:900">INTOLERANCIA A ALIMENTOS</h2>
                                        <label for="no">No</label>
                                        <input type="radio" name="radio_into_aliment" id="intolerancia"
                                            value="no" @checked(empty(old('radio_into_aliment', $data['explo_fisica']['intolerancia_alimentos'])))>
                                        <label for="si">Si</label>
                                        <input type="radio" name="radio_into_aliment" id="intolerancia"
                                            value="yes" @checked(!empty(old('radio_into_aliment', $data['explo_fisica']['intolerancia_alimentos'])))>
                                        <label for="cuales">Cuales</label>
                                        <input type="text" name="intolerancia_alimentos" id="cuales"
                                            value="{{ old('cuales', $data['explo_fisica']['intolerancia_alimentos']) }}">
                                        <label for="actividad" style="font-size: 20px; font-weight:900">ACTIVIDAD
                                            FÍSICA
                                            ACTUAL (frecuencia/intensidad/tiempo)</label>
                                        <input type="text" name="actividad_fis_actual" id="actividad"
                                            value="{{ old('actividad_fis_actual', $data['explo_fisica']['intolerancia_alimentos']) }}">
                                        <label for="cambios_pos_estilo_vida"
                                            style="font-size: 20px; font-weight:900">CAMBIOS POSITIVOS EN EL ESTILO DE
                                            VIDA</label>
                                        <input type="text" name="cambios_pos_estilo_vida"
                                            id="cambios_pos_estilo_vida"
                                            value="{{ old('cambios_pos_estilo_vida', $data['explo_fisica']['cambios_pos_estilo_vida']) }}">
                                        {{-- TABLA DE ANTROPOMÉTRICOS --}}
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">ANTROPOMÉTRICOS
                                        </h2>
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
                                                    <input type="text" style="height: 30px" id=""
                                                        disabled>
                                                    <input type="text" style="height: 30px" name="peso"
                                                        value="{{ old('peso', $data['control_citas']['peso']) }}">
                                                    <input type="text" style="height: 30px"
                                                        name="circunferencia_cintura"
                                                        value="{{ old('circunferencia_cintura', $data['control_citas']['circunferencia_cintura']) }}">
                                                    <input type="text" style="height: 30px"
                                                        name="circunferencia_cadera"
                                                        value="{{ old('circunferencia_cadera', $data['control_citas']['circunferencia_cadera']) }}">
                                                    <input type="text" style="height: 30px" name="masa_muscular"
                                                        value="{{ old('masa_muscular', $data['control_citas']['masa_muscular_kg']) }}">
                                                    <input type="text" style="height: 30px"
                                                        name="mas_grasa_corporal"
                                                        value="{{ old('mas_grasa_corporal', $data['control_citas']['masa_grasa_corporal']) }}">
                                                    <input type="text" style="height: 30px"
                                                        name="masa_libre_grasa"
                                                        value="{{ old('masa_libre_grasa', $data['control_citas']['masa_libre_grasa'] ?? '') }}">
                                                    <input type="text" style="height: 30px" name="act"
                                                        value="{{ old('act', $data['control_citas']['agua_corpolar']) }}">
                                                </div>
                                            </div>
                                            <div class="tabla-derecha">
                                                <div class="mediciones">
                                                    <h2>IMC (kg/m2) Diagnóstico:</h2>
                                                    <h2>Índice cintura-cadera</h2>
                                                    <h2>Rango de peso saludable</h2>
                                                    <h2>Índice de masa libre de grasa</h2>
                                                    <h2>% Grasa corporal</h2>
                                                    <h2>Otros</h2>
                                                </div>
                                                <div class="valor">
                                                    <input type="text" style="height: 30px" name="imc"
                                                        value="{{ old('imc', $data['control_citas']['IMC']) }}">
                                                    <input type="text" style="height: 30px" name="rcc"
                                                        value="{{ old('rcc', $data['composcion_corp']['rcc']) }}">
                                                    <input type="text" style="height: 30px"
                                                        name="rango_peso_saludable"
                                                        value="{{ old('rango_peso_saludable', $data['control_citas']['rango_peso_saludable'] ?? '') }}">
                                                    <input type="text" style="height: 30px"
                                                        name="indice_masa_libre_grasa"
                                                        value="{{ old('indice_masa_libre_grasa', $data['control_citas']['masa_libre_grasa'] ?? '') }}">
                                                    <input type="text" style="height: 30px"
                                                        name="porcentaje_grasa_corporal"
                                                        value="{{ old('porcentaje_grasa_corporal', $data['composcion_corp']['pgc']) }}">
                                                    <input type="text" style="height: 30px"
                                                        name="otros_antropometricos"
                                                        value="{{ old('otros_antropometricos', $data['composcion_corp']['otros'] ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- tabla de bioquimicos --}}
                                    <div class="sexta-parte">
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">BIOQUÍMICOS</h2>
                                        <div class="tabla-bioquimicos">
                                            <div class="tabla-uno">
                                                <div class="bioquimico-formulario1">
                                                    <div class="inputs">
                                                        <p>BIOQUIMICOS:</p>
                                                        <input type="radio" name="" id="">
                                                        <input type="radio" name="" id="">
                                                        <input type="radio" name="" id="">
                                                    </div>
                                                    <div class="inputs">
                                                        <label>Glucosa</label>
                                                        <input type="text" name="glucosa" id=""
                                                            placeholder="mg/dl"
                                                            value="{{ old('glucosa', $data['bioquimicos']['glucosa']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="hbAc1">HbAc1</label>
                                                        <input type="text" name="hbAc1" id="hbAc1"
                                                            placeholder="%"
                                                            value="{{ old('hbAc1', $data['bioquimicos']['hbAc1']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="TG">TG</label>
                                                        <input type="text" name="TG" id="TG"
                                                            placeholder="mg/dl"
                                                            value="{{ old('TG', $data['bioquimicos']['TG']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="CT">CT</label>
                                                        <input type="text" name="CT" id="CT"
                                                            placeholder="mg/dl"
                                                            value="{{ old('CT', $data['bioquimicos']['CT']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="HDL">HDL</label>
                                                        <input type="text" name="HDL" id="HDL"
                                                            placeholder="mg/dl"
                                                            value="{{ old('HDL', $data['bioquimicos']['HDL']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="LDL">LDL</label>
                                                        <input type="text" name="LDL" id="LDL"
                                                            placeholder="mg/dl"
                                                            value="{{ old('LDL', $data['bioquimicos']['LDL']) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tabla-dos">
                                                <div class="bioquimico-formulario2">
                                                    <div class="inputs">
                                                        <label for="AST_perc">%AST</label>
                                                        <input type="text" name="AST_perc" id="AST_perc"
                                                            placeholder="UI/L"
                                                            value="{{ old('AST_perc', $data['bioquimicos']['AST_perc']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="ALT">ALT</label>
                                                        <input type="text" name="ALT" id="ALT"
                                                            placeholder="UI/L"
                                                            value="{{ old('ALT', $data['bioquimicos']['ALT']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="TSH">TSH</label>
                                                        <input type="text" name="TSH" id="TSH"
                                                            placeholder="UI/L"
                                                            value="{{ old('TSH', $data['bioquimicos']['TSH']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="T3">T3</label>
                                                        <input type="text" name="T3" id="T3"
                                                            placeholder="UI/L"
                                                            value="{{ old('T3', $data['bioquimicos']['T3']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="T4">T4</label>
                                                        <input type="text" name="T4" id="T4"
                                                            placeholder="UI/L"
                                                            value="{{ old('T4', $data['bioquimicos']['T4']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="Hb">Hb</label>
                                                        <input type="text" name="Hb" id="Hb"
                                                            placeholder="UI/L"
                                                            value="{{ old('Hb', $data['bioquimicos']['Hb']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="Hierro">Hierro</label>
                                                        <input type="text" name="hierro" id="Hierro"
                                                            placeholder="UI/L"
                                                            value="{{ old('hierro', $data['bioquimicos']['hierro']) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tabla-tres">
                                                <div class="bioquimico-formulario3">
                                                    <div class="inputs">
                                                        <label for="transferrina">Transferrina</label>
                                                        <input type="text" name="transferrina" id="transferrina"
                                                            placeholder="mg/dL"
                                                            value="{{ old('transferrina', $data['bioquimicos']['transferrina']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="ferritina">Ferritina</label>
                                                        <input type="text" name="ferritina" id="ferritina"
                                                            placeholder="ng/mL"
                                                            value="{{ old('ferritina', $data['bioquimicos']['ferritina']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="t3_libre">T3Libre</label>
                                                        <input type="text" name="t3_libre" id="t3_libre"
                                                            placeholder="pg/dL"
                                                            value="{{ old('t3_libre', $data['bioquimicos']['t3_libre']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="t4_libre">T4Libre</label>
                                                        <input type="text" name="t4_libre" id="t4_libre"
                                                            placeholder="ng/dL"
                                                            value="{{ old('t4_libre', $data['bioquimicos']['t4_libre']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="hto">Hto</label>
                                                        <input type="text" name="hto" id="hto"
                                                            placeholder="%"
                                                            value="{{ old('hto', $data['bioquimicos']['hto']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="B12">B12</label>
                                                        <input type="text" name="B12" id="B12"
                                                            placeholder="pg/mL"
                                                            value="{{ old('B12', $data['bioquimicos']['B12']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="folatos">Folatos</label>
                                                        <input type="text" name="folatos" id="folatos"
                                                            placeholder="ng/mL"
                                                            value="{{ old('folatos', $data['bioquimicos']['folatos']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="otros">Otros</label>
                                                        <input type="text" name="otros_bioquimicos"
                                                            id="otros_bioquimicos"
                                                            value="{{ old('otros_bioquimicos', $data['bioquimicos']['otros']) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tabla-cuatro">
                                                <div class="bioquimico-formulario4">
                                                    <div class="inputs">
                                                        <label for="PT">PT</label>
                                                        <input type="text" name="PT" id="PT"
                                                            placeholder="d/dL"
                                                            value="{{ old('PT', $data['bioquimicos']['PT']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="albumina">Albúmina</label>
                                                        <input type="text" name="albumina" id="albumina"
                                                            placeholder="g/dL"
                                                            value="{{ old('albumina', $data['bioquimicos']['albumina']) }}">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="Ca">Ca</label>
                                                        <input type="text" name="Ca" id="Ca"
                                                            placeholder="UI/L"
                                                            value="{{ old('Ca', $data['bioquimicos']['Ca']) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- septima parte - clinicos, medicamentos  y tabla dieteticos --}}
                                    <div class="septima-parte">
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">CLÍNICOS</h2>
                                        <label for="dx_medicos">DX MEDICOS</label>
                                        <input type="text" name="dx_medicos" id="dx_medicos"
                                            value="{{ old('dx_medicos', $data['registro_consulta']['clinicos']) }}">
                                        <label for="dinamometria">DINAMOMETRÍA (fuerza de agarre)</label>
                                        <input type="text" name="dinamometria" id="dinamometria" placeholder="KG"
                                            value="{{ old('dinamometria', $data['registro_consulta']['dinamometria']['dinamometria'] ?? '') }}">
                                        <br>
                                        <br>
                                        <label for="interpretacion_dinamometrica">INTERPRETACIÓN DINAMOMETRICA</label>
                                        <input type="text" name="interpretacion_dinamometrica"
                                            id="interpretacion_dinamometrica"
                                            value="{{ old('interpretacion_dinamometrica', $data['registro_consulta']['dinamometria']['interpretacion_dinamometrica'] ?? '') }}">
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">
                                            MEDICAMENTOS/SUPLEMENTOS</h2>
                                        <input type="text" name="medicamentos_suplementos"
                                            id="medicamentos_suplementos" style="width:650px;"
                                            value="{{ old('medicamentos_suplementos', $data['registro_consulta']['medicamentos_suplementos']) }}">
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">DIETÉTICOS:
                                            FRECUENCIA
                                            DE CONSUMO DE ALIMENTOS, ¿Cuántas veces por semana consume los siguientes
                                            alimentos?</h2>
                                        <div class="tabla-dieteticos">
                                            <div class="dieteticos1">
                                                <h2 style="background:rgb(194, 194, 194);padding:3px">Frutas</h2>
                                                <h2 style="background:rgb(194, 194, 194);padding:3px">Verduras</h2>
                                                <h2 style="background:rgb(194, 194, 194);padding:3px">Cereales s/g</h2>
                                                <h2 style="background:rgb(194, 194, 194);padding:3px">Cereales c/g</h2>
                                                <h2 style="background:rgb(194, 194, 194);padding:3px">Leguminosas</h2>
                                                <h2 style="background:rgb(194, 194, 194);padding:3px">POA</h2>
                                                <h2 style="background:rgb(194, 194, 194);padding:3px">Lácteos</h2>
                                                <h2 style="background:rgb(194, 194, 194);padding:3px">Aceites s/p</h2>
                                                <h2 style="background:rgb(194, 194, 194);padding:3px">Aceites c/p</h2>
                                                <h2 style="background:rgb(194, 194, 194);padding:3px">Azúcares</h2>
                                            </div>
                                            <div class="dieteticos2">
                                                <input type="text" name="frutas" id=""
                                                    style="width:70px"
                                                    value="{{ old('frutas', $data['frecuencia_semanal']['frutas']) }}">
                                                <input type="text" name="verduras" id=""
                                                    style="width:70px"
                                                    value="{{ old('verduras', $data['frecuencia_semanal']['verduras']) }}">
                                                <input type="text" name="cereales_sg" id=""
                                                    style="width:70px"
                                                    value="{{ old('cereales_sg', $data['frecuencia_semanal']['cereales_s_g']) }}">
                                                <input type="text" name="cereales_cg" id=""
                                                    style="width:70px"
                                                    value="{{ old('cereales_cg', $data['frecuencia_semanal']['cereales_c_g']) }}">
                                                <input type="text" name="leguminosas" id=""
                                                    style="width:70px"
                                                    value="{{ old('leguminosas', $data['frecuencia_semanal']['leguminosas']) }}">
                                                <input type="text" name="poa" id=""
                                                    style="width:70px"
                                                    value="{{ old('poa', $data['frecuencia_semanal']['poa']) }}">
                                                <input type="text" name="lacteos" id=""
                                                    style="width:70px"
                                                    value="{{ old('lacteos', $data['frecuencia_semanal']['lacteos']) }}">
                                                <input type="text" name="aceites_sp" id=""
                                                    style="width:70px"
                                                    value="{{ old('aceites_sp', $data['frecuencia_semanal']['aceites_s_p']) }}">
                                                <input type="text" name="aceites_cp" id=""
                                                    style="width:70px"
                                                    value="{{ old('aceites_cp', $data['frecuencia_semanal']['aceites_c_p']) }}">
                                                <input type="text" name="azucares" id=""
                                                    style="width:70px"
                                                    value="{{ old('azucares', $data['frecuencia_semanal']['azucares']) }}">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <button type="submit" class="btn-guardar">Guardar datos</button> --}}
                                    <button class="prueba btn-guardar" type="button">Continuar formulario</button>
                                </div>

                            </div>
                            {{-- </form> --}}
                            {{-- segunda parte --}}
                            {{-- <form action="{{route('dieta-paciente_crear')}}" method="POST" class="segundo-form"> --}}
                            {{-- <input type="hidden" name="id_registro" value="{{$id_registro}}"> --}}
                            <div class="segundo-form">
                                <h3>Dietéticos</h3>
                                <label>Tipo de instrumentos:</label>
                                <input type="radio" name="instrumento" id="hrs" value="Recorda 24/h"
                                    @checked(old('instrumento', $data['instrumento']['tipo_instrumento'] ?? '') == 'Recorda 24/h')>24 hrs
                                <input type="radio" name="instrumento" id="semi"
                                    value="Dieta habitual semicuantitativa"
                                    @checked(old('instrumento', $data['instrumento']['tipo_instrumento'] ?? '') == 'Dieta habitual semicuantitativa')>Semicuantitativa
                                <input type="radio" name="instrumento" id="diario" value="Diario de alimentos"
                                    @checked(old('instrumento', $data['instrumento']['tipo_instrumento'] ?? '') == 'Diario de alimentos')>Diario
                                <br>
                                <label>Desayuno hora: </label>
                                <input type="time" name="desayuno_hora"
                                    value="{{ old('desayuno_hora', $data['instrumento']['desayuno_hora']) }}">
                                <br>
                                <label>
                                    Colación:
                                    <input type="text" name="colacion1"
                                        value="{{ old('colacion1', $data['instrumento']['colacion1']) }}">
                                </label>
                                <br>
                                <label>
                                    Comida hora:
                                    <input type="time" name="comida_hora"
                                        value="{{ old('comida_hora', $data['instrumento']['comida_hora']) }}">
                                </label>
                                <br>
                                <label>
                                    Colación:
                                    <input type="text" name="colacion2"
                                        value="{{ old('colacion2', $data['instrumento']['colacion2']) }}">
                                </label>
                                <br>
                                <label>
                                    Cena hora:
                                    <input type="time" name="cena_hora"
                                        value="{{ old('cena_hora', $data['instrumento']['cena_hora']) }}">
                                </label>
                                <br>
                                <label>
                                    Colación:
                                    <input type="text" name="colacion3"
                                        value="{{ old('colacion3', $data['instrumento']['colacion3']) }}">
                                </label>
                                <br><br>
                                <label>
                                    Total EQ: <br>
                                    Verduras:<input type="text" name="verduras"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['verduras'] ?? '') }}">
                                    Frutas:<input type="text" name="frutas"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['frutas'] ?? '') }}">
                                    Cereales:<input type="text" name="cereales"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['cereales'] ?? '') }}">
                                    Leguminosas:<input type="text" name="leguminosas"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['leguminosas'] ?? '') }}">
                                    Carnes:<input type="text" name="carnes"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['carnes'] ?? '') }}">
                                    Leche:<input type="text" name="leche"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['leche'] ?? '') }}">
                                    Grasa:<input type="text" name="grasa"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['grasa'] ?? '') }}">
                                    Azúcar:<input type="text" name="azucar"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['azucar'] ?? '') }}">
                                </label>
                                <br><br>
                                <label>
                                    TOTAL:<br>
                                    Kcal:<input type="text" name="total_kcal"
                                        value="{{ old('', $data['instrumento']['total_kcal'] ?? '') }}">
                                    Prot:<input type="text" name="total_prot"
                                        value="{{ old('', $data['instrumento']['total_prot']['prot_porcent'] ?? '') }}">(<input
                                        type="text" name="prot_g"
                                        value="{{ old('', $data['instrumento']['total_prot']['prot_g'] ?? '') }}">)
                                    Lip:<input type="text" name="total_lip"
                                        value="{{ old('', $data['instrumento']['total_lip']['lip_porcent'] ?? '') }}">(<input
                                        type="text" name="lip_g"
                                        value="{{ old('', $data['instrumento']['total_lip']['lip_g'] ?? '') }}">)
                                    Hco:<input type="text" name="total_hco"
                                        value="{{ old('', $data['instrumento']['total_hco']['hco_porcent'] ?? '') }}">(<input
                                        type="text" name="hco_g"
                                        value="{{ old('', $data['instrumento']['total_hco']['hco_g'] ?? '') }}">)
                                </label>
                                <br><br>
                                <label>
                                    % ADECUACIÓN:<br>
                                    Energia:<input type="text" name="adecuacion_porcen_ene"
                                        value="{{ old('adecuacion_porcen_ene', $data['instrumento']['adecuacion_porcen_ene']) }}">
                                    Kcal:<input type="text" name="adecuacion_porcen_ener_kcal"
                                        value="{{ old('adecuacion_porcen_ener_kcal', $data['instrumento']['adecuacion_porcen_ener_kcal']) }}">
                                    Prot:<input type="text" name="adecuacion_porcen_prot"
                                        value="{{ old('adecuacion_porcen_prot', $data['instrumento']['adecuacion_porcen_prot']) }}">
                                    Lip:<input type="text" name="adecuacion_porcen_lip"
                                        value="{{ old('adecuacion_porcen_lip', $data['instrumento']['adecuacion_porcen_lip']) }}">
                                    Hco:<input type="text" name="adecuacion_porcen_hco"
                                        value="{{ old('adecuacion_porcen_hco', $data['instrumento']['adecuacion_porcen_hco']) }}">
                                    <br>
                                    Aspectos cualitativos de dieta habitual:<input type="text"
                                        name="aspectos_cualita_dieta_habitual"
                                        value="{{ old('aspectos_cualita_dieta_habitual', $data['instrumento']['aspectos_cualita_dieta_habitual']) }}">
                                </label>
                                <br><br>
                                <label>
                                    REQUERIMIENTOS:<br>
                                    Energia:<input type="text" name="reque_ener"
                                        value="{{ old('reque_ener', $data['diagnostico']['reque_ener']) }}">
                                    Proteina total:<input type="text" name="reque_proteina"
                                        value="{{ old('reque_proteina', $data['diagnostico']['reque_proteina']) }}">(<input
                                        type="text" name="reque_kg_dia"
                                        value="{{ old('reque_kg_dia', $data['diagnostico']['reque_kg_dia']) }}">)
                                </label>
                                <br><br>
                                <label>
                                    DX:NUTRICIO:<br>
                                    <input type="text" name="dx_nutricio"
                                        value="{{ old('dx_nutricio', $data['diagnostico']['dx_nutricio']) }}">
                                </label>
                                <br>
                                <label>
                                    OBJETIVOS:<br>
                                    <input type="text" name="objetivos_dieta"
                                        value="{{ old('objetivos_dieta', $data['generales']['objetivos_dieta']) }}">
                                </label>
                                <br>
                                <label>
                                    PLAN DE ALIMENTACIÓN:<br>
                                    Dieta <input type="text" name="tipo_dieta"
                                        value="{{ old('tipo_dieta', $data['generales']['tipo_dieta']) }}"> de <input
                                        type="text" name="kcal_dieta"
                                        value="{{ old('kcal_dieta', $data['generales']['kcal_dieta']) }}">
                                    Prot:<input type="text" name="prot_porcent_dieta"
                                        value="{{ old('prot_porcent_dieta', $data['generales']['prot_porcent_dieta']) }}">(<input
                                        type="text" name="prot_kg_dia_dieta"
                                        value="{{ old('prot_kg_dia_dieta', $data['generales']['prot_kg_dia_dieta']) }}">)
                                    Lip:<input type="text" name="lip_porcen_dieta"
                                        value="{{ old('lip_porcen_dieta', $data['generales']['lip_porcen_dieta']) }}">(<input
                                        type="text" name="lip_g_dieta"
                                        value="{{ old('lip_g_dieta', $data['generales']['lip_g_dieta']) }}">)
                                    Hco:<input type="text" name="hco_porcen_dieta"
                                        value="{{ old('hco_porcen_dieta', $data['generales']['hco_porcen_dieta']) }}">(<input
                                        type="text" name="hco_g_dieta"
                                        value="{{ old('hco_g_dieta', $data['generales']['hco_g_dieta']) }}">)
                                </label>
                                <br>
                                <label>
                                    SUPLEMENTOS:<br>
                                    <input type="text" name="suplementos"
                                        value="{{ old('suplementos', $data['generales']['suplementos']) }}">
                                </label>
                                <br>
                                <label>
                                    METAS SMART:<br>
                                    <input type="text" name="metas_smart"
                                        value="{{ old('metas_smart', $data['generales']['metas_smart']) }}">
                                </label>
                                <br>
                                <label>
                                    PARAMETROS META:<br>
                                    Peso:<input type="text" name="meta_peso"
                                        value="{{ old('meta_peso', $data['generales']['param_meta']['peso']) }}">
                                    %Grasa:<input type="text" name="meta_grasa"
                                        value="{{ old('meta_grasa', $data['generales']['param_meta']['porcen_grasa']) }}">
                                    Músculo:<input type="text" name="meta_musculo"
                                        value="{{ old('meta_musculo', $data['generales']['param_meta']['musculo']) }}">
                                    C. Cintura:<input type="text" name="meta_cintura"
                                        value="{{ old('meta_cintura', $data['generales']['param_meta']['c_cintura']) }}">
                                    <br>
                                    Horarios:<input type="text" name="meta_horario"
                                        value="{{ old('meta_horario', $data['generales']['param_meta']['horarios']) }}">
                                    Mejorar hábitos:<input type="text" name="meta_mejorar"
                                        value="{{ old('meta_mejorar', $data['generales']['param_meta']['m_habitos']) }}">
                                    Selección de alimentos:<input type="text" name="meta_alimentos"
                                        value="{{ old('meta_alimentos', $data['generales']['param_meta']['selec_alimentos']) }}">
                                </label>
                                <br>
                                <label>
                                    EDUCACIÓN:<br>
                                    <input type="text" name="educacion"
                                        value="{{ old('educacion', $data['generales']['educacion']) }}">
                                </label>
                                <br>
                                <label>
                                    MONITOREO:<br>
                                    <input type="text" name="monitoreo"
                                        value="{{ old('monitoreo', $data['generales']['monitoreo']) }}">
                                </label>
                                <br>
                                <label>
                                    PENDIENTES:<br>
                                    <input type="text" name="pendientes"
                                        value="{{ old('pendientes', $data['registro_consulta']['pendientes']) }}">
                                </label>
                                <br>
                                <label>
                                    NOMBRE COMPLETO, FIRMA Y CÉDULA PROFESIONAL DE QUIEN ELABORÓ LA HISTORIA CLINICA
                                    NUTRICIA:<br>
                                    <input type="text" name="datos_elaborador"
                                        value="{{ old('datos_elaborador', $data['registro_consulta']['nutri_elaborate_data']) }}">
                                </label>
                                <br>
                                <label>
                                    NOMBRE COMPLETO, FIRMA Y CÉDULA PROFESIONAL DE NUTRIÓLOG() RESPONSABLE:<br>
                                    <input type="text" name="datos_nutriologo"
                                        value="{{ old('datos_nutriologo', $data['registro_consulta']['nutri_elaborate_data']) }}">
                                </label>

                                <button type="submit" class="agregar-alumno">Crear</button>
                                <button class="regresar" type="button">Regresar formulario</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
<script>
    let primerForm = document.querySelector('.primer-form');
    let segundoForm = document.querySelector('.segundo-form');
    let btnPrueba = document.querySelector('.prueba');
    let btnRegresar = document.querySelector('.regresar');

    segundoForm.style.display = 'none';

    btnPrueba.addEventListener('click', () => {
        primerForm.style.display = 'none';
        segundoForm.style.display = 'block';
        window.scrollTo(0, 0);
    })

    btnRegresar.addEventListener('click', () => {
        primerForm.style.display = 'block';
        segundoForm.style.display = 'none';
        window.scrollTo(0, 0);

    })
</script>
