<?php

class MaxRule
{
    public function __construct(
        private int $limit
    ) {
    }

    public function isValid($data): bool
    {
        return strlen($data) <= $this->limit;
    }
    public function message($property): string
    {
        return 'Trop de caractères. La taille autorisée est ' . $this->limit;
    }
}
