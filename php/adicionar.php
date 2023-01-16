<?php
require_once 'index.php';
require '../banco/config.php';
/* O objetivo deste arquivo é realizar uma
validação para posteriormente fazer um CRUD.
As variaveis vindas do formulário entrarão
no if se o método estiver correto e após isso
a função criada limpaPost  é chamada*/
if (($_SERVER['REQUEST_METHOD']) == "POST") {
    $adicionar_modelo = limpaPost($_POST['modelo']);
    $adicionar_ano = limpaPost($_POST['ano']);
}


if (empty($adicionar_modelo) || empty($adicionar_ano)) {
    // momentaneamente para testar
    header("Location:../index.html");
} else {
    /* esta funçao regex serve para impedir
     o uso de tags maliciosas*/
    if (!preg_match("/^[A-Za-z0-9-' ]+$/u", $adicionar_modelo && $adicionar_ano)) {
        echo "Somente Letras e números, por favor!" . "<br><br>";
    } else {
        /* Após esta pequena verificação, realiza-se comandos
        para inserir dados na tabela já criada no phpmyadmin
        e atraves da preparação feita no arquivo config.php
        os dados serão puxados. Antes de inserir ocorre uma pequena 
        verificação para ver se existem dados semelhantes no banco
        carros.
        */

        $sql = $pdo->prepare("SELECT * FROM carros WHERE modelo= :modelo AND ano =:ano");
        $sql->bindValue(':modelo', $adicionar_modelo);
        $sql->bindValue(':ano', $adicionar_ano);
        $sql->execute();

        if ($sql->rowCount() == 0) {

            $sql = $pdo->prepare("INSERT INTO carros(modelo,ano)VALUES (:modelo,:ano)");
            $sql->bindValue(':modelo', $adicionar_modelo);
            $sql->bindValue(':ano', $adicionar_ano);
            $sql->execute();
            echo "O modelo do carro adicionado no acervo foi: " . $adicionar_modelo . "<br><br>";
            echo "O ano do carro adicionado no acervo foi: " . $adicionar_ano . "<br><br>";
            header("Location:adicionar.php");
            exit;
        }
        header("Location:../index.html");
        exit;
    }
}
