<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (CModule::IncludeModule('bitlate.proshop')) {
    usort($arResult['rows'], "BitlateProUtils::nl_highloadblock_sort");
}