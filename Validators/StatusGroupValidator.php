<?php

namespace Dev\LaravelStatusModule\Validators;

class StatusGroupValidator
{
    public function validateMandatoryFields(array $data, array $fields): void
    {
        foreach ($fields as $field) {
            if (!array_key_exists($field, $data)) {
                throw new \Exception("Field $field is required");
            }
        }
    }
}
