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

        .bristol-container {
            display: flex;
            align-items: center;
            flex-direction: column;
            border: 1px solid black;
            margin: 0px 0px 20px 10px;
            width: 80%;
            height: 900px;
            gap: -10px;
        }

        .escala-1 {
            display: flex;
            flex-direction: row !important;
            justify-content: center;
            align-items: center;
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

        .sintomas {
            display: flex;
            flex-wrap: wrap;
        }

        .sintomas label {
            margin-left: 50px;
            margin-bottom: 20px;
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
            {{ __('Agregar paciente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>Bienvenido {{ Auth::user()->nombre }}</h2>
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
                                            value="{{ old('nombre', '') }}" required>
                                        <label for="nombre">EDAD</label>
                                        <input type="number" name="edad" id="edad" value="{{ old('edad') }}"
                                            required>
                                        <label for="nombre">HORA</label>
                                        <input type="time" name="hora" id="hora" value="{{ old('hora') }}"
                                            required>
                                    </div>
                                    <div class="segunda-parte">
                                        <br>
                                        <label for="genero">GÉNERO</label>
                                        <select name="genero" id="genero" required>
                                            <option value="M" @selected(old('genero') == 'M')>Masculino</option>
                                            <option value="F" @selected(old('genero') == 'F')>Femenino</option>
                                        </select>

                                        <label for="expediente">NO. EXPEDIENTE</label>
                                        <input type="text" name="expediente" id="expediente"
                                            value="{{ ApiDatosPaciente::max('expediente') + 1 }}" readonly>
                                        <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                            value="{{ old('fecha_nacimiento') }}" required>
                                        <br>
                                        <br>
                                        <label for="no_consulta_paciente">CONSULTA NO.</label>
                                        <input type="text" name="no_consulta_paciente" id="no_consulta_paciente"
                                            value="{{ old('no_consulta_paciente') }}" required>
                                    </div>
                                    <div class="tercera-parte">
                                        <br>
                                        <label for="motivo_consulta">MOTIVO DE CONSULTA:</label>
                                        <br>
                                        <input type="text" name="motivo_consulta" id="motivo_consulta"
                                            style="width: 500px" value="{{ old('motivo_consulta') }}" required>
                                        <br>
                                        <br>
                                        <label for="sintomas">SÍNTOMAS GASTROINTESTINALES:</label>
                                        <br>
                                        {{-- <input type="radio" value="bristol" name='sintoma_gastro'
																									@if (old('sintoma_gastro') == 'bristol') checked @endif> --}}
                                        <br>
                                        <div class="bristol-container">
                                            <h2>Escala de Bristol</h2>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 1" required>
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-1.jpeg') }}"
                                                        alt="" style="width:200px;height:100px">
                                                </label>
                                                <p>(1) Heces en bolas duras y separadas</p>
                                            </div>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 2">
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-2.jpeg') }}"
                                                        alt="" style="width:200px;height:100px">
                                                </label>
                                                <p>(2) Heces alargadas con relieves, formada por bolitas</p>
                                            </div>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 3">
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-3.jpeg') }}"
                                                        alt="" style="width:150px;height:100px">
                                                </label>
                                                <p>(3) Heces alargadas con grietas en la superficie</p>
                                            </div>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 4">
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-4.jpeg') }}"
                                                        alt="" style="width:150px;height:100px">
                                                </label>
                                                <p>(4) Heces alargadas, lisas y blandas</p>
                                            </div>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 5">
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-5.jpeg') }}"
                                                        alt="" style="width:150px;height:100px">
                                                </label>
                                                <p>(5) Heces blandas y trozos separados o con bordes definidos</p>
                                            </div>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 6">
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-6.jpeg') }}"
                                                        alt="" style="width:200px;height:100px">
                                                </label>
                                                <p>(6) Heces blandas y trozos separados o con bordes pegados</p>
                                            </div>
                                            <div class="escala-1">
                                                <input type="radio" id="bristol1" name="escala_bristol"
                                                    value="Tipo 7">
                                                <label for="bristol1"><img src="{{ asset('/assets/escala-7.jpeg') }}"
                                                        alt="" style="width:200px;height:100px">
                                                </label>
                                                <p>(7) Heces líquidas sin trozos sólidos</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <br>
                                <div class="sintomas">
                                    <label for="estreñimiento">ESTREÑIMIENTO</label>
                                    <input type="radio" value="estreñimiento" name='estreñimiento'
                                        @if (old('estreñimiento') == 'estreñimiento') checked @endif>

                                    <label for="diarrea">DIARREA</label>
                                    <input type="radio" value="diarrea" name='diarrea'
                                        @if (old('diarrea') == 'diarrea') checked @endif>

                                    <label for="reflujo">REFLUJO</label>
                                    <input type="radio" value="reflujo" name='reflujo'
                                        @if (old('reflujo') == 'reflujo') checked @endif>

                                    <label for="gastritis">GASTRITIS</label>
                                    <input type="radio" value="gastritis" name='gastritis'
                                        @if (old('gastritis') == 'gastritis') checked @endif>

                                    <label for="saciedad">SACIEDAD</label>
                                    <input type="radio" value="saciedad" name='saciedad'
                                        @if (old('saciedad') == 'saciedad') checked @endif>

                                    <label for="temprana">TEMPRANA</label>
                                    <input type="radio" value="temprana" name='temprana'
                                        @if (old('temprana') == 'temprana') checked @endif>

                                    <label for="apetito">APETITO</label>
                                    <input type="radio" value="apetito" name='apetito'
                                        @if (old('apetito') == 'apetito') checked @endif>

                                    <label for="flatulencia">FLATULENCIA</label>
                                    <input type="radio" value="flatulencia" name='flatulencia'
                                        @if (old('flatulencia') == 'flatulencia') checked @endif>

                                    <br>
                                    <div class="cuarta-parte">
                                        <label for="otros">OTROS</label>
                                        <input type="text" style="width:300px" name="otros_sintoma_gastro"
                                            value="{{ old('otros_sintoma_gastro') }}">
                                        <label for="apego_plan_anterior_barr_apego">APEGO A PLAN ANTERIOR</label>
                                        <input type="text" style="width:300px"
                                            name="apego_plan_anterior_barr_apego"
                                            value="{{ old('apego_plan_anterior_barr_apego') }}" required>
                                        <label for="motivacion">MOTIVACIÓN En una escala, ¿qué tan motivado se siente
                                            de
                                            mejorar sus hábitos de alimentación?</label>
                                        <div class="motivaciones">
                                            <div class="motivacion-item">
                                                <p>Extremadamente desmotivado</p>
                                                <input type="radio" value="extramadamente_desmotivado"
                                                    name="motivacion" @checked(old('motivacion') == 'extramadamente_desmotivado') required>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Muy desmotivado</p>
                                                <input type="radio" value="muy_desmotivado" name="motivacion"
                                                    @checked(old('motivacion') == 'muy_desmotivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Algo desmotivado</p>
                                                <input type="radio" value="algo_desmotivado" name="motivacion"
                                                    @checked(old('motivacion') == 'algo_desmotivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Ligeramente desmotivado</p>
                                                <input type="radio" value="ligeramente_desmotivado"
                                                    name="motivacion" @checked(old('motivacion') == 'ligeramente_desmotivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Motivación neutral</p>
                                                <input type="radio" value="ni_motivado_ni_desmotivado"
                                                    name="motivacion" @checked(old('motivacion') == 'ni_motivado_ni_desmotivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Ligeramente motivado</p>
                                                <input type="radio" value="ligeramente_motivado" name="motivacion"
                                                    @checked(old('motivacion') == 'ligeramente_motivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Algo motivado</p>
                                                <input type="radio" value="algo_motivado" name="motivacion"
                                                    @checked(old('motivacion') == 'algo_motivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Muy motivado</p>
                                                <input type="radio" value="muy_motivado" name="motivacion"
                                                    @checked(old('motivacion') == 'muy_motivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Altamente motivado</p>
                                                <input type="radio" value="altamente_motivado" name="motivacion"
                                                    @checked(old('motivacion') == 'altamente_motivado')>
                                            </div>
                                            <div class="motivacion-item">
                                                <p>Extremadamente motivado</p>
                                                <input type="radio" value="extremadamente_motivado"
                                                    name="motivacion" @checked(old('motivacion') == 'extremadamente_motivado')>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="quinta-parte">
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">HIDRATACIÓN</h2>
                                        <article>
                                            <label for="agua">Agua simple (en mililitros)</label>
                                            <input type="number" name="hidratacion" id="agua"
                                                style="width:100px;" value="{{ old('hidratacion') }}" required>
                                            <div class="inputs">
                                                <label for="otros_hidratacion">Otras bebidas</label><br>
                                                <textarea name="otras_bebidas" id="otros_hidratacion" cols="30" rows="10">{{ old('otras_bebidas') }}</textarea>
                                            </div>
                                        </article>
                                        <label for="sintomas_generales">Síntomas generales</label>
                                        <input type="text" name="sintomas_generales" id=""
                                            value="{{ old('sintomas_generales') }}">
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">EXPLORACIÓN FÍSICA
                                            CENTRADA EN HALLAZGOS DE NUTRICIÓN</h2>
                                        <label for="pelo">Pelo y uñas</label>
                                        <input type="text" name="pelo_unias" id="pelo"
                                            value="{{ old('pelo_unias') }}" required>
                                        <label for="piel">Piel</label>
                                        <input type="text" name="piel" id="piel"
                                            value="{{ old('piel') }}" required>
                                        <label for="ojos">Ojos</label>
                                        <input type="text" name="ojos" id="ojos"
                                            value="{{ old('ojos') }}" required>
                                        <label for="musculo">Musculo</label>
                                        <input type="text" name="musculo" id="musculo"
                                            value="{{ old('musculo') }}" required>
                                        <label for="otros_explo_fisica">Otros</label>
                                        <input type="text" name="otros_explo_fisica" id="otros_explo_fisica"
                                            value="{{ old('otros_explo_fisica') }}" required>
                                        <h2 style="font-size: 20px; font-weight:900">INTOLERANCIA A ALIMENTOS</h2>
                                        <label for="no">No</label>
                                        <input type="radio" name="radio_into_aliment" id="intolerancia"
                                            value="no" @checked(old('radio_into_aliment') == 'no')>
                                        <label for="si">Si</label>
                                        <input type="radio" name="radio_into_aliment" id="intolerancia"
                                            value="yes" @checked(old('radio_into_aliment') == 'yes')>
                                        <label for="cuales">Cuales</label>
                                        <input type="text" name="intolerancia_alimentos" id="cuales"
                                            value="@if (old('radio_into_alimentos') == 'yes') {{ old('intolerancia_alimentos') }} @endif">
                                        <label for="actividad" style="font-size: 20px; font-weight:900">ACTIVIDAD
                                            FÍSICA
                                            ACTUAL (frecuencia/intensidad/tiempo)</label>
                                        <input type="text" name="actividad_fis_actual" id="actividad"
                                            value="{{ old('actividad_fis_actual') }}" required>
                                        <label for="cambios_pos_estilo_vida"
                                            style="font-size: 20px; font-weight:900">CAMBIOS POSITIVOS EN EL ESTILO DE
                                            VIDA</label>
                                        <input type="text" name="cambios_pos_estilo_vida"
                                            id="cambios_pos_estilo_vida" value="{{ old('cambios_pos_estilo_vida') }}"
                                            required>
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
                                                    <input type="text" style="height: 30px" name="mediciones"
                                                        value="{{ old('mediciones') }}">
                                                    <input type="text" style="height: 30px" name="peso"
                                                        value="{{ old('peso') }}" required>
                                                    <input type="text" style="height: 30px"
                                                        name="circunferencia_cintura"
                                                        value="{{ old('circunferencia_cintura') }}" required>
                                                    <input type="text" style="height: 30px"
                                                        name="circunferencia_cadera"
                                                        value="{{ old('circunferencia_cadera') }}" required>
                                                    <input type="text" style="height: 30px" name="masa_muscular"
                                                        value="{{ old('masa_muscular') }}" required>
                                                    <input type="text" style="height: 30px"
                                                        name="mas_grasa_corporal"
                                                        value="{{ old('mas_grasa_corporal') }}" required>
                                                    <input type="text" style="height: 30px"
                                                        name="masa_libre_grasa" value="{{ old('masa_libre_grasa') }}"
                                                        required>
                                                    <input type="text" style="height: 30px" name="act"
                                                        value="{{ old('act') }}" required>
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
                                                        value="{{ old('imc') }}" required>
                                                    <input type="text" style="height: 30px" name="rcc"
                                                        value="{{ old('rcc') }}" required>
                                                    <input type="text" style="height: 30px"
                                                        name="rango_peso_saludable"
                                                        value="{{ old('rango_peso_saludable') }}" required>
                                                    <input type="text" style="height: 30px"
                                                        name="indice_libre_grasa"
                                                        value="{{ old('indice_libre_grasa') }}" required>
                                                    <input type="text" style="height: 30px"
                                                        name="porcentaje_grasa_corporal"
                                                        value="{{ old('porcentaje_grasa_corporal') }}" required>
                                                    <input type="text" style="height: 30px"
                                                        name="otros_antropometricos"
                                                        value="{{ old('otros_antropometricos') }}">
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
                                                            placeholder="mg/dl">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="hbAc1">HbAc1</label>
                                                        <input type="text" name="hbAc1" id="hbAc1"
                                                            placeholder="%">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="TG">TG</label>
                                                        <input type="text" name="TG" id="TG"
                                                            placeholder="mg/dl">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="CT">CT</label>
                                                        <input type="text" name="CT" id="CT"
                                                            placeholder="mg/dl">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="HDL">HDL</label>
                                                        <input type="text" name="HDL" id="HDL"
                                                            placeholder="mg/dl">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="LDL">LDL</label>
                                                        <input type="text" name="LDL" id="LDL"
                                                            placeholder="mg/dl">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tabla-dos">
                                                <div class="bioquimico-formulario2">
                                                    <div class="inputs">
                                                        <label for="AST_perc">%AST</label>
                                                        <input type="text" name="AST_perc" id="AST_perc"
                                                            placeholder="UI/L">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="ALT">ALT</label>
                                                        <input type="text" name="ALT" id="ALT"
                                                            placeholder="UI/L">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="TSH">TSH</label>
                                                        <input type="text" name="TSH" id="TSH"
                                                            placeholder="UI/L">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="T3">T3</label>
                                                        <input type="text" name="T3" id="T3"
                                                            placeholder="UI/L">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="T4">T4</label>
                                                        <input type="text" name="T4" id="T4"
                                                            placeholder="UI/L">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="Hb">Hb</label>
                                                        <input type="text" name="Hb" id="Hb"
                                                            placeholder="UI/L">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="Hierro">Hierro</label>
                                                        <input type="text" name="hierro" id="Hierro"
                                                            placeholder="UI/L">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tabla-tres">
                                                <div class="bioquimico-formulario3">
                                                    <div class="inputs">
                                                        <label for="transferrina">Transferrina</label>
                                                        <input type="text" name="transferrina" id="transferrina"
                                                            placeholder="mg/dL">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="ferritina">Ferritina</label>
                                                        <input type="text" name="ferritina" id="ferritina"
                                                            placeholder="ng/mL">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="t3_libre">T3Libre</label>
                                                        <input type="text" name="t3_libre" id="t3_libre"
                                                            placeholder="pg/dL">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="t4_libre">T4Libre</label>
                                                        <input type="text" name="t4_libre" id="t4_libre"
                                                            placeholder="ng/dL">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="hto">Hto</label>
                                                        <input type="text" name="hto" id="hto"
                                                            placeholder="%">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="B12">B12</label>
                                                        <input type="text" name="B12" id="B12"
                                                            placeholder="pg/mL">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="folatos">Folatos</label>
                                                        <input type="text" name="folatos" id="folatos"
                                                            placeholder="ng/mL">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="otros">Otros</label>
                                                        <input type="text" name="otros_bioquimicos"
                                                            id="otros_bioquimicos">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tabla-cuatro">
                                                <div class="bioquimico-formulario4">
                                                    <div class="inputs">
                                                        <label for="PT">PT</label>
                                                        <input type="text" name="PT" id="PT"
                                                            placeholder="d/dL">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="albumina">Albúmina</label>
                                                        <input type="text" name="albumina" id="albumina"
                                                            placeholder="g/dL">
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="Ca">Ca</label>
                                                        <input type="text" name="Ca" id="Ca"
                                                            placeholder="UI/L">
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
                                            value="{{ old('dx_medicos') }}" required>
                                        <label for="dinamometria">DINAMOMETRÍA (fuerza de agarre)</label>
                                        <input type="text" name="dinamometria" id="dinamometria" placeholder="KG"
                                            value="{{ old('dinamometria') }}">
                                        <br>
                                        <br>
                                        <label for="interpretacion_dinamometrica">INTERPRETACIÓN DINAMOMETRICA</label>
                                        <input type="text" name="interpretacion_dinamometrica"
                                            id="interpretacion_dinamometrica"
                                            value="{{ old('interpretacion_dinamometrica') }}">
                                        <h2 style="font-size:20px;font-weight:900;margin: 10px 0px;">
                                            MEDICAMENTOS/SUPLEMENTOS</h2>
                                        <input type="text" name="medicamentos_suplementos"
                                            id="medicamentos_suplementos" style="width:650px;"
                                            value="{{ old('medicamentos_suplementos') }}">
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
                                                    style="width:70px" value="{{ old('frutas') }}" required>
                                                <input type="text" name="verduras" id=""
                                                    style="width:70px" value="{{ old('verduras') }}" required>
                                                <input type="text" name="cereales_sg" id=""
                                                    style="width:70px" value="{{ old('cereales_sg') }}" required>
                                                <input type="text" name="cereales_cg" id=""
                                                    style="width:70px" value="{{ old('cereales_cg') }}" required>
                                                <input type="text" name="leguminosas" id=""
                                                    style="width:70px" value="{{ old('leguminosas') }}" required>
                                                <input type="text" name="poa" id=""
                                                    style="width:70px" value="{{ old('poa') }}" required>
                                                <input type="text" name="lacteos" id=""
                                                    style="width:70px" value="{{ old('lacteos') }}" required>
                                                <input type="text" name="aceites_sp" id=""
                                                    style="width:70px" value="{{ old('aceites_sp') }}" required>
                                                <input type="text" name="aceites_cp" id=""
                                                    style="width:70px" value="{{ old('aceites_cp') }}" required>
                                                <input type="text" name="azucares" id=""
                                                    style="width:70px" value="{{ old('azucares') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <button type="submit" class="btn-guardar">Guardar datos</button> --}}
                                    <button class="prueba btn-guardar" id="acabar_primer_formulario"
                                        type="button">Continuar formulario</button>
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
                                    @checked(old('instrumento') == 'Recorda 24/h') required>24 hrs
                                <input type="radio" name="instrumento" id="semi"
                                    value="Dieta habitual semicuantitativa"
                                    @checked(old('instrumento') == 'Dieta habitual semicuantitativa')>Semicuantitativa
                                <input type="radio" name="instrumento" id="diario" value="Diario de alimentos"
                                    @checked(old('instrumento') == 'Diario de alimentos')>Diario
                                <br>
                                <label>Desayuno hora: </label>
                                <input type="time" name="desayuno_hora" value="{{ old('desayuno_hora') }}"
                                    required>
                                <br>
                                <label>
                                    Colación:
                                    <input type="text" name="colacion1" value="{{ old('colacion1') }}" required>
                                </label>
                                <br>
                                <label>
                                    Comida hora:
                                    <input type="time" name="comida_hora" value="{{ old('comida_hora') }}"
                                        required>
                                </label>
                                <br>
                                <label>
                                    Colación:
                                    <input type="text" name="colacion2" value="{{ old('colacion2') }}" required>
                                </label>
                                <br>
                                <label>
                                    Cena hora:
                                    <input type="time" name="cena_hora" value="{{ old('cena_hora') }}" required>
                                </label>
                                <br>
                                <label>
                                    Colación:
                                    <input type="text" name="colacion3" value="{{ old('colacion3') }}" required>
                                </label>
                                <br><br>
                                <label>
                                    Total EQ: <br>
                                    Verduras:<input type="text" name="verduras" value="{{ old('verduras') }}">
                                    Frutas:<input type="text" name="frutas" value="{{ old('frutas') }}">
                                    Cereales:<input type="text" name="cereales" value="{{ old('cereales') }}">
                                    Leguminosas:<input type="text" name="leguminosas"
                                        value="{{ old('leguminosas') }}">
                                    Carnes:<input type="text" name="carnes" value="{{ old('carnes') }}">
                                    Leche:<input type="text" name="leche" value="{{ old('leche') }}">
                                    Grasa:<input type="text" name="grasa" value="{{ old('grasa') }}">
                                    Azúcar:<input type="text" name="azucar" value="{{ old('azucar') }}">
                                </label>
                                <br><br>
                                <label>
                                    TOTAL:<br>
                                    Kcal:<input type="text" name="total_kcal" value="{{ old('total_kcal') }}" required>
                                    Prot:<input type="text" name="total_prot"
                                        value="{{ old('total_prot') }}">(<input type="text" name="prot_g"
                                        value="{{ old('prot_g') }}">)
                                    Lip:<input type="text" name="total_lip"
                                        value="{{ old('total_lip') }}">(<input type="text" name="lip_g"
                                        value="{{ old('lip_g') }}">)
                                    Hco:<input type="text" name="total_hco"
                                        value="{{ old('total_hco') }}">(<input type="text" name="hco_g"
                                        value="{{ old('hco_g') }}">)
                                </label>
                                <br><br>
                                <label>
                                    % ADECUACIÓN:<br>
                                    Energia:<input type="text" name="adecuacion_porcen_ene"
                                        value="{{ old('adecuacion_porcen_ene') }}" required>
                                    Kcal:<input type="text" name="adecuacion_porcen_ener_kcal"
                                        value="{{ old('adecuacion_porcen_ener_kcal') }}" required>
                                    Prot:<input type="text" name="adecuacion_porcen_prot"
                                        value="{{ old('adecuacion_porcen_prot') }}" required>
                                    Lip:<input type="text" name="adecuacion_porcen_lip"
                                        value="{{ old('adecuacion_porcen_lip') }}" required>
                                    Hco:<input type="text" name="adecuacion_porcen_hco"
                                        value="{{ old('adecuacion_porcen_hco') }}" required><br>
                                    Aspectos cualitativos de dieta habitual:<input type="text"
                                        name="aspectos_cualita_dieta_habitual"
                                        value="{{ old('aspectos_cualita_dieta_habitual') }}" required>
                                </label>
                                <br><br>
                                <label>
                                    REQUERIMIENTOS:<br>
                                    Energia:<input type="text" name="reque_ener" value="{{ old('reque_ener') }}" required>
                                    Proteina total:<input type="text" name="reque_proteina"
                                        value="{{ old('reque_proteina') }}">(<input type="text"
                                        name="reque_kg_dia" value="{{ old('reque_kg_dia') }}" required>)
                                </label>
                                <br><br>
                                <label>
                                    DX:NUTRICIO:<br>
                                    <input type="text" name="dx_nutricio" value="{{ old('dx_nutricio') }}"
                                        required>
                                </label>
                                <br>
                                <label>
                                    OBJETIVOS:<br>
                                    <input type="text" name="objetivos_dieta"
                                        value="{{ old('objetivos_dieta') }}">
                                </label>
                                <br>
                                <label>
                                    PLAN DE ALIMENTACIÓN:<br>
                                    Dieta <input type="text" name="tipo_dieta" value="{{ old('tipo_dieta') }}"
                                        required> de
                                    <input type="text" name="kcal_dieta" value="{{ old('kcal_dieta') }}"
                                        required>
                                    Prot:<input type="text" name="prot_porcent_dieta"
                                        value="{{ old('prot_porcent_dieta') }}" required>(
                                    <input type="text" name="prot_kg_dia_dieta"
                                        value="{{ old('prot_kg_dia_dieta') }}" required>)
                                    Lip:<input type="text" name="lip_porcen_dieta"
                                        value="{{ old('lip_porcen_dieta') }}" required>(
                                    <input type="text" name="lip_g_dieta" value="{{ old('lip_g_dieta') }}"
                                        required>)
                                    Hco:<input type="text" name="hco_porcen_dieta"
                                        value="{{ old('hco_porcen_dieta') }}" required>(
                                    <input type="text" name="hco_g_dieta" value="{{ old('hco_g_dieta') }}"
                                        required>)
                                </label>
                                <br>
                                <label>
                                    SUPLEMENTOS:<br>
                                    <input type="text" name="suplementos" value="{{ old('suplementos') }}">
                                </label>
                                <br>
                                <label>
                                    METAS SMART:<br>
                                    <input type="text" name="metas_smart" value="{{ old('metas_smart') }}"
                                        required>
                                </label>
                                <br>
                                <label>
                                    PARAMETROS META:<br>
                                    Peso:<input type="text" name="meta_peso" value="{{ old('meta_peso') }}">
                                    %Grasa:<input type="text" name="meta_grasa" value="{{ old('meta_grasa') }}">
                                    Músculo:<input type="text" name="meta_musculo"
                                        value="{{ old('meta_musculo') }}">
                                    C. Cintura:<input type="text" name="meta_cintura"
                                        value="{{ old('meta_cintura') }}">
                                    <br>
                                    Horarios:<input type="text" name="meta_horario"
                                        value="{{ old('meta_horario') }}">
                                    Mejorar hábitos:<input type="text" name="meta_mejorar"
                                        value="{{ old('meta_mejorar') }}">
                                    Selección de alimentos:<input type="text" name="meta_alimentos"
                                        value="{{ old('meta_alimentos') }}">
                                </label>
                                <br>
                                <label>
                                    EDUCACIÓN:<br>
                                    <input type="text" name="educacion" value="{{ old('educacion') }}">
                                </label>
                                <br>
                                <label>
                                    MONITOREO:<br>
                                    <input type="text" name="monitoreo" value="{{ old('monitoreo') }}">
                                </label>
                                <br>
                                <label>
                                    PENDIENTES:<br>
                                    <input type="text" name="pendientes" value="{{ old('pendientes') }}">
                                </label>
                                <br>
                                <label>
                                    NOMBRE COMPLETO, FIRMA Y CÉDULA PROFESIONAL DE QUIEN ELABORÓ LA HISTORIA CLINICA
                                    NUTRICIA:<br>
                                    <input type="text" name="datos_elaborador"
                                        value="{{ old('datos_elaborador') }}" required>
                                </label>
                                <br>
                                <label>
                                    NOMBRE COMPLETO, FIRMA Y CÉDULA PROFESIONAL DE NUTRIÓLOG() RESPONSABLE:<br>
                                    <input type="text" name="datos_nutriologo"
                                        value="{{ old('datos_nutriologo') }}" required>
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
        if (!validate_fills_form()) return;
        primerForm.style.display = 'none';
        segundoForm.style.display = 'block';
        window.scrollTo(0, 0);
    })

    btnRegresar.addEventListener('click', () => {
        primerForm.style.display = 'block';
        segundoForm.style.display = 'none';
        window.scrollTo(0, 0);

    })
    const elements_first_form = document.querySelectorAll(
        '.primer-form input[required], .primer-form textarea[required], .primer-form select[required]');

    function validate_fills_form() {
        const num_elements = elements_first_form.length;
        for (let i = 0; i < num_elements; i++) {
            const element = elements_first_form[i];
            const is_valid = element.reportValidity();
            element.setAttribute('aria-invalid', !is_valid);
            if (!is_valid) {
                return false;
            }
        }
        return true;
    }
</script>
