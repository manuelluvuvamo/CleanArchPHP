<?php

namespace CleanCode\Arquitetura\Academico\Testes\Unidade\Dominio\Aluno;

use CleanCode\Arquitetura\Academico\Dominio\Aluno\Telefone;
use PHPUnit\Framework\TestCase;

class TelefoneTest extends TestCase
{
  public function testTelefoneComDddInvalidoNaoDeveExistir()
  {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('DDD inválido');
    new Telefone('ddd', '22222222');
  }

  public function testTelefoneComNumeroInvalidoNaoDeveExistir()
  {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('Número de telefone inválido');
    new Telefone('24', 'número');
  }

  public function testTelefoneDevePoderSerRepresentadoComoString()
  {
    $telefone = new Telefone('55', '22222222');
    $this->assertSame('(55) 22222222', (string) $telefone);
  }
}