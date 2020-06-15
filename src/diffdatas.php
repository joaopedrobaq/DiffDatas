<?php

namespace DiffDatas;

class Datas
{
  private $data1;
  private $data2;
  private $diff;
  public $agora;

  function __construct()
  {
    $this->agora = date('Y-m-d H:i:s');
  }

  function subDatas()
  {
    $date1 = new \DateTime($this->data1);
    $date2 = new \DateTime($this->data2);
    $diff = date_diff($date1, $date2);
    $this->setDiff($diff);
  }

  function escreverSimples()
  {
    $tipos = ['y', 'm', 'd', 'h', 'i', 's'];
    $full = ['ano', 'mês', 'dia', 'hora', 'minuto', 'segundo'];
    $fullp = ['anos', 'meses', 'dias', 'horas', 'minutos', 'segundos'];
    $feito = false;
    foreach ($tipos as $i => $tipo) {
      $dif = $this->diff->format("%$tipo");
      if ($dif > 0 && $feito == false) {
        $feito = true;
        if ($dif === 1) {
          return $dif . " $full[$i]";
        } else {
          return $dif . " $fullp[$i]";
        }
      }
    }
  }

  function escreverExtenso()
  {
    $tipos = ['y', 'm', 'd', 'h', 'i', 's'];
    $full = ['ano', 'mês', 'dia', 'hora', 'minuto', 'segundo'];
    $fullp = ['anos', 'meses', 'dias', 'horas', 'minutos', 'segundos'];
    foreach ($tipos as $i => $tipo) {
      $dif = $this->diff->format("%$tipo");
      if ($dif > 0) {
        if ($dif === 1) {
          $ext[] = $dif . " $full[$i]";
        } else {
          $ext[] = $dif . " $fullp[$i]";
        }
      }
    }
    $extenso = "";
    for ($i = 0; $i < count($ext); $i++) {
      $extenso .= "$ext[$i]";
      if ($i < count($ext) - 2) {
        $extenso .= ", ";
      } elseif ($i < count($ext) - 1) {
        $extenso .= " e ";
      }
    }
    return $extenso;
  }

  function escreverFuturo($as)
  {
    $fut = new \DateTime($this->data1);
    $atual = new \DateTime($this->agora);
    $dif = date_diff($atual, $fut);
    $diasdif = $dif->format("%d");
    $convert = strtotime($this->data1);
    $data = date("d/m", $convert);
    $diasem = date("l", $convert);
    $hora = date("H:i", $convert);
    if ($diasdif == 0) {
      $datastr = "Hoje";
    } elseif ($diasdif == 1) {
      $datastr = "Amanhã";
    } elseif ($diasdif < 7 && $diasdif > 1) {
      $datastr = $this->converterDia($diasem);
    } else {
      $datastr = $data;
    }
    if ($as) {
      $as = " às ";
    } else {
      $as = " ";
    }
    return $datastr . $as . $hora;
  }

  private function converterDia($dia)
  {
    switch ($dia) {
      case "Sunday":
        return "Domingo";
        break;
      case "Monday":
        return "Segunda";
        break;
      case "Tuesday":
        return "Terça";
        break;
      case "Wednesday":
        return "Quarta";
        break;
      case "Thursday":
        return "Quinta";
        break;
      case "Friday":
        return "Sexta";
        break;
      case "Saturday":
        return "Sábado";
        break;
    }
  }

  function arrayDiff()
  {
    // Converte Diferença em array

    $tipos = ['y', 'm', 'd', 'h', 'i', 's'];
    $full = ['anos', 'meses', 'dias', 'horas', 'minutos', 'segundos'];

    for ($i = 0; $i < count($tipos); $i++) {
      $prop = $tipos[$i];
      $novo[$full[$i]] = $this->diff->$prop;
    }

    return $novo;
  }

  public function setData1($data1)
  {
    $this->data1 = $data1;
  }
  public function setData2($data2)
  {
    $this->data2 = $data2;
  }
  public function getDiff()
  {
    return $this->diff;
  }
  public function setDiff($diff)
  {
    $this->diff = $diff;

    return $this;
  }
}
