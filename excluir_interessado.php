<?php
require_once('lib/conexao.php');
$sql = "DELETE FROM interessados where email = :email";

try {
    $consulta = $conn->prepare($sql);
    $cidades = $consulta->execute(array('email' => $_GET['email'])); 
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>