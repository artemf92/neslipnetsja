<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?if (!empty($arResult['ITEMS'])):
    $itemCount = 0;?>
    <div class="owl-carousel main-slider" data-slideout-ignore>
        <?foreach ($arResult['ITEMS'] as  $arItem):
            if (intval($arItem['PREVIEW_PICTURE']) || $arItem['PROPERTIES']['VIDEO_ID']['VALUE']):
                $itemCount++;
                $blockClass = 'background ';
                if ($arItem['PROPERTIES']['STYLE']['VALUE_XML_ID'] != 'none') {
                    $blockClass .= ($arItem['PROPERTIES']['STYLE']['VALUE_XML_ID'] == 'white') ? 'white' : 'black';
                }
                $pic = false;
                $picStatic = false;
                $video = false;
                $containerClass = 'container row';
                $parallaxItems = array();
                if (intval($arItem['PREVIEW_PICTURE']['ID'])) {
                    $pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width' => 1900, 'height' => 574), BX_RESIZE_IMAGE_EXACT, true);
                    $picStatic = $pic;
                    if (intval($arItem['DETAIL_PICTURE']['ID'])) {
                        $tmpPic = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width' => 1900, 'height' => 574), BX_RESIZE_IMAGE_EXACT, true);
                        if ($tmpPic['src']) {
                            $picStatic = $tmpPic;
                        }
                    }
                    $subClass = '';
                    if ($arItem['DISPLAY_PROPERTIES']['PARALLAX_1']['VALUE'] > 0) {
                        $parallaxItems[1] = $arItem['DISPLAY_PROPERTIES']['PARALLAX_1']['FILE_VALUE']['SRC'];
                    }
                    if ($arItem['DISPLAY_PROPERTIES']['PARALLAX_2']['VALUE'] > 0) {
                        $parallaxItems[2] = $arItem['DISPLAY_PROPERTIES']['PARALLAX_2']['FILE_VALUE']['SRC'];
                    }
                    if ($arItem['DISPLAY_PROPERTIES']['PARALLAX_3']['VALUE'] > 0) {
                        $parallaxItems[3] = $arItem['DISPLAY_PROPERTIES']['PARALLAX_3']['FILE_VALUE']['SRC'];
                    }
                    if ($arItem['DISPLAY_PROPERTIES']['PARALLAX_4']['VALUE'] > 0) {
                        $parallaxItems[4] = $arItem['DISPLAY_PROPERTIES']['PARALLAX_4']['FILE_VALUE']['SRC'];
                    }
                    if (count($parallaxItems) > 0) {
                        $containerClass .= ' parallax-wrap';
                    }
                } else {
                    $video = $arItem['PROPERTIES']['VIDEO_ID']['VALUE'];
                    $videoTime = ($arItem['PROPERTIES']['VIDEO_TIME']['VALUE'] > 0) ? $arItem['PROPERTIES']['VIDEO_TIME']['VALUE'] : 0;
                    $blockClass .= ' video-wrap';
                    $containerClass .= ' video-info';
                    if ($arItem['DISPLAY_PROPERTIES']['PARALLAX_1']['VALUE'] > 0) {
                        $parallaxItems[1] = $arItem['DISPLAY_PROPERTIES']['PARALLAX_1']['FILE_VALUE']['SRC'];
                    }
                }
                $detailUrl = $arItem['PROPERTIES']['LINK']['VALUE'];
                $blockSelector = ($detailUrl) ? 'a' : 'div';?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <<?=$blockSelector?><?if ($detailUrl):?> href="<?=$detailUrl?>"<?endif;?> class="<?=$blockClass?>"<?if ($picStatic['src']):?> style="background-image:url(<?=$picStatic['src']?>);"<?endif;?>>
                        <?if ($video):?>
                            <div class="video-item responsive-embed widescreen" data-video="<?=$video?>" data-time="<?=$videoTime?>"></div>
                        <?elseif (count($parallaxItems) > 0 && $pic['src']):?>
                            <span class="background parallax-background show-for-xlarge" style="background-image:url(<?=$pic['src']?>);">
                        <?endif;?>
                        <?if ($video && $parallaxItems[1]):?>
                            <div class="container row video-layout show-for-large">
                                <img src="<?=$parallaxItems[1]?>" alt="<?=$arItem['NAME']?>">
                            </div>
                        <?endif;?>
                        <span class="<?=$containerClass?>">
                            <?if (!$video && count($parallaxItems) > 0):?>
                                <?foreach ($parallaxItems as $i => $src):?>
                                    <span class="parallax-item" data-speed="<?=$i?>" style="background-image:url(<?=$src?>);"></span>
                                <?endforeach;?>
                                </span>
                                </span>
                                <span class="container row parallax-info">
                            <?endif;?>
                            <span class="main-slider-caption"><?if ($arItem['PROPERTIES']['STYLE']['VALUE_XML_ID'] != 'none') :?><?=$arItem['NAME']?><?endif;?></span>
                            <?if ($arItem['PREVIEW_TEXT'] != '') :?>
                                <span class="main-slider-desc"><?=$arItem['PREVIEW_TEXT']?></span>
                            <?endif;?>
                            <?if ($detailUrl):
                                $urlTitle = ($arItem['DISPLAY_PROPERTIES']['BUTTON_TITLE']['VALUE'] != '') ? $arItem['DISPLAY_PROPERTIES']['BUTTON_TITLE']['VALUE'] : GetMessage("MORE");?>
						<!-- <span class="button hide-for-small-only"><?=$urlTitle?></span> -->
                            <?endif;?>
                        </span>
                    </<?=$blockSelector?>>
                </div>
            <?endif;
        endforeach;?>
    </div>
    <ul id="owl-dots-svg" class="owl-dots owl-dots-svg hide">
        <?for ($i = 0; $i < $itemCount; $i++):?>
            <li class="owl-dot">
                <svg class="dot-svg" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 20 20">
                    <path d="M10,5c2.8,0,5,2.2,5,5s-2.2,5-5,5s-5-2.2-5-5S7.2,5,10,5z"></path>
                </svg>
            </li>
        <?endfor;?>
    </ul>
<?endif;?>