<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crear dieta</title>
    </head>
    <body>
        <h1>El un formulario para registrar dietas</h1>
        
        <form action="crear" method="POST">
            @csrf
            
            <label>
                Tipo de instrumentos:
                <input type="radio" name="instrumento" id="hrs" value="24 hrs">24 hrs
                <input type="radio" name="instrumento" id="semi" value="Semicuantitativa">Semicuantitativa
                <input type="radio" name="instrumento" id="diario" value="Diario">Diario
            </label>
            <br>
            <label>
                Desayuno hora: 
                <input type="text" name="desayuno_hora">
            </label>
            <br>
            <label>
                Colación:
                <input type="text" name="colacion1">
            </label>
            <br>
            <label>
                Comida hora:
                <input type="text" name="comida_hora">
            </label>
            <br>
            <label>
                Colación:
                <input type="text" name="colacion2">
            </label>
            <br>
            <label>
                Cena hora:
                <input type="text" name="cena_hora">
            </label>
            <br>
            <label>
                Colación:
                <input type="text" name="colacion3">
            </label>
            <br><br>
            <label>
                TOTAL:<br>
                Kcal:<input type="text" name="total_kcal">
                Prot:<input type="text" name="total_prot">(<input type="text" name="prot-g">) 
                Lip:<input type="text" name="total_lip">(<input type="text" name="lip-g">) 
                Hco:<input type="text" name="total_hco">(<input type="text" name="hco-g">)
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
                <input type="text" name="datos-elaborador">
            </label>
            <br>
            <label>
                NOMBRE COMPLETO, FIRMA Y CÉDULA PROFESIONAL DE NUTRIÓLOG() RESPONSABLE:<br>
                <input type="text" name="datos-nutriologo">
            </label>
            
            <button type="submit">
                Crear
            </button>
        </form>
    </body>
</html>