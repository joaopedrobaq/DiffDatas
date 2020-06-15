# DiffDatas
Calculadora de Diferença de Datas em PHP

## Instalação
O pacote pode ser instalado pelo composer:
```
composer require joaopedrobaq/diffdatas

```
## Como Usar
No topo do arquivo, coloque:
```php
require_once __DIR__ . '/vendor/autoload.php';

use DiffDatas\Datas;
```

Crie uma instância do objeto Datas e coloque as duas datas. O formato das datas deve ser "aaaa-mm-dd hh:mm:ss", como no exemplo abaixo:
```php
$datas = new Datas;
$datas->setData1("2020-12-24 20:30:00"); // 24 de Dezembro de 2020 às 20:30
$datas->setData2("2020-06-15 12:00:00"); // 15 de Junho de 2020 às 12 horas 
```
Caso queira, pode estabelecer qualquer uma das datas como o momento atual, usando o $datas->agora dentro do setData:
```php
$datas->setData1($datas->agora);
```

Após a inserção das datas, utilize o seguinte método para executar o cálculo de diferença:
```php
$datas->subDatas();
```
Agora que o cálculo foi feito, é possível retornar o resultado de várias maneiras:

## Retornos

Para exemplificar, será usado para todos os casos abaixo o seguinte código:
```php
$datas = new Datas;
$datas->setData1("2020-12-25 00:00:00"); // 25 de Dezembro de 2020 à meia-noite
$datas->setData2("2020-06-15 12:00:00"); // 15 de Junho de 2020 às 12:00:00
$datas->subDatas());
```
Ele irá informar quanto tempo falta para o Natal de 2020, contando a partir de 15 de junho de 2020.

### Array com Diferença

Se deseja retornar um array associativo com a diferença, use:

```php
$resultado = $datas->arrayDiff();
print_r($resultado);

// Retorna

Array
(
    [anos] => 0
    [meses] => 6
    [dias] => 9
    [horas] => 12
    [minutos] => 0
    [segundos] => 0
)
```
Ou seja, faltam 6 meses, 9 dias e 12 horas para o Natal.
### Escrever diferença Simples
Caso queira escrever a maior medida de tempo, pode usar o método `escreverSimples()`
```php
$resultado = $datas->escreverSimples();
echo $resultado;

// Retorna
6 meses
```

### Escrever diferença por extenso
Para escrever por extenso, use o método `escreverExtenso()`
```php
$resultado = $datas->escreverExtenso();
echo $resultado;

// Retorna
6 meses, 9 dias e 12 horas
```


### Escrever data no futuro

É possível também escrever por extenso uma data no futuro de maneira que use palavras como Hoje, Amanhã, Dia da semana (caso seja na semana seguinte) ou apenas a data numeral. Para isso, é necessário apenas informar a `Data1` e realizar a operação. Depois, use o método `escreverFuturo($as)`. O argumento `$as` deve ser um `boolean` que define se a string retornada deve conter a palavra "às" entre o dia e a hora, como no exemplo abaixo:

```php
// A data usada como referência é o momento atual, que nesse exemplo é 15 de junho de 2020

$datas = new Datas;
$datas->setData1("2020-06-15 20:00:00"); // 15 de junho de 2020 às 20 hrs
echo($datas->escreverFuturo(false));

// Retorna
Hoje 20:00

echo($datas->escreverFuturo()); // O valor padrão é false

// Retorna
Hoje 20:00

echo($datas->escreverFuturo(true));

// Retorna
Hoje às 20:00
```

Observe que não é necessário fazer o cálculo `subDatas()`, pois o próprio método já o faz.
Mais exemplos:

```php
$datas = new Datas;
$datas->setData1("2020-06-16 14:00:00"); // 16 de junho de 2020 às 14 hrs
echo($datas->escreverFuturo());

// Retorna
Amanhã 14:00

$datas->setData1("2020-06-18 08:00:00"); // 16 de junho de 2020 às 14 hrs
echo($datas->escreverFuturo(false));

// Retorna
Quinta 08:00

$datas->setData1("2020-06-25 18:30:00"); // 16 de junho de 2020 às 14 hrs
echo($datas->escreverFuturo(true));

// Retorna
25/06 às 18:30
```

## License

MIT License - http://www.opensource.org/licenses/mit-license.php