<?php

declare(strict_types=1);

namespace System\Requests;

abstract class BaseRequest
{
    private $errors = [];

    private $fields = [];

    abstract public function validate(): bool;

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param  array  $fields
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * @param  string  $field
     * @param $value
     */
    public function setError(string $field, $value)
    {
        $this->errors[$field][] = $value;
    }
}
