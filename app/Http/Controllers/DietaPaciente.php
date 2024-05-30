<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiRegistroConsultum; //Aqui se busca el id del paciente
use App\Models\ApiDieteticosInstrumentoMedicion; //Tipo de instrumento - Aspectos cualitativos
use App\Models\ApiDieteticosFrecuenciaSemanal; //Frutas, Verduras, azucares, etc.
use App\Models\ApiResultadoDiagnostico; //Requerimientos, DX Nutricion
use App\Models\ApiDatosGeneralesDietum; //Objetivo - Monitoreo


class DietaPaciente extends Controller
{   
    public function buscar($id){
        $dietaid = ApiRegistroConsultum::find($id);
        if ($dietaid == null) return "No se encontró la dieta.";
        $diagnostico = ApiResultadoDiagnostico::where('id_consulta_paciente', $id)->get();

        $generales = ApiDatosGeneralesDietum::where('id_consulta_paciente', $id)->get();
        if ($generales == null) return "No se encontró la dieta.";
        $instrumento = ApiDieteticosInstrumentoMedicion::where('id_consulta_paciente', $id)->get();
        $frecuencia = ApiDieteticosFrecuenciaSemanal::where('id_consulta_paciente', $id)->get();

        return view('alumno.agregar_dieta', compact('instrumento', 'frecuencia', 'diagnostico', 'generales'));
    }

    public function crear(Request $req) {
        $consulta = new ApiRegistroConsultum();
        $consulta->no_consulta_paciente = $req->no_consulta_paciente;
        $consulta->id_paciente = $req->id_paciente;
        $consulta->motivo_consulta = $req->motivo_consulta;
        $consulta->sintoma_gastro = $req->sintoma_gastro;
        $consulta->apego_plan_anterior_barr_apego = $req->apego_plan_anterior_barr_apego;
        $consulta->motivacion = $req->motivacion;
        $consulta->hidratacion = $req->hidratacion;
        $consulta->sintomas_generales = $req->sintomas_generales;
        $consulta->consulta_actual = $req->consulta_actual;
        $consulta->save();

        $diagnostico = new ApiResultadoDiagnostico();
        $diagnostico->id_consulta_paciente = $req->id_consulta_paciente;
        $diagnostico->reque_ener = $req->reque_ener;
        $diagnostico->reque_proteina = $req->reque_proteina;
        $diagnostico->reque_kg_dia = $req->reque_kg_dia;
        $diagnostico->dx_nutricio = $req->dx_nutricio;
        $diagnostico->save();

        $datos = new ApiDatosGeneralesDietum();
        $datos->id_consulta_paciente = $diagnostico->id_consulta_paciente;
        $datos->objetivos_dieta = $req->objetivos_dieta;
        $datos->tipo_dieta = $req->tipo_dieta;
        $datos->kcal_dieta = $req->kcal_dieta;
        $datos->prot_porcent_dieta = $req->prot_porcent_dieta;
        $datos->prot_kg_dia_dieta = $req->prot_kg_dia_dieta;
        $datos->lip_porcen_dieta = $req->lip_porcen_dieta;
        $datos->lip_g_dieta = $req->lip_g_dieta;
        $datos->hco_porcen_dieta = $req->hco_porcen_dieta;
        $datos->hco_g_dieta = $req->hco_g_dieta;
        $datos->suplementos = $req->suplementos;
        $datos->metas_smart = $req->metas_smart;
        $datos->param_meta = $req->param_meta;
        $datos->educacion = $req->educacion;
        $datos->monitoreo = $req->monitoreo;
        $datos->save();

        $instrum = new ApiDieteticosInstrumentoMedicion();
        $instrum->id_consulta_paciente = $diagnostico->id_consulta_paciente;
        $instrum->tipo_instrumento = $req->tipo_instrumento;
        $instrum->desayuno_hora = $req->desayuno_hora;
        $instrum->colacion1 = $req->colacion1;
        $instrum->comida_hora = $req->comida_hora;
        $instrum->colacion2 = $req->colacion2;
        $instrum->cena_hora = $req->cena_hora;
        $instrum->colacion3 = $req->colacion3;
        $instrum->grupo_total_eq = $req->grupo_total_eq;
        $instrum->total_kcal = $req->total_kcal;
        $instrum->total_prot = $req->total_prot;
        $instrum->total_lip = $req->total_lip;
        $instrum->total_hco = $req->total_hco;
        $instrum->adecuacion_porcen_ener_kcal = $req->adecuacion_porcen_ener_kcal;
        $instrum->adecuacion_porcen_ene = $req->adecuacion_porcen_ene;
        $instrum->adecuacion_porcen_prot = $req->adecuacion_porcen_prot;
        $instrum->adecuacion_porcen_lip = $req->adecuacion_porcen_lip;
        $instrum->adecuacion_porcen_hco = $req->adecuacion_porcen_hco;
        $instrum->aspectos_cualita_dieta_habitual = $req->aspectos_cualita_dieta_habitual;
        $instrum->save();

        $freq = new ApiDieteticosInstrumentoMedicion();
        $freq->id_consulta_paciente = $diagnostico->id_consulta_paciente;
        $freq->frutas = $req->frutas;
        $freq->verduras = $req->verduras;
        $freq->cereales_s_g = $req->cereales_s_g;
        $freq->cereales_c_g = $req->cereales_c_g;
        $freq->leguminosas = $req->leguminosas;
        $freq->poa = $req->poa;
        $freq->lacteos = $req->lacteos;
        $freq->aceites_s_p = $req->aceites_s_p;
        $freq->aceites_c_p = $req->aceites_c_p;
        $freq->azucares = $req->azucares;
        $freq->save();
    }

    public function actualizar(Request $req, string $id) {
        $registro = ApiRegistroConsultum::find($id);
        if ($registro == null) return "No se encontró la dieta.";

        //$consulta = ApiRegistroConsultum::find($registro->id_registro);

        $diagnostico = ApiResultadoDiagnostico::where('id_resultado', $registro->id_registro)->first();
        $diagnostico->reque_ener = $req->reque_ener;
        $diagnostico->reque_proteina = $req->reque_proteina;
        $diagnostico->reque_kg_dia = $req->reque_kg_dia;
        $diagnostico->dx_nutricio = $req->dx_nutricio;
        $diagnostico->save();

        $datos = ApiDatosGeneralesDietum::where('id_consulta_paciente', $diagnostico->id_consulta_paciente)->first();
        $datos->objetivos_dieta = $req->objetivos_dieta;
        $datos->tipo_dieta = $req->tipo_dieta;
        $datos->kcal_dieta = $req->kcal_dieta;
        $datos->prot_porcent_dieta = $req->prot_porcent_dieta;
        $datos->prot_kg_dia_dieta = $req->prot_kg_dia_dieta;
        $datos->lip_porcen_dieta = $req->lip_porcen_dieta;
        $datos->lip_g_dieta = $req->lip_g_dieta;
        $datos->hco_porcen_dieta = $req->hco_porcen_dieta;
        $datos->hco_g_dieta = $req->hco_g_dieta;
        $datos->suplementos = $req->suplementos;
        $datos->metas_smart = $req->metas_smart;
        $datos->param_meta = $req->param_meta;
        $datos->educacion = $req->educacion;
        $datos->monitoreo = $req->monitoreo;
        $datos->save();

        $instrum = ApiDieteticosInstrumentoMedicion::where('id_consulta_paciente', $diagnostico->id_consulta_paciente)->first();
        $instrum->tipo_instrumento = $req->tipo_instrumento;
        $instrum->desayuno_hora = $req->desayuno_hora;
        $instrum->colacion1 = $req->colacion1;
        $instrum->comida_hora = $req->comida_hora;
        $instrum->colacion2 = $req->colacion2;
        $instrum->cena_hora = $req->cena_hora;
        $instrum->colacion3 = $req->colacion3;
        $instrum->grupo_total_eq = $req->grupo_total_eq;
        $instrum->total_kcal = $req->total_kcal;
        $instrum->total_prot = $req->total_prot;
        $instrum->total_lip = $req->total_lip;
        $instrum->total_hco = $req->total_hco;
        $instrum->adecuacion_porcen_ener_kcal = $req->adecuacion_porcen_ener_kcal;
        $instrum->adecuacion_porcen_ene = $req->adecuacion_porcen_ene;
        $instrum->adecuacion_porcen_prot = $req->adecuacion_porcen_prot;
        $instrum->adecuacion_porcen_lip = $req->adecuacion_porcen_lip;
        $instrum->adecuacion_porcen_hco = $req->adecuacion_porcen_hco;
        $instrum->aspectos_cualita_dieta_habitual = $req->aspectos_cualita_dieta_habitual;
        $instrum->save();

        $freq = ApiDieteticosFrecuenciaSemanal::where('id_consulta_paciente', $diagnostico->id_consulta_paciente)->first();
        $freq->frutas = $req->frutas;
        $freq->verduras = $req->verduras;
        $freq->cereales_s_g = $req->cereales_s_g;
        $freq->cereales_c_g = $req->cereales_c_g;
        $freq->leguminosas = $req->leguminosas;
        $freq->poa = $req->poa;
        $freq->lacteos = $req->lacteos;
        $freq->aceites_s_p = $req->aceites_s_p;
        $freq->aceites_c_p = $req->aceites_c_p;
        $freq->azucares = $req->azucares;
        $freq->save();
    }
}
