<?php

namespace CleanCode\Arquitetura\Gamificacao\Aplicacao;

use CleanCode\Arquitetura\Gamificacao\Dominio\Selo\RepositorioDeSelo;
use CleanCode\Arquitetura\Gamificacao\Dominio\Selo\Selo;
use CleanCode\Arquitetura\Shared\Dominio\Evento\Evento;
use CleanCode\Arquitetura\Shared\Dominio\Evento\OuvinteDeEvento;

class GeraSeloDeNovato extends OuvinteDeEvento
{
    private RepositorioDeSelo $repositorioDeSelo;

    public function __construct(RepositorioDeSelo $repositorioDeSelo)
    {
        $this->repositorioDeSelo = $repositorioDeSelo;
    }

    public function sabeProcessar(Evento $evento): bool
    {
        return $evento->nome() === 'aluno_matriculado';
    }

    public function reageAo(Evento $evento): void
    {
        $array = $evento->jsonSerialize();
        $cpf = $array['cpfAluno'];

        $selo = new Selo($cpf, 'Novato');
        $this->repositorioDeSelo->adicionar($selo);
    }
}