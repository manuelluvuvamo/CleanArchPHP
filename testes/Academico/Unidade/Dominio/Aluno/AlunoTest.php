<?php

namespace CleanCode\Arquitetura\Academico\Testes\Unidade\Dominio\Aluno;

use CleanCode\Arquitetura\Academico\Dominio\Aluno\Aluno;
use CleanCode\Arquitetura\Academico\Dominio\Aluno\AlunoLimiteTelefone;
use PHPUnit\Framework\TestCase;

class AlunoTest extends TestCase
{
  private Aluno $aluno;
  protected function setUp(): void
  {
    $this->aluno = Aluno::comCpfNomeEEmail('123.456.789-10', 'Fulado de Tal', 'fulano.tal@test.com');
  }

  public function testAdicionarMaisDe2TelefonesNaoDevePassar()
  {
    $this->expectException(AlunoLimiteTelefone::class);
    $this->expectExceptionMessage('Aluno já tem 2 telefones. Não pode adicionar outro.');
  
    $this->aluno->adicionarTelefones('244', '9100000001')->adicionarTelefones('244', '9200000002')->adicionarTelefones('244', '9300000003');
  }

  public function testAdicionar1TelefoneDevePassar()
  {
        $this->aluno->adicionarTelefones('244', '9100000001');

        $this->assertCount(1, $this->aluno->telefones());
  }

  public function testAdicionar2TelefoneDevePassar()
  {
    $this->aluno->adicionarTelefones('244', '9100000001')->adicionarTelefones('244', '9200000002');

    $this->assertCount(2, $this->aluno->telefones());
  }
}