<?php

namespace CleanCode\Arquitetura\Dominio\Aluno;

use CleanCode\Arquitetura\Dominio\Aluno\AlunoMatriculado;
use CleanCode\Arquitetura\Dominio\Evento;

class LogDeAlunoMatriculado extends OuvinteDeEventos
{
    /**
     * @param AlunoMatriculado $alunoMatriculado
     */
    public function reageAo (Evento $alunoMatriculado): void
    {
        fprintf(STDERR, 'Aluno com CPF %s foi matriculado na data $s', (string) $alunoMatriculado->cpfAluno(), $alunoMatriculado->momento()->format('d-m-Y'));
    }

    public function sabeProcessar (Evento $evento): bool
    {
        return $evento instanceof AlunoMatriculado;
    }
}