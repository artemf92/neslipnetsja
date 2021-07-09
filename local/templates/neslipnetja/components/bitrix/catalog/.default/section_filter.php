<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader,
    Bitrix\Main\ModuleManager;?>
<?if (!CModule::IncludeModule('bitlate.proshop')) return false;
$banners = BitlateProUtils::getBannerType();?>
<?if ($arParams["REQUEST_LOAD"] != "Y"):?>
    <section class="catalog">
        <div class="inner-bg">
            <div class="advanced-container-medium">
                <nav>
                    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
                            "START_FROM" => "0", 
                            "PATH" => "", 
                        )
                    );?>
                </nav>
                <h1><?$APPLICATION->ShowTitle(false)?></h1>
                <?$APPLICATION->ShowProperty("NL_CATALOG_SECTION_DESCRIPTION")?>
            </div>
        </div>
        <?if ($banners['TOP'] == 1 && \Bitrix\Main\Loader::includeModule('advertising')):?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:advertising.banner",
                "main",
                Array(
                    "CACHE_TIME" => "0",
                    "CACHE_TYPE" => "A",
                    "NOINDEX" => "Y",
                    "QUANTITY" => "1",
                    "TYPE" => "BITLATE_TOP",
                )
            );?>
        <?endif;?>
        <div class="advanced-container-medium catalog-wrapper<?if ($arParams["FILTER_VIEW_MODE"] != 'VERTICAL'):?> catalog-wrapper--horizontal<?endif;?>">
            <article class="inner-container">
<?endif;?>
<?if ($isFilter):
    $templateFilter = BitlateProUtils::getComponentTemplate("filter");?>
    <?if ($arParams["REQUEST_LOAD"] != "Y"):?>
        <nav class="inner-menu columns show-for-xlarge" id="catalog-filter-wrapper">
    <?endif;?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.smart.filter",
            $templateFilter,
            array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "SECTION_ID" => ($isShowAll == "Y") ? '' : $arCurSection['ID'],
                "PARENT_SECTION_ID" => $arCurSection['IBLOCK_SECTION_ID'],
                "FILTER_NAME" => $arParams["FILTER_NAME"],
                "PRICE_CODE" => $arParams["FILTER_PRICE_CODE"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "SAVE_IN_SESSION" => "N",
                "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                "XML_EXPORT" => "Y",
                "SECTION_TITLE" => "NAME",
                "SECTION_DESCRIPTION" => "DESCRIPTION",
                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                "SEF_MODE" => "Y",
                "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                "REQUEST_SORT" => $arParams['REQUEST_SORT'],
                "REQUEST_VIEW" => $arParams['REQUEST_VIEW'],
                "REQUEST_PAGE_EL_COUNT" => $arParams['REQUEST_PAGE_EL_COUNT'],
                "REQUEST_LOAD" => $arParams["REQUEST_LOAD"],
                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
                "TOP_MENU_DEPTH" => $arParams["SECTION_TOP_MENU_DEPTH"],
                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                "ADD_SECTIONS_CHAIN" => "N",
                "SHOW_ALL_WO_SECTION" => $isShowAll,
                "PARAMS_STRING" => $arParams["PARAMS_STRING"],
                "CATALOG_SHOW_IN_FILTER" => $arParams["SECTION_CATALOG_SHOW_IN_FILTER"],
                "CATALOG_IN_FILTER_VIEW" => $arParams["SECTION_CATALOG_IN_FILTER_VIEW"],
                "CATALOG_IN_FILTER_HIDE" => $arParams["SECTION_CATALOG_IN_FILTER_HIDE"],
                "CATALOG_SHOW_SUBSECTION" => $arParams["SECTION_CATALOG_SHOW_SUBSECTION"],
                "CATALOG_MENU_OTHER_PIC" => $arParams["SECTION_CATALOG_MENU_OTHER_PIC"],
                "CATALOG_MENU_PIC" => $arParams["SECTION_CATALOG_MENU_PIC"],
                "MENU_SHOW_DEEP" => $arParams["SECTION_LIST_MENU_SHOW_DEEP"],
                "FILTER_NUMBERS_SHOW" => $arParams["FILTER_NUMBERS_SHOW"],
                "DISPLAY_ELEMENT_COUNT" => $arParams["DISPLAY_ELEMENT_COUNT"],
            ),
            $component,
            array('HIDE_ICONS' => 'Y')
        );?>
    <?if ($arParams["REQUEST_LOAD"] != "Y"):?>
            <?if ($arParams["FILTER_VIEW_MODE"] == 'VERTICAL' && $banners['LEFT'] == 1):?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:advertising.banner",
                    "main",
                    Array(
                        "CACHE_TIME" => "0",
                        "CACHE_TYPE" => "A",
                        "NOINDEX" => "Y",
                        "QUANTITY" => "1",
                        "TYPE" => "BITLATE_LEFT",
                    )
                );?>
            <?endif;?>
        </nav>
    <?endif;?>
<?endif?>
<?
if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
    $basketAction = (isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '');
else
    $basketAction = (isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '');

$intSectionID = 0;?>
    <?if ($arParams["REQUEST_LOAD"] != "Y"):?>
        <div class="inner-content columns row float-right catalog-reload">
    <?endif;?>
        <?if ($arParams["SECTION_CATALOG_SHOW_SUBSECTION"] == "Y"):?>
            <?$APPLICATION->IncludeComponent(
                "bitlatepro:catalog.section.id.list",
                "subcategory",
                array(
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "SECTION_ID" => $arCurSection["ID"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                    "TOP_DEPTH" => 1,
                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                    "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                    "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                    "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                    "ADD_SECTIONS_CHAIN" => "N",
                    "USE_LAZY_LOAD" => $arParams["USE_LAZY_LOAD"],
                ),
                $component,
                array("HIDE_ICONS" => "Y")
            );?>
        <?endif;?>
        <?$arSortView = $APPLICATION->IncludeComponent(
            "bitlatepro:catalog.sort.view",
            "",
            array(
                "SORT_CODES" => $arParams['SORT_LIST_CODES'],
                "SORT_FIELDS" => $arParams['SORT_LIST_FIELDS'],
                "SORT_ORDERS" => $arParams['SORT_LIST_ORDERS'],
                "SORT_NAME" => $arParams['SORT_LIST_NAME'],
                "REQUEST_SORT" => $arParams['REQUEST_SORT'],
                "REQUEST_VIEW" => $arParams['REQUEST_VIEW'],
                "REQUEST_LOAD" => $arParams["REQUEST_LOAD"],
            ),
            $component,
            array('HIDE_ICONS' => 'Y')
        );?>
        <?$arPageTo = $APPLICATION->IncludeComponent(
            "bitlatepro:catalog.page.to.calc",
            "",
            array(
                "PAGE_TO_LIST" => $arParams['PAGE_TO_LIST'],
                "PAGE_ELEMENT_COUNT" => $arParams['PAGE_ELEMENT_COUNT'],
                "REQUEST_PAGE_EL_COUNT" => $arParams['REQUEST_PAGE_EL_COUNT'],
                "REQUEST_LOAD" => $arParams['REQUEST_LOAD'],
            ),
            $component,
            array('HIDE_ICONS' => 'Y')
        );

        ?>
    
        <?$intSectionID = $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            $arSortView["VIEW"],
            // 'catalog-main',
            array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ELEMENT_SORT_FIELD" => $arSortView["SORT"][0]["FIELD"],
                "ELEMENT_SORT_ORDER" => $arSortView["SORT"][0]["ORDER"],
                "ELEMENT_SORT_FIELD2" => $arSortView["SORT"][1]["FIELD"],
                "ELEMENT_SORT_ORDER2" => $arSortView["SORT"][1]["ORDER"],
                "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                "SHOW_MAX_QUANTITY" => $arParams["LIST_SHOW_MAX_QUANTITY"],
                "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                "BASKET_URL" => $arParams["BASKET_URL"],
                "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                "FILTER_NAME" => $arParams["FILTER_NAME"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "SET_TITLE" => $arParams["SET_TITLE"],
                "MESSAGE_404" => $arParams["MESSAGE_404"],
                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                "SHOW_404" => $arParams["SHOW_404"],
                "FILE_404" => $arParams["FILE_404"],
                "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                "PAGE_ELEMENT_COUNT" => $arPageTo["PAGE_ELEMENT_COUNT"],
                "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                "PRICE_CODE" => $arParams["PRICE_CODE"],
                "PRICE_MULTY" => $arParams["PRICE_MULTY"],
                "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                "USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
                "MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
                "MAX_AMOUNT" => $arParams["MAX_AMOUNT"],

                "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

                "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                "SECTION_USER_FIELDS" => array(
                    0 => "UF_SEO_BOTTOM",
                ),
                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                'LABEL_PROP' => $arParams['LABEL_PROP'],
                'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                'MESS_BTN_BUY_ALREADY' => $arParams['MESS_BTN_BUY_ALREADY'],
                'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                'MESS_BTN_SUBSCRIBE_ALREADY' => $arParams['MESS_BTN_SUBSCRIBE_ALREADY'],
                'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

                'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                "ADD_SECTIONS_CHAIN" => "Y",
                'ADD_TO_BASKET_ACTION' => $basketAction,
                'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
                'REQUEST_LOAD' => $arParams["REQUEST_LOAD"],
                'PAGE_TO_LIST' => $arPageTo["PAGE_TO_LIST"],
                "SHOW_ALL_WO_SECTION" => $isShowAll,
                "MOBILE_PRODUCT_COLUMN" => $arParams["MOBILE_PRODUCT_COLUMN"],
                "SHOW_PRODUCT_PREVIEW" => $arParams["SHOW_PRODUCT_PREVIEW"],
                "SKU_PICT_TYPE" => $arParams["SKU_PICT_TYPE"],
                "USE_LAZY_LOAD" => $arParams["USE_LAZY_LOAD"],
            ),
            $component
        );?>
<?if ($arParams["REQUEST_LOAD"] != "Y"):?>
    </div>
	<?
	$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;
	unset($basketAction);
    ?>
            </article>
        </div>
        <?if ($banners['BOTTOM'] == 1 && \Bitrix\Main\Loader::includeModule('advertising')):?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:advertising.banner",
                "main",
                Array(
                    "CACHE_TIME" => "0",
                    "CACHE_TYPE" => "A",
                    "NOINDEX" => "Y",
                    "QUANTITY" => "1",
                    "TYPE" => "BITLATE_BOTTOM",
                )
            );?>
        <?endif;?>
    </section>
<?endif;?>