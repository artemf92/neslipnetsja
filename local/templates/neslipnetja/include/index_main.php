<?
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
Loader::includeModule('bitlate.proshop');
$IBLOCK_ID = Option::get('bitlate.proshop', "NL_MAIN_SLIDER_ID", 0, SITE_ID);
$MAIN_BANNER_TYPE = $templateOptions['main_banner'];
$MAIN_SLIDER_TYPE = $templateOptions['action_pos'];
$useLazyLoad = $templateOptions['use_lazy_load'];
global $arrFilter;
$arrFilter = BitlateProUtils::getContentFilter();?>
<div class="main-slider-banner-inner">
	<div class="main-slider-banner<?=(($MAIN_SLIDER_TYPE == 'on') ? " lapping" : '')?> <?=$MAIN_BANNER_TYPE?> float-center<?if ($MAIN_SLIDER_TYPE == 'right'):?> banner-right<?endif;?>">
	    <?$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		"main_slider", 
		array(
			"IBLOCK_TYPE" => "services",
			"IBLOCK_ID" => $IBLOCK_ID,
			"NEWS_COUNT" => "5",
			"SORT_BY1" => "SORT",
			"SORT_ORDER1" => "ASC",
			"SORT_BY2" => "ACTIVE_FROM",
			"SORT_ORDER2" => "DESC",
			"USE_FILTER" => (count($arrFilter)>0)?"Y":"N",
			"FILTER_NAME" => (count($arrFilter)>0)?"arrFilter":"",
			"FIELD_CODE" => array(
				0 => "NAME",
				1 => "PREVIEW_TEXT",
				2 => "PREVIEW_PICTURE",
				3 => "DETAIL_PICTURE",
				4 => "",
			),
			"PROPERTY_CODE" => array(
				0 => "",
				1 => "LINK",
				2 => "STYLE",
				3 => "VIDEO_ID",
				4 => "VIDEO_TIME",
				5 => "PARALLAX_1",
				6 => "PARALLAX_2",
				7 => "PARALLAX_3",
				8 => "PARALLAX_4",
				9 => "BUTTON_TITLE",
				10 => "",
			),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
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
			"PAGER_SHOW_ALWAYS" => "Y",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"DISPLAY_PANEL" => "Y",
			"USE_LAZY_LOAD" => $useLazyLoad,
			"COMPONENT_TEMPLATE" => "main_slider",
			"SET_BROWSER_TITLE" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_META_DESCRIPTION" => "Y",
			"SET_LAST_MODIFIED" => "N",
			"STRICT_SECTION_CHECK" => "N",
			"PAGER_TITLE" => "Новости",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"SHOW_404" => "N",
			"MESSAGE_404" => ""
		),
		false
	);?>
	    <?if ($templateOptions['main_actions_position']):
	        require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/index_actions.php");
	    endif;?>
	</div>
</div>