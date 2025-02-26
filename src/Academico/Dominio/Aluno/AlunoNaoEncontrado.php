<?php

namespace CleanCode\Arquitetura\Academico\Dominio\Aluno;

use CleanCode\Arquitetura\Academico\Dominio\Cpf;

class AlunoNaoEncontrado extends \DomainException
{
  public function __construct(Cpf $cpf)
  {
    parent::__construct("Aluno com CPF $cpf não encontrado");
  }
}