<?php

namespace CleanCode\Arquitetura\Gamificacao\Aplicacao\Selo\BuscarSelosDoAluno;

class BuscarSelosDoAlunoDto
{
    public string $cpfAluno;

    public function __construct(string $cpfAluno)
    {
        $this->cpfAluno = $cpfAluno;
    }
}