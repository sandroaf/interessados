<?php
//Carrega a Conexão com Bando de Dados
include_once('lib/conexao.php');
include_once('lib/funcoes_interessados.php');
echo "<script>console.log('Entrou Ajax');</script>";
//Validação dos dados recebidos para grava
function fValida($valores) {
    $msg = "";
    $valido = true;
    if (empty($valores['nome'])) {
        $msg = "Nome Inválido";
        $valido = false;
    } elseif (!filter_var($valores['email'], FILTER_VALIDATE_EMAIL)) {
        $msg = "e-mail Inválido";
        $valido = false;
    } elseif (!preg_match("/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/",$valores['fone'])) {
        $msg = "Fone Inválido";
        $valido = false;
    } elseif ($valores['estado']=='00') {
        $msg = "Selecione o Estado";
        $valido = false;
    } elseif ($valores['cidade']=='00') {     
        $msg = "Selecione a Cidade";
        $valido = false;
    }   
    echo "<h3>".$msg."</h3>";
   return $valido;
}

//Gravação no Bando de Dados
//Verifica se o botão Gravar foi clicado.
if (isset($_POST['bGravar'])) {
    $valores = array("email"  => $_POST['iEmail'],
                     "nome"   => $_POST['iNome'],
                     "fone"   => $_POST['iFone'],
                     "estado" => $_POST['sEstado'],
                     "cidade" => $_POST['sCidade']);
    //echo "valido: ".fValida($valores);
    //Fazer a Validação dos Campos no PHP
    if (fValida($valores)) {
        try {
            $sql = "INSERT into interessados(email,nome,fone,estado,cidade) 
                    values (:email,:nome,:fone,:estado,:cidade)";
            $consulta = $conn->prepare($sql);
            //echo $sql;
            //Tratar exceção de erro "Duplicação de Cadastro"
            $consulta->execute($valores);
            echo "<strong>Dados Salvos</strong><br>";
            echo "e-mail: ".$valores['email']."<br>";
            echo "Nome: ".$valores['nome']."<br>";
            echo "Fone: ".$valores['fone']."<br>";
       } catch(PDOException $e) {
           echo 'ERROR: ' . $e->getMessage() . "<br>";
       }
    }
}
?>