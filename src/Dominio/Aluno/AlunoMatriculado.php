<?php

namespace CleanCode\Arquitetura\Dominio\Aluno;

use CleanCode\Arquitetura\Dominio\Evento;
use CleanCode\Arquitetura\Dominio\Cpf;

class AlunoMatriculado implements Evento
{
    private \DatetimeImmutable $momento;
    private Cpf $cpfAluno;

    public function __construct(Cpf $cpfAluno)
    {
        $this->momento = new \DatetimeImmutable();
        $this->cpfAluno = $cpfAluno;
    }

    public function cpfAluno(): Cpf
    {
        return $this->cpfAluno;
    }

    public function momento(): \Datetimeimmutable
    {
        return $this->momento;
    }

}