<?php

namespace App\Http\Controllers;

use App\enums\Genero;
use App\Models\ApiBioquimico;
use App\Models\ApiComposicionCorporalDiagnosticoObesidad;
use App\Models\ApiControlCita;
use App\Models\ApiDatosPaciente;
use App\Models\ApiExploFisica;
use App\Models\ApiPersona;
use App\Models\ApiRegistroConsultum;
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
        $request->validate([
            'nombre' => ['required'],
            'edad' => ['required', 'integer'],
            'genero' => ['required', Rule::enum(Genero::class)],
            'expediente' => ['required', 'unique:App\Models\ApiDatosPaciente,expediente','integer'],
            'fecha_nacimiento' => ['required', 'date_format:Y-m-d'],
            'motivo_consulta' => ['required','max:500'],
            'sintoma_gastro' => ['required'],
            'apego_plan_anterior_barr_apego' => ['required','max:250'],
            'motivacion' => ['required'],
            'sintomas_generales' => ['required','max:500'],
            'pelo_unias' => ['required'],
            'piel' => ['required'],
            'ojos' => ['required'],
            'musculo' => ['required'],
            'otros_explo_fisica' => ['required'],
            'intolerancia_alimentos' => ['required'],
            'actividad_fis_actual' => ['required'],
            'cambios_pos_estilo_vida' => ['required'],
            'peso' => ['required', 'decimal:0,2'],
            'imc' => ['required', 'decimal:0,2'],
            'masa_grasa_corporal' => ['required', 'decimal:0,2'],
            'porcentaje_grasa_corporal' => ['required', 'decimal:0,2'],
            'masa_muscular' => ['required', 'decimal:0,2'],
            'agua_corpolar' => ['required', 'decimal:0,2'],
            'circunferencia_cintura' => ['required', 'numeric', 'max:32767'],
            'circunferencia_cadera' => ['required', 'numeric', 'max:32767'],
            'fecha_cita' => ['required', 'date_format:Y-m-d'],
            'hora_cita' => ['required', 'date_format:H:i'],
            'fecha_prox_cita' => ['required', 'date_format:Y-m-d'],
            'control_musculo' => ['required', 'decimal:0,2'],
            'control_grasa' => ['required', 'decimal:0,2'],
            'pgc' => ['decimal:0,2'],
            'rcc' => ['decimal:0,2'],
            'metabolismo_kcal_basal' => ['decimal:0,2'],
            'hbAc1' => ['decimal:0,2'],
            'TG' => ['decimal:0,2'],
            'CT' => ['decimal:0,2'],
            'HDL' => ['decimal:0,2'],
            'LDL' => ['decimal:0,2'],
            'AST_perc' => ['decimal:0,2'],
            'ALT' => ['decimal:0,2'],
            'THS' => ['decimal:0,2'],
            'T3' => ['decimal:0,2'],
            'T4' => ['decimal:0,2'],
            'Hb' => ['decimal:0,2'],
            'hierro' => ['decimal:0,2'],
            'transferrina' => ['decimal:0,2'],
            't3_libre' => ['decimal:0,2'],
            't4_libre' => ['decimal:0,2'],
            'hto' => ['decimal:0,2'],
            'B12' => ['decimal:0,2'],
            'folatos' => ['decimal:0,2'],
            'PT' => ['decimal:0,2'],
            'albumina' => ['decimal:0,2'],
            'Ca' => ['decimal:0,2'],
            'otros_bioquimicos' => '',
            'clinicos' => '',
            'medicamentos_suplementos' => [],
        ]);
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

        $registrocitas = new ApiRegistroConsultum();
        $registrocitas->no_consulta_paciente = $request->no_consulta_paciente;
        $registrocitas->id_paciente = $paciente->persona_id;
        $registrocitas->motivo_consulta = $request->motivo_consulta;
        $registrocitas->sintoma_gastro = $request->sintoma_gastro;
        $registrocitas->apego_plan_anterior_barr_apego = $request->apego_plan_anterior_barr_apego;
        $registrocitas->motivacion = $request->motivacion;
        $registrocitas->hidratacion = [json_encode($request->hidratacion)];
        $registrocitas->sintomas_generales = $request->sintomas_generales;
        $registrocitas->save();

        $exploracionfisica = new ApiExploFisica();
        $exploracionfisica->id_consulta_paciente = $registrocitas->id_consulta_paciente;
        $exploracionfisica->pelo_unias = $request->pelo_unias;
        $exploracionfisica->piel = $request->piel;
        $exploracionfisica->ojos = $request->ojos;
        $exploracionfisica->musculo = $request->musculo;
        $exploracionfisica->otros = $request->otros;
        $exploracionfisica->intolerancia_alimentos = $request->intolerancia_alimentos;
        $exploracionfisica->actividad_fis_actual = $request->actividad_fis_actual;
        $exploracionfisica->cambios_pos_estilo_vida = $request->cambios_pos_estilo_vida;
        $exploracionfisica->save();

        $composicioncorporal = new ApiComposicionCorporalDiagnosticoObesidad();
        $composicioncorporal->id_consulta_paciente = $registrocitas->id_consulta_paciente;
        $composicioncorporal->peso = $request->peso;
        $composicioncorporal->masa_muscular = $request->masa_muscular;
        $composicioncorporal->mas_grasa_corporal = $request->masa_grasa_corporal;
        $composicioncorporal->act = $request->act;
        $composicioncorporal->imc = $request->imc;
        $composicioncorporal->pgc = $request->pgc;
        $composicioncorporal->rcc = $request->rcc;
        $composicioncorporal->metabolismo_kcal_basal = $request->metabolismo_kcal_basal;
        $composicioncorporal->save();

        $controlcita = new ApiControlCita();
        $controlcita->id_consulta_paciente = $paciente->persona_id;
        $controlcita->id_consulta_paciente = $registrocitas->id_registro;
        $controlcita->peso = $request->peso;
        $controlcita->IMC = $request->imc;
        $controlcita->masa_grasa_corporal = $request->masa_grasa_corporal;
        $controlcita->porcentaje_grasa_corporal = $request->porcentaje_grasa_corporal;
        $controlcita->masa_muscular_kg = $request->masa_muscular;
        $controlcita->agua_corpolar = $request->agua_corpolar;
        $controlcita->circunferencia_cintura = $request->circunferencia_cintura;
        $controlcita->circunferencia_cadera = $request->circunferencia_cadera;
        $controlcita->fecha_cita = $request->fecha_cita;
        $controlcita->hora_cita = $request->hora_cita;
        $controlcita->fecha_prox_cita = $request->fecha_prox_cita;
        $controlcita->control_musculo = $request->control_musculo;
        $controlcita->control_grasa = $request->control_grasa;
        $controlcita->save();

        $bioquimico = new ApiBioquimico();
        $bioquimico->glucosa = $request->glucosa;
        if ($bioquimico->glucosa == null) {
            return "se guardaron los datos, menos bioquimicos";
        }
        $bioquimico->id_consulta_paciente = $registrocitas->id_consulta_paciente;
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
        $bioquimico->otros = $request->otros;
        $bioquimico->clinicos = $request->clinicos;
        $bioquimico->dinamometria = [json_encode($request->dinamometria)];
        $bioquimico->medicamentos_suplementos = $request->medicamentos_suplementos;
        $bioquimico->save();
        return "se guardaron los datos";
    }
    public function actualizar(Request $request, string $id)
    {
        $registrocitas = ApiRegistroConsultum::find($id);
        if ($registrocitas == null) {
            return "No se enconto la cita";
        }
        $paciente = ApiPersona::find($registrocitas->id_paciente);
        $paciente->edad = $request->edad;
        $paciente->save();

        $registrocitas->no_consulta_paciente = $request->no_consulta_paciente;
        $registrocitas->id_paciente = $paciente->persona_id;
        $registrocitas->motivo_consulta = $request->motivo_consulta;
        $registrocitas->sintoma_gastro = $request->sintoma_gastro;
        $registrocitas->apego_plan_anterior_barr_apego = $request->apego_plan_anterior_barr_apego;
        $registrocitas->motivacion = $request->motivacion;
        $registrocitas->hidratacion = [json_encode($request->hidratacion)];
        $registrocitas->sintomas_generales = $request->sintomas_generales;
        $registrocitas->save();

        $controlcita = ApiControlCita::where('id_paciente', $registrocitas->id_paciente)->first();
        $controlcita->peso = $request->peso;
        $controlcita->IMC = $request->imc;
        $controlcita->masa_grasa_corporal = $request->masa_grasa_corporal;
        $controlcita->porcentaje_grasa_corporal = $request->porcentaje_grasa_corporal;
        $controlcita->masa_muscular_kg = $request->masa_muscular;
        $controlcita->agua_corpolar = $request->agua_corpolar;
        $controlcita->circunferencia_cintura = $request->circunferencia_cintura;
        $controlcita->circunferencia_cadera = $request->circunferencia_cadera;
        $controlcita->fecha_cita = $request->fecha_cita;
        $controlcita->hora_cita = $request->hora_cita;
        $controlcita->fecha_prox_cita = $request->fecha_prox_cita;
        $controlcita->control_musculo = $request->control_musculo;
        $controlcita->control_grasa = $request->control_grasa;
        $controlcita->save();

        $exploracionfisica = ApiExploFisica::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $exploracionfisica->pelo_unias = $request->pelo_unias;
        $exploracionfisica->piel = $request->piel;
        $exploracionfisica->ojos = $request->ojos;
        $exploracionfisica->musculo = $request->musculo;
        $exploracionfisica->otros = $request->otros;
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
        $composicioncorporal->pgc = $request->pgc;
        $composicioncorporal->rcc = $request->rcc;
        $composicioncorporal->metabolismo_kcal_basal = $request->metabolismo_kcal_basal;
        $composicioncorporal->save();

        if ($request->glucosa == null) {
            return "se actualizaron los datos, menos bioquimicos";
        }
        $bioquimico = ApiBioquimico::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        if ($bioquimico == null) {
            $bioquimico = new ApiBioquimico();
            $bioquimico->id_consulta_paciente = $registrocitas->id_consulta_paciente;
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
        $bioquimico->otros = $request->otros;
        $bioquimico->clinicos = $request->clinicos;
        $bioquimico->dinamometria = [json_encode($request->dinamometria)];
        $bioquimico->medicamentos_suplementos = $request->medicamentos_suplementos;
        $bioquimico->save();
        return "se actualizaron los datos";
    }
}