<?php

/**
 * ConfigurationTest
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

use \zipMoney\Configuration;

class ConfigurationTest extends Setup
{
    public function testPlatform()
    {
        $config = Configuration::getDefaultConfiguration();

        $config->setPlatform("Magento/1.0.0");
        $this->assertEquals($config->getPlatform(), "Magento/1.0.0");
    }

    public function testEnvironment()
    {
        $config = Configuration::getDefaultConfiguration();

        $config->setEnvironment("sandbox");
        $this->assertEquals($config->getEnvironment(), "sandbox");
        $this->assertEquals($config->getHost(), "https://global-api.sand.au.edge.zip.co/merchant");

        $config->setEnvironment("production");
        $this->assertEquals($config->getEnvironment(), "production");
        $this->assertEquals($config->getHost(), "https://global-api.prod.au.edge.zip.co/merchant");
    }

    public function testApiHeaders()
    {
        $config = Configuration::getDefaultConfiguration();

        $config->setPlatform("Magento/1.0.0")
            ->setDefaultHeaders("sandbox");
        $packageJson = file_get_contents(dirname(__FILE__)."./../composer.json");
        $data = json_decode($packageJson);
        $version = $data->version;

        $this->assertEquals($config->getUserAgent(), "Magento/1.0.0 merchantapi-php/" . $version);
        $this->assertEquals($config->getDefaultHeaders(), array("Zip-Version" => "2017-03-01"));
    }

    public function testPackageVersion()
    {
        $config = Configuration::getDefaultConfiguration();
        $packageJson = file_get_contents(dirname(__FILE__)."./../composer.json");
        $data = json_decode($packageJson);
        $this->assertEquals($config->getPackageVersion(), $data->version);
    }
}
