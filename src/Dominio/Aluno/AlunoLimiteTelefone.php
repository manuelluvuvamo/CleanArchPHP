<?php

namespace CleanCode\Arquitetura\Dominio\Aluno;

use CleanCode\Arquitetura\Dominio\Cpf;

class AlunoLimiteTelefone extends \DomainException
{
  public function __construct()
  {
    parent::__construct("Aluno já tem 2 telefones. Não pode adicionar outro.");
  }
}