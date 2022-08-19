<?php
require_once('lib/conexao.php');
echo "<script>alert(".$_GET["campo"].")</script>";
if ($_GET["campo"]=="n") {
    $sql = "UPDATE interessados set nome=:valor where email = :email";
} elseif ($_GET["campo"]=="f") {
    $sql = "UPDATE interessados set fone=:valor where email = :email";
} 
echo $sql;
try {
    $consulta = $conn->prepare($sql);
    $cidades = $consulta->execute(array('valor' => $_GET['valor'], 'email'  => $_GET['email'])); 
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>