<?php

class EmailRule
{
    public function isValid($data): bool
    {
        return filter_var($data, FILTER_VALIDATE_EMAIL) !== false;
    }
    public function message($property): string
    {
        return 'Le format n\'est pas correct';
    }
}
