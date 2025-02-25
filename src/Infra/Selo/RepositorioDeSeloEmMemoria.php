<?php

namespace CleanCode\Arquitetura\Infra\Selo;

use CleanCode\Arquitetura\Dominio\Aluno\AlunoNaoEncontrado;
use CleanCode\Arquitetura\Dominio\Aluno\RepositorioDeAluno;
use CleanCode\Arquitetura\Dominio\Aluno\Aluno;
use CleanCode\Arquitetura\Dominio\Cpf;
use CleanCode\Arquitetura\Dominio\Selo\RepositorioDeSelo;
use CleanCode\Arquitetura\Dominio\Selo\Selo;

class RepositorioDeSeloEmMemoria implements RepositorioDeSelo
{
	private array $selos;


	public function adicionar(Selo $selo): void
	{
		$this->selos[] = $selo;
	}

	public function selosDeAlunoComCpf(Cpf $cpf)
	{
		return array_filter( $this->selos, fn (Selo $selo) => $selo->cpfAluno() == $cpf);

	}
	
	public function buscarTodos(): array
	{
		return $this->selos;
	}
}