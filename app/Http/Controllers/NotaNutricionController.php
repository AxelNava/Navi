<?php

namespace App\Http\Controllers;

use App\Models\ApiBioquimico;
use App\Models\ApiComposicionCorporalDiagnosticoObesidad;
use App\Models\ApiControlCita;
use App\Models\ApiDatosPaciente;
use App\Models\ApiExploFisica;
use App\Models\ApiRegistroConsultum;
use Illuminate\Http\Request;

class NotaNutricionController extends Controller
{
    public function buscar(int $id)
    {
        $registrocitas = ApiRegistroConsultum::find($id);
        if ($registrocitas == null)
            return "No se enconto la cita";
        $datospaciente = ApiDatosPaciente::find($registrocitas->id_paciente);
        $controlcita = ApiControlCita::where('id_paciente', $registrocitas->id_paciente)->first();
        $exploracionfisica = ApiExploFisica::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $composicioncorporal = ApiComposicionCorporalDiagnosticoObesidad::where('id_consulta_paciente', $registrocitas->id_registro)->first();
        $bioquimico = ApiBioquimico::where('id_consulta_paciente', $registrocitas->id_registro)->first();

        return [
            $registrocitas, $datospaciente, $controlcita, $exploracionfisica ?? new ApiExploFisica(),
            $composicioncorporal ?? new ApiComposicionCorporalDiagnosticoObesidad(),$bioquimico ?? new ApiBioquimico()
        ];
    }
    public function crear(Request $request)
    {
        
    }
    public function actualizar(Request $request, string $id)
    {
        
    }
}
