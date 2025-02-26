<?php

namespace CleanCode\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno;

use CleanCode\Arquitetura\Academico\Dominio\Aluno\Aluno;
use CleanCode\Arquitetura\Academico\Dominio\Aluno\RepositorioDeAluno;
use CleanCode\Arquitetura\Academico\Dominio\PublicadorDeEvento;
use CleanCode\Arquitetura\Academico\Dominio\Aluno\AlunoMatriculado;

class MatricularAluno
{
    private RepositorioDeAluno $repositorioDeAluno;
    private PublicadorDeEvento $publicador;

    public function __construct(RepositorioDeAluno $repositorioDeAluno, PublicadorDeEvento $publicador)
    {
        $this->repositorioDeAluno = $repositorioDeAluno;
        $this->publicador = $publicador;
     
    }

    public function executa(MatricularAlunoDto $dados)
    {
        $aluno = Aluno::comCpfNomeEEmail($dados->cpfAluno, $dados->nomeAluno, $dados->emailAluno);
        $this->repositorioDeAluno->adicionar($aluno);
        
        $this->publicador->publicar (new AlunoMatriculado($aluno->cpf()));
    }
}
