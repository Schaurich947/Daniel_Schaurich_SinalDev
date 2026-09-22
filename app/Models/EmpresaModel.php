<?php
class EmpresaModel
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function buscarTodos()
    {
        $stmt = $this->db->prepare("SELECT * FROM empresas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM empresas WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM empresas WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados)
    {
        $sql = "INSERT INTO empresas (nome_fantasia, cnpj, email, senha, site)
                VALUES (:nome_fantasia, :cnpj, :email, :senha, :site)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nome_fantasia' => $dados['nome_fantasia'],
            'cnpj' => $dados['cnpj'] ?? null,
            'email' => $dados['email'],
            'senha' => password_hash($dados['senha'], PASSWORD_DEFAULT),
            'site' => $dados['site'] ?? null,
        ]);
        return $this->db->lastInsertId();
    }

    public function atualizar($id, $dados)
    {
        $sql = "UPDATE empresas SET nome_fantasia = :nome_fantasia, cnpj = :cnpj, email = :email, site = :site WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nome_fantasia' => $dados['nome_fantasia'],
            'cnpj' => $dados['cnpj'] ?? null,
            'email' => $dados['email'],
            'site' => $dados['site'] ?? null,
            'id' => $id,
        ]);
        return $stmt->rowCount();
    }

    public function excluir($id)
    {
        $stmt = $this->db->prepare("DELETE FROM empresas WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }
}
