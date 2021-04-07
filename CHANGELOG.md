# (MODX)EvolutionCMS.snippets.ddGetDate changelog


## Version 2.1.2 (2014-07-13)
* \* Bugfix: undeclared variables in PHP 5.3.
* \* The redundant code has been removed.


## Version 2.1.1 (2012-03-16)
* \+ Added English support for short formated date (if used `shortFormat`).


## Version 2.1 (2012-03-05)
* \+ Added English support in month names (if `monthToStr` equals `1`).


## Version 2.0 (2012-01-23)
* \* Attention! Backward compatibility is broken.
* \* Parameters → `date`:
	* \+ Now supports not only unixtime. Added unixtime check and converting with `strtotime()`.
	* \* Value `'current'` was replaced to `'now'` (`strtotime()` native support).


## Version 1.9 (2010-11-23)
* \* Minor optimization.


<link rel="stylesheet" type="text/css" href="https://DivanDesign.ru/assets/files/ddMarkdown.css" />
<style>ul{list-style:none;}</style>