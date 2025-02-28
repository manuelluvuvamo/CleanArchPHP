<?php

namespace CleanCode\Arquitetura\Academico\Dominio\Indicacao;

use CleanCode\Arquitetura\Shared\Dominio\Cpf;

interface RepositorioDeIndicacao
{
  public function adicionar(Indicacao $indicacao): void;
  public function buscarPorIndicante(Cpf $cpf_indicante): array;
  public function buscarPorIndicado(Cpf $cpf_indicado): array;
  public function buscarPorIndicanteEIndicado(Cpf $cpf_indicante, Cpf $cpf_indicado): Indicacao;
  /** @return Indicacao[] */
  public function buscarTodos(): array;
}