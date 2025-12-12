<?php

namespace Core\Validator\Rules;
class UniqueRule 
{
    private PDO $db;
    private string $table;
    private string $column;

    public function __construct(PDO $db, string $table, string $column) 
    {
        $this->db = $db;
        $this->table = $table;
        $this->column = $column;
    }

    public function run($value): bool 
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE {$this->column} = ?");
        $stmt->execute([$value]);
        return $stmt->fetchColumn() == 0;
    }

    public function message(): string
    {
        return "Wartość już istnieje.";
    }
}
