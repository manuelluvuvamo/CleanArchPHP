<?php

namespace CleanCode\Arquitetura\Gamificacao\Testes\Unidade\Dominio\Selo;

use CleanCode\Arquitetura\Gamificacao\Dominio\Selo\Selo;
use CleanCode\Arquitetura\Shared\Dominio\Cpf;
use PHPUnit\Framework\TestCase;

class SeloTest extends TestCase
{
  public function testSeloeDevePoderSerRepresentadoComoString()
  {
    $selo = new Selo(new Cpf('123.456.789-10'), 'Novato');
    $this->assertSame('Novato', (string) $selo);
  }
}