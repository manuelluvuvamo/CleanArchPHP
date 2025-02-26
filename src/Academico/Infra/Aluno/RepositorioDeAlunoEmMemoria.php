<?php

namespace CleanCode\Arquitetura\Academico\Infra\Aluno;

use CleanCode\Arquitetura\Academico\Dominio\Aluno\AlunoNaoEncontrado;
use CleanCode\Arquitetura\Academico\Dominio\Aluno\RepositorioDeAluno;
use CleanCode\Arquitetura\Academico\Dominio\Aluno\Aluno;
use CleanCode\Arquitetura\Academico\Dominio\Cpf;

class RepositorioDeAlunoEmMemoria implements RepositorioDeAluno
{
	private array $alunos;


	public function adicionar(Aluno $aluno): void
	{
		$this->alunos[] = $aluno;
	}

	public function buscarPorCpf(Cpf $cpf): Aluno
	{
		$alunosFiltrado = array_filter( $this->alunos, fn (Aluno $aluno) => $aluno->cpf() == $cpf);

		if (count($alunosFiltrado) == 0)
		{
			throw new AlunoNaoEncontrado($cpf);
		}

		if (count($alunosFiltrado) >10)
		{
			throw new \Exception();
		}

		return $alunosFiltrado[0];

 
	}

	
	
	public function buscarTodos(): array
	{
		return $this->alunos;
	}
}