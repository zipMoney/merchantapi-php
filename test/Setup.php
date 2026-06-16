<?php

declare(strict_types=1);

namespace zipMoney;

use PHPUnit\Framework\TestCase;
use zipMoney\Helper\Payload;

class Setup extends TestCase
{
    protected $_payloadHelper;

    /**
     * Setup before running each test case.
     */
    public function setUp(): void
    {
        $this->_payloadHelper = new Payload();

        $auth = parse_ini_file(__DIR__ . '/auth.ini');

        Configuration::getDefaultConfiguration()->setApiKey('Authorization', "Bearer {$auth['private_key']}");
        Configuration::getDefaultConfiguration()->setEnvironment('sandbox');
        Configuration::getDefaultConfiguration()->setSSLVerification(false);
    }
}
