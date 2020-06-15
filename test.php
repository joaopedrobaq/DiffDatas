<?php

use DiffDatas\Datas;

require_once "src/diffdatas.php";

$datas = new Datas;

$datas->setData1("2020-12-25 00:00:00"); // 25 de Dezembro de 2020 à meia-noite
$datas->setData2("2020-06-15 12:00:00"); // 15 de Junho de 2020 às 12:00:00
$datas->subDatas();
echo ($datas->escreverFuturo(true));

/* $datas = new Datas;
$datas->setData1("2020-06-25 18:30:00"); // 15 de junho de 2020 às 20 hrs
echo ($datas->escreverFuturo(true)); */

echo "\n";
