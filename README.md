# (MODX)EvolutionCMS.snippets.ddGetDate

Snippet returns the date in a specified format. It can also:
* Return the current date;
* Return document pubdate by default, or createon if pubdate is empty;
* Display month as a string (like `January`, `February`, `March`, etc);
* Return short formated date (like `Today`, `Yesterday`, `Day before yesterday`).


## Requires

* PHP >= 5.6
* [(MODX)EvolutionCMS](https://github.com/evolution-cms/evolution) >= 1.1
* [(MODX)EvolutionCMS.libraries.ddTools](https://code.divandesign.biz/modx/ddtools) >= 0.48


## Documentation


### Installation

Elements → Snippets: Create a new snippet with the following data:

1. Snippet name: `ddGetDate`.
2. Description: `<b>2.1.2</b> Snippet returns the date in a specified format.`.
3. Category: `Core`.
4. Parse DocBlock: `no`.
5. Snippet code (php): Insert content of the `ddGetDate_snippet.php` file from the archive.


### Parameters description

* `date`
	* Desctription: Date.
	* Valid values:
		* `integer`
		* `string`
		* `'now'` — current date
	* Default value: Pubdate or createdon (if pubdate is empty).
	
* `format`
	* Desctription: Date format to display.
	* Valid values: `string`
	* Default value: `'d.m.y'`
	
* `monthToStr`
	* Desctription: Display month as string. If it's true month in `format` must be specified as `'month'`.
	* Valid values:
		* `0`
		* `1`
	* Default value: `0`
	
* `shortFormat`
	* Desctription: Display shorted fromated date. If it's true date in `shortFormat` must be specified as `'short'`.
	* Valid values: `string`
	* Default value: —
	
* `lang`
	* Desctription: Month names language.
	* Valid values:
		* `'ru'`
		* `'en'`
	* Default value: `'ru'`


### Examples


#### Get current year

```
[[ddGetDate?
	&date=`now`
	&format=`Y`
]]
```

Returns:

```
2021
```


#### Get document `pubdate` or `creadeon` (if `pubdate` is empty)

```
[[ddGetDate]]
```

Returns:

```
27.03.21
```


#### Get some TV-date with month name to string

```
[[ddGetDate?
	&date=`[*tvDate*]`
	&format=`d month Y`
	&monthToStr=`1`
	&lang=`en`
]]
```

Returns:

```
27 March 2021
```


#### Get date in short format (for example, today is 28.03.2021)

```
[[ddGetDate?
	&shortFormat=`short, G:i`
]]
```

Returns:

```
Yesterday, 9:48.
```


## Links

* [Home page](https://code.divandesign.biz/modx/ddgetdate)
* [Telegram chat](https://t.me/dd_code)
* [Packagist](https://packagist.org/packages/dd/evolutioncms-snippets-ddgetdate)


<link rel="stylesheet" type="text/css" href="https://DivanDesign.ru/assets/files/ddMarkdown.css" />