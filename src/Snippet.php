<?php
namespace ddGetDate;

class Snippet extends \DDTools\Snippet {
	protected
		$version = '2.2.0',
		
		$params = [
			//Defaults
			'date' => null,
			'format' => 'd.m.y',
			'monthToStr' => false,
			'shortFormat' => null,
			'lang' => 'ru'
		]
	;
	
	/**
	 * prepareParams
	 * @version 1.0 (2021-03-27)
	 * 
	 * @param $this->params {stdClass|arrayAssociative|stringJsonObject|stringQueryFormatted}
	 * 
	 * @return {void}
	 */
	protected function prepareParams($params = []){
		//Call base method
		parent::prepareParams($params);
		
		if (is_null($this->params->date)){
			$this->params->date =
				\ddTools::$modx->documentObject['pub_date'] ?
				\ddTools::$modx->documentObject['pub_date'] :
				\ddTools::$modx->documentObject['createdon']
			;
		}
		
		//Если дата не является Unix-меткой
		if (!is_numeric($this->params->date)){
			$this->params->date = strtotime($this->params->date);
		}
	}
	
	/**
	 * run
	 * @version 1.0.1 (2021-03-27)
	 * 
	 * @return {string}
	 */
	public function run(){
		//The snippet must return an empty string even if result is absent
		$result = '';
		
		if ($this->params->date){
			if ($this->params->lang == 'en'){
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
			if (!is_null($this->params->shortFormat)){
				//Если разница времени меньше чем в один день, то добавляем "Сегодня"
				if (
					(
						time() -
						date($this->params->date)
					) <
					86400
				){
					$result = date(
						str_replace(
							'short',
							$short[2],
							$this->params->shortFormat
						),
						$this->params->date
					);
				//Вчера
				}elseif (
					(
						time() -
						date($this->params->date)
					) <
					172800
				){
					$result = date(
						str_replace(
							'short',
							$short[1],
							$this->params->shortFormat
						),
						$this->params->date
					);
				//Позавчера
				}elseif (
					(
						time() -
						date($this->params->date)
					) <
					259200
				){
					$result = date(
						str_replace(
							'short',
							$short[0],
							$this->params->shortFormat
						),
						$this->params->date
					);
				}else{
					//Флаг, что короткий формат не использовался
					$this->params->shortFormat = null;
				}
			}
			
			//If short format did not used
			if (is_null($this->params->shortFormat)){
				if ($this->params->monthToStr){
					$this->params->format = str_replace(
						'month',
						'\m\o\n\t\h',
						$this->params->format
					);
					
					$result = str_replace(
						'month',
						$monthes[
							date(
								'n',
								$this->params->date
							) -
							1
						],
						date(
							$this->params->format,
							$this->params->date
						)
					);
				}else{
					$result = date(
						$this->params->format,
						$this->params->date
					);
				}
			}
		}
		
		return $result;
	}
}