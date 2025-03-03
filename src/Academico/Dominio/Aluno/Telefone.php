<?php

namespace CleanCode\Arquitetura\Academico\Dominio\Aluno;

class Telefone
{
  private string $ddd;
  private string $numero;

  public function __construct(string $ddd, string $numero)
  {
    $this->setDdd($ddd);
    $this->setNumero($numero);
  }

  private function setDdd(string $ddd):void
  {
    if (preg_match('/^\d{1,3}$/', $ddd) !== 1) {
      throw new \InvalidArgumentException('DDD inválido');
    }

    $this->ddd = $ddd;
  }

  private function setNumero(string $numero):void
  {
    if (preg_match('/\d{8,9}/', $numero) !== 1) {
      throw new \InvalidArgumentException('Número de telefone inválido');
    }

    $this->numero = $numero;
  }

  public function __tostring()
  {
    return "({$this->ddd}) {$this->numero}";
  }

  public function ddd():string
  {
    return $this->ddd;
  }

  public function numero():string
  {
    return $this->numero;
  }
}