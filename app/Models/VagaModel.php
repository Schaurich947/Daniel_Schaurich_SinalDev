<?php
class VagaModel
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function buscarTodos()
    {
        $sql = "SELECT vagas.*, empresas.nome_fantasia
                FROM vagas
                JOIN empresas ON empresas.id = vagas.empresa_id
                ORDER BY vagas.criado_em DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM vagas WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados)
    {
        $sql = "INSERT INTO vagas (empresa_id, titulo, descricao, disponibilidade_id, estado, cidade)
                VALUES (:empresa_id, :titulo, :descricao, :disponibilidade_id, :estado, :cidade)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'empresa_id' => $dados['empresa_id'],
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'] ?? null,
            'disponibilidade_id' => $dados['disponibilidade_id'] ?? null,
            'estado' => $dados['estado'] ?? null,
            'cidade' => $dados['cidade'] ?? null,
        ]);
        return $this->db->lastInsertId();
    }

    public function atualizar($id, $dados)
    {
        $sql = "UPDATE vagas SET titulo = :titulo, descricao = :descricao, disponibilidade_id = :disponibilidade_id,
                estado = :estado, cidade = :cidade, ativa = :ativa WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'] ?? null,
            'disponibilidade_id' => $dados['disponibilidade_id'] ?? null,
            'estado' => $dados['estado'] ?? null,
            'cidade' => $dados['cidade'] ?? null,
            'ativa' => $dados['ativa'] ?? 1,
            'id' => $id,
        ]);
        return $stmt->rowCount();
    }

    public function excluir($id)
    {
        $stmt = $this->db->prepare("DELETE FROM vagas WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }
}