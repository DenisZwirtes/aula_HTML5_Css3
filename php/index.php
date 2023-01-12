<?php


if (($_SERVER['REQUEST_METHOD']) == "POST") {
    $adicionar = limpaPost($_POST['adicionar']);
    $remover = limpaPost($_POST['remover']);
    //verifica se as variaveis estão vazias
    if (empty($adicionar)) {
        echo "Nenhum carro adicionado" . "<br><br>";
    } else {
        if (!preg_match("/^[A-Za-z0-9-' ]+$/u", $adicionar)) {
            echo "Somente Letras e números, por favor!" . "<br><br>";
        } else {
            echo "O carro adicionado foi: " . $adicionar . "!" . "<br><br>";
        }
    }
    if (empty($remover)) {
        echo "Nenhum carro removido!" . "<br><br>";
    } else {
        if (!preg_match("/^[A-Za-z0-9-' ]+$/u", $remover)) {
            echo "Somente letras e números, por favor!";
        } else {
            echo "O carro removido do acervo foi: " . $remover;
        }
    }
}
function limpaPost($variavel)
{
    $variavel = trim($variavel); //para tirar os espaços
    $variavel = stripslashes($variavel); //proteçao contra barras invertidas
    $variavel = htmlspecialchars($variavel); //proteçao contra tags html maliciosas
    return $variavel;
}
