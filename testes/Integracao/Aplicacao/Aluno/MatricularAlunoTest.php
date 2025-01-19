<?php

namespace CleanCode\Arquitetura\Testes\Integracao\Aplicacao\Aluno;

use CleanCode\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use CleanCode\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use CleanCode\Arquitetura\Dominio\Cpf;
use CleanCode\Arquitetura\Infra\Aluno\RepositorioDeAlunoComPdo;
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

        try {
            // Defina o caminho do banco de dados
            $caminhoBanco = __DIR__ . '/../../../../banco_teste.sqlite';
        
            // Crie a conexão com o SQLite
            $conexao = new \PDO('sqlite:' . $caminhoBanco);
            $conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
            // Carregue o arquivo SQL
            $scriptSql = $scriptSql = file_get_contents(__DIR__ . '/../../../../banco.sql');

        
            // Execute o script SQL
            $conexao->exec($scriptSql);
        
            echo "Banco de dados criado com sucesso!";
        } catch (\PDOException $e) {
            die('Erro ao criar o banco de dados: ' . $e->getMessage());
        }

        $repositorioDeAluno = new RepositorioDeAlunoComPdo($conexao);
        $useCase = new MatricularAluno($repositorioDeAluno);

        $useCase->executa($dadosAluno);

        $aluno = $repositorioDeAluno->buscarPorCpf(new Cpf('123.456.789-10'));
        $this->assertSame('Manuel Luvuvamo', (string) $aluno->nome());
        $this->assertSame('manuel.teste@gmail.com', (string) $aluno->email());
        $this->assertEmpty($aluno->telefones());
    
    }
}