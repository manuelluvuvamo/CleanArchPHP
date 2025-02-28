<?php

use CleanCode\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use CleanCode\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use CleanCode\Arquitetura\Academico\Dominio\Aluno\LogDeAlunoMatriculado;
use CleanCode\Arquitetura\Academico\Infra\Aluno\RepositorioDeAlunoEmMemoria;
use CleanCode\Arquitetura\Shared\Dominio\Evento\PublicadorDeEvento;
use CleanCode\Arquitetura\Gamificacao\Aplicacao\GeraSeloDeNovato;
use CleanCode\Arquitetura\Gamificacao\Infra\Selo\RepositorioDeSeloEmMemoria;
use CleanCode\Arquitetura\Gamificacao\Aplicacao\Selo\BuscarSelosDoAluno\BuscarSelosDoAluno;
use CleanCode\Arquitetura\Gamificacao\Aplicacao\Selo\BuscarSelosDoAluno\BuscarSelosDoAlunoDto;

require 'vendor/autoload.php';

$cpf = $argv[1];
$nome = $argv[2];
$email = $argv[3];
//$ddd = $argv[4];
//$numero = $argv[5];

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
$publicador->adicionarOuvinte (new GeraSeloDeNovato(new RepositorioDeSeloEmMemoria()));


$useCase = new MatricularAluno(new RepositorioDeAlunoEmMemoria(), $publicador);
$useCase->executa($dadosAluno);


$dados = new BuscarSelosDoAlunoDto($cpf);
$useCase = new BuscarSelosDoAluno(new RepositorioDeSeloEmMemoria());
$useCase->executa($dados);
