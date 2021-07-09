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
<h2 class="section__title appetite-title">Скидки</h2>
<div class="main-sales">
    <div class="main-sales-left">
        <div class="main-sales-left__content">
            <span>Для наших постоянных покупателей у нас предусмотрена накопительная система скидок!</span>
        </div>
        <div class="main-sales-left__bg"></div>
    </div>
    <div class="main-sales-right">
        <div class="main-sales-right__top">
            <div class="main-sales-right__top-content">В&nbsp;течение календарного месяца купите на&nbsp;10000 руб и&nbsp;мы&nbsp;выдадим вам карту постоянного покупателя!</div>
            <div class="main-sales-right__sale">5%</div>
            <div class="badge">
                <img src="/local/templates/neslipnetja/images/badge-sale.png" alt="">
            </div>
        </div>
        <div class="main-sales-right__bottom">
            <p class="text-center">Скидка не действует на акционный товар и на доставку</p>
            <svg width="120" height="10" viewBox="0 0 120 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M107.727 9.81559C104.032 9.81559 102.218 7.70276 100.909 6.15778C99.6364 4.68285 99.1227 4.24037 98.1818 4.24037C97.2409 4.24037 96.7318 4.67179 95.4546 6.15778C94.1318 7.70276 92.3227 9.81559 88.6364 9.81559C84.95 9.81559 83.1318 7.70276 81.8182 6.15778C80.5455 4.68285 80.0364 4.24037 79.0909 4.24037C78.1455 4.24037 77.6409 4.67179 76.3637 6.15778C75.0455 7.70276 73.2318 9.81559 69.5455 9.81559C65.8591 9.81559 64.0409 7.69908 62.7273 6.15778C61.4546 4.68285 60.9455 4.24037 60 4.24037C59.0546 4.24037 58.55 4.67179 57.2727 6.15778C55.9546 7.69908 54.1409 9.81559 50.4546 9.81559C46.7682 9.81559 44.9455 7.69908 43.6364 6.15778C42.3636 4.68285 41.8546 4.24037 40.9091 4.24037C39.9636 4.24037 39.4591 4.67179 38.1818 6.15778C36.8591 7.69908 35.05 9.81559 31.3636 9.81559C27.6773 9.81559 25.8546 7.70276 24.5455 6.15778C23.2727 4.68285 22.7636 4.24037 21.8182 4.24037C20.8727 4.24037 20.3727 4.67179 19.0909 6.15778C17.7727 7.69908 15.9591 9.81559 12.2727 9.81559C8.58637 9.81559 6.76819 7.69908 5.45455 6.15778C4.18637 4.68285 3.67273 4.24037 2.72728 4.24037C2.06424 4.24037 1.42835 4.02671 0.959513 3.64638C0.490672 3.26605 0.22728 2.75022 0.22728 2.21235C0.22728 1.67448 0.490672 1.15865 0.959513 0.778321C1.42835 0.397992 2.06424 0.184326 2.72728 0.184326C6.42273 0.184326 8.23183 2.30085 9.54546 3.84214C10.8136 5.31707 11.3273 5.75955 12.2727 5.75955C13.2182 5.75955 13.7182 5.32813 15 3.84214C16.3136 2.30085 18.1227 0.184326 21.8182 0.184326C25.5136 0.184326 27.3182 2.30085 28.6364 3.84214C29.9091 5.31707 30.4182 5.75955 31.3636 5.75955C32.3091 5.75955 32.8136 5.32813 34.0909 3.84214C35.4 2.30085 37.2091 0.184326 40.9091 0.184326C44.6091 0.184326 46.4136 2.30085 47.7273 3.84214C48.9955 5.31707 49.5091 5.75955 50.4546 5.75955C51.4 5.75955 51.9 5.32813 53.1818 3.84214C54.4909 2.30085 56.3 0.184326 60 0.184326C63.7 0.184326 65.5 2.29716 66.8182 3.84214C68.0909 5.31707 68.6 5.75955 69.5455 5.75955C70.4909 5.75955 70.9909 5.32813 72.2727 3.84214C73.5818 2.30085 75.3909 0.184326 79.0909 0.184326C82.7909 0.184326 84.5955 2.30085 85.9091 3.84214C87.1773 5.31707 87.6909 5.75955 88.6364 5.75955C89.5818 5.75955 90.0864 5.32813 91.3637 3.84214C92.6727 2.29716 94.4818 0.184326 98.1818 0.184326C101.882 0.184326 103.686 2.29716 105 3.84214C106.273 5.31707 106.782 5.75955 107.727 5.75955C108.673 5.75955 109.173 5.32813 110.455 3.84214C111.768 2.29716 113.577 0.184326 117.273 0.184326C117.936 0.184326 118.572 0.397992 119.041 0.778321C119.509 1.15865 119.773 1.67448 119.773 2.21235C119.773 2.75022 119.509 3.26605 119.041 3.64638C118.572 4.02671 117.936 4.24037 117.273 4.24037C116.336 4.24037 115.823 4.67179 114.545 6.15778C113.232 7.70276 111.418 9.81559 107.727 9.81559Z" stroke="#74C5F3" stroke-miterlimit="10"/>
                </g>
                <defs>
                <clipPath id="clip0">
                <rect width="120" height="10" fill="white"/>
                </defs>
            </svg>
            <p class="text-center">Если у вас уже есть карта, обязательно сообщайте об это во время формирования заказа, в противном случае скидка посчитана не будет!</p>
        </div>
    </div>
</div>