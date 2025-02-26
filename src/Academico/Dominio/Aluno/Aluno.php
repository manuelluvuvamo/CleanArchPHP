<?php

namespace CleanCode\Arquitetura\Academico\Dominio\Aluno;

use CleanCode\Arquitetura\Academico\Dominio\Cpf;
use CleanCode\Arquitetura\Academico\Dominio\Email;

class Aluno
{
  private Cpf $cpf;
  private string $nome;
  private Email $email;
  private array $telefones;
  private string $senha;

  public static function comCpfNomeEEmail(string $cpf, string $nome, string $email): self
  {
    return new Aluno(new Cpf($cpf), $nome, new Email($email));
  }

  public function __construct(Cpf $cpf, string $nome, Email $email)
  {
    $this->cpf = $cpf;
    $this->nome = $nome;
    $this->email = $email;
    $this->telefones = [];
  }

  public function adicionarTelefones(string $ddd, string $numero)
  {
    if (count($this->telefones) >= 2)
      throw new AlunoLimiteTelefone();
    $this->telefones[] = new Telefone($ddd, $numero);
    return $this;
  }

  public function cpf(): Cpf
  {
    return $this->cpf;
  }

  public function nome(): string
  {
    return $this->nome;
  }

  public function email(): string
  {
    return $this->email;
  }

  /**
   * @return Telefone[]
   */
  public function telefones(): array
  {
    return $this->telefones;
  }
}