<?php

namespace CleanCode\Arquitetura\Gamificacao\Aplicacao\Selo\BuscarSelosDoAluno;

use CleanCode\Arquitetura\Gamificacao\Dominio\Selo\RepositorioDeSelo;
use CleanCode\Arquitetura\Shared\Dominio\Cpf;

class BuscarSelosDoAluno
{
    private RepositorioDeSelo $repositorioDeSelo;

    /**
     * @param RepositorioDeSelo $repositorioDeSelo
     */
    public function __construct(RepositorioDeSelo $repositorioDeSelo)
    {
        $this->repositorioDeSelo = $repositorioDeSelo;
    }

    public function executa(BuscarSelosDoAlunoDto $dados)
    {
        $this->repositorioDeSelo->selosDeAlunoComCpf(new Cpf($dados->cpfAluno));
    }
}