<?
use Bitrix\Main\Config\Option;
$arTabs = array(
	'recomend' => array(
		'SORT_FIELD' => 'PROPERTY_SORT_RECOMEND',
		'FILTER_NAME' => 'arrRecomendFilter',
		'FILTER_VALUE' => array('!PROPERTY_RECOMEND' => false),
	),
	'news' => array(
		'SORT_FIELD' => 'PROPERTY_SORT_NEWS',
		'FILTER_NAME' => 'arrNewFilter',
		'FILTER_VALUE' => array('!PROPERTY_NEWPRODUCT' => false),
		
	),
	'hits' => array(
		'SORT_FIELD' => 'PROPERTY_SORT_HITS',
		'FILTER_NAME' => 'arrHitFilter',
		'FILTER_VALUE' => array('!PROPERTY_SALELEADER' => false),
		
	),
	'discount' => array(
		'SORT_FIELD' => 'PROPERTY_SORT_DISCOUNT',
		'FILTER_NAME' => 'arrDiscountFilter',
		'FILTER_VALUE' => array('!PROPERTY_DISCOUNT' => false),
	)
);
$arTab = $arTabs[$TYPE];
global ${$arTab['FILTER_NAME']};
${$arTab['FILTER_NAME']} = $arTab['FILTER_VALUE'];
$sortField = $arTab['SORT_FIELD'];
if (!CModule::IncludeModule('bitlate.proshop')) return false;
$ACTION_POS = BitlateProUtils::getActionPos();
$PRODUCT_SIZE_TYPE = BitlateProUtils::getProductSize();
if ($ACTION_POS == 'product') {
	$PAGE_ELEMENT_COUNT = Option::get("bitlate.proshop", "NL_MAIN_TABS_PAGE_ELEMENT_COUNT_BANNERS", false, SITE_ID);
} elseif ($PRODUCT_SIZE_TYPE == 'max') {
	$PAGE_ELEMENT_COUNT = Option::get("bitlate.proshop", "NL_MAIN_TABS_PAGE_ELEMENT_COUNT_MAX", false, SITE_ID);
} else {
	$PAGE_ELEMENT_COUNT = Option::get("bitlate.proshop", "NL_MAIN_TABS_PAGE_ELEMENT_COUNT", false, SITE_ID);
}
$mobileColumn = BitlateProUtils::getOptionCustomParam('mobile_product');
$productPreview = BitlateProUtils::getOptionCustomParam('product_preview');
$useLazyLoad = BitlateProUtils::getOptionCustomParam('use_lazy_load');
$typePict = BitlateProUtils::getSkuPictType();
$template = BitlateProUtils::getComponentTemplate("board");
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"board", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "7",
		"ELEMENT_SORT_FIELD" => $sortField,
		"ELEMENT_SORT_ORDER" => "DESC",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "asc",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"INCLUDE_SUBSECTIONS" => "Y",
		"BASKET_URL" => "/personal/cart/",
		"COMPARE_PATH" => "/catalog/compare/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"FILTER_NAME" => $arTab["FILTER_NAME"],
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"PAGE_ELEMENT_COUNT" => $PAGE_ELEMENT_COUNT,
		"LINE_ELEMENT_COUNT" => "4",
		"PRICE_CODE" => array(
			0 => "Розничная",
		),
		"PRICE_MULTY" => "Y",
		"DISPLAY_COMPARE" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "Y",
		"USE_MIN_AMOUNT" => "Y",
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"USE_PRODUCT_QUANTITY" => "Y",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PRODUCT_PROPERTIES" => array(
		),
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "",
		"PAGER_SHOW_ALL" => "N",
		"OFFERS_CART_PROPERTIES" => array(
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => " ",
			2 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "name",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "asc",
		"OFFERS_LIMIT" => "0",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_URL" => "/catalog/#SECTION_CODE#/",
		"DETAIL_URL" => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#.html",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"LABEL_PROP" => "SALELEADER",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"ADD_VIDEO_PROP" => "",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_ADD_VIDEO_PROP" => "",
		"OFFER_TREE_PROPS" => array(
		),
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"MESS_BTN_BUY" => "В корзину",
		"MESS_BTN_BUY_ALREADY" => "В корзине",
		"MESS_BTN_ADD_TO_BASKET" => "",
		"MESS_BTN_SUBSCRIBE" => "",
		"MESS_BTN_SUBSCRIBE_ALREADY" => "",
		"MESS_BTN_DETAIL" => "",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"TEMPLATE_THEME" => $TEMPLATE_THEME,
		"ADD_SECTIONS_CHAIN" => "N",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_ALL_WO_SECTION" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"TAB_TYPE" => $TYPE,
		"REQUEST_LOAD" => ($_REQUEST["load"]=="Y")?"Y":"N",
		"ACTION_POS" => $ACTION_POS,
		"PRODUCT_SIZE_TYPE" => $PRODUCT_SIZE_TYPE,
		"MOBILE_PRODUCT_COLUMN" => $mobileColumn,
		"SHOW_PRODUCT_PREVIEW" => $productPreview,
		"SKU_PICT_TYPE" => $typePict,
		"USE_LAZY_LOAD" => $useLazyLoad,
		"DEFER_INIT" => $INIT,
		"COMPONENT_TEMPLATE" => "board",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"BACKGROUND_IMAGE" => "-",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_COMPARE" => "Сравнить",
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);?>