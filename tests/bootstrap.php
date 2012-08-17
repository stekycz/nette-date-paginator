<?php
/**
 * Soubor pro načtení všech souborů PHPUnit testů. Používá se jen pro spouštění
 * testů v IDE PHPStorm.
 *
 * @author Martin Štekl <martin.stekl@gmail.com>
 * @since 2012-07-23
 */

use Nette\Config\Configurator;
use Nette\Forms\Container;
use Nette\Application\Routers\Route;

define('TEST_DIR', __DIR__);
define('LIBS_DIR', TEST_DIR . '/../vendor');

// Composer autoloading
require LIBS_DIR . '/autoload.php';

// Configure application
$configurator = new Nette\Config\Configurator;

// Enable Nette Debugger for error visualisation & logging
$configurator->setDebugMode(Configurator::AUTO);
$configurator->enableDebugger(TEST_DIR . '/../log', 'martin.stekl@gmail.com');

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(TEST_DIR . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(TEST_DIR . '/../DatePaginator')
	->register();
