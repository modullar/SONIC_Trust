<?php namespace sgoendoer\Sonic\Identity;

use sgoendoer\Sonic\Identity\GID;

/**
  * Class to describes the trustor object in trustors relationshiop
 */
class Trustor
{

  private static $MAX_TRUST_VALUE = 10;
  private static $MIN_TRUST_VALUE = 0;

  const JSONLD_CONTEXT		= 'http://sonic-project.net/';
	const JSONLD_TYPE			= 'trustor';

  private $globalID             = NULL;
  private $socialRecordURL     = NULL;
  private $trustValue           = NULL;



  public function __construct(TrustorBuilder $builder)
	{
		$this->globalID			      = $builder->getGlobalID();
		$this->trustValue		      = $builder->getTrustValue();
    $this->socialRecordURL		= $builder->getsocialRecordURL();
	}

  public function __toString()
	{
		return $this->getJSONString();
	}

  /**
	 * @deprecated
	 */
	public function getJSON()
	{
		return $this->getJSONString();
	}


  public function getJSONString()
	{
		return '{'
				. '"@context": "' .	Trustor::JSONLD_CONTEXT . '",'
				. '"@type": "' .	Trustor::JSONLD_TYPE . '",'
				. '"globalID": "' .		$this->globalID . '",'
				. '"trustValue": "' . $this->trustValue . '",'
				. '}';
	}

  public function getJSONObject()
	{
		return json_decode($this->getJSONString());
	}

  public function getGlobalID()
	{
		return $this->globalID;
	}

  public function getTrustValue()
	{
		return $this->trustValue;
	}

  public function getSocialRecordURL()
	{
		return $this->socialRecordURL;
	}

	/**
	 * Determines if the format of a given Trustor is valid.
	 *
	 * @param trustor
	 *
	 * @return true if the format of trustor is a valid, else false
	 */
	public static function isValid($trustor)
	{
    if (is_null($trustor['gid']) and is_null($trustor['trustValue']))
    {
      return false;
      if(!GID::isValid($trustor['gid']) and !isTrustValueValid($trustor['trustValue']))
      {
        return false;
      }
    }
		return true;
	}

  /* Verfiy trust value */
  public static function isTrustValueValid($trustValue){
    if (($trustValue > self::$MAX_TRUST_VALUE) or ($trustValue < self::$MIN_TRUST_VALUE))
      return false;
    return true;
  }

}

?>
