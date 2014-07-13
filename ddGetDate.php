<?php
/** 
 * ddGetDate.php
 * @version 2.1.2 (2014-07-13)
 * 
 * @desc Snippet returns the date in a specified format.
 * 
 * @param $date {integer | string} - Date. Value 'now' — current date. Default: Pubdate or createdon (if pubdate is empty).
 * @param $format {string} - Date format to display. Default: 'd.m.y'.
 * @param $monthToStr {0; 1} - Display month as string. If it's true month in «format» must be specified as 'month'. Default: 0.
 * @param $shortFormat {string} - Display shorted fromated date. If it's true date in «shortFormat» must be specified as 'short'. Default: ''.
 * @param $lang {ru; en} - Month names language. Default: 'ru'.
 * 
 * @link http://code.divandesign.biz/modx/ddgetdate/2.1.2
 * 
 * @copyright 2014, DivanDesign
 * http://www.DivanDesign.biz
 */

$format = isset($format) ? $format : 'd.m.y';

if (!isset($date)){
	$date = ($modx->documentObject['pub_date']) ? $modx->documentObject['pub_date'] : $modx->documentObject['createdon'];
}

//Если дата не является Unix-меткой
if (!is_numeric($date)){
	$date = strtotime($date);
}

if ($date){
	if (isset($lang) && $lang == 'en'){
		$short = array('Day before yesterday', 'Yesterday', 'Today');
		$monthes = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	}else{
		$short = array('Позавчера', 'Вчера', 'Сегодня');
		$monthes = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
	}
	
	//Если задан короткий формат и совпадает год с месяцем, то пытаемся его вывести
	if (isset($shortFormat)){
		//Если разница времени меньше чем в один день, то добавляем "Сегодня"
		if (time() - date($date) < 86400){
			return date(str_replace('short', $short[2], $shortFormat), $date);
		//Вчера
		}else if (time() - date($date) < 172800){
			return date(str_replace('short', $short[1], $shortFormat), $date);
		//Позавчера
		}else if (time() - date($date) < 259200){
			return date(str_replace('short', $short[0], $shortFormat), $date);
		}
	}
	
	if (isset($monthToStr) && $monthToStr == '1'){
		$format = str_replace('month', '\m\o\n\t\h', $format);
		$result = str_replace('month', $monthes[date('n',$date)-1], date($format, $date));
	}else{
		$result = date($format, $date);
	}
	
	return $result;
}
?>