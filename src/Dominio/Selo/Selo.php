<?php

namespace CleanCode\Arquitetura\Dominio\Selo;

use CleanCode\Arquitetura\Dominio\Cpf;

class Selo
{
  private Cpf $cpfAluno;
  private string $nome;

  public function __construct(Cpf $cpfAluno, string $nome)
  {
    $this->cpf = $cpfAluno;
    $this->nome = $nome;
  }

  public function cpfAluno(): Cpf
  {
    return $this->cpfAluno;
  }

  public function __toString(): string
  {
    return $this->nome;
  }

}