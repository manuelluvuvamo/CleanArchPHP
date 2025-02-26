<?php

namespace CleanCode\Arquitetura\Academico\Testes\Unidade\Aplicacao\Aluno;

use CleanCode\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use CleanCode\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use CleanCode\Arquitetura\Academico\Dominio\Aluno\LogDeAlunoMatriculado;
use CleanCode\Arquitetura\Academico\Dominio\Cpf;
use CleanCode\Arquitetura\Academico\Dominio\PublicadorDeEvento;
use CleanCode\Arquitetura\Academico\Infra\Aluno\RepositorioDeAlunoEmMemoria;
use PHPUnit\Framework\TestCase;

class MatricularAlunoTest extends TestCase
{
    public function testAlunoDeveSerAdicionadoAoRepositorio()
    {
        $dadosAluno = new MatricularAlunoDto(
            '123.456.789-10',
            'Manuel Luvuvamo',
            'manuel.teste@gmail.com',
        );

        $publicador = new PublicadorDeEvento();
        $publicador->adicionarOuvinte (new LogDeAlunoMatriculado());


        $repositorioDeAluno = new RepositorioDeAlunoEmMemoria();
        $useCase = new MatricularAluno($repositorioDeAluno, $publicador);

        $useCase->executa($dadosAluno);

        $aluno = $repositorioDeAluno->buscarPorCpf(new Cpf('123.456.789-10'));
        $this->assertSame('Manuel Luvuvamo', (string) $aluno->nome());
        $this->assertSame('manuel.teste@gmail.com', (string) $aluno->email());
        $this->assertEmpty($aluno->telefones());
    
    }
}