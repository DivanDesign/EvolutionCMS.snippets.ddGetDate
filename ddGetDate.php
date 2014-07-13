<?php
/** 
 * ddGetDate.php
 * @version 2.1 (2012-03-05)
 * 
 * @desc Выводит дату по заданному формату.
 * 
 * @param date {integer | string} - Дата. Доступные значения: 'now' - текущая дата. По умолчанию: дата публикации, если нет даты публикации, дата создания документа.
 * @param format {string} - Формат, по которому выводить дату. По умолчанию: 'd.m.y'.
 * @param monthToStr {0; 1} - Отображать ли месяц строкой (января, февраля, марта и т.д.), в этом случае месяц в строке format должен быть задан как 'month'. По умолчанию: 0.
 * @param shortFormat {string} - Если задан короткий формат, то выводит дату относительно текущей, в этом случае дата в строке shotFormat должна быть задана как 'short'. По умолчанию: ''.
 * @param lang {ru; en} - Язык названий месяцев. По умолчанию русский.
 * 
 * @copyright 2012, DivanDesign
 * http://www.DivanDesign.biz
 */

$format = isset($format) ? $format : 'd.m.y';
$monthToStr = ($monthToStr == '1') ? true : false;

if (!isset($date)){
	$date = ($modx->documentObject['pub_date']) ? $modx->documentObject['pub_date'] : $modx->documentObject['createdon'];
}

//Если дата не является Unix-меткой
if (!is_numeric($date)){
	$date = strtotime($date);
}

if ($date){
	//Если задан короткий формат и совпадает год с месяцем, то пытаемся его вывести
	if (isset($shortFormat)){
		//Если разница времени меньше чем в один день, то добавляем "Сегодня"
		if (time() - date($date) < 86400){
			return date(str_replace('short', 'Сегодня', $shortFormat), $date);
		//Вчера
		}else if (time() - date($date) < 172800){
			return date(str_replace('short', 'Вчера', $shortFormat), $date);
		//Позавчера
		}else if (time() - date($date) < 259200){
			return date(str_replace('short', 'Позавчера', $shortFormat), $date);
		}
	}
	
	if ($monthToStr){
		if (isset($lang) && $lang == 'en'){
			$monthes = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		}else{
			$monthes = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
		}
		$format = str_replace('month', '\m\o\n\t\h', $format);
		$result = str_replace('month', $monthes[date('n',$date)-1], date($format, $date));
	}else{
		$result = date($format, $date);
	}
	
	return $result;
}
?>