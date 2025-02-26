<?php

namespace CleanCode\Arquitetura\Academico\Infra\Indicacao;

use CleanCode\Arquitetura\Academico\Dominio\Cpf;
use CleanCode\Arquitetura\Academico\Dominio\Indicacao\Indicacao;
use CleanCode\Arquitetura\Academico\Dominio\Indicacao\RepositorioDeIndicacao;
use CleanCode\Arquitetura\Academico\Dominio\Aluno\Aluno;

class RepositorioDeIndicacaoComPdo implements RepositorioDeIndicacao
{
    private \PDO $conexao;

    public function __construct(\PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function adicionar(Indicacao $indicacao): void
    {
        $sql = 'INSERT INTO indicacoes (cpf_indicante, cpf_indicado, data_indicacao) 
                VALUES (:cpf_indicante, :cpf_indicado, :data_indicacao)';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':cpf_indicante', $indicacao->indicante()->cpf());
        $stmt->bindValue(':cpf_indicado', $indicacao->indicado()->cpf());
        $stmt->bindValue(':data_indicacao', $indicacao->dataIndicacao()->format('Y-m-d H:i:s'));
        $stmt->execute();
    }

    public function buscarPorIndicado(Cpf $cpf_indicado): array
    {
        $sql = 'SELECT i.*, a1.nome AS nome_indicante, a1.email AS email_indicante, 
                       a2.nome AS nome_indicado, a2.email AS email_indicado
                FROM indicacoes i
                JOIN alunos a1 ON i.cpf_indicante = a1.cpf
                JOIN alunos a2 ON i.cpf_indicado = a2.cpf
                WHERE i.cpf_indicado = :cpf_indicado';

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':cpf_indicado', $cpf_indicado);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this->montarListaIndicacoes($dados);
    }

    public function buscarPorIndicante(Cpf $cpf_indicante): array
    {
        $sql = 'SELECT i.*, a1.nome AS nome_indicante, a1.email AS email_indicante, 
                       a2.nome AS nome_indicado, a2.email AS email_indicado
                FROM indicacoes i
                JOIN alunos a1 ON i.cpf_indicante = a1.cpf
                JOIN alunos a2 ON i.cpf_indicado = a2.cpf
                WHERE i.cpf_indicante = :cpf_indicante';

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':cpf_indicante', $cpf_indicante);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this->montarListaIndicacoes($dados);
    }

    public function buscarPorIndicanteEIndicado(Cpf $cpf_indicante, Cpf $cpf_indicado): Indicacao
    {
        $sql = 'SELECT i.*, a1.nome AS nome_indicante, a1.email AS email_indicante, 
                       a2.nome AS nome_indicado, a2.email AS email_indicado
                FROM indicacoes i
                JOIN alunos a1 ON i.cpf_indicante = a1.cpf
                JOIN alunos a2 ON i.cpf_indicado = a2.cpf
                WHERE i.cpf_indicante = :cpf_indicante AND i.cpf_indicado = :cpf_indicado';

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':cpf_indicante', $cpf_indicante);
        $stmt->bindValue(':cpf_indicado', $cpf_indicado);
        $stmt->execute();
        $dados = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$dados) {
            throw new \DomainException('Indicação não encontrada.');
        }

        return $this->montarIndicacao($dados);
    }

    public function buscarTodos(): array
    {
        $sql = 'SELECT i.*, a1.nome AS nome_indicante, a1.email AS email_indicante, 
                       a2.nome AS nome_indicado, a2.email AS email_indicado
                FROM indicacoes i
                JOIN alunos a1 ON i.cpf_indicante = a1.cpf
                JOIN alunos a2 ON i.cpf_indicado = a2.cpf';

        $stmt = $this->conexao->query($sql);
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this->montarListaIndicacoes($dados);
    }

    private function montarListaIndicacoes(array $dados): array
    {
        $indicacoes = [];
        foreach ($dados as $linha) {
            $indicacoes[] = $this->montarIndicacao($linha);
        }
        return $indicacoes;
    }

    private function montarIndicacao(array $dados): Indicacao
    {
        $indicante = Aluno::comCpfNomeEEmail($dados['cpf_indicante'], $dados['nome_indicante'], $dados['email_indicante']);
        $indicado = Aluno::comCpfNomeEEmail($dados['cpf_indicado'], $dados['nome_indicado'], $dados['email_indicado']);

        $indicacao = new Indicacao($indicante, $indicado);
        return $indicacao;
    }
}
