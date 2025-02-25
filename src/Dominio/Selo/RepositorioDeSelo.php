<?php

namespace CleanCode\Arquitetura\Dominio\Selo;

use CleanCode\Arquitetura\Dominio\Cpf;

interface RepositorioDeSelo
{
  public function adicionar(Selo $selo): void;
  public function selosDeAlunoComCpf(Cpf $cpf);
  /** @return Selo[] */
  public function buscarTodos(): array;
}