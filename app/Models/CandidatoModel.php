<?php
class CandidatoModel
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function buscarTodos()
    {
        $stmt = $this->db->prepare("SELECT * FROM candidatos");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM candidatos WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM candidatos WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados)
    {
        $sql = "INSERT INTO candidatos (nome, email, senha, telefone, data_nascimento, pais, estado, cidade, disponibilidade_id)
                VALUES (:nome, :email, :senha, :telefone, :data_nascimento, :pais, :estado, :cidade, :disponibilidade_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'senha' => password_hash($dados['senha'], PASSWORD_DEFAULT),
            'telefone' => $dados['telefone'] ?? null,
            'data_nascimento' => $dados['data_nascimento'] ?? null,
            'pais' => $dados['pais'] ?? 'Brasil',
            'estado' => $dados['estado'] ?? null,
            'cidade' => $dados['cidade'] ?? null,
            'disponibilidade_id' => $dados['disponibilidade_id'] ?? null,
        ]);
        return $this->db->lastInsertId();
    }

    public function atualizar($id, $dados)
    {
        $sql = "UPDATE candidatos SET nome = :nome, email = :email, telefone = :telefone,
                data_nascimento = :data_nascimento, pais = :pais, estado = :estado, cidade = :cidade,
                disponibilidade_id = :disponibilidade_id WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'telefone' => $dados['telefone'] ?? null,
            'data_nascimento' => $dados['data_nascimento'] ?? null,
            'pais' => $dados['pais'] ?? 'Brasil',
            'estado' => $dados['estado'] ?? null,
            'cidade' => $dados['cidade'] ?? null,
            'disponibilidade_id' => $dados['disponibilidade_id'] ?? null,
            'id' => $id,
        ]);
        return $stmt->rowCount();
    }

    public function excluir($id)
    {
        $stmt = $this->db->prepare("DELETE FROM candidatos WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }
}
