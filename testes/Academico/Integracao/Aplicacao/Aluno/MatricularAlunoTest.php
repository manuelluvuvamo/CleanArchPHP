<?php

namespace CleanCode\Arquitetura\Testes\Academico\Integracao\Aplicacao\Aluno;

use CleanCode\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use CleanCode\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use CleanCode\Arquitetura\Academico\Dominio\Cpf;
use CleanCode\Arquitetura\Academico\Dominio\Email;
use CleanCode\Arquitetura\Academico\Dominio\Aluno\Aluno;
use CleanCode\Arquitetura\Academico\Infra\Aluno\RepositorioDeAlunoComPdo;
use CleanCode\Arquitetura\Academico\Dominio\PublicadorDeEvento;
use CleanCode\Arquitetura\Academico\Dominio\Aluno\LogDeAlunoMatriculado;
use PHPUnit\Framework\TestCase;
use Mockery;

class MatricularAlunoTest extends TestCase
{
    public function testAlunoDeveSerAdicionadoAoRepositorio()
    {
        $dadosAluno = new MatricularAlunoDto(
            '123.456.789-10',
            'Fulano de Tal',
            'fulano.tal@test.com',
        );

        $repositorioDeAluno = Mockery::mock(RepositorioDeAlunoComPdo::class);
        $repositorioDeAluno->shouldreceive('adicionar')->once()->with(Mockery::type(Aluno::class));
        $repositorioDeAluno->shouldReceive('buscarPorCpf')->once()
            ->with(Mockery::on(fn ($cpf) => (string)$cpf === '123.456.789-10'))
            ->andReturn(new Aluno(new Cpf('123.456.789-10'), 'Fulano de Tal', new Email('fulano.tal@test.com')));


        $publicador = new PublicadorDeEvento();
        $publicador->adicionarOuvinte (new LogDeAlunoMatriculado());

        $useCase = new MatricularAluno($repositorioDeAluno, $publicador);

        $useCase->executa($dadosAluno);

        $aluno = $repositorioDeAluno->buscarPorCpf(new Cpf('123.456.789-10'));
        $this->assertSame('Fulano de Tal', (string) $aluno->nome());
        $this->assertSame('fulano.tal@test.com', (string) $aluno->email());
        $this->assertEmpty($aluno->telefones());
    
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}