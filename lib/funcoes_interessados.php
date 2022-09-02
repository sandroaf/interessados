<?php
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

//Função option_estados - Carrega os estados do Banco de Dados e monta os options
function option_estados() {
    $conn = $GLOBALS['conn'];
    //Selecionar os estados do Banco de Dados        
    $sql = "SELECT Uf, Nome FROM estado";
    $consulta = $conn->prepare($sql);
    $estados = $consulta->execute();
    while($r = $consulta->fetch()) {
        echo '<option value="'.$r['Uf'].'">'.$r['Nome'].'</option>';
    } 
}
?>
