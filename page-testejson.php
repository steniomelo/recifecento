<?php

header('Content-type: application/json');

$apitoken = APITOKEN;
$qtdImoveis = 6;

$filtro = array(
    "token" => $apitoken,
    "quantidadeImoveis" => $qtdImoveis,
    "situacaoEmpreendimento" => 1, // Lançamento
);

$imoveis = listarImoveis($filtro);

// $fp = fopen('arquivo.json', 'w');
// fwrite($fp, json_encode($imoveis));
// fclose($fp);

echo json_encode($imoveis);

?>