<?php

declare(strict_types=1);

/*
 * PaypalServerSdkLib
 *
 * This file was automatically generated by APIMATIC v3.0 ( https://www.apimatic.io ).
 */

namespace PaypalServerSdkLib\Models\Builders;

use Core\Utils\CoreHelper;
use PaypalServerSdkLib\Models\BancontactPaymentRequest;
use PaypalServerSdkLib\Models\ExperienceContext;

/**
 * Builder for model BancontactPaymentRequest
 *
 * @see BancontactPaymentRequest
 */
class BancontactPaymentRequestBuilder
{
    /**
     * @var BancontactPaymentRequest
     */
    private $instance;

    private function __construct(BancontactPaymentRequest $instance)
    {
        $this->instance = $instance;
    }

    /**
     * Initializes a new bancontact payment request Builder object.
     */
    public static function init(string $name, string $countryCode): self
    {
        return new self(new BancontactPaymentRequest($name, $countryCode));
    }

    /**
     * Sets experience context field.
     */
    public function experienceContext(?ExperienceContext $value): self
    {
        $this->instance->setExperienceContext($value);
        return $this;
    }

    /**
     * Initializes a new bancontact payment request object.
     */
    public function build(): BancontactPaymentRequest
    {
        return CoreHelper::clone($this->instance);
    }
}
