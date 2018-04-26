<?php
namespace zipMoney\Model;

class CatchMetadata extends Metadata{

  public function __construct(){

    /* E.g The following can be changed to whatever */
    self::$swaggerTypes  = array("session_id" => "string");
    self::$attributeMap  = array("session_id" => "session_id");
    self::$setters  = array("session_id" => "setSessionId");
    self::$getters  = array("session_id" => "getSessionId");


    self::_setDiscriminator();
  }

  public function __call($methodName, $params = null)
  {
      $methodPrefix = substr($methodName, 0, 3);
      $key = strtolower(substr($methodName, 3));
      if($methodPrefix == 'set' && count($params) == 1)
      {
          $value = $params[0];
          $this->container[$key] = $value;
      }
      elseif($methodPrefix == 'get')
      {
          if(isset($this->container) && array_key_exists($key, $this->container)) return $this->container[$key];
      }
      else
      {
          exit('Opps! The method is not defined!');
      }
  }

  private function _setDiscriminator(){
    self::$swaggerTypes["subclass"] = "string";
    self::$attributeMap["subclass"] = "subclass";
    self::$setters["subclass"] = "setSubclass";
    self::$getters['subclass'] = "getSubclass";

    self::setSubclass(substr(self::class, strrpos(self::class, '\\')+1));
  }
}