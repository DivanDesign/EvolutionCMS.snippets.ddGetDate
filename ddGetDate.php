<?php
/**
 * ddGetDate.php
 * @version 1.9 (2010-11-23)
 * 
 * @desc Выводит дату по заданному формату.
 * 
 * @param date {integer | string} - Дата. Доступные значения: 'current' - текущая дата. По умолчанию: дата публикации, если нет даты публикации, дата создания документа.
 * @param format {string} - Формат, по которому выводить дату. По умолчанию: 'd.m.y'.
 * @param monthToStr {0; 1} - Отображать ли месяц строкой (января, февраля, марта и т.д.), в этом случае месяц в строке format должен быть задан как 'month'. По умолчанию: 0.
 * @param shortFormat {string} - Если задан короткий формат, то выводит дату относительно текущей, в этом случае дата в строке shotFormat должна быть задана как 'short'. По умолчанию: ''.
 * 
 * @copyright 2010, DivanDesign
 * http://www.DivanDesign.biz
 */

$format = isset($format) ? $format : 'd.m.y';
$monthToStr = ($monthToStr == '1') ? true : false;

if (!isset($date)){
	$date = ($modx->documentObject['pub_date']) ? $modx->documentObject['pub_date'] : $modx->documentObject['createdon'];
}else if ($date == 'current'){
	$date = time();
}

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
	$monthes = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
	$format = str_replace('month', '\m\o\n\t\h', $format);
	$result = str_replace('month', $monthes[date('n',$date)-1], date($format, $date));
}else{
	$result = date($format, $date);
}

return $result;
?>