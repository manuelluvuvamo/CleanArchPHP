<?php

use CleanCode\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use CleanCode\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use CleanCode\Arquitetura\Dominio\Aluno\Aluno;
use CleanCode\Arquitetura\Infra\Aluno\RepositorioDeAlunoEmMemoria;
use CleanCode\Arquitetura\Dominio\PublicadorDeEvento;
use CleanCode\Arquitetura\Dominio\Aluno\LogDeAlunoMatriculado;

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

$repositorioDeAluno = new RepositorioDeAlunoEmMemoria();

$publicador = new PublicadorDeEvento();
$publicador->adicionarOuvinte (new LogDeAlunoMatriculado());


$useCase = new MatricularAluno($repositorioDeAluno, $publicador);
$useCase->executa($dadosAluno);

