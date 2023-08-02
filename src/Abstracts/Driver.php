<?php

namespace Martian\SpamMailChecker\Abstracts;

use GuzzleHttp\Client;
use Martian\SpamMailChecker\Builders\ConfigBuilder;
use Martian\SpamMailChecker\Contracts\DriverInterface;
use QuickEmailVerification\Client as QuickEmailVerificationClient;

abstract class Driver implements DriverInterface
{
    /**
     * @var ConfigBuilder
     */
    protected $config;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var QuickEmailVerification
     */
    protected $quickEmailVerification;

    /**
     * Driver constructor.
     */
    public function __construct()
    {
        $this->config = new ConfigBuilder();
        $this->client = new Client();
        $this->quickEmailVerification = new QuickEmailVerificationClient();
    }

    /**
     * Validate the email.
     * 
     * @return bool
     */
    abstract public function validate(string $email): bool;

    /**
     * Get the email domain.
     * 
     * @param string $email
     * @return string
     */
    protected function getDomain(string $email): string
    {
        return strtolower(substr(strrchr($email, "@"), 1));
    }
}