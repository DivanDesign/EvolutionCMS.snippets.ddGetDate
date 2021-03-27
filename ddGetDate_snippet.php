<?php
/** 
 * ddGetDate
 * @version 2.1.2 (2014-07-13)
 * 
 * @see README.md
 * 
 * @link https://code.divandesign.biz/modx/ddgetdate
 * 
 * @copyright 2009–2014 DD Group {@link https://DivanDesign.biz }
 */

$format =
	isset($format) ?
	$format :
	'd.m.y'
;

if (!isset($date)){
	$date =
		$modx->documentObject['pub_date'] ?
		$modx->documentObject['pub_date'] :
		$modx->documentObject['createdon']
	;
}

//Если дата не является Unix-меткой
if (!is_numeric($date)){
	$date = strtotime($date);
}

if ($date){
	if (
		isset($lang) &&
		$lang == 'en'
	){
		$short = [
			'Day before yesterday',
			'Yesterday',
			'Today'
		];
		$monthes = [
			'January',
			'February',
			'March',
			'April',
			'May',
			'June',
			'July',
			'August',
			'September',
			'October',
			'November',
			'December'
		];
	}else{
		$short = [
			'Позавчера',
			'Вчера',
			'Сегодня'
		];
		$monthes = [
			'января',
			'февраля',
			'марта',
			'апреля',
			'мая',
			'июня',
			'июля',
			'августа',
			'сентября',
			'октября',
			'ноября',
			'декабря'
		];
	}
	
	//Если задан короткий формат и совпадает год с месяцем, то пытаемся его вывести
	if (isset($shortFormat)){
		//Если разница времени меньше чем в один день, то добавляем "Сегодня"
		if (
			(
				time() -
				date($date)
			) <
			86400
		){
			return date(
				str_replace(
					'short',
					$short[2],
					$shortFormat
				),
				$date
			);
		//Вчера
		}else if (
			(
				time() -
				date($date)
			) <
			172800
		){
			return date(
				str_replace(
					'short',
					$short[1],
					$shortFormat
				),
				$date
			);
		//Позавчера
		}else if (
			(
				time() -
				date($date)
			) <
			259200
		){
			return date(
				str_replace(
					'short',
					$short[0],
					$shortFormat
				),
				$date
			);
		}
	}
	
	if (
		isset($monthToStr) &&
		$monthToStr == '1'
	){
		$format = str_replace(
			'month',
			'\m\o\n\t\h',
			$format
		);
		
		$result = str_replace(
			'month',
			$monthes[
				date(
					'n',
					$date
				) -
				1
			],
			date(
				$format,
				$date
			)
		);
	}else{
		$result = date(
			$format,
			$date
		);
	}
	
	return $result;
}
?>