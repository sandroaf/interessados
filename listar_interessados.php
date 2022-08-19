<?php
//Carrega a Conexão com Bando de Dados
include_once('lib/conexao.php');

//Função Lista Interessados - Busca dados da tabela de Interessados no Bando de Dados
function lista_interessados() {
    $conn = $GLOBALS['conn'];
    //Selecionar os interessados do Banco de Dados        
    $sql = "SELECT nome,email,fone FROM interessados order by nome";
    $consulta = $conn->prepare($sql);
    try {
       $interessados = $consulta->execute();
    }
    catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }   
    echo "<table>";
    $linha = "0";
    while($r = $consulta->fetch()) {
        echo "<tr id='l".$linha."'>";
        echo "<td>".$r["nome"]."</td>";
        echo "<td>".$r["email"]."</td>";
        echo "<td>".$r["fone"]."</td>";
        echo "<td><input type='button' value='D' onclick='fExcluirInteressado(\"".$r["email"]."\",".$linha.")'></td>";
        echo "</tr>";
        $linha = $linha+1;
    } 
    echo "</table>";
}

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
    <div>
        <a href="/interessados/#cadastro">Cadastro</a>
    </div>     
    <br>
    <?php
       lista_interessados();
    ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script language="JavaScript">
   function fExcluirInteressado(email,l) {
    let acao = "excluir_interessado.php?email="+email;
    
    //Ajax para excluir o Interessado
    $.get(acao, function(dados, status){
        if (status == "success") {
            $("#l"+l).remove();
        }
    });  

   }
</script>   
</html>