<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   userlytics
 * @author    Georg Lugmayr
 * @license   GNU/LGPL
 * @copyright Georg Lugmayr
 */


/**
 * Namespace
 */
namespace userlytics;


/**
 * Class beuserlytics
 *
 * @copyright  Georg Lugmayr
 * @author     Georg Lugmayr
 * @package    Devtools
 */
class beuserlytics extends \BackendModule
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_userlytics';


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		
		if(!$this->Input->post('userlytics_time')){
			$start = 978307200;
		}
		else{
			$start = $this->Input->post('userlytics_time');
			if($start == 'lastyears')
				$start = 978307200;
			if($start == 'lastmonth')
				$start = time()-60*60*24*30;
			if($start == 'lastweek')
				$start = time()-60*60*24*7;
			if($start == 'yesterday')
				$start = time()-60*60*24;
				
			$url = $this->Input->post('userlytics_website');
		}
	
		if(!$this->Input->post('userlytics_time')){
			$objEntries = $this->Database->prepare("SELECT * FROM tl_userlytics WHERE ts > ?")
										 ->execute($start);
		}
		else{
			if($this->Input->post('userlytics_website') == "all"){
				$objEntries = $this->Database->prepare("SELECT * FROM tl_userlytics WHERE ts > ?")
										 ->execute($start);
			}
			else{
				$objEntries = $this->Database->prepare("SELECT * FROM tl_userlytics WHERE ts > ? AND url = ?")
										 ->execute($start, $url);
			}
		}
		
		$all = 0;
		$mobile = 0;
		
		while ($objEntries->next()){
			if($objEntries->mobile == 1){
				$arrBrowserMobile[$objEntries->browser] = $arrBrowserMobile[$objEntries->browser]+1;
				$arrBrowserVersionMobile[$objEntries->browser][$objEntries->browserversion] = $arrBrowserVersionMobile[$objEntries->browser][$objEntries->browserversion]+1;
				$arrOsMobile[$objEntries->os] = $arrOsMobile[$objEntries->os]+1;
			}
			else{
				$arrBrowser[$objEntries->browser] = $arrBrowser[$objEntries->browser]+1;
				$arrBrowserVersion[$objEntries->browser][$objEntries->browserversion] = $arrBrowserVersion[$objEntries->browser][$objEntries->browserversion]+1;
				$arrOs[$objEntries->os] = $arrOs[$objEntries->os]+1;
				
			}
			$arrMobile[$objEntries->mobile] = $arrMobile[$objEntries->mobile]+1;
			$all++;
			
		}
		
		
		
		
		// SORTING
		@arsort($arrBrowser);
		@arsort($arrOs);
		@arsort($arrBrowserMobile);
		@arsort($arrOsMobile);
		
		$this->Template->browser = $arrBrowser;
		$this->Template->browserMobile = $arrBrowserMobile;
		$this->Template->browserVersion = $arrBrowserVersion;
		$this->Template->browserVersionMobile = $arrBrowserVersionMobile;
		$this->Template->os = $arrOs;
		$this->Template->osMobile = $arrOsMobile;
		$this->Template->mobile = $arrMobile;
		$this->Template->all = $all;
		
		
		$websites = array();
		$objWebsite = $this->Database->execute("SELECT url FROM tl_userlytics GROUP BY url");
		while ($objWebsite->next()){
			$websites[$objWebsite->url] = $objWebsite->url;
		}
		$this->Template->websites = $websites;

	}
}
