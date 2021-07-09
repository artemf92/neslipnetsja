<?
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
Loader::includeModule('bitlate.proshop');
$IBLOCK_ID = Option::get('bitlate.proshop', "NL_NEWS_ID", 0, SITE_ID);
$countNews = Option::get('bitlate.proshop', "NL_SLIDER_NEWS_PAGE_ELEMENT_COUNT", 0, SITE_ID);
$blockTitle = Option::get('bitlate.proshop', "NL_MAIN_NEWS_TITLE", false, SITE_ID);
$fieldCode = array(
    0 => "NAME",
    1 => "ACTIVE_FROM",
    2 => "PREVIEW_TEXT",
);
$NEWS_TYPE = $templateOptions['news_type'];
$useLazyLoad = $templateOptions['use_lazy_load'];
if ($NEWS_TYPE == 1 || $NEWS_TYPE == 3) {
    $fieldCode[] = "PREVIEW_PICTURE";
}
global $arrFilterNews;
$arrFilterNews = BitlateProUtils::getContentFilter();
?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "main_news", array(
	"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => $IBLOCK_ID,
		"NEWS_COUNT" => $countNews,
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"USE_FILTER" => (count($arrFilterNews)>0)?"Y":"N",
		"FILTER_NAME" => (count($arrFilterNews)>0)?"arrFilterNews":"N",
		"FIELD_CODE" => $fieldCode,
		"DISPLAY_PICTURE" => ($NEWS_TYPE==1)?"Y":"N",
		"PROPERTY_CODE" => "",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => $blockTitle,
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"DISPLAY_PANEL" => "Y",
		"USE_LAZY_LOAD" => $useLazyLoad
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>