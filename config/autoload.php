<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Userlytics
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'userlytics',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'userlytics\ModuleAnalyst' => 'system/modules/userlytics/modules/ModuleAnalyst.php',
	
	// Classes
	'userlytics\feuserlytics' => 'system/modules/userlytics/classes/feuserlytics.php',
	'userlytics\beuserlytics' => 'system/modules/userlytics/classes/beuserlytics.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_userlytics' => 'system/modules/userlytics/templates',
	'fe_userlytics'  => 'system/modules/userlytics/templates',
));
