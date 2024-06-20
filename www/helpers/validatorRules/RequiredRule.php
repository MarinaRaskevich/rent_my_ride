<?php

class RequiredRule
{
    public function isValid($data): bool
    {
        return isset($data) && $data != '';
    }
    public function message($property): string
    {
        return 'Ce champ est obligatoire';
    }
}
