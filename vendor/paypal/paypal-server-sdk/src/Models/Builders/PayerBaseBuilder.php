<?php

declare(strict_types=1);

/*
 * PaypalServerSdkLib
 *
 * This file was automatically generated by APIMATIC v3.0 ( https://www.apimatic.io ).
 */

namespace PaypalServerSdkLib\Models\Builders;

use Core\Utils\CoreHelper;
use PaypalServerSdkLib\Models\PayerBase;

/**
 * Builder for model PayerBase
 *
 * @see PayerBase
 */
class PayerBaseBuilder
{
    /**
     * @var PayerBase
     */
    private $instance;

    private function __construct(PayerBase $instance)
    {
        $this->instance = $instance;
    }

    /**
     * Initializes a new payer base Builder object.
     */
    public static function init(): self
    {
        return new self(new PayerBase());
    }

    /**
     * Sets email address field.
     */
    public function emailAddress(?string $value): self
    {
        $this->instance->setEmailAddress($value);
        return $this;
    }

    /**
     * Sets payer id field.
     */
    public function payerId(?string $value): self
    {
        $this->instance->setPayerId($value);
        return $this;
    }

    /**
     * Initializes a new payer base object.
     */
    public function build(): PayerBase
    {
        return CoreHelper::clone($this->instance);
    }
}
