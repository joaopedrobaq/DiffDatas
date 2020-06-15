<?php

namespace DiffDatas;

class DiffDatas
{
  private $datapassado;
  private $datafuturo;
  private $diff;
  public $agora;

  function __construct()
  {
    $this->agora = date('Y-m-d H:i:s');
  }

  function subDatas()
  {
    $date1 = new \DateTime($this->datapassado);
    $date2 = new \DateTime($this->datafuturo);
    $diff = date_diff($date1, $date2);
    $this->setDiff($diff);
  }

  function escreverDiff()
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

  function mostrarFuturo()
  {
    $fut = new \DateTime($this->datafuturo);
    $dif = date_diff($this->agora, $fut);
    $diasdif = $dif->format("%d");
    $convert = strtotime($this->datafuturo);
    $data = date("d/m", $convert);
    $diasem = date("l", $convert);
    $hora = date("H:i", $convert);
    if ($diasdif == 0) {
      $datastr = "Hoje às ";
    } elseif ($diasdif == 1) {
      $datastr = "Amanhã às ";
    } elseif ($diasdif < 7 && $diasdif > 1) {
      $datastr = $this->converterDia($diasem) . " às ";
    } else {
      $datastr = $data . " às ";
    }
    return $data . $hora;
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

  public function setDataFuturo($datafuturo)
  {
    $this->datafuturo = $datafuturo;
  }
  public function setDataPassado($datapassado)
  {
    $this->datapassado = $datapassado;
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
