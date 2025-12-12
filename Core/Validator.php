<?php

namespace Core;

use Core\Database;

class Validator
{
    private array $data;
    private array $rules;
    public array $errors = [];
    private ?Database $db;

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->db = $db;
    }

    public function Run(): bool
    {
        foreach ($this->rules as $field => $rules) {
            $value = $this->post($field);

            foreach ($rules as $rule) 
            {
                
                [$ruleName, $param] = $this->parseRule($rule);

                $method = 'validate' . ucfirst($ruleName);
                if (method_exists($this, $method)) 
                {
                    $this->$method($field, $value, $param);
                }
            }
        }

        return empty($this->errors);
    }



    public function validated(): array
    {
        $valid = [];
        foreach ($this->rules as $field => $ruleObjects) 
        {
            if (!isset($this->errors[$field]) && array_key_exists($field, $this->data)) {
                $valid[$field] = $this->data[$field];
            }
        }
        return $valid;
    }

    protected function parseRule(string $rule): array
    {
        if (strpos($rule, ':') !== false) {
            $parts = explode(':', $rule, 2);
            return [$parts[0], $parts[1]];
        }
        return [$rule, null];
    }

    // przykładowe metody walidacji
    protected function validateRequired($field, $value, $param)
    {
        if (empty($value)) {
            $this->addError($field, "The {$field} field is required.");
        }
    }

    protected function validateEmail($field, $value, $param)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "The {$field} must be a valid email address.");
        }
    }

    protected function validateMin($field, $value, $param)
    {
        if (strlen($value) < (int) $param) {
            $this->addError($field, "The {$field} must be at least {$param} characters.");
        }
    }

    protected function validateUnique($field, $value, $param)
    {
        // $param = "users,email"
        [$table, $column] = explode(',', $param);
        $stmt = $this->db->prepare("SELECT id FROM {$table} WHERE {$column} = ?");
        $stmt->execute([$value]);
        if ($stmt->rowCount() > 0) {
            $this->addError($field, "The {$field} has already been taken.");
        }
    }

}
