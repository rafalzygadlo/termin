<?php

namespace Core\Request;
use Core\Validator;

abstract class FormRequest extends Request
{
    protected array $errors = [];

    /**
     * Defines the validation rules.
     * Should return an array in the format: ['field' => ['rule1', 'rule2']].
     * @return array
     */
    abstract public function rules(): array;

    public function validate(): array|false 
    {
        $validator = new Validator($this->post(), $this->rules());

        if (!$validator->validate()) 
        {
        return false;
        }

        return $this->post();
    }

    /**
     * Runs the validation process.
     * @return bool Returns true if validation passes, false otherwise.
     */
    /*
    public function Validate(): bool
    {
        foreach ($this->rules() as $field => $rules) {
            $value = $this->post($field);
            foreach ($rules as $rule) {
                // Handle 'required' rule
                if ($rule === 'required' && empty($value)) {
                    $this->addError($field, "The {$field} field is required.");
                }

                // Handle 'email' rule
                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, "The {$field} field must be a valid email address.");
                }

                // Handle 'min:length' rule
                if (strpos($rule, 'min:') === 0) {
                    $minLength = (int) substr($rule, 4);
                    if (strlen($value) < $minLength) {
                        $this->addError($field, "The {$field} field must be at least {$minLength} characters.");
                    }
                }
                // Handle 'unique:table,column' rule
                if (strpos($rule, 'unique:') === 0) {
                    // parsujemy tabelę i kolumnę
                    list($table, $column) = explode(',', substr($rule, 7));

                    $stmt = $this->db->prepare("SELECT id FROM {$table} WHERE {$column} = ?");
                    $stmt->execute([$value]);
                    if ($stmt->rowCount() > 0) {
                        $this->addError($field, "The {$field} has already been taken.");
                    }
                }

            }
        }

        return empty($this->errors);
    }
    */
    /**
     * Adds an error message for a given field.
     * @param string $field
     * @param string $message
     */
    protected function AddError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }

    /**
     * Returns the validation errors.
     * @return array
     */
    public function GetErrors(): array
    {
        return $this->errors;
    }
}