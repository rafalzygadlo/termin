<?php

namespace Core;

use Core\Database;

class Validator
{
    private array $data;
    private array $rules;
    public array $errors = [];
    private ?Database $db;

    public function __construct(array $data, array $rules, ?Database $db = null)
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->db = $db;
    }

    public function Run(): bool
    {
        
        foreach ($this->rules as $field => $rules) 
        {
        
            $value = $this->data[$field] ?? null;

            foreach ($rules as $rule) 
            {        
                [$ruleName, $param] = $this->ParseRule($rule);

                $method = ucfirst($ruleName);
                if (method_exists($this, $method)) 
                {
                    $this->$method($field, $value, $param);
                }
            }
        }

        return empty($this->errors);
    }


    public function Validated(): array
    {
        $valid = [];
        foreach ($this->rules as $field => $ruleObjects) 
        {
            if (!isset($this->errors[$field]) && array_key_exists($field, $this->data)) 
            {
                $valid[$field] = $this->data[$field];
            }
        }

        return $valid;
    }

    protected function ParseRule(string $rule): array
    {
        if (strpos($rule, ':') !== false) 
        {
            $parts = explode(':', $rule, 2);
            return [$parts[0], $parts[1]];
        }
        return [$rule, null];
    }

    protected function AddError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }

    // Example validation methods
    protected function Required($field, $value, $param)
    {
        if (empty($value)) 
        {
            $this->AddError($field, str_replace(':field', $field, __('validation.required')));
        }
    }

    protected function Email($field, $value, $param)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) 
        {
            $this->AddError($field, str_replace(':field', $field, __('validation.email')));
        }
    }

    protected function Min($field, $value, $param)
    {
        if (strlen($value) < (int) $param) 
        {
            $message = str_replace([':field', ':min'], [$field, $param], __('validation.min'));
            $this->AddError($field, $message);
        }
    }

    protected function Unique($field, $value, $param)
    {
        // $param = "users,email"
        if (!$this->db) 
        {
            // Throw an exception or ignore the rule if there is no database connection
            // throw new \Exception("Database connection not provided to Validator for 'unique' rule.");
            return;
        }

        [$table, $column] = explode(',', $param);
        // Secure table and column names to prevent SQL Injection
        $stmt = $this->db->prepare("SELECT `id` FROM `{$table}` WHERE `{$column}` = ?");
        $stmt->execute([$value]);
        if ($stmt->rowCount() > 0) 
        {
            $this->AddError($field, str_replace(':field', $field, __('validation.unique')));
        }
    }

}
