<?php namespace sgoendoer\Sonic\examples;

require_once(__DIR__ . '/../../../../vendor/autoload.php');

use sgoendoer\Sonic\Sonic;
use sgoendoer\Sonic\Identity\EntityAuthData;
use sgoendoer\Sonic\Identity\SocialRecordManager;

try
{
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// importing SocialRecord objects to work with
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// load SocialRecords from files to instatiaze the Sonic framework
	$srp = SocialRecordManager::importSocialRecord(file_get_contents(__DIR__ . '/data/SRPlatform.json'));
	$platformSocialRecord = $srp['socialRecord'];
	$platformAccountKeyPair = $srp['accountKeyPair'];
	$platformPersonalKeyPair = $srp['personalKeyPair'];

	$source = SocialRecordManager::importSocialRecord(file_get_contents(__DIR__ . '/data/SRAlice.json'));
	$sourceSocialRecord = $source['socialRecord'];
	$userAccountKeyPair = $sra['accountKeyPair'];
	$userPersonalKeyPair = $sra['personalKeyPair'];

	$target = SocialRecordManager::importSocialRecord(file_get_contents(__DIR__ . '/data/SRBob.json'));
	$targetSocialRecord = $target['socialRecord'];


  # SONIC Trust Example
	print("Trust Value Is: \n");
	print_r(SocialRecordManager::trustPath($sourceSocialRecord, $targetSocialRecord));
}
catch (\Exception $e)
{
	die($e->getMessage() . "\n\n" . $e->getTraceAsString());
}

?>
