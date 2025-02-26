<?php 

namespace CleanCode\Arquitetura\Academico\Dominio\Aluno;

interface CifradorDeSenha
{
    public function cifrar(string $senha): string;
    public function verificar(string $senhaEmTexto, string $senhaCifrada): bool;
}