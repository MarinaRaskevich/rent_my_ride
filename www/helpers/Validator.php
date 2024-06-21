<?php
// require 'validatorRules/RequiredRule.php';
// require 'validatorRules/MaxRule.php';
// require 'validatorRules/RegexRule.php';

class Validator
{
    private static $classContainer = [
        'required' => RequiredRule::class,
        'max' => MaxRule::class,
        'regex' => RegexRule::class
        // 'date' => DateRule::class,
    ];
    private static $errors;
    public static function validate($data, $rules): void
    {

        foreach ($rules as $field => $rulesList) {
            $rulesArray = explode('|', $rulesList);
            foreach ($rulesArray as $rule) {
                $ruleOptions = explode(':', $rule, 2);
                $ruleName = $ruleOptions[0];
                $ruleParam = $ruleOptions[1] ?? null;

                $value = $data[$field];
                $ruleInstance = is_null($ruleParam)
                    ? new self::$classContainer[$ruleName]
                    : new self::$classContainer[$ruleName]($ruleParam);
                if (!$ruleInstance->isValid($value))
                    self::$errors[$field][] = $ruleInstance->message($field);
            }
        }
    }
    public static function getErrors()
    {
        return self::$errors;
    }
}
