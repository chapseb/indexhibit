<?php define('SITE', 'Bonjour!');

// -----------------------------------------------------------
//
// 	WELCOME TO INDEXHIBIT
//
//  A collaboration between Daniel Eatock and Jeffery Vaska
//  Open source and free to use for good in this world.
//
// -----------------------------------------------------------

// turn this on if you want to check things
if (phpversion() >= 5.3)
{
	//error_reporting(E_ALL ^ E_NOTICE | E_STRICT);
}
else
{
	//error_reporting(E_ALL ^ E_NOTICE);
}

// the basics
if (file_exists('config/config.php')) require_once 'config/config.php';

require_once 'defaults.php';
require_once 'common.php';

// make sure we have our connection array
shutDownCheck();
	
// preloading things
load_helpers(array('html', 'entrance', 'time', 'server'));

// general tools for loading things
load_class('core', FALSE, 'lib');

// "I'm digging for fire" - Pixies	
$OBJ =& load_class('router', TRUE, 'lib');

// are we logged in?
$OBJ->access->checkLogin();

// get user prefernces
$OBJ->lang->setlang($OBJ->access->prefs['user_lang']);

// loading our module object
$INDX =& load_class($go['a'], TRUE, 'mod', TRUE);

// referencing wonkiness
// review when there is time
//$aINDX =& $INDX;

// loading our module method
$OBJ->tunnel($INDX, $go['a'], $go['q']);

// output
$INDX->template->output('index');


?>