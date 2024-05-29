<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crear dieta</title>
    </head>
    <body>
        <h1>El un formulario para registrar pacientes</h1>
        
        <form action="">
            <label>
                Titulo:
                <input type="text" name="title">
            </label>
            <br>
            <label>
                Tipo de instrumentos:
                <input type="radio" name="instrumentos" id="hrs">24 hrs <input type="radio" name="instrumentos" id="semi">Semicuantitativa 
                <input type="radio" name="instrumentos" id="diario">Diario
            </label>
            <br>
            <label>
                Desayuno hora:
                <input type="text" name="desayuno-h">
            </label>
            <br>
            <label>
                Colación:
                <input type="text" name="desayuno-c">
            </label>
            <br>
            <label>
                Comida hora:
                <input type="text" name="comida-h">
            </label>
            <br>
            <label>
                Colación:
                <input type="text" name="comida-c">
            </label>
            <br>
            <label>
                Cena hora:
                <input type="text" name="cena-h">
            </label>
            <br>
            <label>
                Colación:
                <input type="text" name="cena-c">
            </label>
            <br><br>
            <label>
                Total EQ: <br>
                Verduras:<input type="text" name="verduras">Frutas:<input type="text" name="frutas">Cereales:<input type="text" name="cereales">
                Leguminosas:<input type="text" name="leguminosas">Carnes:<input type="text" name="carnes">Leche:<input type="text" name="leche">
                Grasa:<input type="text" name="grasa">Azúcar:<input type="text" name="azucar">
            </label>
            <br><br>
            <label>
                TOTAL:<br>
                Kcal:<input type="text" name="kcal">Prot:<input type="text" name="prot-per">(<input type="text" name="prot-g">) 
                Lip:<input type="text" name="lip-per">(<input type="text" name="lip-g">) Hco:<input type="text" name="hco-per">(<input type="text" name="hco-g">)
            </label>
            <br><br>
            <label>
                % ADECUACIÓN:<br>
                Energia:<input type="text" name="adec-energ"> Kcal:<input type="text" name="adec-kcal"> Prot:<input type="text" name="adec-prot"> 
                Lip:<input type="text" name="adec-lip"> Hco:<input type="text" name="adec-hco"><br>
                Aspectos cualitativos de dieta habitual:<input type="text" name="adec-habitual">
            </label>
            <br><br>
            <label>
                REQUERIMIENTOS:<br>
                Energia:<input type="text" name="req-energ"> Proteina total:<input type="text" name="req-prot-g">(<input type="text" name="req-prot-dia">)
            </label>
            <br><br>
            <label>
                DX:NUTRICIO:<br>
                <input type="text" name="dxNutricio">
            </label>
            <br>
            <label>
                OBJETIVOS:<br>
                <input type="text" name="objetivos">
            </label>
            <br>
            <label>
                PLAN DE ALIMENTACIÓN:<br>
                Dieta <input type="text" name="plan-dieta"> de <input type="text" name="plan-de"> Prot:<input type="text" name="plan-prot-per">(<input type="text" name="plan-prot-g">)
                Lip:<input type="text" name="plan-lip-per">(<input type="text" name="plan-lip-g">) Hco:<input type="text" name="plan-hco-per">(<input type="text" name="plan-hco-g">)
            </label>
            <label>
                SUPLEMENTOS:<br>
                <input type="text" name="suplementos">
            </label>
            <label>
                METAS SMART:<br>
                <input type="text" name="metas-smart">
            </label>
            <br>
            <label>
                PARAMETROS META:<br>
                Peso:<input type="text" name="meta-peso"> %Grasa:<input type="text" name="meta-grasa"> Músculo:<input type="text" name="meta-musculo"> 
                C. Cintura:<input type="text" name="meta-cintura">
                <br>
                Horarios:<input type="text" name="meta-horario"> Mejorar hábitos:<input type="text" name="meta-mejorar"> 
                Selección de alimentos:<input type="text" name="meta-alimentos">
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
        </form>
    </body>
</html>