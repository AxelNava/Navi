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
            Formulario de {{ $data['paciente']->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="formulario">
                        <b style="font-size: 20px">NOTA DE NUTRICIÓN</b>
                        <form
                            action="{{ route('nota-nutricion_actualizar', $data['registro_consulta']['id_registro']) }}"
                            method="POST">
                            @csrf @method('PATCH')
                            <div class="primer-form">

                                <div class="inputs-form">
                                    <div class="primera-parte">
                                        <label for="nombre"><strong>NOMBRE</strong></label>
                                        <label for="">{{ $data['paciente']->nombre }}</label>
                                        <label for="nombre">EDAD</label>
                                        <label for="">{{ $data['paciente']->edad }}</label>
                                        <label for="nombre">HORA</label>
                                        <label>{$data['control_citas']->hora_cita{}}</label>
                                    </div>
                                    <div class="segunda-parte">
                                        <br>
                                        <label for="genero">GÉNERO</label>
                                        <label for="">{{ $data['paciente']['genero'] }}</label>

                                        <label for="expediente">NO. EXPEDIENTE</label>
                                        <label for="">{{ $data['datos_paciente']['expediente'] }}</label>
                                        <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                                        <label for="">{{ $data['datos_paciente']['fecha_nacimiento'] }}</label>
                                        <br>
                                        <br>
                                        <label for="no_consulta_paciente">CONSULTA NO.</label>
                                        <label>{{ $data['registro_consulta']['no_consulta_paciente'] }}</label>
                                    </div>
                                    <div class="tercera-parte">
                                        <br>
                                        <label for="motivo_consulta">MOTIVO DE CONSULTA:</label>
                                        <br>
                                        <label>{{ $data['registro_consulta']['motivo_consulta'] }}</label>
                                        <br>
                                        <br>
                                        {{-- revisar aqui --}}
                                        <label for="sintomas">SÍNTOMAS GASTROINTESTINALES:</label>
                                        <div class="bristol-container">
                                            <h2>Escala de Bristol</h2>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 1" @checked(old('escala_bristol', $data['registro_consulta']['escala_bristol']) == 'Tipo 1') required>
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-1.jpeg') }}"
                                                        alt="" style="width:200px;height:100px">
                                                </label>
                                                <p>(1) Heces en bolas duras y separadas</p>
                                            </div>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 2" @checked(old('escala_bristol', $data['registro_consulta']['escala_bristol']) == 'Tipo 2')>
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-2.jpeg') }}"
                                                        alt="" style="width:200px;height:100px">
                                                </label>
                                                <p>(2) Heces alargadas con relieves, formada por bolitas</p>
                                            </div>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 3" @checked(old('escala_bristol', $data['registro_consulta']['escala_bristol']) == 'Tipo 3')>
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-3.jpeg') }}"
                                                        alt="" style="width:150px;height:100px">
                                                </label>
                                                <p>(3) Heces alargadas con grietas en la superficie</p>
                                            </div>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 4" @checked(old('escala_bristol', $data['registro_consulta']['escala_bristol']) == 'Tipo 4')>
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-4.jpeg') }}"
                                                        alt="" style="width:150px;height:100px">
                                                </label>
                                                <p>(4) Heces alargadas, lisas y blandas</p>
                                            </div>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 5" @checked(old('escala_bristol', $data['registro_consulta']['escala_bristol']) == 'Tipo 5')>
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-5.jpeg') }}"
                                                        alt="" style="width:150px;height:100px">
                                                </label>
                                                <p>(5) Heces blandas y trozos separados o con bordes definidos</p>
                                            </div>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 6" @checked(old('escala_bristol', $data['registro_consulta']['escala_bristol']) == 'Tipo 6')>
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-6.jpeg') }}"
                                                        alt="" style="width:200px;height:100px">
                                                </label>
                                                <p>(6) Heces blandas y trozos separados o con bordes pegados</p>
                                            </div>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 7" @checked(old('escala_bristol', $data['registro_consulta']['escala_bristol']) == 'Tipo 7')>
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-7.jpeg') }}"
                                                        alt="" style="width:200px;height:100px">
                                                </label>
                                                <p>(7) Heces líquidas sin trozos sólidos</p>
                                            </div>
                                        </div>
                                        <label for="estreñimiento">ESTREÑIMIENTO:</label>
                                        <input type="radio" value="estreñimiento" name='estreñimiento'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']['estreñimiento'] ?? '') == 'estreñimiento') readonly>
                                        <label for="diarrea">DIARREA:</label>
                                        <input type="radio" value="diarrea" name='diarrea'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']['diarrea'] ?? '') == 'diarrea') readonly>
                                        <label for="reflujo">REFLUJO:</label>
                                        <input type="radio" value="reflujo" name='reflujo'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']['reflujo'] ?? '') == 'reflujo') readonly>
                                        <label for="gastritis">GASTRITIS:</label>
                                        <input type="radio" value="gastritis" name='gastritis'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']['gastritis'] ?? '') == 'gastritis') readonly>
                                        <label for="saciedad">SACIEDAD:</label>
                                        <input type="radio" value="saciedad" name='saciedad'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']['saciedad'] ?? '') == 'saciedad') readonly>
                                        <label for="temprana">TEMPRANA:</label>
                                        <input type="radio" value="temprana" name='temprana'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']['temprana'] ?? '') == 'temprana') readonly>
                                        <label for="apetito">APETITO:</label>
                                        <input type="radio" value="apetito" name='apetito'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']['apetito'] ?? '') == 'apetito') readonly>
                                        <label for="flatulencia">FLATULENCIA:</label>
                                        <input type="radio" value="flatulencia" name='flatulencia'
                                            @checked(old('sintoma_gastro', $data['registro_consulta']['sintoma_gastro']['flatulencia'] ?? '') == 'flatulencia') readonly>
                                    </div>
                                    <div class="cuarta-parte">
                                        <label for="otros">OTROS</label>
                                        <label>{{ $data['registro_consulta']['otros_sintoma_gastro'] }}</label>
                                        <label for="apego_plan_anterior_barr_apego">APEGO A PLAN ANTERIOR</label>
                                        <label>{{ $data['registro_consulta']['apego_plan_anterior_barr_apego'] }}</label>
                                        <label for="motivacion">MOTIVACIÓN En una escala, ¿qué tan motivado se siente
                                            de
                                            mejorar sus hábitos de alimentación?</label>
                                        <div class="motivaciones">
                                            <div class="motivacion-item">
                                                <p>Extremadamente desmotivado</p>
                                                <input type="radio" value="extramadamente_desmotivado"
                                                    name="motivacion" @checked(old('motivacion', $data['registro_consulta']['motivacion']) == 'extramadamente_desmotivado') required readonly>
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
                                            <label>{{ $data['registro_consulta']['hidratacion']['hidratacion'] }}</label>
                                            <div class="inputs">
                                                <label for="otros_hidratacion">Otras bebidas</label><br>
                                                <p>{{ $data['registro_consulta']['hidratacion']['otros_hidratacion'] }}
                                                </p>
                                            </div>
                                        </article>
                                        <label for="sintomas_generales">Síntomas generales</label>
                                        <p>{{ $data['registro_consulta']['sintomas_generales'] }}</p>
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">EXPLORACIÓN FÍSICA
                                            CENTRADA EN HALLAZGOS DE NUTRICIÓN</h2>
                                        <label for="pelo">Pelo y uñas</label>
                                        <input type="text" name="pelo_unias" id="pelo"
                                            value="{{ old('pelo_unias', $data['explo_fisica']['pelo_unias']) }}"
                                            required>
                                        <label for="piel">Piel</label>
                                        <label>{{ $data['explo_fisica']['piel'] }}</label>
                                        <label for="ojos">Ojos</label>
                                        <label>{{ $data['explo_fisica']['ojos'] }}</label>
                                        <label for="musculo">Musculo</label>
                                        <label>{{ $data['explo_fisica']['musculo'] }}</label>
                                        <label for="otros_explo_fisica">Otros</label>
                                        <label>{{ $data['explo_fisica']['otros'] }}</label>
                                        <h2 style="font-size: 20px; font-weight:900">INTOLERANCIA A ALIMENTOS</h2>
                                        <label for="no">No</label>
                                        <input type="radio" id="intolerancia" value="no"
                                            @checked(empty($data['explo_fisica']['intolerancia_alimentos'])) readonly>
                                        <label for="si">Si</label>
                                        <input type="radio" id="intolerancia" value="yes"
                                            @checked(!empty($data['explo_fisica']['intolerancia_alimentos'])) readonly>
                                        <label for="cuales">Cuales</label>
                                        <p>{{ $data['explo_fisica']['intolerancia_alimentos'] }}</p>
                                        <label for="actividad" style="font-size: 20px; font-weight:900">ACTIVIDAD
                                            FÍSICA
                                            ACTUAL (frecuencia/intensidad/tiempo)</label>
                                        <p>{{ $data['explo_fisica']['intolerancia_alimentos'] }}</p>
                                        <label for="cambios_pos_estilo_vida"
                                            style="font-size: 20px; font-weight:900">CAMBIOS POSITIVOS EN EL ESTILO DE
                                            VIDA</label>
                                        <p>{{ $data['explo_fisica']['cambios_pos_estilo_vida'] }}</p>
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
                                                    <label>{{ $data['control_citas']['peso'] }}</label>
                                                    <label>{{ $data['control_citas']['circunferencia_cintura'] }}</label>
                                                    <label>{{ $data['control_citas']['circunferencia_cadera'] }}</label>
                                                    <label>{{ $data['control_citas']['masa_muscular_kg'] }}</label>
                                                    <label>{{ $data['control_citas']['masa_grasa_corporal'] }}</label>
                                                    <label>{{ $data['composcion_corp']['masa_libre_grasa'] }}</label>
                                                    <label>{{ $data['control_citas']['agua_corpolar'] }}</label>
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
                                                    <label>{{ $data['control_citas']['IMC'] }}</label>
                                                    <label>{{ $data['composcion_corp']['rcc'] }}</label>
                                                    <label>{{ $data['composcion_corp']['rango_peso_saludable'] }}</label>
                                                    <label>{{ $data['composcion_corp']['indice_libre_grasa'] }}</label>
                                                    <label>{{ $data['composcion_corp']['pgc'] }}</label>
                                                    <label>{{ $data['composcion_corp']['otros'] }}</label>

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
                                                        <input type="text" placeholder="mg/dl"
                                                            value="{{ old('glucosa', $data['bioquimicos']['glucosa']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="hbAc1">HbAc1</label>
                                                        <input type="text" placeholder="%"
                                                            value="{{ old('hbAc1', $data['bioquimicos']['hbAc1']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="TG">TG</label>
                                                        <input type="text" placeholder="mg/dl"
                                                            value="{{ old('TG', $data['bioquimicos']['TG']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="CT">CT</label>
                                                        <input type="text" placeholder="mg/dl"
                                                            value="{{ old('CT', $data['bioquimicos']['CT']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="HDL">HDL</label>
                                                        <input type="text" placeholder="mg/dl"
                                                            value="{{ old('HDL', $data['bioquimicos']['HDL']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="LDL">LDL</label>
                                                        <input type="text" placeholder="mg/dl"
                                                            value="{{ old('LDL', $data['bioquimicos']['LDL']) }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tabla-dos">
                                                <div class="bioquimico-formulario2">
                                                    <div class="inputs">
                                                        <label for="AST_perc">%AST</label>
                                                        <input type="text" placeholder="UI/L"
                                                            value="{{ old('AST_perc', $data['bioquimicos']['AST_perc']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="ALT">ALT</label>
                                                        <input type="text" placeholder="UI/L"
                                                            value="{{ old('ALT', $data['bioquimicos']['ALT']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="TSH">TSH</label>
                                                        <input type="text" placeholder="UI/L"
                                                            value="{{ old('TSH', $data['bioquimicos']['TSH']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="T3">T3</label>
                                                        <input type="text" placeholder="UI/L"
                                                            value="{{ old('T3', $data['bioquimicos']['T3']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="T4">T4</label>
                                                        <input type="text" placeholder="UI/L"
                                                            value="{{ old('T4', $data['bioquimicos']['T4']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="Hb">Hb</label>
                                                        <input type="text" placeholder="UI/L"
                                                            value="{{ old('Hb', $data['bioquimicos']['Hb']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="Hierro">Hierro</label>
                                                        <input type="text" placeholder="UI/L"
                                                            value="{{ old('hierro', $data['bioquimicos']['hierro']) }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tabla-tres">
                                                <div class="bioquimico-formulario3">
                                                    <div class="inputs">
                                                        <label for="transferrina">Transferrina</label>
                                                        <input type="text" placeholder="mg/dL"
                                                            value="{{ old('transferrina', $data['bioquimicos']['transferrina']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="ferritina">Ferritina</label>
                                                        <input type="text" placeholder="ng/mL"
                                                            value="{{ old('ferritina', $data['bioquimicos']['ferritina']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="t3_libre">T3Libre</label>
                                                        <input type="text" placeholder="pg/dL"
                                                            value="{{ old('t3_libre', $data['bioquimicos']['t3_libre']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="t4_libre">T4Libre</label>
                                                        <input type="text" placeholder="ng/dL"
                                                            value="{{ old('t4_libre', $data['bioquimicos']['t4_libre']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="hto">Hto</label>
                                                        <input type="text" placeholder="%"
                                                            value="{{ old('hto', $data['bioquimicos']['hto']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="B12">B12</label>
                                                        <input type="text" placeholder="pg/mL"
                                                            value="{{ old('B12', $data['bioquimicos']['B12']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="folatos">Folatos</label>
                                                        <input type="text" placeholder="ng/mL"
                                                            value="{{ old('folatos', $data['bioquimicos']['folatos']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="otros">Otros</label>
                                                        <input type="text" id="otros_bioquimicos"
                                                            value="{{ old('otros_bioquimicos', $data['bioquimicos']['otros']) }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tabla-cuatro">
                                                <div class="bioquimico-formulario4">
                                                    <div class="inputs">
                                                        <label for="PT">PT</label>
                                                        <input type="text" placeholder="d/dL"
                                                            value="{{ old('PT', $data['bioquimicos']['PT']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="albumina">Albúmina</label>
                                                        <input type="text" placeholder="g/dL"
                                                            value="{{ old('albumina', $data['bioquimicos']['albumina']) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="Ca">Ca</label>
                                                        <input type="text" placeholder="UI/L"
                                                            value="{{ old('Ca', $data['bioquimicos']['Ca']) }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- septima parte - clinicos, medicamentos  y tabla dieteticos --}}
                                    <div class="septima-parte">
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">CLÍNICOS</h2>
                                        <label for="dx_medicos">DX MEDICOS</label>
                                        <p>{{ $data['registro_consulta']['clinicos'] }}</p>
                                        <label for="dinamometria">DINAMOMETRÍA (fuerza de agarre)</label>
                                        <label>{{ $data['registro_consulta']['dinamometria']['dinamometria'] }}</label>
                                        <br>
                                        <br>
                                        <label for="interpretacion_dinamometrica">INTERPRETACIÓN DINAMOMETRICA</label>
                                        <label>{{ $data['registro_consulta']['dinamometria']['interpretacion_dinamometrica'] }}</label>
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">
                                            MEDICAMENTOS/SUPLEMENTOS</h2>
                                        <label>{{ $data['registro_consulta']['medicamentos_suplementos'] }}</label>
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
                                                <input type="text" style="width:70px"
                                                    value="{{ old('frutas', $data['frecuencia_semanal']['frutas']) }}"
                                                    required readonly>
                                                <input type="text" style="width:70px"
                                                    value="{{ old('verduras', $data['frecuencia_semanal']['verduras']) }}"
                                                    required readonly>
                                                <input type="text" style="width:70px"
                                                    value="{{ old('cereales_sg', $data['frecuencia_semanal']['cereales_s_g']) }}"
                                                    required readonly>
                                                <input type="text" style="width:70px"
                                                    value="{{ old('cereales_cg', $data['frecuencia_semanal']['cereales_c_g']) }}"
                                                    required readonly>
                                                <input type="text" style="width:70px"
                                                    value="{{ old('leguminosas', $data['frecuencia_semanal']['leguminosas']) }}"
                                                    required readonly>
                                                <input type="text" style="width:70px"
                                                    value="{{ old('poa', $data['frecuencia_semanal']['poa']) }}"
                                                    required readonly>
                                                <input type="text" style="width:70px"
                                                    value="{{ old('lacteos', $data['frecuencia_semanal']['lacteos']) }}"
                                                    required readonly>
                                                <input type="text" style="width:70px"
                                                    value="{{ old('aceites_sp', $data['frecuencia_semanal']['aceites_s_p']) }}"
                                                    required readonly>
                                                <input type="text" style="width:70px"
                                                    value="{{ old('aceites_cp', $data['frecuencia_semanal']['aceites_c_p']) }}"
                                                    required readonly>
                                                <input type="text" style="width:70px"
                                                    value="{{ old('azucares', $data['frecuencia_semanal']['azucares']) }}"
                                                    required readonly>
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
                                    @checked(old('instrumento', $data['instrumento']['tipo_instrumento'] ?? '') == 'Recorda 24/h') required readonly>24 hrs
                                <input type="radio" name="instrumento" id="semi"
                                    value="Dieta habitual semicuantitativa"
                                    @checked(old('instrumento', $data['instrumento']['tipo_instrumento'] ?? '') == 'Dieta habitual semicuantitativa')>Semicuantitativa
                                <input type="radio" name="instrumento" id="diario" value="Diario de alimentos"
                                    @checked(old('instrumento', $data['instrumento']['tipo_instrumento'] ?? '') == 'Diario de alimentos')>Diario
                                <br>
                                <label>Desayuno hora: </label>
                                <label>{{ $data['instrumento']['desayuno_hora'] }}</label>
                                <br>
                                <label>
                                    Colación:
                                    <label>{{ $data['instrumento']['colacion1'] }}</label>
                                </label>
                                <br>
                                <label>
                                    Comida hora:
                                    <label>{{ $data['instrumento']['comida_hora'] }}</label>
                                </label>
                                <br>
                                <label>
                                    Colación:
                                    <label>{{ $data['instrumento']['colacion2'] }}</label>
                                </label>
                                <br>
                                <label>
                                    Cena hora:
                                    <label>{{ $data['instrumento']['cena_hora'] }}</label>
                                </label>
                                <br>
                                <label>
                                    Colación:
                                    <label>{{ $data['instrumento']['colacion3'] }}</label>
                                </label>
                                <br><br>
                                <label>
                                    Total EQ: <br>
                                    Verduras:<input type="text"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['verduras'] ?? '') }}"
                                        readonly>
                                    Frutas:<input type="text"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['frutas'] ?? '') }}"
                                        readonly>
                                    Cereales:<input type="text"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['cereales'] ?? '') }}"
                                        readonly>
                                    Leguminosas:<input type="text"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['leguminosas'] ?? '') }}"
                                        readonly>
                                    Carnes:<input type="text"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['carnes'] ?? '') }}"
                                        readonly>
                                    Leche:<input type="text"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['leche'] ?? '') }}"
                                        readonly>
                                    Grasa:<input type="text"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['grasa'] ?? '') }}"
                                        readonly>
                                    Azúcar:<input type="text"
                                        value="{{ old('', $data['instrumento']['grupo_total_eq']['azucar'] ?? '') }}"
                                        readonly>
                                </label>
                                <br><br>
                                <label>
                                    TOTAL:<br>
                                    Kcal:<input type="text" name="total_kcal"
                                        value="{{ old('', $data['instrumento']['total_kcal'] ?? '') }}" required
                                        readonly>
                                    Prot:<input type="text" name="total_prot"
                                        value="{{ old('', $data['instrumento']['total_prot']['prot_porcent'] ?? '') }}"
                                        required readonly>(<input type="text" name="prot_g"
                                        value="{{ old('', $data['instrumento']['total_prot']['prot_g'] ?? '') }}"
                                        required readonly>)
                                    Lip:<input type="text" name="total_lip"
                                        value="{{ old('', $data['instrumento']['total_lip']['lip_porcent'] ?? '') }}"
                                        required readonly>(<input type="text" name="lip_g"
                                        value="{{ old('', $data['instrumento']['total_lip']['lip_g'] ?? '') }}"
                                        required readonly>)
                                    Hco:<input type="text" name="total_hco"
                                        value="{{ old('', $data['instrumento']['total_hco']['hco_porcent'] ?? '') }}"
                                        required readonly>(<input type="text" name="hco_g"
                                        value="{{ old('', $data['instrumento']['total_hco']['hco_g'] ?? '') }}"
                                        required readonly>)
                                </label>
                                <br><br>
                                <label>
                                    % ADECUACIÓN:<br>
                                    Energia:<input type="text" name="adecuacion_porcen_ene"
                                        value="{{ old('adecuacion_porcen_ene', $data['instrumento']['adecuacion_porcen_ene'] ?? '') }}"
                                        required readonly>
                                    Kcal:<input type="text" name="adecuacion_porcen_ener_kcal"
                                        value="{{ old('adecuacion_porcen_ener_kcal', $data['instrumento']['adecuacion_porcen_ener_kcal'] ?? '') }}"
                                        required readonly>
                                    Prot:<input type="text" name="adecuacion_porcen_prot"
                                        value="{{ old('adecuacion_porcen_prot', $data['instrumento']['adecuacion_porcen_prot'] ?? '') }}"
                                        required readonly>
                                    Lip:<input type="text" name="adecuacion_porcen_lip"
                                        value="{{ old('adecuacion_porcen_lip', $data['instrumento']['adecuacion_porcen_lip'] ?? '') }}"
                                        required readonly>
                                    Hco:<input type="text" name="adecuacion_porcen_hco"
                                        value="{{ old('adecuacion_porcen_hco', $data['instrumento']['adecuacion_porcen_hco'] ?? '') }}"
                                        required readonly>
                                    <br>
                                    Aspectos cualitativos de dieta
                                    habitual:<label>{{ $data['instrumento']['aspectos_cualita_dieta_habitual'] }}</label>
                                </label>
                                <br><br>
                                <label>
                                    REQUERIMIENTOS:<br>
                                    Energia:<label>{{ $data['diagnostico']['reque_ener'] }}</label>
                                    Proteina total:<input type="text" name="reque_proteina"
                                        value="{{ old('reque_proteina', $data['diagnostico']['reque_proteina'] ?? '') }}"
                                        required>(<input type="text" name="reque_kg_dia"
                                        value="{{ old('reque_kg_dia', $data['diagnostico']['reque_kg_dia'] ?? '') }}"
                                        required>)
                                </label>
                                <br><br>
                                <label>
                                    DX:NUTRICIO:<br>
                                    <label>{{ $data['diagnostico']['dx_nutricio'] }}</label>
                                </label>
                                <br>
                                <label>
                                    OBJETIVOS:<br>
                                    <label>{{ $data['generales']['objetivos_dieta'] }}</label>
                                </label>
                                <br>
                                <label>
                                    PLAN DE ALIMENTACIÓN:<br>
                                    Dieta <input type="text" name="tipo_dieta"
                                        value="{{ old('tipo_dieta', $data['generales']['tipo_dieta'] ?? '') }}"
                                        readonly> de
                                    <input type="text" name="kcal_dieta"
                                        value="{{ old('kcal_dieta', $data['generales']['kcal_dieta'] ?? '') }}"
                                        required readonly>
                                    Prot:<input type="text" name="prot_porcent_dieta"
                                        value="{{ old('prot_porcent_dieta', $data['generales']['prot_porcent_dieta'] ?? '') }}"
                                        required readonly>(<input type="text" name="prot_kg_dia_dieta"
                                        value="{{ old('prot_kg_dia_dieta', $data['generales']['prot_kg_dia_dieta'] ?? '') }}"
                                        required readonly>)
                                    Lip:<input type="text" name="lip_porcen_dieta"
                                        value="{{ old('lip_porcen_dieta', $data['generales']['lip_porcen_dieta'] ?? '') }}"
                                        required readonly>(<input type="text" name="lip_g_dieta"
                                        value="{{ old('lip_g_dieta', $data['generales']['lip_g_dieta'] ?? '') }}"
                                        required readonly> )
                                    Hco:<input type="text" name="hco_porcen_dieta"
                                        value="{{ old('hco_porcen_dieta', $data['generales']['hco_porcen_dieta'] ?? '') }}"
                                        required readonly>(<input type="text" name="hco_g_dieta"
                                        value="{{ old('hco_g_dieta', $data['generales']['hco_g_dieta'] ?? '') }}"
                                        required readonly>)
                                </label>
                                <br>
                                <label>
                                    SUPLEMENTOS:<br>
                                    <label>{{ $data['generales']['suplementos'] }}</label>
                                </label>
                                <br>
                                <label>
                                    METAS SMART:<br>
                                    <label>{{ $data['generales']['metas_smart'] }}</label>
                                </label>
                                <br>
                                <label>
                                    PARAMETROS META:<br>
                                    Peso:<label>{{ $data['generales']['param_meta']['peso'] ?? '' }}</label>
                                    %Grasa:<label>{{ $data['generales']['param_meta']['porcen_grasa'] ?? '' }}</label>
                                    Músculo:<label>{{ $data['generales']['param_meta']['musculo'] ?? '' }}</label>
                                    C.
                                    Cintura:<label>{{ $data['generales']['param_meta']['c_cintura'] ?? '' }}</label>
                                    <br>
                                    Horarios:<label>{{ $data['generales']['param_meta']['horarios'] ?? '' }}</label>
                                    Mejorar
                                    hábitos:<label>{{ $data['generales']['param_meta']['m_habitos'] ?? '' }}</label>
                                    Selección de
                                    alimentos:<label>{{ $data['generales']['param_meta']['selec_alimentos'] ?? '' }}</label>
                                </label>
                                <br>
                                <label>
                                    EDUCACIÓN:<br>
                                    <label>{{ $data['generales']['educacion'] }}</label>
                                </label>
                                <br>
                                <label>
                                    MONITOREO:<br>
                                    <label>{{ $data['generales']['monitoreo'] }}</label>
                                </label>
                                <br>
                                <label>
                                    PENDIENTES:<br>
                                    <label>{{ $data['registro_consulta']['pendientes'] }}</label>
                                </label>
                                <br>
                                <label>
                                    NOMBRE COMPLETO, FIRMA Y CÉDULA PROFESIONAL DE QUIEN ELABORÓ LA HISTORIA CLINICA
                                    NUTRICIA:<br>
                                    {{ $data['registro_consulta']['nutri_elaborate_data'] ?? '' }}
                                </label>
                                <br>
                                <label>
                                    NOMBRE COMPLETO, FIRMA Y CÉDULA PROFESIONAL DE NUTRIÓLOGO RESPONSABLE:<br>
                                    <input type="text" name="datos_nutriologo"
                                        value="{{ old('datos_nutriologo', $data['registro_consulta']['nutri_elaborate_data'] ?? '') }}"
                                        required>
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
