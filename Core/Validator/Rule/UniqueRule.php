<?php

namespace Core\Validator\Rules;
 use Core\Database;
class UniqueRule 
{
   

    public function Run($value): bool 
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE {$this->column} = ?");
        $stmt->execute([$value]);
        return $stmt->fetchColumn() == 0;
    }

    public function Message(): string
    {
        return "Wartość już istnieje.";
    }
}
