<?php

namespace CleanCode\Arquitetura\Academico\Dominio\Aluno;

use CleanCode\Arquitetura\Shared\Dominio\Cpf;
use CleanCode\Arquitetura\Shared\Dominio\Evento\Evento;

class AlunoMatriculado implements Evento
{
    private \DatetimeImmutable $momento;
    private Cpf $cpfAluno;
    private string $nome;

    public function __construct(Cpf $cpfAluno)
    {
        $this->momento = new \DatetimeImmutable();
        $this->cpfAluno = $cpfAluno;
        $this->nome = 'aluno_matriculado';
    }

    public function cpfAluno(): Cpf
    {
        return $this->cpfAluno;
    }

    public function momento(): \Datetimeimmutable
    {
        return $this->momento;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public  function  jsonSerialize()
    {
        return get_object_vars($this);
    }

}