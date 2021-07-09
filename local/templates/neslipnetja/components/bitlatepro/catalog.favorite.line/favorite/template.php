<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!CModule::IncludeModule('bitlate.proshop')) return;
$headerVersion = BitlateProUtils::getHeaderVersion();?>

<div class="inline-block-item relative" id="bx_favorite_count">
    <?$frame = new \Bitrix\Main\Page\FrameHelper("bx_favorite_count", false);
    $frame->begin();
        $countFav = BitlateProUtils::getCountFavorits();?>
        <a href="javascript:;" class="button transparent add2liked inline-block-item relative add2liked_fancybox">
            <svg class="icon">
                <use xlink:href="#svg-icon-liked"></use>
            </svg>
            <?if (in_array($headerVersion, array('v1', 'v3'))):
                $countFavCaptionMini = $countFav . ' ' . BitlateProUtils::nl_inclination($countFav, GetMessage('NL_PRODUCT_1'), GetMessage('NL_PRODUCT_2'), GetMessage('NL_PRODUCT_10'));?>
                <span class="text"><?=getMessage('FAVORITE')?></span>
                <span class="header-block-info-counter inline-block-item add2liked_counter" title="<?=$countFavCaptionMini?>"><?if ($countFav > 0):?><?=$countFav?><?endif;?></span>
                
            <?else:?>
                <?=getMessage('FAVORITE')?><span class="add2liked_counter"><?if ($countFav > 0):?> (<?=$countFav?>)<?endif;?></span>
            <?endif;?>
        </a>
        <div class="liked_products" style="display:none;">
            <?if ($countFav > 0):
                $likedProducts = BitlateProUtils::getFavorits();?>
                    <?foreach ($likedProducts as $position => $offers):
                        foreach ($offers as $offerId => $count):
                            $productId = ($offerId > 0) ? $offerId : $position;?>
                            <div data-product-id="<?=$productId?>"></div>
                        <?endforeach;?>
                    <?endforeach;?>
            <?endif;?>
        </div>
    <?$frame->beginStub();?>
        <a href="javascript:;" class="button transparent add2liked inline-block-item relative add2liked_fancybox">
            <svg class="icon">
                <use xlink:href="#svg-icon-liked"></use>
            </svg>
            <?if (in_array($headerVersion, array('v1', 'v3'))):?>
                <span class="text"><?=getMessage('FAVORITE')?></span>
            <?else:?>
                <?=getMessage('FAVORITE')?>
            <?endif;?>
        </a>
    <?$frame->end();?>
    <script>
        var NL_ADD_2_LIKED_DELETE = '<?=GetMessage('ADD_2_LIKED_DELETE')?>';
        var NL_ADD_2_LIKED = '<?=GetMessage('ADD_2_LIKED')?>';
    </script>
</div>