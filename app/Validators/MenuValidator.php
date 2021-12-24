<?php

namespace App\Validators;

use Prettus\Validator\LaravelValidator;

/**
 * Class MenuValidator.
 *
 * @package namespace App\Validators;
 */
class MenuValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [],
        self::RULE_UPDATE => [],
    ];
}
