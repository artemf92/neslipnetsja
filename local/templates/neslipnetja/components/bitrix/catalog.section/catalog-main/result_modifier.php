<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
if (!CModule::IncludeModule('bitlate.proshop')) return false;

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
$arDefaultParams = array(
	'PRODUCT_DISPLAY_MODE' => 'N',
	'ADD_PICT_PROP' => '-',
	'LABEL_PROP' => '-',
	'OFFER_ADD_PICT_PROP' => '-',
	'OFFER_TREE_PROPS' => array('-'),
	'SHOW_DISCOUNT_PERCENT' => 'N',
	'SHOW_OLD_PRICE' => 'N',
	'ADD_TO_BASKET_ACTION' => 'ADD',
	'SHOW_CLOSE_POPUP' => 'N',
	'MESS_BTN_BUY' => '',
	'MESS_BTN_BUY_ALREADY' => '',
	'MESS_BTN_ADD_TO_BASKET' => '',
	'MESS_BTN_SUBSCRIBE' => '',
	'MESS_BTN_DETAIL' => '',
	'MESS_NOT_AVAILABLE' => '',
	'MESS_BTN_COMPARE' => ''
);
$arParams = array_merge($arDefaultParams, $arParams);

if (!isset($arParams['LINE_ELEMENT_COUNT']))
	$arParams['LINE_ELEMENT_COUNT'] = 3;
$arParams['LINE_ELEMENT_COUNT'] = intval($arParams['LINE_ELEMENT_COUNT']);
if (2 > $arParams['LINE_ELEMENT_COUNT'] || 5 < $arParams['LINE_ELEMENT_COUNT'])
	$arParams['LINE_ELEMENT_COUNT'] = 3;

$arResult['NAV_STRING'] = $arResult['NAV_RESULT']->GetPageNavStringEx(
	$navComponentObject,
	$arParams['PAGER_TITLE'],
	$arParams['PAGER_TEMPLATE'],
	$arParams['PAGER_SHOW_ALWAYS'],
	$this->__component,
	$arResult['NAV_PARAM']
);

if ('Y' != $arParams['PRODUCT_DISPLAY_MODE'])
	$arParams['PRODUCT_DISPLAY_MODE'] = 'N';

$arParams['ADD_PICT_PROP'] = trim($arParams['ADD_PICT_PROP']);
if ('-' == $arParams['ADD_PICT_PROP'])
	$arParams['ADD_PICT_PROP'] = '';
$arParams['LABEL_PROP'] = trim($arParams['LABEL_PROP']);
if ('-' == $arParams['LABEL_PROP'])
	$arParams['LABEL_PROP'] = '';
$arParams['OFFER_ADD_PICT_PROP'] = trim($arParams['OFFER_ADD_PICT_PROP']);
if ('-' == $arParams['OFFER_ADD_PICT_PROP'])
	$arParams['OFFER_ADD_PICT_PROP'] = '';
if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
{
	if (!is_array($arParams['OFFER_TREE_PROPS']))
		$arParams['OFFER_TREE_PROPS'] = array($arParams['OFFER_TREE_PROPS']);
	foreach ($arParams['OFFER_TREE_PROPS'] as $key => $value)
	{
		$value = (string)$value;
		if ('' == $value || '-' == $value)
			unset($arParams['OFFER_TREE_PROPS'][$key]);
	}
	if (empty($arParams['OFFER_TREE_PROPS']) && isset($arParams['OFFERS_CART_PROPERTIES']) && is_array($arParams['OFFERS_CART_PROPERTIES']))
	{
		$arParams['OFFER_TREE_PROPS'] = $arParams['OFFERS_CART_PROPERTIES'];
		foreach ($arParams['OFFER_TREE_PROPS'] as $key => $value)
		{
			$value = (string)$value;
			if ('' == $value || '-' == $value)
				unset($arParams['OFFER_TREE_PROPS'][$key]);
		}
	}
}
else
{
	$arParams['OFFER_TREE_PROPS'] = array();
}
if ('Y' != $arParams['PRODUCT_SUBSCRIPTION'])
	$arParams['PRODUCT_SUBSCRIPTION'] = 'N';
if ('Y' != $arParams['SHOW_DISCOUNT_PERCENT'])
	$arParams['SHOW_DISCOUNT_PERCENT'] = 'N';
if ('Y' != $arParams['SHOW_OLD_PRICE'])
	$arParams['SHOW_OLD_PRICE'] = 'N';
if ($arParams['ADD_TO_BASKET_ACTION'] != 'BUY')
	$arParams['ADD_TO_BASKET_ACTION'] = 'ADD';
if ($arParams['SHOW_CLOSE_POPUP'] != 'Y')
	$arParams['SHOW_CLOSE_POPUP'] = 'N';
$arParams['MESS_BTN_BUY'] = trim($arParams['MESS_BTN_BUY']);
$arParams['MESS_BTN_BUY_ALREADY'] = trim($arParams['MESS_BTN_BUY_ALREADY']);
$arParams['MESS_BTN_ADD_TO_BASKET'] = trim($arParams['MESS_BTN_ADD_TO_BASKET']);
$arParams['MESS_BTN_SUBSCRIBE'] = trim($arParams['MESS_BTN_SUBSCRIBE']);
$arParams['MESS_BTN_DETAIL'] = trim($arParams['MESS_BTN_DETAIL']);
$arParams['MESS_NOT_AVAILABLE'] = trim($arParams['MESS_NOT_AVAILABLE']);
$arParams['MESS_BTN_COMPARE'] = trim($arParams['MESS_BTN_COMPARE']);
$arResult['IS_PRODUCT_BANNER'] = ($arParams["TEMPLATE_THEME"] != 'slider' && $arParams['ACTION_POS'] == 'product') ? true : false;
if ($arParams['PRODUCT_SIZE_TYPE'] != 'max') {
	$arResult['IS_SHOW_LARGE_PREVIEW'] = false;
} else {
	$arResult['IS_SHOW_LARGE_PREVIEW'] = ($arParams["TAB_TYPE"] && $arParams["TEMPLATE_THEME"] != "slider" && !$arResult['IS_PRODUCT_BANNER']) ? true : false;
}
$strEmptyPreview = SITE_TEMPLATE_PATH . '/images/no_photo.png';
$arResult['EMPTY_PREVIEW'] = $strEmptyPreview;

if (!empty($arResult['ITEMS']))
{
	$arEmptyPreview = false;
	if (file_exists($_SERVER['DOCUMENT_ROOT'].$strEmptyPreview))
	{
		$arSizes = getimagesize($_SERVER['DOCUMENT_ROOT'].$strEmptyPreview);
		if (!empty($arSizes))
		{
			$arEmptyPreview = array(
				'SRC' => $strEmptyPreview,
				'WIDTH' => intval($arSizes[0]),
				'HEIGHT' => intval($arSizes[1])
			);
		}
		unset($arSizes);
	}

	$arSKUPropList = array();
	$arSKUPropIDs = array();
	$arSKUPropKeys = array();
	$boolSKU = false;
	$strBaseCurrency = '';
	$boolConvert = isset($arResult['CONVERT_CURRENCY']['CURRENCY_ID']);

	if ($arResult['MODULES']['catalog'])
	{
		if (!$boolConvert)
			$strBaseCurrency = CCurrency::GetBaseCurrency();

		$arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
		$boolSKU = !empty($arSKU) && is_array($arSKU);
		if ($boolSKU && !empty($arParams['OFFER_TREE_PROPS']) && 'Y' == $arParams['PRODUCT_DISPLAY_MODE'])
		{
			$arSKUPropList = CIBlockPriceTools::getTreeProperties(
				$arSKU,
				$arParams['OFFER_TREE_PROPS'],
				array(
					'PICT' => $arEmptyPreview,
					'NAME' => '-'
				)
			);

			$arNeedValues = array();
			CIBlockPriceTools::getTreePropertyValues($arSKUPropList, $arNeedValues);
			$arSKUPropIDs = array_keys($arSKUPropList);
			if (empty($arSKUPropIDs))
				$arParams['PRODUCT_DISPLAY_MODE'] = 'N';
			else
				$arSKUPropKeys = array_fill_keys($arSKUPropIDs, false);
		}
	}

	$arNewItemsList = array();
	foreach ($arResult['ITEMS'] as $key => $arItem)
	{
		$arItem['CHECK_QUANTITY'] = false;
		if (!isset($arItem['CATALOG_MEASURE_RATIO']))
			$arItem['CATALOG_MEASURE_RATIO'] = 1;
		if (!isset($arItem['CATALOG_QUANTITY']))
			$arItem['CATALOG_QUANTITY'] = 0;
		$arItem['CATALOG_QUANTITY'] = (
			0 < $arItem['CATALOG_QUANTITY'] && is_float($arItem['CATALOG_MEASURE_RATIO'])
			? floatval($arItem['CATALOG_QUANTITY'])
			: intval($arItem['CATALOG_QUANTITY'])
		);
		$arItem['CATALOG'] = false;
		if (!isset($arItem['CATALOG_SUBSCRIPTION']) || 'Y' != $arItem['CATALOG_SUBSCRIPTION'])
			$arItem['CATALOG_SUBSCRIPTION'] = 'N';

		CIBlockPriceTools::getLabel($arItem, $arParams['LABEL_PROP']);

		$productPictures = CIBlockPriceTools::getDoublePicturesForItem($arItem, $arParams['ADD_PICT_PROP']);
		if (empty($productPictures['PICT']))
			$productPictures['PICT'] = $arEmptyPreview;
		if (empty($productPictures['SECOND_PICT']))
			$productPictures['SECOND_PICT'] = $productPictures['PICT'];

		$arItem['PREVIEW_PICTURE'] = $productPictures['PICT'];
		$arItem['PREVIEW_PICTURE_SECOND'] = $productPictures['SECOND_PICT'];
		$arItem['SECOND_PICT'] = true;
		$arItem['PRODUCT_PREVIEW'] = $productPictures['PICT'];
		$arItem['PRODUCT_PREVIEW_SECOND'] = $productPictures['SECOND_PICT'];

		if ($arResult['MODULES']['catalog'])
		{
			$arItem['CATALOG'] = true;
			if (!isset($arItem['CATALOG_TYPE']))
				$arItem['CATALOG_TYPE'] = CCatalogProduct::TYPE_PRODUCT;
			if (
				(CCatalogProduct::TYPE_PRODUCT == $arItem['CATALOG_TYPE'] || CCatalogProduct::TYPE_SKU == $arItem['CATALOG_TYPE'])
				&& !empty($arItem['OFFERS'])
			)
			{
				$arItem['CATALOG_TYPE'] = CCatalogProduct::TYPE_SKU;
			}
			switch ($arItem['CATALOG_TYPE'])
			{
				case CCatalogProduct::TYPE_SET:
					$arItem['OFFERS'] = array();
					$arItem['CHECK_QUANTITY'] = ('Y' == $arItem['CATALOG_QUANTITY_TRACE'] && 'N' == $arItem['CATALOG_CAN_BUY_ZERO']);
					break;
				case CCatalogProduct::TYPE_SKU:
					break;
				case CCatalogProduct::TYPE_PRODUCT:
				default:
					$arItem['CHECK_QUANTITY'] = ('Y' == $arItem['CATALOG_QUANTITY_TRACE'] && 'N' == $arItem['CATALOG_CAN_BUY_ZERO']);
					break;
			}
		}
		else
		{
			$arItem['CATALOG_TYPE'] = 0;
			$arItem['OFFERS'] = array();
		}

		if ($arItem['CATALOG'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS']))
		{
			$isBigPreview = (!empty($arItem['PROPERTIES']['PRODUCT_OF_DAY']['VALUE']) && intval($arItem['PROPERTIES']['ALREADY_PAYED']['VALUE']) > 0 && $arResult['IS_SHOW_LARGE_PREVIEW']) ? true : false;
			$arSizePreview = ($isBigPreview) ? array('width' => 429, 'height' => 380) : array('width' => 170, 'height' => 150);
			if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
			{
				$arMatrixFields = $arSKUPropKeys;
				$arMatrix = array();

				$arNewOffers = array();
				$boolSKUDisplayProperties = false;
				$arItem['OFFERS_PROP'] = false;

				$arDouble = array();
				foreach ($arItem['OFFERS'] as $keyOffer => $arOffer)
				{
					$arOffer['ID'] = intval($arOffer['ID']);
					if (isset($arDouble[$arOffer['ID']]))
						continue;
					$arRow = array();
					foreach ($arSKUPropIDs as $propkey => $strOneCode)
					{
						$arCell = array(
							'VALUE' => 0,
							'SORT' => PHP_INT_MAX,
							'NA' => true
						);
						if (isset($arOffer['DISPLAY_PROPERTIES'][$strOneCode]))
						{
							$arMatrixFields[$strOneCode] = true;
							$arCell['NA'] = false;
							if ('directory' == $arSKUPropList[$strOneCode]['USER_TYPE'])
							{
								$intValue = $arSKUPropList[$strOneCode]['XML_MAP'][$arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE']];
								$arCell['VALUE'] = $intValue;
							}
							elseif ('L' == $arSKUPropList[$strOneCode]['PROPERTY_TYPE'])
							{
								$arCell['VALUE'] = intval($arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE_ENUM_ID']);
							}
							elseif ('E' == $arSKUPropList[$strOneCode]['PROPERTY_TYPE'])
							{
								$arCell['VALUE'] = intval($arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE']);
							}
							$arCell['SORT'] = $arSKUPropList[$strOneCode]['VALUES'][$arCell['VALUE']]['SORT'];
						}
						$arRow[$strOneCode] = $arCell;
					}
					$arMatrix[$keyOffer] = $arRow;

					CIBlockPriceTools::clearProperties($arOffer['DISPLAY_PROPERTIES'], $arParams['OFFER_TREE_PROPS']);

					CIBlockPriceTools::setRatioMinPrice($arOffer, false);

					$offerPictures = CIBlockPriceTools::getDoublePicturesForItem($arOffer, $arParams['OFFER_ADD_PICT_PROP']);
					$arOffer['OWNER_PICT'] = empty($offerPictures['PICT']);
					$arOffer['PREVIEW_PICTURE'] = false;
					$arOffer['PREVIEW_PICTURE_SECOND'] = false;
					$arOffer['SECOND_PICT'] = true;
					if (!$arOffer['OWNER_PICT'])
					{
						if (empty($offerPictures['SECOND_PICT']))
							$offerPictures['SECOND_PICT'] = $offerPictures['PICT'];
						$arOffer['PREVIEW_PICTURE'] = $offerPictures['PICT'];
						$pic = false;
						if ($arOffer['PREVIEW_PICTURE']['ID'] > 0) {
							$pic = BitlateProUtils::getResizeImg($arOffer["PREVIEW_PICTURE"]['ID'], $arSizePreview);
						}
						if ($pic === false) {
							$pic['src'] = $strEmptyPreview;
						}
						$arOffer['PREVIEW_PICTURE']['SRC'] = $pic['src'];
						$arOffer['PREVIEW_PICTURE_SECOND'] = $offerPictures['SECOND_PICT'];
					}
					if ('' != $arParams['OFFER_ADD_PICT_PROP'] && isset($arOffer['DISPLAY_PROPERTIES'][$arParams['OFFER_ADD_PICT_PROP']]))
						unset($arOffer['DISPLAY_PROPERTIES'][$arParams['OFFER_ADD_PICT_PROP']]);

					$arDouble[$arOffer['ID']] = true;
					$arNewOffers[$keyOffer] = $arOffer;
				}
				$arItem['OFFERS'] = $arNewOffers;

				$arUsedFields = array();
				$arSortFields = array();

				foreach ($arSKUPropIDs as $propkey => $strOneCode)
				{
					$boolExist = $arMatrixFields[$strOneCode];
					foreach ($arMatrix as $keyOffer => $arRow)
					{
						if ($boolExist)
						{
							if (!isset($arItem['OFFERS'][$keyOffer]['TREE']))
								$arItem['OFFERS'][$keyOffer]['TREE'] = array();
							$arItem['OFFERS'][$keyOffer]['TREE']['PROP_'.$arSKUPropList[$strOneCode]['ID']] = $arMatrix[$keyOffer][$strOneCode]['VALUE'];
							$arItem['OFFERS'][$keyOffer]['SKU_SORT_'.$strOneCode] = $arMatrix[$keyOffer][$strOneCode]['SORT'];
							$arUsedFields[$strOneCode] = true;
							$arSortFields['SKU_SORT_'.$strOneCode] = SORT_NUMERIC;
						}
						else
						{
							unset($arMatrix[$keyOffer][$strOneCode]);
						}
					}
				}
				$arItem['OFFERS_PROP'] = $arUsedFields;
				$arItem['OFFERS_PROP_CODES'] = (!empty($arUsedFields) ? base64_encode(serialize(array_keys($arUsedFields))) : '');

				Collection::sortByColumn($arItem['OFFERS'], $arSortFields);

				$arMatrix = array();
				$intSelected = -1;
				$arItem['MIN_PRICE'] = false;
				$arItem['MIN_BASIS_PRICE'] = false;
				foreach ($arItem['OFFERS'] as $keyOffer => $arOffer)
				{
					if ($arItem['OFFER_ID_SELECTED'] > 0)
					{
						if ($arOffer['ID'] == $arItem['OFFER_ID_SELECTED']) {
							$intSelected = $keyOffer;
						}
					} elseif (empty($arItem['MIN_PRICE']) && $arOffer['CAN_BUY'])
					{
						$intSelected = $keyOffer;
						$arItem['MIN_PRICE'] = (isset($arOffer['RATIO_PRICE']) ? $arOffer['RATIO_PRICE'] : $arOffer['MIN_PRICE']);
						$arItem['MIN_BASIS_PRICE'] = $arOffer['MIN_PRICE'];
					}
					$arSKUProps = false;
					if (!empty($arOffer['DISPLAY_PROPERTIES']))
					{
						$boolSKUDisplayProperties = true;
						$arSKUProps = array();
						foreach ($arOffer['DISPLAY_PROPERTIES'] as &$arOneProp)
						{
							if ('F' == $arOneProp['PROPERTY_TYPE'])
								continue;
							$arSKUProps[] = array(
								'NAME' => $arOneProp['NAME'],
								'VALUE' => $arOneProp['DISPLAY_VALUE']
							);
						}
						unset($arOneProp);
					}

					$arOneRow = array(
						'ID' => $arOffer['ID'],
						'NAME' => $arOffer['~NAME'],
						'TREE' => $arOffer['TREE'],
						'DISPLAY_PROPERTIES' => $arSKUProps,
						'PRICE' => (isset($arOffer['RATIO_PRICE']) ? $arOffer['RATIO_PRICE'] : $arOffer['MIN_PRICE']),
						'BASIS_PRICE' => $arOffer['MIN_PRICE'],
						'SECOND_PICT' => $arOffer['SECOND_PICT'],
						'OWNER_PICT' => $arOffer['OWNER_PICT'],
						'PREVIEW_PICTURE' => $arOffer['PREVIEW_PICTURE'],
						'PREVIEW_PICTURE_SECOND' => $arOffer['PREVIEW_PICTURE_SECOND'],
						'CHECK_QUANTITY' => $arOffer['CHECK_QUANTITY'],
						'MAX_QUANTITY' => $arOffer['CATALOG_QUANTITY'],
						'STEP_QUANTITY' => $arOffer['CATALOG_MEASURE_RATIO'],
						'QUANTITY_FLOAT' => is_double($arOffer['CATALOG_MEASURE_RATIO']),
						'MEASURE' => $arOffer['~CATALOG_MEASURE_NAME'],
						'CAN_BUY' => $arOffer['CAN_BUY'],
					);
					$arMatrix[$keyOffer] = $arOneRow;
				}
				if (-1 == $intSelected)
					$intSelected = 0;
				if (!$arMatrix[$intSelected]['OWNER_PICT'])
				{
					$arItem['PREVIEW_PICTURE'] = $arMatrix[$intSelected]['PREVIEW_PICTURE'];
					$arItem['PREVIEW_PICTURE_SECOND'] = $arMatrix[$intSelected]['PREVIEW_PICTURE_SECOND'];
				}
				$arItem['JS_OFFERS'] = $arMatrix;
				$arItem['OFFERS_SELECTED'] = $intSelected;
				$arItem['OFFERS_PROPS_DISPLAY'] = $boolSKUDisplayProperties;
				$pic = false;
				if ($arItem['PRODUCT_PREVIEW']['ID'] > 0) {
					$pic = BitlateProUtils::getResizeImg($arItem["PRODUCT_PREVIEW"]['ID'], $arSizePreview);
				}
				if ($pic === false) {
					$pic['src'] = $strEmptyPreview;
				}
				$arItem['PRODUCT_PREVIEW']['SRC'] = $pic['src'];
			}
			else
			{
				$arItem['MIN_PRICE'] = CIBlockPriceTools::getMinPriceFromOffers(
					$arItem['OFFERS'],
					$boolConvert ? $arResult['CONVERT_CURRENCY']['CURRENCY_ID'] : $strBaseCurrency
				);
			}
		}

		if (
			$arResult['MODULES']['catalog']
			&& $arItem['CATALOG']
			&&
				($arItem['CATALOG_TYPE'] == CCatalogProduct::TYPE_PRODUCT
				|| $arItem['CATALOG_TYPE'] == CCatalogProduct::TYPE_SET)
		)
		{
			CIBlockPriceTools::setRatioMinPrice($arItem, false);
			$arItem['MIN_BASIS_PRICE'] = $arItem['MIN_PRICE'];
		}

		if (!empty($arItem['DISPLAY_PROPERTIES']))
		{
			foreach ($arItem['DISPLAY_PROPERTIES'] as $propKey => $arDispProp)
			{
				if ('F' == $arDispProp['PROPERTY_TYPE'])
					unset($arItem['DISPLAY_PROPERTIES'][$propKey]);
			}
		}
		$arItem['LAST_ELEMENT'] = 'N';
		$arNewItemsList[$key] = $arItem;
	}
	$arNewItemsList[$key]['LAST_ELEMENT'] = 'Y';
	$arResult['ITEMS'] = $arNewItemsList;
	$arResult['SKU_PROPS'] = $arSKUPropList;
	$arResult['DEFAULT_PICTURE'] = $arEmptyPreview;

	$arResult['CURRENCIES'] = array();
	if ($arResult['MODULES']['currency'])
	{
		if ($boolConvert)
		{
			$currencyFormat = CCurrencyLang::GetFormatDescription($arResult['CONVERT_CURRENCY']['CURRENCY_ID']);
			$arResult['CURRENCIES'] = array(
				array(
					'CURRENCY' => $arResult['CONVERT_CURRENCY']['CURRENCY_ID'],
					'FORMAT' => array(
						'FORMAT_STRING' => $currencyFormat['FORMAT_STRING'],
						'DEC_POINT' => $currencyFormat['DEC_POINT'],
						'THOUSANDS_SEP' => $currencyFormat['THOUSANDS_SEP'],
						'DECIMALS' => $currencyFormat['DECIMALS'],
						'THOUSANDS_VARIANT' => $currencyFormat['THOUSANDS_VARIANT'],
						'HIDE_ZERO' => $currencyFormat['HIDE_ZERO']
					)
				)
			);
			unset($currencyFormat);
		}
		else
		{
			$currencyIterator = CurrencyTable::getList(array(
				'select' => array('CURRENCY')
			));
			while ($currency = $currencyIterator->fetch())
			{
				$currencyFormat = CCurrencyLang::GetFormatDescription($currency['CURRENCY']);
				$arResult['CURRENCIES'][] = array(
					'CURRENCY' => $currency['CURRENCY'],
					'FORMAT' => array(
						'FORMAT_STRING' => $currencyFormat['FORMAT_STRING'],
						'DEC_POINT' => $currencyFormat['DEC_POINT'],
						'THOUSANDS_SEP' => $currencyFormat['THOUSANDS_SEP'],
						'DECIMALS' => $currencyFormat['DECIMALS'],
						'THOUSANDS_VARIANT' => $currencyFormat['THOUSANDS_VARIANT'],
						'HIDE_ZERO' => $currencyFormat['HIDE_ZERO']
					)
				);
			}
			unset($currencyFormat, $currency, $currencyIterator);
		}
	}
	
	$bannerPosition = ($arParams['PAGE_ELEMENT_COUNT'] * ($arResult['NAV_RESULT']->NavPageNomer - 1)) + 1;
	$bannersList = array();
	if ($arResult['IS_PRODUCT_BANNER'] && $arParams["TAB_TYPE"] == 'recomend') {
		$arFilter = Array(
			"IBLOCK_ID" => COption::GetOptionString("bitlate.proshop", "NL_MAIN_ACTIONS_ID", false, SITE_ID), 
			"ACTIVE" => "Y",
			"ACTIVE_DATE" => "Y",
			">PROPERTY_POSITION" => 0,
			array(
				"LOGIC" => "OR",
				array("PROPERTY_SIZE" => BitlateProUtils::getBannerSizeId('big_product')),
				array("PROPERTY_SIZE" => BitlateProUtils::getBannerSizeId('gorizontal_priduct')),
			),
		);
		$arFilter[] = BitlateProUtils::getContentFilter();
		$res = CIBlockElement::GetList(Array("ACTIVE_FROM" => "DESC", "SORT" => "ASC"), $arFilter, Array("IBLOCK_ID", "ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_POSITION", "PROPERTY_MIN_PRODUCT_PHOTO", "PROPERTY_SQUARE_PRODUCT_PHOTO", "PROPERTY_GORIZONTAL_PRODUCT_PHOTO", "PROPERTY_LINK_TYPE", "PROPERTY_LINK"));
		while($obRes = $res->GetNextElement()) {
			$arRes = $obRes->GetFields();
			$arButtons = CIBlock::GetPanelButtons(
				$arRes["IBLOCK_ID"],
				$arRes["ID"],
				0,
				array("SECTION_BUTTONS"=>false, "SESSID"=>false)
			);
			$arPropSize = $obRes->GetProperty("SIZE");
			$size = (in_array('gorizontal_priduct', $arPropSize['VALUE_XML_ID'])) ? 'gorizontal_priduct' : 'big_product';
			$arSize = ($size == 'gorizontal_priduct') ? array('width' => 241, 'height' => 291) : array('width' => 481, 'height' => 581);
			$smallPicture = ($arRes["PROPERTY_MIN_PRODUCT_PHOTO_VALUE"] > 0) ? $arRes["PROPERTY_MIN_PRODUCT_PHOTO_VALUE"] : false;
			$bigPicture = false;
			if ($size == 'gorizontal_priduct') {
				$bigPicture = ($arRes["PROPERTY_GORIZONTAL_PRODUCT_PHOTO_VALUE"] > 0) ? $arRes["PROPERTY_GORIZONTAL_PRODUCT_PHOTO_VALUE"] : false;
				if (!$smallPicture) {
					$smallPicture = (!$bigPicture) ? $arItem['PREVIEW_PICTURE'] : $bigPicture;
				}
			} else {
				$bigPicture = false;
				if (!$smallPicture) {
					$smallPicture = ($arRes["PROPERTY_SQUARE_PRODUCT_PHOTO_VALUE"] > 0) ? $arRes["PROPERTY_SQUARE_PRODUCT_PHOTO_VALUE"] : false;
				}
			}
			$smallPicture = (!$smallPicture) ? $arItem['PREVIEW_PICTURE'] : $smallPicture;
			if ($smallPicture > 0) {
				$pic = BitlateProUtils::getResizeImg($smallPicture, $arSize, BX_RESIZE_IMAGE_EXACT);
				$picBig = false;
				if ($size == 'gorizontal_priduct') {
					if (!$bigPicture) {
						$bigPicture = ($arRes["DETAIL_PICTURE"] > 0) ? $arRes["DETAIL_PICTURE"] : $smallPicture;
					}
					$picBig = BitlateProUtils::getResizeImg($bigPicture, array('width' => 481, 'height' => 291), BX_RESIZE_IMAGE_EXACT);
				}
				$linkCustom = BitlateProUtils::getLinkTypeId('custom');
				$linkDetail = BitlateProUtils::getLinkTypeId('detail');
				switch ($arRes["PROPERTY_LINK_TYPE_ENUM_ID"]) {
					case $linkCustom:
						$link = $arRes["PROPERTY_LINK_VALUE"];
						break;
					case $linkDetail:
						$link = $arRes['DETAIL_PAGE_URL'];
						break;
					default:
						$link = '';
						break;
				}
				$bannersList[$arRes['PROPERTY_POSITION_VALUE']][] = array(
					'ID' => $arRes['ID'],
					'IBLOCK_ID' => $arRes['IBLOCK_ID'],
					'NAME' => $arRes['NAME'],
					'PREVIEW_PICTURE' => $pic['src'],
					'BIG_PICTURE' => $picBig['src'],
					'LINK' => $link,
					'POSITION' => $arRes['PROPERTY_POSITION_VALUE'],
					'SIZE' => $size,
					'EDIT_LINK' => $arButtons["edit"]["edit_element"]["ACTION_URL"],
					'DELETE_LINK' => $arButtons["edit"]["delete_element"]["ACTION_URL"],
				);
				if (($arResult['NAV_RESULT']->NavPageNomer - 1) == 0 && $arRes['PROPERTY_POSITION_VALUE'] < $bannerPosition) {
					$bannerPosition++;
				} elseif (($arResult['NAV_RESULT']->NavPageNomer - 1) > 0 && $arRes['PROPERTY_POSITION_VALUE'] <= $bannerPosition) {
					$bannerPosition++;
				}
			}
		}
	}
	$arResult['BANNER_POSITION'] = $bannerPosition;
	$arResult['BANNERS_LIST'] = $bannersList;
}
$cp = $this->__component;

if (is_object($cp))
{
	$cp->arResult['DESCRIPTION'] = $arResult['DESCRIPTION'];
	$cp->SetResultCacheKeys(array(
		"ID",
		"NAV_CACHED_DATA",
		$arParams["META_KEYWORDS"],
		$arParams["META_DESCRIPTION"],
		$arParams["BROWSER_TITLE"],
		$arParams["BACKGROUND_IMAGE"],
		"NAME",
		"PATH",
		"IBLOCK_SECTION_ID",
		"IPROPERTY_VALUES",
		"ITEMS_TIMESTAMP_X",
		'BACKGROUND_IMAGE',
		'USE_CATALOG_BUTTONS',
		'DESCRIPTION'
	));
}
?>