<?use Bitrix\Main\Config\Option;
$blockRecomendTitle = Option::get('bitlate.proshop', "NL_TAB_RECOMEND_TITLE", false, SITE_ID);
$blockNewsTitle = Option::get('bitlate.proshop', "NL_TAB_NEWS_TITLE", false, SITE_ID);
$blockHitsTitle = Option::get('bitlate.proshop', "NL_TAB_HITS_TITLE", false, SITE_ID);
$blockDiscountTitle = Option::get('bitlate.proshop', "NL_TAB_DISCOUNT_TITLE", false, SITE_ID);
$deferLoad = Option::get('bitlate.proshop', "NL_DEFER_LOAD", false, SITE_ID);
?>
<h2 class="section__title appetite-title">Товары</h2>
<div class="main-product-tabs<?if ($deferLoad == "Y"):?> defer-tabs<?endif;?>">
    <div class="advanced-container-medium">
        <select class="select-tabs hide-for-large">
            <option value="#product-tab-recomend" data-tab-type="recomend"><?=$blockRecomendTitle?></option>
            <option value="#product-tab-news" data-tab-type="news"><?=$blockNewsTitle?></option>
            <option value="#product-tab-hits" data-tab-type="hits"><?=$blockHitsTitle?></option>
            <option value="#product-tab-discount" data-tab-type="discount"><?=$blockDiscountTitle?></option>
        </select>
        <ul class="tabs inline-block-container text-center show-for-large" id="main-product-tabs" data-tabs>
            <li class="tabs-title inline-block-item float-none is-active"><a href="#product-tab-recomend" data-tab-type="recomend"><span><?=$blockRecomendTitle?></span></a></li>
            <li class="tabs-title inline-block-item float-none"><a href="#product-tab-news" onclick="initDeferTab('news')"><span><?=$blockNewsTitle?></span></a></li>
            <li class="tabs-title inline-block-item float-none"><a href="#product-tab-hits" onclick="initDeferTab('hits')"><span><?=$blockHitsTitle?></span></a></li>
            <li class="tabs-title inline-block-item float-none"><a href="#product-tab-discount" onclick="initDeferTab('discount')"><span><?=$blockDiscountTitle?></span></a></li>
        </ul>
    </div>
    <div class="advanced-container-medium row tabs-content" data-tabs-content="main-product-tabs">
        <?$arTabs = array('recomend', 'news', 'hits', 'discount');
        foreach ($arTabs as $type):?>
            <div class="tabs-panel<?if ($type == 'recomend'):?> is-active<?endif;?>" id="product-tab-<?=$type?>">
                <?if ($deferLoad == "Y"):?>
                    <div class="product-grid-<?=$type?>" id="product-grid-<?=$type?>" data-ajax="<?=SITE_DIR?>nl_ajax/product_tab.php?TAB_TYPE=<?=$type?>&PRODUCT_TYPE=<?=$templateOptions['product_type']?>&INIT=Y&load=Y">
                    </div>
                <?else:?>
					<?if ($type=="discount"){?>
				 <?require($_SERVER["DOCUMENT_ROOT"] . SITE_DIR . "include/discount_main.php");?><?}
					else
					{	
					if ($templateOptions['product_type'] != 'slider'):?>
                        <div class="product-grid-<?=$type?>">
                    <?endif;?>
                        <?$PRODUCT_TYPE = $templateOptions['product_type'];
                        $PRODUCT_COUNT = $templateOptions['product_count'];
                        $TYPE = $type;?>
                        <?require($_SERVER["DOCUMENT_ROOT"] . SITE_DIR . "include/popup/product_tab.php");?>
					<?}?>	
                <?endif;?>
            </div>
        <?endforeach;?>
        <?if ($deferLoad == "Y"):?>
            <script>
                $(window).on('load', function() {
                    setTimeout(function(){
                        $('#catalog-preloader-recomend').show();
                        getCatalogItems(".product-grid-recomend", '.product-grid-recomend', false, true, true);
                    }, 6000);
                })
            </script>
        <?endif;?>
    </div>
</div>