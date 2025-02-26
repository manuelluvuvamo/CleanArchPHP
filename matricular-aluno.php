<?php

use CleanCode\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use CleanCode\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use CleanCode\Arquitetura\Academico\Dominio\Aluno\Aluno;
use CleanCode\Arquitetura\Academico\Infra\Aluno\RepositorioDeAlunoEmMemoria;
use CleanCode\Arquitetura\Academico\Dominio\PublicadorDeEvento;
use CleanCode\Arquitetura\Academico\Dominio\Aluno\LogDeAlunoMatriculado;

require 'vendor/autoload.php';

$cpf = $argv[1];
$nome = $argv[2];
$email = $argv[3];
$ddd = $argv[4];
$numero = $argv[5];

// $aluno = Aluno::comCpfNomeEEmail($cpf, $nome, $email)->adicionarTelefones($ddd, $numero);
// $repositorio = new RepositorioDeAlunoEmMemoria();
// $repositorio->adicionar($aluno);

$dadosAluno = new MatricularAlunoDto(
  $cpf,
  $nome,
  $email,
);


$publicador = new PublicadorDeEvento();
$publicador->adicionarOuvinte (new LogDeAlunoMatriculado());


$useCase = new MatricularAluno(new RepositorioDeAlunoEmMemoria(), $publicador);
$useCase->executa($dadosAluno);

