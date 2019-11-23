<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/formulario.css">
    <script src="js/index.js"></script>
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
    <legend>INSIRA OS DADOS DO FILME</legend>
    </div>

    <!-- Login Form -->
    <div id="filmes">
        <div class="campoFilme" id="menu">
            <input type="text" class="nomeFilme" class="fadeIn second" placeholder='Nome do Filme'>
            <input type="text" class="amostra" class="fadeIn second" placeholder='Insira a amostra separada por espaço (" ")'>
        </div>
    </div>
    <input type="button" id="btnAddFilme" class="btn btn-success" value="addFilme">
    <input type="submit" style="background-color: green"  id="btnEnviar" class="fadeIn fourth btn btn-success" value="Enviar">
    </div>
</div>
</body>
</html>