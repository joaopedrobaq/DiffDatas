<?php

use DiffDatas\DiffDatas;

require_once "src/diffdatas.php";

$diff = new DiffDatas;

$diff->setDataFuturo('2020-12-25 00:00:00');
$diff->setDataPassado($diff->agora);
$diff->subDatas();
echo $diff->agora;

echo "\n";
