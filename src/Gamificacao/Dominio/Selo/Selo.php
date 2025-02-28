<?php

namespace CleanCode\Arquitetura\Gamificacao\Dominio\Selo;

use CleanCode\Arquitetura\Shared\Dominio\Cpf;

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