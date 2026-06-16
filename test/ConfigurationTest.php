<?php

declare(strict_types=1);

/**
 * ConfigurationTest.
 *
 * @category Class
 *
 * @see     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

class ConfigurationTest extends Setup
{
    public function testPlatform(): void
    {
        $config = Configuration::getDefaultConfiguration();

        $config->setPlatform('Magento/1.0.0');
        $this->assertEquals($config->getPlatform(), 'Magento/1.0.0');
    }

    public function testEnvironment(): void
    {
        $config = Configuration::getDefaultConfiguration();

        $config->setEnvironment('sandbox');
        $this->assertEquals($config->getEnvironment(), 'sandbox');
        $this->assertEquals($config->getHost(), 'https://sand.merchant-api.com/merchant');

        $config->setEnvironment('production');
        $this->assertEquals($config->getEnvironment(), 'production');
        $this->assertEquals($config->getHost(), 'https://merchant-api.com/merchant');
    }

    public function testApiHeaders(): void
    {
        $config = Configuration::getDefaultConfiguration();

        $config->setPlatform('Magento/1.0.0')->setDefaultHeaders();
        $packageJson = file_get_contents(__DIR__ . './../composer.json');
        $data = json_decode($packageJson);
        $version = $data->version;

        $this->assertEquals($config->getUserAgent(), 'Magento/1.0.0 merchantapi-php/' . $version);
        $this->assertEquals($config->getDefaultHeaders(), ['Zip-Version' => '2017-03-01']);
    }

    public function testPackageVersion(): void
    {
        $config = Configuration::getDefaultConfiguration();
        $packageJson = file_get_contents(__DIR__ . './../composer.json');
        $data = json_decode($packageJson);
        $this->assertEquals($config->getPackageVersion(), $data->version);
    }
}
