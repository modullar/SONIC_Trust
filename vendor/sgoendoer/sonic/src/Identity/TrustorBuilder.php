<?php namespace sgoendoer\Sonic\Identity;

use sgoendoer\Sonic\Identity\GID;
use sgoendoer\Sonic\Identity\Trustor;

class TrustorBuilder{
  private $globalID   = NULL;
  private $trustValue = NULL;

  private static $MAX_TRUST_VALUE = 10;
  private static $MIN_TRUST_VALUE = 0;

  public function __construct(){
  }

  public static function buildFromJSON($json){


    if(!property_exists($json, 'globalID'))
			throw new SocialRecordFormatException('Trustor: Property globalID is missing!');
		if(!property_exists($json, 'trustValue'))
			throw new SocialRecordFormatException('Trustor: Property $trustValue is missing!');


    return (new TrustorBuilder())
				->globalID($json->globalID)
				->trustValue($json->trustValue)
				->build();
  }

  public function getGlobalID()
	{
		return $this->globalID;
	}

	public function globalID($globalID)
	{
		$this->globalID = $globalID;

		return $this;
	}

	public function getTrustValue()
	{
		return $this->trustValue;
	}

	public function trustValue($trustValue)
	{
		$this->trustValue = $trustValue;

		return $this;
	}

	public function build(){
    if($this->globalID == NULL)
			throw new \Exception('globalID is not set');
		if($this->trustValue == NULL)
			throw new \Exception('trustValue is not set');
    if(!GID::isValid($this->globalID))
			throw new \Exception('Invalid value for GlobalID');
    if(!Trustor::isTrustValueValid($this->trustValue))
			throw new \Exception('Invalid value for TrustValue');
    return new Trustor($this);
  }

  /* Verfiy trust value */

}
