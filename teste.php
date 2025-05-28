<?php

$testeArrayAssociativo = [];

$testeArrayAssociativo[] = [
    'nome' => 'Estudar php',
    'concluida' => false,
    'prioridade' => 'alta',
];

$testeArrayAssociativo[] = [
    'nome' => 'Estudar javaScript',
    'concluida' => true,
    'prioridade' => 'baixa',
];

foreach ($testeArrayAssociativo as $key => $value) {
    echo $value['nome'] . '<br>';
}