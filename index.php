<?php
//Carrega a Conexão com Bando de Dados
include_once('lib/conexao.php');
include_once('lib/funcoes_interessados.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lib/estilo.css">
    <title>Interessandos</title>
</head>
<body>
    <h1>INTERESSADOS - NewsLetter - DEVs-TI</h1>
    <div id="dConteudo">
        <h2 id="cadastro">Cadastro</h2>
         <div id="dMsg"></div> <!-- Área para Mensagens de Validação -->
        <div id="dInteressados">
            <form id="fInteressados">
                <label for="iNome">Nome:</label>
                <input id="iNome" name="iNome" type="input" value="">
                <br>
                <label for="iEmail">e-mail:</label>
                <input id="iEmail" name="iEmail" type="input" value="">
                <br>
                <label for="iFone">fone:</label>
                <input id="iFone" name="iFone" type="input" value="" placeholder="(99) 99999-9999">
                <br>
                <label for="sEstado">Estado:</label>
                <select id="sEstado" name="sEstado"> 
                    <option value="00">Selecionar</option>
                    <?php option_estados(); ?>
                </select>
                <br>
                <label for="sCidade">Cidade:</label>
                <select id="sCidade" name="sCidade">
                    <option value="00">Selecionar</option>
                </select>
                <br><br>
                <input id="bLimpar" type="reset" value="Limpar">&nbsp;|&nbsp;
                <input id="bGravar" name="bGravar" type="button" value="Gravar">
            </form>
        </div>
    </div>     
    <hr>
    <div id="dListaInteressados"><div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script language="JavaScript" src="lib/funcoes.js"></script>
<script language="JavaScript" src="lib/interessados.js"></script>

</html>