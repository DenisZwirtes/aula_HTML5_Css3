<?php
require_once 'index.php';
/* O objetivo deste arquivo é realizar uma
validação para posteriormente fazer um CRUD.
As variaveis vindas do formulário entrarão
no if se o método estiver correto e após isso
a função criada limpaPost  é chamada*/
if (($_SERVER['REQUEST_METHOD']) == "POST") {
    $remover_modelo = limpaPost($_POST['modelo']);
    $remover_ano = limpaPost($_POST['ano']);
}

if (empty($remover_modelo) || empty($remover_ano)) {
    header("Location:../index.html");
} else {
    /* esta funçao regex serve para impedir
 o uso de tags maliciosas*/
    if (!preg_match("/^[A-Za-z0-9-' ]+$/u", $remover_modelo && $remover_ano)) {
        echo "Somente letras e números, por favor!";
    } else {
        echo "O modelo do carro removido do acervo foi: " . $remover_modelo . "<br><br>";
        echo "O ano do carro removido do acervo foi: " . $remover_ano . "<br><br>";
    }
}
