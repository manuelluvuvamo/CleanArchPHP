<?php

namespace CleanCode\Arquitetura\Academico\Dominio\Indicacao;

use CleanCode\Arquitetura\Academico\Dominio\Aluno\Aluno;

class Indicacao
{
  private Aluno $indicante;
  private Aluno $indicado;
  private \DateTimeImmutable $data;

  public function __construct(Aluno $indicante, Aluno $indicado)
  {
    $this->indicante = $indicante;
    $this->indicado = $indicado;

    $this->data = new \DateTimeImmutable();
  }

  public function indicante(): Aluno
  {
    return $this->indicante;
  }

  public function indicado(): Aluno
  {
    return $this->indicado;
  }

  public function dataIndicacao(): \DateTimeImmutable
  {
    return $this->data;
  }
}