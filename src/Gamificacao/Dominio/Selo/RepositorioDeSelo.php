<?php

namespace CleanCode\Arquitetura\Gamificacao\Dominio\Selo;

use CleanCode\Arquitetura\Shared\Dominio\Cpf;

interface RepositorioDeSelo
{
  public function adicionar(Selo $selo): void;
  public function selosDeAlunoComCpf(Cpf $cpf);
  /** @return Selo[] */
  public function buscarTodos(): array;
}