<?php  /** * Contao Open Source CMS * * Copyright (c) 2005-2014 Leo Feyer * * @package   userlytics * @author    Georg Lugmayr * @license   GNU/LGPL * @copyright Georg Lugmayr *//** * Namespace */namespace userlytics;/** * Class ModuleAnalyst * * @copyright  Georg Lugmayr * @author     Georg Lugmayr * @package    Devtools */class ModuleAnalyst extends \Module  {     /**      * Template      * @var string      */     protected $strTemplate = '';     /**      * Generate the module      */     protected function compile()     { 				// CHECK IF NEW SESSION		if(is_null($this->Session->get('userlytics'))){						// DETECT BOT			if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])){				$this->Session->set('userlytics',true);			}			else{				$this->import('Environment');				$ua = $this->Environment->agent;				$arrSet = array				(					'url'       	 => $_SERVER['HTTP_HOST'],					'ts'       		 => time(),					'os'  			 => $ua->os,					'browser'   	 => $ua->browser,					'browserversion' => $ua->version,					'mobile'       	 => $ua->mobile				);		 				$this->Database->prepare("INSERT INTO tl_userlytics %s")->set($arrSet)->execute();				$this->Session->set('userlytics',true);			}					}    } }