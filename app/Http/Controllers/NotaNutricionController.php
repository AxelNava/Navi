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
use App\Models\ApiDieteticosInstrumentoMedicion;
use Carbon\Carbon;
use App\Models\ApiDatosGeneralesDietum;
use App\Models\ApiResultadoDiagnostico;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NotaNutricionController extends Controller
{
    public function buscar(int $id_registro)
    {
        $registrocitas = ApiRegistroConsultum::find($id_registro);
        if ($registrocitas == null)
            return "No se encontró la cita";
        $datospaciente = ApiDatosPaciente::find($registrocitas->id_paciente);
        $paciente = ApiPersona::find($datospaciente->id_persona);
        $controlcita = ApiControlCita::where('id_paciente', $registrocitas->id_paciente)->first();
        $exploracionfisica = ApiExploFisica::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $composicioncorporal = ApiComposicionCorporalDiagnosticoObesidad::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $bioquimico = ApiBioquimico::where('id_consulta_paciente', $registrocitas->id_registro)->first();

        $freq = ApiDieteticosFrecuenciaSemanal::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $diagnostico = ApiResultadoDiagnostico::where('id_consulta_paciente', $registrocitas->id_registro)->first();

        $generales = ApiDatosGeneralesDietum::where('id_consulta_paciente', $registrocitas->id_registro)->first();

        $instrumento = ApiDieteticosInstrumentoMedicion::where('id_consulta_paciente', $registrocitas->id_registro)->first();


        return view('alumno.modificar_registro', [
            'data' => [
                'paciente' => $paciente,
                'registro_consulta' => $registrocitas,
                'datos_paciente' => $datospaciente,
                'control_citas' => $controlcita,
                'explo_fisica' => $exploracionfisica ?? new ApiExploFisica(),
                'composcion_corp' => $composicioncorporal ?? new ApiComposicionCorporalDiagnosticoObesidad(),
                'bioquimicos' => $bioquimico ?? new ApiBioquimico(),
                'diagnostico' => $diagnostico,
                'generales' => $generales,
                'instrumento' => $instrumento,
                'frecuencia_semanal' => $freq
            ]
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
            'apego_plan_anterior_barr_apego' => ['required', 'max:250'],
            'motivacion' => ['required'],
            'hidratacion' => ['required'],
            'otros_hidratacion' => ['nullable'],
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
            'rango_peso_saludable' => ['nullable'],
            'indice_libre_grasa' => ['nullable'],
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
            'TSH' => ['nullable', 'decimal:0,2'],
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
            'tipo_instrument' => 'required',
            'desayuno_hora' => 'required',
            'colacion1' => 'required',
            'comida_hora' => 'required',
            'colacion2' => 'required',
            'cena_hora' => 'required',
            'colacion3' => 'required',
            'total_kcal' => 'required',
            'aspectos_cualita_dieta_habitual' => 'required',
            'dx_nutricio' => 'required',
            'tipo_dieta' => 'required',
            'kcal_dieta' => 'required',
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
            !ApiNutriologoPaciente::where(
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
        $registrocitas->sintoma_gastro = [
            'bristol' => $request->bristol,
            'flatulencia' => $request->flatulencia,
            'estreñimiento' => $request->estreñimiento,
            'diarrea' => $request->diarrea,
            'reflujo' => $request->reflujo,
            'gastritis' => $request->gastritis,
            'saciedad' => $request->saciedad,
            'temprana' => $request->temprana,
            'apetito' => $request->apetito
        ];
        $registrocitas->escala_bristol = $request->escala_bristol;
        $registrocitas->otros_sintoma_gastro = $request->otros_sintoma_gastro ?? '';
        $registrocitas->apego_plan_anterior_barr_apego = $request->apego_plan_anterior_barr_apego;
        $registrocitas->motivacion = $request->motivacion;
        $registrocitas->hidratacion = [
            'hidratacion' => $request->hidratacion,
            'otros_hidratacion' => $request->otras_bebidas ?? ''
        ];
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
        $composicioncorporal->masa_libre_grasa = $request->masa_libre_grasa;
        $composicioncorporal->indice_libre_grasa = $request->indice_libre_grasa;
        $composicioncorporal->rango_peso_saludable = $request->rango_peso_saludable;

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
        if ($bioquimico->glucosa != null) {
            $bioquimico->id_consulta_paciente = $registrocitas->id_registro;
            $bioquimico->hbAc1 = $request->hbAc1;
            $bioquimico->TG = $request->TG;
            $bioquimico->CT = $request->CT;
            $bioquimico->HDL = $request->HDL;
            $bioquimico->LDL = $request->LDL;
            $bioquimico->AST_perc = $request->AST_perc;
            $bioquimico->ALT = $request->ALT;
            $bioquimico->TSH = $request->TSH;
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
        }

        // dieta paciente
        $instrumento = new ApiDieteticosInstrumentoMedicion();
        $instrumento->id_consulta_paciente = $id_registro;
        $instrumento->tipo_instrumento = $request->tipo_instrumento;
        $instrumento->desayuno_hora = $request->desayuno_hora;
        $instrumento->colacion1 = $request->colacion1;
        $instrumento->comida_hora = $request->comida_hora;
        $instrumento->colacion2 = $request->colacion2;
        $instrumento->cena_hora = $request->cena_hora;
        $instrumento->colacion3 = $request->colacion3;
        $instrumento->grupo_total_eq = [
            'verduras' => $request->verduras,
            'frutas' => $request->frutas,
            'cereales' => $request->cereales,
            'leguminosas' => $request->leguminosas,
            'carnes' => $request->carnes,
            'leche' => $request->leche,
            'grasa' => $request->grasa,
            'azucar' => $request->azucar
        ];
        $instrumento->total_kcal = $request->total_kcal;
        $instrumento->total_prot = [
            'prot_porcent' => $request->total_prot,
            'prot_g' => $request->prot_g
        ];
        $instrumento->total_lip = [
            'lip_porcent' => $request->total_lip,
            'lip_g' => $request->lip_g,
        ];
        $instrumento->total_hco = [
            'hco_porcent' => $request->total_hco,
            'hco_g' => $request->hco_g,
        ];
        $instrumento->adecuacion_porcen_ene = $request->adecuacion_porcen_ene;
        $instrumento->adecuacion_porcen_ener_kcal = $request->adecuacion_porcen_ener_kcal;
        $instrumento->adecuacion_porcen_prot = $request->adecuacion_porcen_prot;
        $instrumento->adecuacion_porcen_lip = $request->adecuacion_porcen_lip;
        $instrumento->adecuacion_porcen_hco = $request->adecuacion_porcen_hco;
        $instrumento->aspectos_cualita_dieta_habitual = $request->aspectos_cualita_dieta_habitual;
        $instrumento->save();

        $diagnostico = new ApiResultadoDiagnostico();
        $diagnostico->id_consulta_paciente = $id_registro;
        $diagnostico->reque_ener = $request->reque_ener;
        $diagnostico->reque_proteina = $request->reque_proteina;
        $diagnostico->reque_kg_dia = $request->reque_kg_dia;
        $diagnostico->dx_nutricio = $request->dx_nutricio;
        $diagnostico->save();

        $generales = new ApiDatosGeneralesDietum();
        $generales->id_consulta_paciente = $id_registro;
        $generales->objetivos_dieta = $request->objetivos_dieta;
        $generales->tipo_dieta = $request->tipo_dieta;
        $generales->kcal_dieta = $request->kcal_dieta;
        $generales->prot_porcent_dieta = $request->prot_porcent_dieta;
        $generales->prot_kg_dia_dieta = $request->prot_kg_dia_dieta;
        $generales->lip_porcen_dieta = $request->lip_porcen_dieta;
        $generales->lip_g_dieta = $request->lip_g_dieta;
        $generales->hco_porcen_dieta = $request->hco_porcen_dieta;
        $generales->hco_g_dieta = $request->hco_g_dieta;
        $generales->suplementos = $request->suplementos;
        $generales->metas_smart = $request->metas_smart;
        $generales->param_meta = [
            'peso' => $request->meta_peso,
            'porcen_grasa' => $request->meta_grasa,
            'musculo' => $request->meta_musculo,
            'c_cintura' => $request->meta_cintura,
            'horarios' => $request->meta_horario,
            'm_habitos' => $request->meta_mejorar,
            'selec_alimentos' => $request->meta_alimentos
        ];
        $generales->educacion = $request->educacion;
        $generales->monitoreo = $request->monitoreo;
        $generales->save();

        $registro = new ApiRegistroConsultum();
        $registro->id_registro = $id_registro;
        $registro->pendientes = $request->pendientes;
        $registro->nutri_elaborate_data = $request->datos_elaborador;
        $registro->nutri_who_approved_data = $request->datos_nutriologo;
        $registro->where('id_registro', $request->id_registro)->update([
            'pendientes' => $registro->pendientes,
            'nutri_elaborate_data' => $registro->nutri_elaborate_data,
            'nutri_who_approved_data' => $registro->nutri_who_approved_data,
        ]);

        return redirect()->route('alumno.inicio')->with('success', 'Se ha registrado al paciente correctamente');
    }

    public function actualizar(Request $request, string $id)
    {
        $request->validate([
            'edad' => ['required', 'integer'],
            'motivo_consulta' => ['required', 'max:500'],
            'apego_plan_anterior_barr_apego' => ['required', 'max:250'],
            'motivacion' => ['required'],
            'sintomas_generales' => ['required', 'max:500'],
            'otros_sintoma_gastro' => ['nullable', 'max:255'],
            'pelo_unias' => ['required'],
            'piel' => ['required'],
            'ojos' => ['required'],
            'musculo' => ['required'],
            'otros_explo_fisica' => ['nullable'],
            'intolerancia_alimentos' => ['nullable', 'required_if_accepted:radio_into_aliment'],
            'actividad_fis_actual' => ['required'],
            'cambios_pos_estilo_vida' => ['required'],
            'peso' => ['required', 'decimal:0,2'],
            'imc' => ['required', 'decimal:0,2'],
            'mas_grasa_corporal' => ['required', 'decimal:0,2'],
            'porcentaje_grasa_corporal' => ['required', 'decimal:0,2'],
            'masa_muscular' => ['required', 'decimal:0,2'],
            'masa_libre_grasa' => ['required', 'decimal:0,2'],
            'rango_peso_saludable' => ['nullable'],
            'indice_libre_grasa' => ['nullable'],
            'act' => ['required', 'decimal:0,2'],
            'circunferencia_cintura' => ['required', 'numeric', 'max:32767'],
            'circunferencia_cadera' => ['required', 'numeric', 'max:32767'],
            'hora' => ['required', 'date_format:H:i:s'],
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
            'TSH' => ['nullable', 'decimal:0,2'],
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
            'tipo_instrument' => 'required',
            'desayuno_hora' => 'required',
            'colacion1' => 'required',
            'comida_hora' => 'required',
            'colacion2' => 'required',
            'cena_hora' => 'required',
            'colacion3' => 'required',
            'total_kcal' => 'required',
            'aspectos_cualita_dieta_habitual' => 'required',
            'dx_nutricio' => 'required',
            'tipo_dieta' => 'required',
            'kcal_dieta' => 'required',
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
        $registrocitas->sintoma_gastro = [
            'bristol' => $request->escala_bristol,
            'flatulencia' => $request->flatulencia,
            'estreñimiento' => $request->estreñimiento,
            'diarrea' => $request->diarrea,
            'reflujo' => $request->reflujo,
            'gastritis' => $request->gastritis,
            'saciedad' => $request->saciedad,
            'temprana' => $request->temprana,
            'apetito' => $request->apetito,
        ];
        $registrocitas->escala_bristol = $request->escala_bristol;
        $registrocitas->otros_sintoma_gastro = $request->otros_sintoma_gastro ?? '';
        $registrocitas->apego_plan_anterior_barr_apego = $request->apego_plan_anterior_barr_apego;
        $registrocitas->motivacion = $request->motivacion;
        $registrocitas->hidratacion = [
            'hidratacion' => $request->hidratacion,
            'otros_hidratacion' => $request->otras_bebidas ?? ''
        ];
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
        $composicioncorporal->mas_grasa_corporal = $request->mas_grasa_corporal;
        $composicioncorporal->act = $request->act;
        $composicioncorporal->imc = $request->imc;
        $composicioncorporal->pgc = $request->porcentaje_grasa_corporal;
        $composicioncorporal->rcc = $request->rcc;
        $composicioncorporal->masa_libre_grasa = $request->masa_libre_grasa;
        $composicioncorporal->indice_libre_grasa = $request->indice_masa_libre_grasa;
        $composicioncorporal->rango_peso_saludable = $request->rango_peso_saludable;

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

        if ($request->glucosa != null) {
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
            $bioquimico->TSH = $request->TSH;
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
        }

        $diagnostico = ApiResultadoDiagnostico::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        if ($diagnostico == null) {
            $diagnostico = new ApiResultadoDiagnostico();
            $diagnostico->id_consulta_paciente = $registrocitas->id_registro;
        }
        $diagnostico->reque_ener = $request->reque_ener;
        $diagnostico->reque_proteina = $request->reque_proteina;
        $diagnostico->reque_kg_dia = $request->reque_kg_dia;
        $diagnostico->dx_nutricio = $request->dx_nutricio;
        $diagnostico->save();

        $datos = ApiDatosGeneralesDietum::where('id_consulta_paciente', $diagnostico->id_consulta_paciente)->first();
        if ($datos == null) {
            $datos = new ApiDatosGeneralesDietum();
            $datos->id_consulta_paciente = $diagnostico->id_consulta_paciente;
        }
        $datos->objetivos_dieta = $request->objetivos_dieta;
        $datos->tipo_dieta = $request->tipo_dieta;
        $datos->kcal_dieta = $request->kcal_dieta;
        $datos->prot_porcent_dieta = $request->prot_porcent_dieta;
        $datos->prot_kg_dia_dieta = $request->prot_kg_dia_dieta;
        $datos->lip_porcen_dieta = $request->lip_porcen_dieta;
        $datos->lip_g_dieta = $request->lip_g_dieta;
        $datos->hco_porcen_dieta = $request->hco_porcen_dieta;
        $datos->hco_g_dieta = $request->hco_g_dieta;
        $datos->suplementos = $request->suplementos;
        $datos->metas_smart = $request->metas_smart;
        $datos->param_meta = [
            'peso' => $request->meta_peso,
            'porcen_grasa' => $request->meta_grasa,
            'musculo' => $request->meta_musculo,
            'c_cintura' => $request->meta_cintura,
            'horarios' => $request->meta_horario,
            'm_habitos' => $request->meta_mejorar,
            'selec_alimentos' => $request->meta_alimentos
        ];
        $datos->educacion = $request->educacion;
        $datos->monitoreo = $request->monitoreo;

        $datos->save();

        $instrum = ApiDieteticosInstrumentoMedicion::where('id_consulta_paciente', $diagnostico->id_consulta_paciente)->first();
        if ($instrum == null) {
            $instrum = new ApiDieteticosInstrumentoMedicion();
            $instrum->id_consulta_paciente = $diagnostico->id_consulta_paciente;
        }
        $instrum->tipo_instrumento = $request->instrumento;
        $instrum->desayuno_hora = $request->desayuno_hora;
        $instrum->colacion1 = $request->colacion1;
        $instrum->comida_hora = $request->comida_hora;
        $instrum->colacion2 = $request->colacion2;
        $instrum->cena_hora = $request->cena_hora;
        $instrum->colacion3 = $request->colacion3;
        $instrum->grupo_total_eq = [
            'verduras' => $request->verduras,
            'frutas' => $request->frutas,
            'cereales' => $request->cereales,
            'leguminosas' => $request->leguminosas,
            'carnes' => $request->carnes,
            'leche' => $request->leche,
            'grasa' => $request->grasa,
            'azucar' => $request->azucar
        ];
        $instrum->total_kcal = $request->total_kcal;
        $instrum->total_prot = [
            'prot_porcent' => $request->total_prot,
            'prot_g' => $request->prot_g
        ];
        $instrum->total_lip = [
            'lip_porcent' => $request->total_lip,
            'lip_g' => $request->lip_g
        ];
        $instrum->total_hco = [
            'hco_porcent' => $request->total_hco,
            'hco_g' => $request->hco_g
        ];
        $instrum->adecuacion_porcen_ener_kcal = $request->adecuacion_porcen_ener_kcal;
        $instrum->adecuacion_porcen_ene = $request->adecuacion_porcen_ene;
        $instrum->adecuacion_porcen_prot = $request->adecuacion_porcen_prot;
        $instrum->adecuacion_porcen_lip = $request->adecuacion_porcen_lip;
        $instrum->adecuacion_porcen_hco = $request->adecuacion_porcen_hco;
        $instrum->aspectos_cualita_dieta_habitual = $request->aspectos_cualita_dieta_habitual;
        $instrum->save();

        $registrocitas->pendientes = $request->pendientes;
        $registrocitas->nutri_elaborate_data = $request->datos_elaborador;
        $registrocitas->nutri_who_approved_data = $request->datos_nutriologo;
        $registrocitas->save();

        return redirect()->route('modificar_registro_formulario', ['id_registro' => $registrocitas->id_registro])->with('success', 'Se han actualizado los datos');
    }
    public function create_new_registro_formulario(Request $request, string $id_paciente)
    {
        $token = $request->session()->token();
        $token = csrf_token();
        $request->validate([
            'edad' => ['required', 'integer', 'gt:0'],
            'motivo_consulta' => ['required', 'max:500'],
            'apego_plan_anterior_barr_apego' => ['required', 'max:250'],
            'motivacion' => ['required'],
            'hidratacion' => ['required'],
            'otros_hidratacion' => ['nullable'],
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
            'rango_peso_saludable' => ['nullable'],
            'indice_libre_grasa' => ['nullable'],
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
            'TSH' => ['nullable', 'decimal:0,2'],
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
            'instrumento' => 'required',
            'desayuno_hora' => 'required',
            'colacion1' => 'required',
            'comida_hora' => 'required',
            'colacion2' => 'required',
            'cena_hora' => 'required',
            'colacion3' => 'required',
            'total_kcal' => 'required',
            'aspectos_cualita_dieta_habitual' => 'required',
            'dx_nutricio' => 'required',
            'tipo_dieta' => 'required',
            'kcal_dieta' => 'required',
        ]);
        $datospaciente = ApiDatosPaciente::find($id_paciente);
        $persona = ApiPersona::find($datospaciente->id_persona);
        $persona->edad = $request->edad;
        $persona->save();

        $registrocitas = new ApiRegistroConsultum();
        $registrocitas->no_consulta_paciente = $request->no_consulta_paciente;
        $registrocitas->id_paciente = $datospaciente->id_dato_paciente;
        $registrocitas->motivo_consulta = $request->motivo_consulta;
        $registrocitas->sintoma_gastro = [
            'bristol' => $request->bristol,
            'flatulencia' => $request->flatulencia,
            'estreñimiento' => $request->estreñimiento,
            'diarrea' => $request->diarrea,
            'reflujo' => $request->reflujo,
            'gastritis' => $request->gastritis,
            'saciedad' => $request->saciedad,
            'temprana' => $request->temprana,
            'apetito' => $request->apetito
        ];
        $registrocitas->escala_bristol = $request->escala_bristol;
        $registrocitas->otros_sintoma_gastro = $request->otros_sintoma_gastro ?? '';
        $registrocitas->apego_plan_anterior_barr_apego = $request->apego_plan_anterior_barr_apego;
        $registrocitas->motivacion = $request->motivacion;
        $registrocitas->hidratacion = [
            'hidratacion' => $request->hidratacion,
            'otros_hidratacion' => $request->otras_bebidas ?? ''
        ];
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
        $composicioncorporal->masa_libre_grasa = $request->masa_libre_grasa;
        $composicioncorporal->indice_libre_grasa = $request->indice_libre_grasa;
        $composicioncorporal->rango_peso_saludable = $request->rango_peso_saludable;

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
        if ($bioquimico->glucosa != null) {
            $bioquimico->id_consulta_paciente = $registrocitas->id_registro;
            $bioquimico->hbAc1 = $request->hbAc1;
            $bioquimico->TG = $request->TG;
            $bioquimico->CT = $request->CT;
            $bioquimico->HDL = $request->HDL;
            $bioquimico->LDL = $request->LDL;
            $bioquimico->AST_perc = $request->AST_perc;
            $bioquimico->ALT = $request->ALT;
            $bioquimico->TSH = $request->TSH;
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
        }

        // dieta paciente
        $instrumento = new ApiDieteticosInstrumentoMedicion();
        $instrumento->id_consulta_paciente = $id_registro;
        $instrumento->tipo_instrumento = $request->tipo_instrumento;
        $instrumento->desayuno_hora = $request->desayuno_hora;
        $instrumento->colacion1 = $request->colacion1;
        $instrumento->comida_hora = $request->comida_hora;
        $instrumento->colacion2 = $request->colacion2;
        $instrumento->cena_hora = $request->cena_hora;
        $instrumento->colacion3 = $request->colacion3;
        $instrumento->grupo_total_eq = [
            'verduras' => $request->verduras,
            'frutas' => $request->frutas,
            'cereales' => $request->cereales,
            'leguminosas' => $request->leguminosas,
            'carnes' => $request->carnes,
            'leche' => $request->leche,
            'grasa' => $request->grasa,
            'azucar' => $request->azucar
        ];
        $instrumento->total_kcal = $request->total_kcal;
        $instrumento->total_prot = [
            'prot_porcent' => $request->total_prot,
            'prot_g' => $request->prot_g
        ];
        $instrumento->total_lip = [
            'lip_porcent' => $request->total_lip,
            'lip_g' => $request->lip_g,
        ];
        $instrumento->total_hco = [
            'hco_porcent' => $request->total_hco,
            'hco_g' => $request->hco_g,
        ];
        $instrumento->adecuacion_porcen_ene = $request->adecuacion_porcen_ene;
        $instrumento->adecuacion_porcen_ener_kcal = $request->adecuacion_porcen_ener_kcal;
        $instrumento->adecuacion_porcen_prot = $request->adecuacion_porcen_prot;
        $instrumento->adecuacion_porcen_lip = $request->adecuacion_porcen_lip;
        $instrumento->adecuacion_porcen_hco = $request->adecuacion_porcen_hco;
        $instrumento->aspectos_cualita_dieta_habitual = $request->aspectos_cualita_dieta_habitual;
        $instrumento->save();

        $diagnostico = new ApiResultadoDiagnostico();
        $diagnostico->id_consulta_paciente = $id_registro;
        $diagnostico->reque_ener = $request->reque_ener;
        $diagnostico->reque_proteina = $request->reque_proteina;
        $diagnostico->reque_kg_dia = $request->reque_kg_dia;
        $diagnostico->dx_nutricio = $request->dx_nutricio;
        $diagnostico->save();

        $generales = new ApiDatosGeneralesDietum();
        $generales->id_consulta_paciente = $id_registro;
        $generales->objetivos_dieta = $request->objetivos_dieta;
        $generales->tipo_dieta = $request->tipo_dieta;
        $generales->kcal_dieta = $request->kcal_dieta;
        $generales->prot_porcent_dieta = $request->prot_porcent_dieta;
        $generales->prot_kg_dia_dieta = $request->prot_kg_dia_dieta;
        $generales->lip_porcen_dieta = $request->lip_porcen_dieta;
        $generales->lip_g_dieta = $request->lip_g_dieta;
        $generales->hco_porcen_dieta = $request->hco_porcen_dieta;
        $generales->hco_g_dieta = $request->hco_g_dieta;
        $generales->suplementos = $request->suplementos;
        $generales->metas_smart = $request->metas_smart;
        $generales->param_meta = [
            'peso' => $request->meta_peso,
            'porcen_grasa' => $request->meta_grasa,
            'musculo' => $request->meta_musculo,
            'c_cintura' => $request->meta_cintura,
            'horarios' => $request->meta_horario,
            'm_habitos' => $request->meta_mejorar,
            'selec_alimentos' => $request->meta_alimentos
        ];
        $generales->educacion = $request->educacion;
        $generales->monitoreo = $request->monitoreo;
        $generales->save();

        $registro = new ApiRegistroConsultum();
        $registro->id_registro = $id_registro;
        $registro->pendientes = $request->pendientes;
        $registro->nutri_elaborate_data = $request->datos_elaborador;
        $registro->nutri_who_approved_data = $request->datos_nutriologo;
        $registro->where('id_registro', $request->id_registro)->update([
            'pendientes' => $registro->pendientes,
            'nutri_elaborate_data' => $registro->nutri_elaborate_data,
            'nutri_who_approved_data' => $registro->nutri_who_approved_data,
        ]);

        return redirect()->route('alumno.inicio')->with('success', 'Se ha registrado al paciente correctamente');
    }
    public function get_base_paciente(int $id_paciente)
    {
        $datospaciente = ApiDatosPaciente::find($id_paciente);
        $paciente = ApiPersona::find($datospaciente->id_persona);
        return view('alumno.registrar-nueva-consulta-paciente', [
            'paciente' => $paciente,
            'datospaciente' => $datospaciente
        ]);
    }
    public function form_validation(int $id_registro)
    {
        $registrocitas = ApiRegistroConsultum::find($id_registro);
        if ($registrocitas == null)
            return view('director.formulario_validacion', [
                'data' => 'no se ha encontrado nada'
            ]);
        $datospaciente = ApiDatosPaciente::find($registrocitas->id_paciente);
        $paciente = ApiPersona::find($datospaciente->id_persona);
        $controlcita = ApiControlCita::where('id_paciente', $registrocitas->id_paciente)->first();
        $exploracionfisica = ApiExploFisica::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $composicioncorporal = ApiComposicionCorporalDiagnosticoObesidad::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $bioquimico = ApiBioquimico::where('id_consulta_paciente', $registrocitas->id_registro)->first();

        $freq = ApiDieteticosFrecuenciaSemanal::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $diagnostico = ApiResultadoDiagnostico::where('id_consulta_paciente', $registrocitas->id_registro)->first();

        $generales = ApiDatosGeneralesDietum::where('id_consulta_paciente', $registrocitas->id_registro)->first();

        $instrumento = ApiDieteticosInstrumentoMedicion::where('id_consulta_paciente', $registrocitas->id_registro)->first();

        return view('director.formulario_validacion', [
            'data' => [
                'paciente' => $paciente,
                'registro_consulta' => $registrocitas,
                'datos_paciente' => $datospaciente,
                'control_citas' => $controlcita,
                'explo_fisica' => $exploracionfisica ?? new ApiExploFisica(),
                'composcion_corp' => $composicioncorporal ?? new ApiComposicionCorporalDiagnosticoObesidad(),
                'bioquimicos' => $bioquimico ?? new ApiBioquimico(),
                'diagnostico' => $diagnostico,
                'generales' => $generales,
                'instrumento' => $instrumento,
                'frecuencia_semanal' => $freq
            ]
        ]);
    }
    public function validar_registro_consulta(Request $request, int $id_registro)
    {
        $request->validate([
            'datos_nutriologo_validador' => 'required'
        ]);
        $registro = ApiRegistroConsultum::findOrFail($id_registro);
        $registro->nutri_who_approved_data = $request->datos_nutriologo_validador;
        $registro->save();
        return redirect()->route('formulario_validation_paciente', $id_registro)
            ->with('success', 'Se ha registrado al paciente correctamente');
    }
}
//ver comentarios
