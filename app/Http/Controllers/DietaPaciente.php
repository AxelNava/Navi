<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiRegistroConsultum; //Aqui se busca el id del paciente
use App\Models\ApiDieteticosInstrumentoMedicion; //Tipo de instrumento - Aspectos cualitativos
use App\Models\ApiResultadoDiagnostico; //Requerimientos, DX Nutricion
use App\Models\ApiDatosGeneralesDietum; //Objetivo - Monitoreo

use function PHPUnit\Framework\isEmpty;

class DietaPaciente extends Controller
{   
    public function buscar($id){
        $dietaid = ApiRegistroConsultum::find($id); //Buscamos que el ID de registro exista
        if ($dietaid == null) return "No se encontró la dieta."; //Si no existe, retorna un error
        
        $diagnostico = ApiResultadoDiagnostico::where('id_consulta_paciente', $id)->get();
        if ($diagnostico->isEmpty()) return "No se encontró el diagnostico."; //Si no existe, retorna un error
        
        $generales = ApiDatosGeneralesDietum::where('id_consulta_paciente', $id)->get();
        if ($generales->isEmpty()) return "No se encontraron datos generales."; //Si no existe, retorna un error
        
        $instrumento = ApiDieteticosInstrumentoMedicion::where('id_consulta_paciente', $id)->get();
        if ($instrumento->isEmpty()) return "No se encontraron datos del instrumento."; //Si no existe, retorna un error

        //return view('alumno.agregar_dieta', compact('instrumento', 'frecuencia', 'diagnostico', 'generales'));
        return [
            $diagnostico,
            $generales,
            $instrumento
        ];
    }

    public function crear(Request $req) {
        $req->validate([
            'id_registro' => ['required'],
        ]);
        $instrumento = new ApiDieteticosInstrumentoMedicion();
        $instrumento->id_consulta_paciente = $req->id_registro;
        $instrumento->tipo_instrumento = $req->tipo_instrumento; 
        $instrumento->desayuno_hora = $req->desayuno_hora;
        $instrumento->colacion1 = $req->colacion1;
        $instrumento->comida_hora = $req->comida_hora;
        $instrumento->colacion2 = $req->colacion2;
        $instrumento->cena_hora = $req->cena_hora;
        $instrumento->colacion3 = $req->colacion3;
        $instrumento->grupo_total_eq = [
            'verduras' => $req -> verduras,
            'frutas' => $req -> frutas,
            'cereales' => $req -> cereales,
            'leguminosas' => $req -> leguminosas,
            'carnes' => $req -> carnes,
            'leche' => $req -> leche,
            'grasa' => $req -> grasa,
            'azucar' => $req -> azucar];
        $instrumento->total_kcal = $req->total_kcal;
        $instrumento->total_prot = [
            'prot_porcent' => $req -> total_prot,
            'prot_g' => $req -> prot_g];
        $instrumento->total_lip = [
            'lip_porcent' => $req -> total_lip,
            'lip_g' => $req -> lip_g,
        ];
        $instrumento->total_hco = [
            'hco_porcent' => $req -> total_hco,
            'hco_g' => $req -> hco_g,
        ];
        $instrumento->adecuacion_porcen_ene = $req->adecuacion_porcen_ene;
        $instrumento->adecuacion_porcen_ener_kcal = $req->adecuacion_porcen_ener_kcal;
        $instrumento->adecuacion_porcen_prot = $req->adecuacion_porcen_prot;
        $instrumento->adecuacion_porcen_lip = $req->adecuacion_porcen_lip;
        $instrumento->adecuacion_porcen_hco = $req->adecuacion_porcen_hco;
        $instrumento->aspectos_cualita_dieta_habitual = $req->aspectos_cualita_dieta_habitual;
        $instrumento->save();

        $diagnostico = new ApiResultadoDiagnostico();
        $diagnostico->id_consulta_paciente = $req->id_registro;
        $diagnostico->reque_ener = $req->reque_ener;
        $diagnostico->reque_proteina = $req->reque_proteina;
        $diagnostico->reque_kg_dia = $req->reque_kg_dia;
        $diagnostico->dx_nutricio = $req->dx_nutricio;
        $diagnostico->save();

        $generales = new ApiDatosGeneralesDietum();
        $generales->id_consulta_paciente = $req->id_registro;
        $generales->objetivos_dieta = $req->objetivos_dieta;
        $generales->tipo_dieta = $req->tipo_dieta;
        $generales->kcal_dieta = $req->kcal_dieta;
        $generales->prot_porcent_dieta = $req->prot_porcent_dieta;
        $generales->prot_kg_dia_dieta = $req->prot_kg_dia_dieta;
        $generales->lip_porcen_dieta = $req->lip_porcen_dieta;
        $generales->lip_g_dieta = $req->lip_g_dieta;
        $generales->hco_porcen_dieta = $req->hco_porcen_dieta;
        $generales->hco_g_dieta = $req->hco_g_dieta;
        $generales->suplementos = $req->suplementos;
        $generales->metas_smart = $req->metas_smart;
        $generales->param_meta = [
        'peso' => $req -> meta_peso,
        'porcen_grasa' => $req -> meta_grasa,
        'musculo' => $req -> meta_musculo,
        'c_cintura' => $req -> meta_cintura,
        'horarios' => $req -> meta_horario,
        'm_habitos' => $req -> meta_mejorar,
        'selec_alimentos' => $req -> meta_alimentos];
        $generales->educacion = $req->educacion;
        $generales->monitoreo = $req->monitoreo;
        $generales->save();

        $registro = new ApiRegistroConsultum();
        $registro->id_registro = $req->id_registro;
        $registro -> pendientes = $req -> pendientes;
        $registro -> nutri_elaborate_data = $req -> datos_elaborador;
        $registro -> nutri_who_approved_data = $req -> datos_nutriologo;
        $registro->where('id_registro',$req->id_registro)->update([
            'pendientes' => $registro->pendientes,
            'nutri_elaborate_data' => $registro->nutri_elaborate_data,
            'nutri_who_approved_data' => $registro->nutri_who_approved_data,
        ]);
        // return $registro;

        return[
            $instrumento,
            $diagnostico,
            $generales,
            $registro
        ];
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
    }
}
