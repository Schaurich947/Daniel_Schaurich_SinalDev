<?php
class DisponibilidadeModel
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function listarTodos()
    {
        $stmt = $this->db->prepare("SELECT * FROM disponibilidades");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}