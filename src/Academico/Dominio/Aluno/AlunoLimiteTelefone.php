<?php

namespace CleanCode\Arquitetura\Academico\Dominio\Aluno;

class AlunoLimiteTelefone extends \DomainException
{
  public function __construct()
  {
    parent::__construct("Aluno já tem 2 telefones. Não pode adicionar outro.");
  }
}