<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var array $arResult */
$cp = $this->__component;

if (is_object($cp))
{
	$cp->arResult['DETAIL_PICTURE'] = $arResult['DETAIL_PICTURE'];
	$cp->arResult['PREVIEW_PICTURE'] = $arResult['PREVIEW_PICTURE'];
	$cp->SetResultCacheKeys(array(
		"DETAIL_PICTURE",
		"PREVIEW_PICTURE",
	));
}
?>