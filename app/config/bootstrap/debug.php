<?php

/**
 * General info:
 *		Embed this code in your lithium (li3) app.
 *		At the end of the app\config\connections.php for example.
 *
 *		Uncomment the var_dump lines OR use the lithium Logger Class
 *		Use/modify the first callback, if you just want to see the query array data.
 *		Use the second callback for dumping the raw sql data.
 *
 * @author: 2011 weluse GmbH, Marc Schwering
 */
use lithium\data\Connections;
use lithium\analysis\Logger;
use lithium\action\Dispatcher;
use lithium\core\Environment;

Logger::config(array(
    'default' => array('adapter' => 'FirePhp'),
));

Dispatcher::applyFilter('_call', function($self, $params, $chain) {
    if (isset($params['callable']->response)) {
        Logger::adapter('default')->bind($params['callable']->response);
    }
    return $chain->next($self, $params, $chain);
});



foreach(Connections::get() as $connection_name) {
	
	Connections::get($connection_name)->applyFilter("read", function($self, $params, $chain) {
		$response = $chain->next($self, $params, $chain);
		if (is_a($params['query'], 'lithium\data\model\Query')) {
			/**
			 * dump the query-object-data as array:
			 */
			//var_dump($params['query']->export($self));

			/**
			 * dump the result:
			 */
			//var_dump($res->data());
		} //
		return $response;
	});

	Connections::get($connection_name)->applyFilter("_execute", function($self, $params, $chain) {
		$response = $chain->next($self, $params, $chain);
		if (!Environment::is('production')) {
			Logger::info(print_r($params['sql'],true));
		}
		return $response;
	});

}

/**
 * Inspect the message, and do a string conversion via print_r
 *
 * @author: 2011 weluse GmbH, Marc Schwering
 */
Logger::applyFilter('write', function ($self, $params, $chain){
	$var = $params['message'];
	if(is_array($var) || is_object($var)){
		$params['message'] = print_r($var,true);
	}
	return $chain->next($self, $params, $chain);
});

?>