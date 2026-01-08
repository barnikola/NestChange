<?php

require_once __DIR__ . '/../core/model.php';

class LegalContent extends Model
{
    public function getAll(): array
    {
        return $this->db->fetchAll("SELECT * FROM legal_content ORDER BY title ASC");
    }

    public function getByType(string $type): ?array
    {
        $result = $this->db->fetchOne("SELECT * FROM legal_content WHERE type = ?", [$type]);
        return $result ?: null;
    }

    public function updateContent(string $type, string $title, string $content): bool
    {
        // Upsert logic if we want to be safe, but update is sufficient as we seeded
        $exists = $this->getByType($type);
        if ($exists) {
            $this->db->query(
                "UPDATE legal_content SET title = ?, content = ? WHERE type = ?",
                [$title, $content, $type]
            );
        } else {
            $this->db->query(
                "INSERT INTO legal_content (type, title, content) VALUES (?, ?, ?)",
                [$type, $title, $content]
            );
        }
        return true;
    }
}
