<?php

namespace CleanCode\Arquitetura\Aplicacao\Aluno\MatricularAluno;

use CleanCode\Arquitetura\Dominio\Aluno\Aluno;
use CleanCode\Arquitetura\Dominio\Aluno\RepositorioDeAluno;

class MatricularAluno
{
    private RepositorioDeAluno $repositorioDeAluno;

    public function __construct(RepositorioDeAluno $repositorioDeAluno)
    {
        $this->repositorioDeAluno = $repositorioDeAluno;
    }

    public function executa(MatricularAlunoDto $dados)
    {
        $aluno = Aluno::comCpfNomeEEmail($dados->cpfAluno, $dados->nomeAluno, $dados->emailAluno);
        $this->repositorioDeAluno->adicionar($aluno);
    }
}
