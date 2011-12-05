<?php
/**
 * @author 2011 weluse GmbH, Marc Schwering
 */

use lithium\core\Environment;
use lithium\core\ConfigException;

Environment::is(function($request) {
		$http_host = $request->env('HTTP_HOST');
		//in array search example
		/*if (in_array($http_host, array('domain', 'domain2' , 'domain3'))) {
			return 'development';
		}
		if ($http_host == 'subdomain.weluse.de' || $http_host == 'domain.test') {
			return 'test';
		}*/
		//str pos search analouge to general environment detection:
		if (strpos($http_host, '.local')){
			ini_set("display_errors", 1);
			return 'development';
		}
		if (strpos($http_host,'.test') || strpos($http_host, '.weluse.de')){
			ini_set("display_errors", 1);
			return 'test';
		}
	return 'production';
});

$preferred_locales = array('de_DE.utf8', 'de_DE@euro', 'de_DE', 'de', 'ge');

$loc_de = setlocale (LC_ALL, $preferred_locales);

if(!in_array($loc_de, $preferred_locales)){
	$locales = implode(', ', $preferred_locales);
	throw new ConfigException('preferred Locale is not Supported: ' . $locales);
}
?>