<?php
require_once __DIR__ . '/../../config/config.php';

class RegexRule
{
    public function __construct(
        private string $regex
    ) {
    }

    public function isValid($data): bool
    {
        if ($this->regex == 'registration') {
            return filter_var($data, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_REGISTRATION . '/')));
        } else if ($this->regex == 'mileage') {
            return filter_var($data, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/' . REGEX_MILEAGE . '/')));
        }
    }
    public function message($property): string
    {
        return 'Le format saisi est incorrect';
    }
}
