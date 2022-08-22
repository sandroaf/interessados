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
        echo "<td><input type='text' readonly id='n".$linha."' ondblclick='fAlterarValor(this,\"".$r["email"]."\")' value='".$r["nome"]."'></td>";
        echo "<td><input type='text' readonly id='e".$linha."' value='".$r["email"]."'></td>";
        echo "<td><input type='text' readonly id='f".$linha."' ondblclick='fAlterarValor(this,\"".$r["email"]."\")' value='".$r["fone"]."'></td>";
        printf("<td><input type='button' value='D' onclick='fExcluirInteressado(\"%s\",%u)'></td>",$r["email"],$linha);
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
        <a href="cadastro_interessados.php">Cadastro</a>
    </div>     
    <br>
    <?php
         lista_interessados();
    ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script language="JavaScript">
   
   function fAlterarValor(valor,email) 
   {    
      $("#"+valor.id).removeAttr("readonly"); //retira o somente leitura
      $("#"+valor.id).attr("class","altera"); //muda o estilo
      let campo = valor.id.slice(0,1); //seleciona a primeira letra do ID
      
      //criar um evento para quando for alterado um valor
      $("#"+valor.id).change( function() {
        let acao = "altera_valor.php?email="+email+"&valor="+$("#"+valor.id).val()+"&campo="+campo;
        //console.log(acao);
        //Ajax Alteração dado
        $.get(acao, function(dados, status) {
        //alert(dados);
           if (status == "success") {
               $("#"+valor.id).attr("readonly","");
               $("#"+valor.id).removeAttr("class");
          }
        });  
      });

      //Ao sair do Input retorna as propriedades
      $("#"+valor.id).blur( function() { 
            $("#"+valor.id).attr("readonly","");
            $("#"+valor.id).removeAttr("class");
        });

   }

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