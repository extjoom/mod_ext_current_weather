<?php 
/*
# ------------------------------------------------------------------------
# Extensions for Joomla 2.5.x - Joomla 3.x
# ------------------------------------------------------------------------
# Copyright (C) 2011-2014 Ext-Joom.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2.
# Author: Ext-Joom.com
# Websites:  http://www.ext-joom.com 
# Date modified: 20/09/2014 - 13:00
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;
error_reporting(E_ALL & ~E_NOTICE);

$document 			= JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'modules/mod_ext_current_weather/assets/css/default.css');
$moduleclass_sfx	= $params->get('moduleclass_sfx');


$cityID				= (int)$params->get('cityid', 27);
$count_day			= (int)$params->get('count_day', 1);
$lang_xml			= $params->get('lang_xml', 'en');

$ext_show_t			= (int)$params->get('ext_show_t', 1);
$ext_show_img		= (int)$params->get('ext_show_img', 1);
$ext_show_cloud		= (int)$params->get('ext_show_cloud', 1);
$ext_show_w			= (int)$params->get('ext_show_w', 1);
$ext_show_h			= (int)$params->get('ext_show_h', 1);
$ext_show_p			= (int)$params->get('ext_show_p', 1);


// parser
$path='http://xml.weather.co.ua/1.2/forecast/'.$cityID.'?dayf='.$count_day.'&lang='.$lang_xml.'';


$file_headers = @get_headers($path);
if(strpos($file_headers[0],'200 OK')>0){
	$xml = simplexml_load_file($path);
	$ext_error 	= '';
	//var_dump($xml);
} else {
	//exit('Failed to open '.$path);
	$ext_error = 'Failed to open '.$path;
	}	

$cloud = $xml->current->cloud;
if($cloud >= 0 && $cloud < 10) 			$cloud_text = JText::_(CLEAR);
elseif($cloud >= 10 && $cloud < 20) 	$cloud_text = JText::_(PARTLY_CLOUDY);
elseif($cloud >= 20 && $cloud < 30) 	$cloud_text = JText::_(CLOUDY);
elseif($cloud >= 30 && $cloud < 40) 	$cloud_text = JText::_(DREARY);
elseif($cloud >= 40 && $cloud < 50) 	$cloud_text = JText::_(INTERMITTENT_RAIN);
elseif($cloud >= 50 && $cloud < 60) 	$cloud_text = JText::_(RAIN);
elseif($cloud >= 60 && $cloud < 70) 	$cloud_text = JText::_(STORM);
elseif($cloud >= 70 && $cloud < 80) 	$cloud_text = JText::_(HAIL_SHOWER);
elseif($cloud >= 80 && $cloud < 90) 	$cloud_text = JText::_(SLUSHY_WEATHER);
elseif($cloud >= 90 && $cloud < 100) 	$cloud_text = JText::_(SNOW_FLURRY);
elseif($cloud >= 100 && $cloud < 110) 	$cloud_text = JText::_(SNOW);
else $cloud_text = '';	


$w_rumb = $xml->current->w_rumb;
if ($w_rumb >=0 && $w_rumb < 20) 		$wind_direction = JText::_(N);
elseif ($w_rumb >=20 && $w_rumb < 35) 	$wind_direction = JText::_(NNE);
elseif ($w_rumb >=35 && $w_rumb < 55) 	$wind_direction = JText::_(NE);
elseif ($w_rumb >=55 && $w_rumb < 70) 	$wind_direction = JText::_(ENE);
elseif ($w_rumb >=70 && $w_rumb < 110)	$wind_direction = JText::_(E);
elseif ($w_rumb >=110 && $w_rumb < 125) $wind_direction = JText::_(ESE);
elseif ($w_rumb >=125 && $w_rumb < 145) $wind_direction = JText::_(SE);
elseif ($w_rumb >=145 && $w_rumb < 160) $wind_direction = JText::_(SSE);
elseif ($w_rumb >=160 && $w_rumb < 200) $wind_direction = JText::_(S);
elseif ($w_rumb >=200 && $w_rumb < 215) $wind_direction = JText::_(SSW);
elseif ($w_rumb >=215 && $w_rumb < 235) $wind_direction = JText::_(SW);
elseif ($w_rumb >=235 && $w_rumb < 250) $wind_direction = JText::_(WSW);
elseif ($w_rumb >=250 && $w_rumb < 290) $wind_direction = JText::_(W);
elseif ($w_rumb >=290 && $w_rumb < 305) $wind_direction = JText::_(WNW);
elseif ($w_rumb >=305 && $w_rumb < 325) $wind_direction = JText::_(NW);
elseif ($w_rumb >=325 && $w_rumb < 340) $wind_direction = JText::_(NNW);
else $wind_direction = JText::_(N);	


require JModuleHelper::getLayoutPath('mod_ext_current_weather', $params->get('layout', 'default'));
?>