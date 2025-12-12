<?php 

namespace Core;
class Validator 
{
    private array $data;
    private array $rules;
    public array $errors = [];

    public function __construct(array $data, array $rules) 
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate(): bool 
    {
        foreach ($this->rules as $field => $ruleObjects) 
        {
            $value = $this->data[$field] ?? null;

            foreach ($ruleObjects as $rule) 
            {
                if (!$rule->run($value)) 
                {
                    $this->errors[$field][] = $rule->message();
                }
            }
        }
        return empty($this->errors);
    }
}
