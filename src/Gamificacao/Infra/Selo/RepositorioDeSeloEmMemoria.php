<?php

namespace CleanCode\Arquitetura\Gamificacao\Infra\Selo;


use CleanCode\Arquitetura\Academico\Dominio\Cpf;
use CleanCode\Arquitetura\Gamificacao\Dominio\Selo\RepositorioDeSelo;
use CleanCode\Arquitetura\Gamificacao\Dominio\Selo\Selo;

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