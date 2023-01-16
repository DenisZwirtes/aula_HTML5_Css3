<?php


//função criada para limpar o que o usuário digitar
function limpaPost($variavel)
{
    $variavel = trim($variavel); //para tirar os espaços
    $variavel = stripslashes($variavel); //proteçao contra barras invertidas
    $variavel = htmlspecialchars($variavel); //proteçao contra tags html maliciosas
    return $variavel;
}
