<?php
/**
 * @author 2011 weluse GmbH, Marc Schwering
 */

use lithium\core\Environment;

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
			return 'development';
		}
		if (strpos($http_host,'.test') || strpos($http_host, '.weluse.de')){
			return 'test';
		}
	return 'production';
});

?>