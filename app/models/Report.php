<?php
/**
 * Report Model
 * Handles user reports for abuse, disputes, inappropriate content.
 */
require_once dirname(__DIR__) . '/core/model.php';
class Report extends Model
{
    protected string $table = 'report';
    protected string $primaryKey = 'id';

    public function createReport($reporterId, $reportedType, $reportedId, $reason, $description) {
        $id = $this->generateUuid();
        $this->create([
            'id' => $id,
            'reporter_id' => $reporterId,
            'reported_type' => $reportedType,
            'reported_id' => $reportedId,
            'reason' => $reason,
            'description' => $description,
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return $id;
    }

    public function getReports($status = null) {
        $sql = "SELECT r.*, 
                       a.email as reporter_email,
                       p.first_name as reporter_first_name,
                       p.last_name as reporter_last_name,
                       CONCAT(COALESCE(p.first_name, ''), ' ', COALESCE(p.last_name, '')) as reporter_name
                FROM {$this->table} r
                LEFT JOIN user_profile p ON r.reporter_id = p.id
                LEFT JOIN account a ON p.account_id = a.id";
        $params = [];
        if ($status) {
            $sql .= " WHERE r.status = ?";
            $params[] = $status;
        }
        $sql .= " ORDER BY r.created_at DESC";
        return $this->db->fetchAll($sql, $params);
    }

    public function getReportWithReporter($id) {
        $sql = "SELECT r.*, 
                       a.email as reporter_email,
                       p.first_name as reporter_first_name,
                       p.last_name as reporter_last_name,
                       CONCAT(COALESCE(p.first_name, ''), ' ', COALESCE(p.last_name, '')) as reporter_name
                FROM {$this->table} r
                LEFT JOIN user_profile p ON r.reporter_id = p.id
                LEFT JOIN account a ON p.account_id = a.id
                WHERE r.id = ?";
        return $this->db->fetchOne($sql, [$id]);
    }

    public function updateStatus($id, $status) {
        return $this->update($id, ['status' => $status]);
    }

    private function generateUuid(): string {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
