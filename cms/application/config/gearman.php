<?php
/**
 * Gearman custom config file.
 */

$ENVIRONMENT = isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development';

if ($ENVIRONMENT=="staging")
{
	$config['gearman_server'] = array('db');
	$config['gearman_port'] = array('4730');
}
else if ($ENVIRONMENT=="production")
{
	$config['gearman_server'] = array('np-db-1');
	$config['gearman_port'] = array('4730');	
}
else
{
	$config['gearman_server'] = array('localhost');
	$config['gearman_port'] = array('4730');
}