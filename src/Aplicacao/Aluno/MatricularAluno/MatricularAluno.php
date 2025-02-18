<?php

namespace CleanCode\Arquitetura\Aplicacao\Aluno\MatricularAluno;

use CleanCode\Arquitetura\Dominio\Aluno\Aluno;
use CleanCode\Arquitetura\Dominio\Aluno\RepositorioDeAluno;
use CleanCode\Arquitetura\Dominio\PublicadorDeEvento;
use CleanCode\Arquitetura\Dominio\Aluno\AlunoMatriculado;

class MatricularAluno
{
    private RepositorioDeAluno $repositorioDeAluno;
    private PublicadorDeEvento $publicador;

    public function __construct(RepositorioDeAluno $repositorioDeAluno, PublicadorDeEvento $publicador)
    {
        $this->repositorioDeAluno = $repositorioDeAluno;
     
    }

    public function executa(MatricularAlunoDto $dados)
    {
        $aluno = Aluno::comCpfNomeEEmail($dados->cpfAluno, $dados->nomeAluno, $dados->emailAluno);
        $this->repositorioDeAluno->adicionar($aluno);
        
        $publicador->publicar (new AlunoMatriculado($aluno->cpf()));
    }
}
