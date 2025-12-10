<?php
/**
 * Base Model Class
 * 
 * Provides common database operations for all models.
 * All model classes should extend this base class.
 */

require_once __DIR__ . '/database.php';

abstract class Model
{
    protected Database $db;
    protected string $table;
    protected string $primaryKey = 'id';

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Find a record by its primary key
     * 
     * @param mixed $id The primary key value
     * @return array|false
     */
    public function find(mixed $id): array|false
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return $this->db->fetchOne($sql, [$id]);
    }

    /**
     * Find all records
     * 
     * @param string $orderBy Optional ORDER BY clause
     * @param int|null $limit Optional LIMIT
     * @param int $offset Optional OFFSET
     * @return array
     */
    public function findAll(string $orderBy = '', ?int $limit = null, int $offset = 0): array
    {
        $sql = "SELECT * FROM {$this->table}";
        
        if (!empty($orderBy)) {
            $sql .= " ORDER BY {$orderBy}";
        }
        
        if ($limit !== null) {
            $sql .= " LIMIT {$limit} OFFSET {$offset}";
        }
        
        return $this->db->fetchAll($sql);
    }

    /**
     * Find records by a specific column value
     * 
     * @param string $column Column name
     * @param mixed $value Column value
     * @return array
     */
    public function findBy(string $column, mixed $value): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} = ?";
        return $this->db->fetchAll($sql, [$value]);
    }

    /**
     * Find one record by a specific column value
     * 
     * @param string $column Column name
     * @param mixed $value Column value
     * @return array|false
     */
    public function findOneBy(string $column, mixed $value): array|false
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} = ? LIMIT 1";
        return $this->db->fetchOne($sql, [$value]);
    }

    /**
     * Find records matching multiple conditions
     * 
     * @param array $conditions Associative array of column => value
     * @return array
     */
    public function findWhere(array $conditions): array
    {
        $where = [];
        $params = [];
        
        foreach ($conditions as $column => $value) {
            $where[] = "{$column} = ?";
            $params[] = $value;
        }
        
        $sql = "SELECT * FROM {$this->table} WHERE " . implode(' AND ', $where);
        return $this->db->fetchAll($sql, $params);
    }

    /**
     * Create a new record
     * 
     * @param array $data Associative array of column => value
     * @return string The ID of the inserted record
     */
    public function create(array $data): string
    {
        $this->db->insert($this->table, $data);
        return $data[$this->primaryKey] ?? $this->db->lastInsertId();
    }

    /**
     * Update a record by its primary key
     * 
     * @param mixed $id The primary key value
     * @param array $data Associative array of column => value
     * @return int Number of affected rows
     */
    public function update(mixed $id, array $data): int
    {
        return $this->db->update($this->table, $data, "{$this->primaryKey} = ?", [$id]);
    }

    /**
     * Delete a record by its primary key
     * 
     * @param mixed $id The primary key value
     * @return int Number of affected rows
     */
    public function delete(mixed $id): int
    {
        return $this->db->delete($this->table, "{$this->primaryKey} = ?", [$id]);
    }

    /**
     * Count all records or records matching conditions
     * 
     * @param array $conditions Optional conditions
     * @return int
     */
    public function count(array $conditions = []): int
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        $params = [];
        
        if (!empty($conditions)) {
            $where = [];
            foreach ($conditions as $column => $value) {
                $where[] = "{$column} = ?";
                $params[] = $value;
            }
            $sql .= " WHERE " . implode(' AND ', $where);
        }
        
        $result = $this->db->fetchOne($sql, $params);
        return (int) $result['count'];
    }

    /**
     * Check if a record exists by its primary key
     * 
     * @param mixed $id The primary key value
     * @return bool
     */
    public function exists(mixed $id): bool
    {
        $sql = "SELECT 1 FROM {$this->table} WHERE {$this->primaryKey} = ? LIMIT 1";
        return $this->db->fetchOne($sql, [$id]) !== false;
    }

    /**
     * Execute a custom query
     * 
     * @param string $sql The SQL query
     * @param array $params Optional parameters
     * @return array
     */
    protected function raw(string $sql, array $params = []): array
    {
        return $this->db->fetchAll($sql, $params);
    }


    public function beginTransaction(): bool
    {
        return $this->db->beginTransaction();
    }


    public function commit(): bool
    {
        return $this->db->commit();
    }


    public function rollback(): bool
    {
        return $this->db->rollback();
    }
}
