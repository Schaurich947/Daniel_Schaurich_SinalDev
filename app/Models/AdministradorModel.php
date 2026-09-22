<?php
class AdministradorModel
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function buscarPorEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM administradores WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}