<?php
class CandidaturaModel
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function buscarPorVaga($vagaId)
    {
        $sql = "SELECT candidaturas.*, candidatos.nome, candidatos.email, status_candidatura.descricao AS status
                FROM candidaturas
                JOIN candidatos ON candidatos.id = candidaturas.candidato_id
                JOIN status_candidatura ON status_candidatura.id = candidaturas.status_candidatura_id
                WHERE candidaturas.vaga_id = :vaga_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['vaga_id' => $vagaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($candidatoId, $vagaId)
    {
        $stmt = $this->db->prepare("INSERT INTO candidaturas (candidato_id, vaga_id) VALUES (:candidato_id, :vaga_id)");
        $stmt->execute(['candidato_id' => $candidatoId, 'vaga_id' => $vagaId]);
        return $this->db->lastInsertId();
    }


    public function listarStatus()
    {
        $stmt = $this->db->prepare("SELECT * FROM status_candidatura");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function atualizarStatus($id, $statusId)
    {
        $stmt = $this->db->prepare("UPDATE candidaturas SET status_candidatura_id = :status WHERE id = :id");
        $stmt->execute(['status' => $statusId, 'id' => $id]);
        return $stmt->rowCount();
    }

    public function excluir($id)
    {
        $stmt = $this->db->prepare("DELETE FROM candidaturas WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }
}
