<?php

class AgeRule
{
    public function isValid($data): bool
    {
        $birthdate = new DateTime($data);
        $today = new DateTime();

        $age = $today->diff($birthdate)->y;
        return $age >= 18;
    }
    public function message($property): string
    {
        return 'Vous devez avoir plus de 18 ans';
    }
}
