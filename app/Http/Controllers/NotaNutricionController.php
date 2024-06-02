<?php

namespace App\Http\Controllers;

use App\enums\Genero;
use App\Models\ApiBioquimico;
use App\Models\ApiComposicionCorporalDiagnosticoObesidad;
use App\Models\ApiControlCita;
use App\Models\ApiDatosNutriologo;
use App\Models\ApiDatosPaciente;
use App\Models\ApiDieteticosFrecuenciaSemanal;
use App\Models\ApiExploFisica;
use App\Models\ApiNutriologoPaciente;
use App\Models\ApiPersona;
use App\Models\ApiRegistroConsultum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NotaNutricionController extends Controller
{
    public function buscar(int $id)
    {
        $registrocitas = ApiRegistroConsultum::find($id);
        if ($registrocitas == null)
            return "No se enconto la cita";
        $paciente = ApiPersona::find($registrocitas->id_paciente);
        $datospaciente = ApiDatosPaciente::find($registrocitas->id_paciente);
        $controlcita = ApiControlCita::where('id_paciente', $registrocitas->id_paciente)->first();
        $exploracionfisica = ApiExploFisica::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $composicioncorporal = ApiComposicionCorporalDiagnosticoObesidad::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $bioquimico = ApiBioquimico::where('id_consulta_paciente', $registrocitas->id_registro)->first();

        return response()->json([
            $paciente,
            $registrocitas,
            $datospaciente,
            $controlcita,
            $exploracionfisica ?? new ApiExploFisica(),
            $composicioncorporal ?? new ApiComposicionCorporalDiagnosticoObesidad(),
            $bioquimico ?? new ApiBioquimico()
        ]);
    }
    public function crear(Request $request)
    {
        $token = $request->session()->token();
        $token = csrf_token();
        $request->validate([
            'nombre' => ['required'],
            'edad' => ['required', 'integer', 'gt:0'],
            'genero' => ['required', Rule::enum(Genero::class)],
            'expediente' => [
                'required',
                'integer',
                Rule::unique('api_datos_paciente', 'expediente')->ignore($request->id_paciente ?? 0),
            ],
            'fecha_nacimiento' => ['required', 'date_format:Y-m-d'],
            'motivo_consulta' => ['required', 'max:500'],
            'sintoma_gastro' => ['required'],
            'apego_plan_anterior_barr_apego' => ['required', 'max:250'],
            'motivacion' => ['required'],
            'sintomas_generales' => ['required', 'max:500'],
            'otros_sintoma_gastro' => ['nullable', 'max:255'],
            'pelo_unias' => ['required'],
            'piel' => ['required'],
            'ojos' => ['required'],
            'musculo' => ['required'],
            'otros_explo_fisica' => ['nullable'],
            'intolerancia_alimentos' => ['required_if_accepted:radio_into_aliment'],
            'actividad_fis_actual' => ['required'],
            'cambios_pos_estilo_vida' => ['required'],
            'peso' => ['required', 'decimal:0,2'],
            'imc' => ['required', 'decimal:0,2'],
            'mas_grasa_corporal' => ['required', 'decimal:0,2'],
            'porcentaje_grasa_corporal' => ['required', 'decimal:0,2'],
            'masa_muscular' => ['required', 'decimal:0,2'],
            'masa_libre_grasa' => ['required', 'decimal:0,2'],
            'act' => ['required', 'decimal:0,2'],
            'circunferencia_cintura' => ['required', 'numeric', 'max:32767'],
            'circunferencia_cadera' => ['required', 'numeric', 'max:32767'],
            'hora' => ['required', 'date_format:H:i'],
            'dinamometria' => ['nullable', 'decimal:0,2'],
            'interpretacion_dinamometrica' => ['nullable'],
            'frutas' => ['required', 'integer', 'max:127'],
            'verduras' => ['required', 'integer', 'max:127'],
            'cereales_sg' => ['required', 'integer', 'max:127'],
            'cereales_cg' => ['required', 'integer', 'max:127'],
            'leguminosas' => ['required', 'integer', 'max:127'],
            'poa' => ['required', 'integer', 'max:127'],
            'lacteos' => ['required', 'integer', 'max:127'],
            'aceites_sp' => ['required', 'integer', 'max:127'],
            'aceites_cp' => ['required', 'integer', 'max:127'],
            'azucares' => ['required', 'integer', 'max:127'],
            'pgc' => ['nullable', 'decimal:0,2'],
            'rcc' => ['nullable', 'decimal:0,2'],
            'metabolismo_kcal_basal' => ['nullable', 'decimal:0,2'],
            'hbAc1' => ['nullable', 'decimal:0,2'],
            'TG' => ['nullable', 'decimal:0,2'],
            'CT' => ['nullable', 'decimal:0,2'],
            'HDL' => ['nullable', 'decimal:0,2'],
            'LDL' => ['nullable', 'decimal:0,2'],
            'AST_perc' => ['nullable', 'decimal:0,2'],
            'ALT' => ['nullable', 'decimal:0,2'],
            'THS' => ['nullable', 'decimal:0,2'],
            'T3' => ['nullable', 'decimal:0,2'],
            'T4' => ['nullable', 'decimal:0,2'],
            'Hb' => ['nullable', 'decimal:0,2'],
            'hierro' => ['nullable', 'decimal:0,2'],
            'transferrina' => ['nullable', 'decimal:0,2'],
            't3_libre' => ['nullable', 'decimal:0,2'],
            't4_libre' => ['nullable', 'decimal:0,2'],
            'hto' => ['nullable', 'decimal:0,2'],
            'B12' => ['nullable', 'decimal:0,2'],
            'folatos' => ['nullable', 'decimal:0,2'],
            'PT' => ['nullable', 'decimal:0,2'],
            'albumina' => ['nullable', 'decimal:0,2'],
            'Ca' => ['nullable', 'decimal:0,2'],
            'otros_bioquimicos' => ['nullable'],
            'clinicos' => ['nullable'],
            'medicamentos_suplementos' => ['nullable'],
        ]);
        $datospaciente = null;
        if (isset($request->id_paciente)) {
            $datospaciente = ApiDatosPaciente::find($request->id_paciente);
        } else {
            $paciente = new ApiPersona();
            $paciente->nombre = $request->nombre;
            $paciente->edad = $request->edad;
            $paciente->genero = $request->genero;
            $paciente->save();

            $datospaciente = new ApiDatosPaciente();
            $datospaciente->id_persona = $paciente->persona_id;
            $datospaciente->expediente = $request->expediente;
            $datospaciente->fecha_nacimiento = $request->fecha_nacimiento;
            $datospaciente->save();
        }

        $nutriologo = new ApiNutriologoPaciente();
        $nutriologo->id_nutriologo = ApiDatosNutriologo::where(
            'id_persona',
            '=',
            $request->user()->persona_id
        )->first()->id_nutriologo;
        $nutriologo->id_paciente = $datospaciente->id_dato_paciente;
        if (
            !ApiNutriologoPaciente::
                where(
                    ['id_paciente' => 'id_paciente', 'id_nutriologo' => 'id_nutriologo'],
                    '=',
                    [$nutriologo->id_nutriologo, $nutriologo->id_paciente]
                )->first()
        ) {
            $nutriologo->save();
        }

        $registrocitas = new ApiRegistroConsultum();
        $registrocitas->no_consulta_paciente = $request->no_consulta_paciente;
        $registrocitas->id_paciente = $datospaciente->id_dato_paciente;
        $registrocitas->motivo_consulta = $request->motivo_consulta;
        $registrocitas->sintoma_gastro = $request->sintoma_gastro;
        $registrocitas->escala_bristol = $request->escala_bristol;
        $registrocitas->otros_sintoma_gastro = $request->otros_sintoma_gastro ?? '';
        $registrocitas->apego_plan_anterior_barr_apego = $request->apego_plan_anterior_barr_apego;
        $registrocitas->motivacion = $request->motivacion;
        $registrocitas->hidratacion = $request->hidratacion;
        $registrocitas->sintomas_generales = $request->sintomas_generales;

        $registrocitas->clinicos = $request->dx_medicos;
        $registrocitas->dinamometria = [
            'dinamometria' => $request->dinamometria ?? '',
            'interpretacion_dinamometrica' => $request->interpretacion_dinamometrica ?? ''
        ];
        $registrocitas->medicamentos_suplementos = $request->medicamentos_suplementos;
        $registrocitas->save();

        $exploracionfisica = new ApiExploFisica();
        $exploracionfisica->id_consulta_paciente = $registrocitas->id_registro;
        $exploracionfisica->pelo_unias = $request->pelo_unias;
        $exploracionfisica->piel = $request->piel;
        $exploracionfisica->ojos = $request->ojos;
        $exploracionfisica->musculo = $request->musculo;
        $exploracionfisica->otros = $request->otros_explo_fisica;
        $exploracionfisica->intolerancia_alimentos = $request->intolerancia_alimentos;
        $exploracionfisica->actividad_fis_actual = $request->actividad_fis_actual;
        $exploracionfisica->cambios_pos_estilo_vida = $request->cambios_pos_estilo_vida;
        $exploracionfisica->save();

        $composicioncorporal = new ApiComposicionCorporalDiagnosticoObesidad();
        $composicioncorporal->id_consulta_paciente = $registrocitas->id_registro;
        $composicioncorporal->peso = $request->peso;
        $composicioncorporal->masa_muscular = $request->masa_muscular;
        $composicioncorporal->mas_grasa_corporal = $request->mas_grasa_corporal;
        $composicioncorporal->act = $request->act;
        $composicioncorporal->imc = $request->imc;
        $composicioncorporal->pgc = $request->porcentaje_grasa_corporal;
        $composicioncorporal->rcc = $request->rcc;
        $composicioncorporal->metabolismo_kcal_basal = $request->metabolismo_kcal_basal ?? 0;
        $composicioncorporal->save();

        $controlcita = new ApiControlCita();
        $controlcita->id_paciente = $datospaciente->id_dato_paciente;

        $controlcita->id_registro_consulta = $registrocitas->id_registro;
        $controlcita->peso = $request->peso;
        $controlcita->IMC = $request->imc;
        $controlcita->masa_grasa_corporal = $request->mas_grasa_corporal;
        $controlcita->porcentaje_grasa_corporal = $request->porcentaje_grasa_corporal;
        $controlcita->masa_muscular_kg = $request->masa_muscular;
        $controlcita->agua_corpolar = $request->act;
        $controlcita->circunferencia_cintura = $request->circunferencia_cintura;
        $controlcita->circunferencia_cadera = $request->circunferencia_cadera;
        $controlcita->fecha_cita = Carbon::today();
        $controlcita->hora_cita = Carbon::createFromTimeString($request->hora);

        $controlcita->save();

        $freq = new ApiDieteticosFrecuenciaSemanal();
        $freq->id_consulta_paciente = $registrocitas->id_registro;
        $freq->frutas = $request->frutas;
        $freq->verduras = $request->verduras;
        $freq->cereales_s_g = $request->cereales_sg;
        $freq->cereales_c_g = $request->cereales_cg;
        $freq->leguminosas = $request->leguminosas;
        $freq->poa = $request->poa;
        $freq->lacteos = $request->lacteos;
        $freq->aceites_s_p = $request->aceites_sp;
        $freq->aceites_c_p = $request->aceites_cp;
        $freq->azucares = $request->azucares;
        $freq->save();

        $id_registro = $registrocitas->id_registro;
        $bioquimico = new ApiBioquimico();
        $bioquimico->glucosa = $request->glucosa;
        if ($bioquimico->glucosa == null) {
            return view('alumno.agregar_dieta', compact('id_registro'));
        }
        $bioquimico->id_consulta_paciente = $registrocitas->id_registro;
        $bioquimico->hbAc1 = $request->hbAc1;
        $bioquimico->TG = $request->TG;
        $bioquimico->CT = $request->CT;
        $bioquimico->HDL = $request->HDL;
        $bioquimico->LDL = $request->LDL;
        $bioquimico->AST_perc = $request->AST_perc;
        $bioquimico->ALT = $request->ALT;
        $bioquimico->THS = $request->THS;
        $bioquimico->T3 = $request->T3;
        $bioquimico->T4 = $request->T4;
        $bioquimico->Hb = $request->Hb;
        $bioquimico->hierro = $request->hierro;
        $bioquimico->transferrina = $request->transferrina;
        $bioquimico->t3_libre = $request->t3_libre;
        $bioquimico->t4_libre = $request->t4_libre;
        $bioquimico->hto = $request->hto;
        $bioquimico->B12 = $request->B12;
        $bioquimico->folatos = $request->folatos;
        $bioquimico->PT = $request->PT;
        $bioquimico->albumina = $request->albumina;
        $bioquimico->Ca = $request->Ca;
        $bioquimico->otros = $request->otros_bioquimicos;
        $bioquimico->save();
        return view('alumno.agregar_dieta', compact('id_registro'));
    }

    public function actualizar(Request $request, string $id)
    {
        $request->validate([
            'nombre' => ['required'],
            'edad' => ['required', 'integer', 'positive'],
            'genero' => ['required', Rule::enum(Genero::class)],
            'expediente' => [
                'required',
                'unique:App\Models\ApiDatosPaciente, expediente,' . $id
            ],
            'fecha_nacimiento' => ['required', 'date_format:Y-m-d'],
            'motivo_consulta' => ['required', 'max:500'],
            'sintoma_gastro' => ['required'],
            'apego_plan_anterior_barr_apego' => ['required', 'max:250'],
            'motivacion' => ['required'],
            'sintomas_generales' => ['required', 'max:500'],
            'otros_sintoma_gastro' => ['nullable', 'max:255'],
            'pelo_unias' => ['required'],
            'piel' => ['required'],
            'ojos' => ['required'],
            'musculo' => ['required'],
            'otros_explo_fisica' => ['nullable'],
            'intolerancia_alimentos' => ['required_if_accepted:radio_into_aliment'],
            'actividad_fis_actual' => ['required'],
            'cambios_pos_estilo_vida' => ['required'],
            'peso' => ['required', 'decimal:0,2'],
            'imc' => ['required', 'decimal:0,2'],
            'mas_grasa_corporal' => ['required', 'decimal:0,2'],
            'porcentaje_grasa_corporal' => ['required', 'decimal:0,2'],
            'masa_muscular' => ['required', 'decimal:0,2'],
            'masa_libre_grasa' => ['required', 'decimal:0,2'],
            'act' => ['required', 'decimal:0,2'],
            'circunferencia_cintura' => ['required', 'numeric', 'max:32767'],
            'circunferencia_cadera' => ['required', 'numeric', 'max:32767'],
            'hora' => ['required', 'date_format:H:i'],
            'dinamometria' => ['nullable', 'decimal:0,2'],
            'interpretacion_dinamometrica' => ['nullable'],
            'pgc' => ['nullable', 'decimal:0,2'],
            'rcc' => ['nullable', 'decimal:0,2'],
            'metabolismo_kcal_basal' => ['nullable', 'decimal:0,2'],
            'frutas' => ['required', 'integer', 'max:127'],
            'verduras' => ['required', 'integer', 'max:127'],
            'cereales_sg' => ['required', 'integer', 'max:127'],
            'cereales_cg' => ['required', 'integer', 'max:127'],
            'leguminosas' => ['required', 'integer', 'max:127'],
            'poa' => ['required', 'integer', 'max:127'],
            'lacteos' => ['required', 'integer', 'max:127'],
            'aceites_sp' => ['required', 'integer', 'max:127'],
            'aceites_cp' => ['required', 'integer', 'max:127'],
            'azucares' => ['required', 'integer', 'max:127'],
            'hbAc1' => ['nullable', 'decimal:0,2'],
            'TG' => ['nullable', 'decimal:0,2'],
            'CT' => ['nullable', 'decimal:0,2'],
            'HDL' => ['nullable', 'decimal:0,2'],
            'LDL' => ['nullable', 'decimal:0,2'],
            'AST_perc' => ['nullable', 'decimal:0,2'],
            'ALT' => ['nullable', 'decimal:0,2'],
            'THS' => ['nullable', 'decimal:0,2'],
            'T3' => ['nullable', 'decimal:0,2'],
            'T4' => ['nullable', 'decimal:0,2'],
            'Hb' => ['nullable', 'decimal:0,2'],
            'hierro' => ['nullable', 'decimal:0,2'],
            'transferrina' => ['nullable', 'decimal:0,2'],
            't3_libre' => ['nullable', 'decimal:0,2'],
            't4_libre' => ['nullable', 'decimal:0,2'],
            'hto' => ['nullable', 'decimal:0,2'],
            'B12' => ['nullable', 'decimal:0,2'],
            'folatos' => ['nullable', 'decimal:0,2'],
            'PT' => ['nullable', 'decimal:0,2'],
            'albumina' => ['nullable', 'decimal:0,2'],
            'Ca' => ['nullable', 'decimal:0,2'],
            'otros_bioquimicos' => ['nullable'],
            'clinicos' => ['nullable'],
            'medicamentos_suplementos' => ['nullable'],
        ]);
        $registrocitas = ApiRegistroConsultum::find($id);
        if ($registrocitas == null) {
            return "No se enconto la cita";
        }
        $datopaciente = ApiDatosPaciente::find($registrocitas->id_paciente);
        $paciente = ApiPersona::find($datopaciente->id_persona);
        $paciente->edad = $request->edad;
        $paciente->save();

        $registrocitas->motivo_consulta = $request->motivo_consulta;
        $registrocitas->sintoma_gastro = $request->sintoma_gastro;
        $registrocitas->escala_bristol = $request->escala_bristol;
        $registrocitas->otros_sintoma_gastro = $request->otros_sintoma_gastro ?? '';
        $registrocitas->apego_plan_anterior_barr_apego = $request->apego_plan_anterior_barr_apego;
        $registrocitas->motivacion = $request->motivacion;
        $registrocitas->hidratacion = $request->hidratacion;
        $registrocitas->sintomas_generales = $request->sintomas_generales;
        $registrocitas->clinicos = $request->dx_medicos;
        $registrocitas->dinamometria = [
            'dinamometria' => $request->dinamometria ?? '',
            'interpretacion_dinamometrica' => $request->interpretacion_dinamometrica ?? ''
        ];
        $registrocitas->medicamentos_suplementos = $request->medicamentos_suplementos;
        $registrocitas->save();

        $controlcita = ApiControlCita::where('id_paciente', $registrocitas->id_paciente)->first();
        $controlcita->peso = $request->peso;
        $controlcita->IMC = $request->imc;
        $controlcita->masa_grasa_corporal = $request->mas_grasa_corporal;
        $controlcita->porcentaje_grasa_corporal = $request->porcentaje_grasa_corporal;
        $controlcita->masa_muscular_kg = $request->masa_muscular;
        $controlcita->agua_corpolar = $request->act;
        $controlcita->circunferencia_cintura = $request->circunferencia_cintura;
        $controlcita->circunferencia_cadera = $request->circunferencia_cadera;
        $controlcita->hora_cita = Carbon::createFromTimeString($request->hora);
        $controlcita->save();

        $exploracionfisica = ApiExploFisica::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $exploracionfisica->pelo_unias = $request->pelo_unias;
        $exploracionfisica->piel = $request->piel;
        $exploracionfisica->ojos = $request->ojos;
        $exploracionfisica->musculo = $request->musculo;
        $exploracionfisica->otros = $request->otros_explo_fisica;
        $exploracionfisica->intolerancia_alimentos = $request->intolerancia_alimentos;
        $exploracionfisica->actividad_fis_actual = $request->actividad_fis_actual;
        $exploracionfisica->cambios_pos_estilo_vida = $request->cambios_pos_estilo_vida;
        $exploracionfisica->save();

        $composicioncorporal = ApiComposicionCorporalDiagnosticoObesidad::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $composicioncorporal->peso = $request->peso;
        $composicioncorporal->masa_muscular = $request->masa_muscular;
        $composicioncorporal->mas_grasa_corporal = $request->masa_grasa_corporal;
        $composicioncorporal->act = $request->act;
        $composicioncorporal->imc = $request->imc;
        $composicioncorporal->pgc = $request->porcentaje_grasa_corporal;
        $composicioncorporal->rcc = $request->rcc;
        $composicioncorporal->metabolismo_kcal_basal = $request->metabolismo_kcal_basal ?? 0;
        $composicioncorporal->save();

        $freq = new ApiDieteticosFrecuenciaSemanal();
        $freq->id_consulta_paciente = $registrocitas->id_registro;
        $freq->frutas = $request->frutas;
        $freq->verduras = $request->verduras;
        $freq->cereales_s_g = $request->cereales_sg;
        $freq->cereales_c_g = $request->cereales_cg;
        $freq->leguminosas = $request->leguminosas;
        $freq->poa = $request->poa;
        $freq->lacteos = $request->lacteos;
        $freq->aceites_s_p = $request->aceites_sp;
        $freq->aceites_c_p = $request->aceites_cp;
        $freq->azucares = $request->azucares;
        $freq->save();

        if ($request->glucosa == null) {
            return "se actualizaron los datos, menos bioquimicos";
        }
        $bioquimico = ApiBioquimico::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        if ($bioquimico == null) {
            $bioquimico = new ApiBioquimico();
            $bioquimico->id_consulta_paciente = $registrocitas->id_registro;
        }
        $bioquimico->hbAc1 = $request->hbAc1;
        $bioquimico->TG = $request->TG;
        $bioquimico->CT = $request->CT;
        $bioquimico->HDL = $request->HDL;
        $bioquimico->LDL = $request->LDL;
        $bioquimico->AST_perc = $request->AST_perc;
        $bioquimico->ALT = $request->ALT;
        $bioquimico->THS = $request->THS;
        $bioquimico->T3 = $request->T3;
        $bioquimico->T4 = $request->T4;
        $bioquimico->Hb = $request->Hb;
        $bioquimico->hierro = $request->hierro;
        $bioquimico->transferrina = $request->transferrina;
        $bioquimico->t3_libre = $request->t3_libre;
        $bioquimico->t4_libre = $request->t4_libre;
        $bioquimico->hto = $request->hto;
        $bioquimico->B12 = $request->B12;
        $bioquimico->folatos = $request->folatos;
        $bioquimico->PT = $request->PT;
        $bioquimico->albumina = $request->albumina;
        $bioquimico->Ca = $request->Ca;
        $bioquimico->otros = $request->otros_bioquimicos;

        $bioquimico->save();
        return response()->json(["se actualizaron los datos", "id_registro_consulta" => $controlcita->id_registro_consulta]);
    }
}