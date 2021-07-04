<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
\CModule::IncludeModule('bitlate.proshop');?>
<?if (count($arResult["ITEMS"]) > 0):?>
    <div class="main-plus<?if (intval($arParams["MOBILE_COLUMN"]) == 2):?> small-down-2<?endif;?>">
        <div class="advanced-container-medium row">
            <?if ($arParams['PAGER_TITLE'] != ""):?>
                <h2 class="main-plus-caption"><?=$arParams['PAGER_TITLE']?></h2>
            <?endif;?>
            <ul class="main-plus-container inline-block-container">
                <?foreach($arResult["ITEMS"] as $k => $arItem):
                    $pic = false;
                    $link = false;
                    if (intval($arItem["PREVIEW_PICTURE"])) {
                        $pic = BitlateProUtils::getResizeImg($arItem["PREVIEW_PICTURE"]["ID"], array('width' => 200, 'height' => 115), BX_RESIZE_IMAGE_EXACT);
                    }
                    if ($arItem["DISPLAY_PROPERTIES"]["LINK"]["VALUE"] != '') {
                        $link = $arItem["DISPLAY_PROPERTIES"]["LINK"]["VALUE"];
                    }?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <?if ($link):?>
                        <a href="<?=$link?>">
                    <?endif;?>
                    <li class="main-plus-item inline-block-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <?if ($arItem["DISPLAY_PROPERTIES"]["TYPE_ICON"]["VALUE_XML_ID"]):?>
                            <svg class="icon main-plus-<?=$arItem["DISPLAY_PROPERTIES"]["TYPE_ICON"]["VALUE_XML_ID"]?>">
                                <use xlink:href="#svg-icon-plus-<?=$arItem["DISPLAY_PROPERTIES"]["TYPE_ICON"]["VALUE_XML_ID"]?>"></use>
                            </svg>
                        <?else:?>
                            <img src="<?=$pic['src']?>" alt="<?echo $arItem["PREVIEW_TEXT"];?>">
                        <?endif;?>
                        <span class="main-plus-text"><?echo $arItem["PREVIEW_TEXT"];?></span>
                    </li>
                    <?if ($link):?>
                        </a>
                    <?endif;?>
                <?endforeach;?>
            </ul>
        </div>
    </div>
<?endif;?>
