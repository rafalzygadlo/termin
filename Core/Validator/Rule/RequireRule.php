<?php

namespace Core\Validator\Rules;
 use Core\Database;
class RequireRule 
{
    
    public function __construct(Database $db, string $table, string $column) 
    {
        $this->db = $db;
        $this->table = $table;
        $this->column = $column;
    }

    public function Run($value): bool 
    {
         if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $this->addError($field, "The {$field} must be a valid email address.");
    }
    }

    public function Message(): string
    {
        return "Wartość już istnieje.";
    }
}
