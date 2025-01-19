<?php

namespace CleanCode\Arquitetura\Dominio\Indicacao;

use CleanCode\Arquitetura\Dominio\Cpf;

interface RepositorioDeIndicacao
{
  public function adicionar(Indicacao $indicacao): void;
  public function buscarPorIndicante(Cpf $cpf_indicante): array;
  public function buscarPorIndicado(Cpf $cpf_indicado): array;
  public function buscarPorIndicanteEIndicado(Cpf $cpf_indicante, Cpf $cpf_indicado): Indicacao;
  /** @return Indicacao[] */
  public function buscarTodos(): array;
}