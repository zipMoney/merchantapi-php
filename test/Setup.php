<?php
namespace zipMoney;

use \zipMoney\Configuration;
use \zipMoney\ApiClient;
use \zipMoney\ApiException;
use \zipMoney\ObjectSerializer;
use \zipMoney\Helper\Payload;

class Setup  extends \PHPUnit_Framework_TestCase
{
  protected $_payloadHelper;

  /**
   * Setup before running each test case
   */
  public function setUp()
  {      
    $this->_payloadHelper = new Payload;

    Configuration::getDefaultConfiguration()->setApiKey('Authorization', "Bearer test");
    Configuration::getDefaultConfiguration()->setEnvironment("sandbox");

  }
}