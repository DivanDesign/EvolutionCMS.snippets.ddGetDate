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

//Include (MODX)EvolutionCMS.libraries.ddTools
require_once(
	$modx->getConfig('base_path') .
	'assets/libs/ddTools/modx.ddtools.class.php'
);

$params = \DDTools\ObjectTools::extend([
	'objects' => [
		//Defaults
		(object) [
			'date' =>
				$modx->documentObject['pub_date'] ?
				$modx->documentObject['pub_date'] :
				$modx->documentObject['createdon']
			,
			'format' => 'd.m.y',
			'monthToStr' => false,
			'shortFormat' => null,
			'lang' => 'ru'
		],
		$params
	]
]);

//Если дата не является Unix-меткой
if (!is_numeric($params->date)){
	$params->date = strtotime($params->date);
}


if ($params->date){
	if ($params->lang == 'en'){
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
	if (!is_null($params->shortFormat)){
		//Если разница времени меньше чем в один день, то добавляем "Сегодня"
		if (
			(
				time() -
				date($params->date)
			) <
			86400
		){
			return date(
				str_replace(
					'short',
					$short[2],
					$params->shortFormat
				),
				$params->date
			);
		//Вчера
		}else if (
			(
				time() -
				date($params->date)
			) <
			172800
		){
			return date(
				str_replace(
					'short',
					$short[1],
					$params->shortFormat
				),
				$params->date
			);
		//Позавчера
		}else if (
			(
				time() -
				date($params->date)
			) <
			259200
		){
			return date(
				str_replace(
					'short',
					$short[0],
					$params->shortFormat
				),
				$params->date
			);
		}
	}
	
	if ($params->monthToStr){
		$params->format = str_replace(
			'month',
			'\m\o\n\t\h',
			$params->format
		);
		
		$result = str_replace(
			'month',
			$monthes[
				date(
					'n',
					$params->date
				) -
				1
			],
			date(
				$params->format,
				$params->date
			)
		);
	}else{
		$result = date(
			$params->format,
			$params->date
		);
	}
	
	return $result;
}
?>