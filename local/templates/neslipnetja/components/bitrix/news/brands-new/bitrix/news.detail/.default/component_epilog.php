<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;
global $APPLICATION;
Loc::loadMessages(__FILE__);
Loader::includeModule('bitlate.proshop');
$brandTitle = Option::get('bitlate.proshop', "NL_SLIDER_BRAND_TITLE", false, SITE_ID);?>
<?$APPLICATION->IncludeFile(
    SITE_DIR . "include/product_slider.php",
    Array(
        "TITLE" => $brandTitle,
        "FILTER" => array("PROPERTY_MANUFACTURE" => $arResult['ID']),
        "SUB_SLIDER" => "Y",
    )
);?>
<?$arFile = array();
if (intval($arResult["DETAIL_PICTURE"]['ID']))
    $arFile = $arResult["DETAIL_PICTURE"];
elseif (intval($arResult["PREVIEW_PICTURE"]['ID']))
    $arFile = $arResult["PREVIEW_PICTURE"];
BitlateProUtils::getPreviewPage($arFile);?>