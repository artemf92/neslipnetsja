<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
if (!CModule::IncludeModule('bitlate.proshop')) return false;
$templateOptions = BitlateProUtils::initTemplateOptions();
global $USER;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?$APPLICATION->SetAdditionalCSS("https://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic,900,900italic&subset=cyrillic-ext,cyrillic,latin");?>
    <?$APPLICATION->SetAdditionalCSS($templateOptions['theme_css']);?>
    <?$APPLICATION->SetAdditionalCSS("/local/templates/".SITE_TEMPLATE_ID."/css/site.css");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/jquery.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/jquery-ui.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/foundation.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/isotope.pkgd.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/packery-mode.pkgd.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/slideout.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/owl.carousel.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/jquery.fancybox.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/zoomsl.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/selectbox.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/jquery.inputmask.bundle.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/jquery.lazy.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/yandex.maps.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/main.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/colorpicker.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/jquery.validate.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/site.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/jquery-ui.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/scripts.js");?>
    <?if (strpos($APPLICATION->GetCurDir(), SITE_DIR . 'company/contacts') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'company/shops') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'shop/delivery') === 0):?>
        <?$APPLICATION->AddHeadScript("https://api-maps.yandex.ru/2.1/?lang=ru_RU");?>
    <?endif;?>
    <?$APPLICATION->ShowHead()?>
    <title><?$APPLICATION->ShowTitle();?></title>
    <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_favicon.php");?>
    <meta property="og:title" content="<?$APPLICATION->ShowTitle();?>"/>
    <?$APPLICATION->ShowProperty("og_description");?>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?=BitlateProUtils::getServerProtocol() . $_SERVER['HTTP_HOST'] . $APPLICATION->GetCurUri()?>" />
    <?$APPLICATION->ShowProperty("og_img");?>
    <?$APPLICATION->ShowProperty("og_width");?>
    <?$APPLICATION->ShowProperty("og_height");?>
    <?if ($templateOptions['pwa_use'] == "Y"):?>
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('<?=SITE_DIR?>service-worker.js').then(
                        function(registration) {
                            console.log('ServiceWorker registration successful with scope: ', registration.scope);
                        },
                        function(err) {
                            console.log('ServiceWorker registration failed: ', err);
                        }
                    );
                });
            }
        </script>
    <?endif;?>
    <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_head.php");?>
</head>
<body>
    <?$APPLICATION->ShowPanel();?>
    <div style="height: 0; width: 0; position: absolute; visibility: hidden">
        <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_svg.php");?>
    </div>
    
    <nav id="mobile-menu" class="mobile-menu hide-for-xlarge">
        <div class="mobile-menu-wrapper">
            <a href="<?=SITE_DIR?>personal/" class="button mobile-menu-profile relative">
                <svg class="icon">
                    <use xlink:href="#svg-icon-profile"></use>
                </svg>
                <?=getMessage('PERSONAL_CABINET')?>
            </a>
            <div class="is-drilldown">
                <!--noindex-->
                <?$APPLICATION->IncludeComponent('bitrix:menu', "mobile_menu_main", array(
                        "ROOT_MENU_TYPE" => "main",
                        "MENU_CACHE_TYPE" => "Y",
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MAX_LEVEL" => "2",
                        "USE_EXT" => "Y",
                        "ALLOW_MULTI_SELECT" => "N",
                        "SUB_CLASS" => "mobile-menu-main",
                    )
                );?>
                <!--/noindex-->
                <?$APPLICATION->IncludeComponent('bitrix:menu', "mobile_menu_main", array(
                        "ROOT_MENU_TYPE" => "site",
                        "MENU_CACHE_TYPE" => "Y",
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MAX_LEVEL" => "2",
                        "USE_EXT" => "Y",
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "bottom",
                        "DELAY" => "N",
                    )
                );?>
                <form action="<?=$templateOptions['url_catalog_search']?>" class="mobile-menu-search relative">
                    <button type="submit">
                        <svg class="icon">
                            <use xlink:href="#svg-icon-search"></use>
                        </svg>
                    </button>
                    <input type="text" placeholder="<?=getMessage('SEARCH_STRING')?>" name="q" class="hollow" />
                </form>
                <div class="mobile-menu-info">
                    <p><?=getMessage('TITLE_CONTACTS')?></p>
                    <?$phone = BitlateProUtils::getGeoPhone();?>
                    <p><?if ($phone):?><?=$phone?><?else:?><?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "PATH" => SITE_DIR . "include/phone.php"
                        )
                    );?><?endif;?></p>
                    <?$orderEmail = COption::GetOptionString("sale", "order_email");
                    if ($orderEmail):?>
                        <p><a href="mailto:<?=$orderEmail?>"><?=$orderEmail?></a></p>
                    <?endif;?>
                    <?$APPLICATION->IncludeFile(
                        SITE_DIR . "include/social_links_mobile.php",
                        Array()
                    );?>
                </div>
            </div>
        </div>
    </nav>
    <?$headerClass = $templateOptions['header_class'];
    if ($APPLICATION->GetCurDir() == SITE_DIR) {
        $headerClass .= ' index-page';
    }
    if ($templateOptions['main_menu_pos'] == 'fix') {
        $headerClass .= ' menu-fixed';
    }
    if ($templateOptions['use_lazy_load'] == 'Y') {
        $headerClass .= ' page-lazy';
    }?>
    <div id="page" class="<?=trim($headerClass)?>">
        <?if ($templateOptions['banner_type']['HEADER'] == 1 && \Bitrix\Main\Loader::includeModule('advertising')):?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:advertising.banner",
                "main",
                Array(
                    "CACHE_TIME" => "0",
                    "CACHE_TYPE" => "A",
                    "NOINDEX" => "Y",
                    "QUANTITY" => "1",
                    "TYPE" => "BITLATE_TOP_HEADER"
                )
            );?>
        <?endif;?>
        <header<?if ($templateOptions['basket_pos'] == 'fixed'):?> class="header-fixed"<?endif;?>>
            <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_" . $templateOptions['header_version'] . ".php");?>
            <?if ($templateOptions['mobile_header'] == "Y"):?>
                <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_mobile.php");?>
            <?endif;?>
        </header>
        <?$classSection = "";
        $isSearch = ($APPLICATION->GetCurDir() == $templateOptions['url_catalog_search'] && isset($_REQUEST['q']));
        if ($APPLICATION->GetCurDir() == SITE_DIR) {
        } elseif ($APPLICATION->GetCurDir() == SITE_DIR . 'personal/cart/' || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/order/make/') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/order/payment/') === 0) {
            $classSection = "cart";
        } elseif (($APPLICATION->GetCurDir() == SITE_DIR . 'personal/subscribes/' || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/subscribes/') === 0) && $USER->IsAuthorized()) {
            $classSection = "catalog";
        } elseif (($APPLICATION->GetCurDir() == SITE_DIR . 'personal/' || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/') === 0) && $USER->IsAuthorized()) {
            $classSection = "inner";
        } elseif (ERROR_404 == "Y") {
            $classSection = "not-found";
        } elseif (strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'auth/') === 0) {
            $classSection = "fancy";
        } else {
            $classSection = "inner";
        }
        if (ERROR_404 != "Y" && (strpos($APPLICATION->GetCurDir(), $templateOptions['url_catalog']) === false || $isSearch)):?>
            <section class="<?=$classSection?>">
                <?if ($APPLICATION->GetCurDir() == SITE_DIR):?>
                    <?foreach ($templateOptions['positions'] as $position => $pos):
                        $positionFile = $pos['path'];
                        if ($pos['visible'] == 1 && ($position != 'ACTIONS' || ($position == 'ACTIONS' && !$templateOptions['main_actions_position']))) {
                            require($positionFile);
                        }
                    endforeach;?>
                <?elseif ($APPLICATION->GetCurDir() == SITE_DIR . 'personal/cart/' || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/order/make/') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/order/payment/') === 0):?>
                    <div class="inner-bg">
                        <div class="advanced-container-medium">
                            <?if ($APPLICATION->GetCurDir() == SITE_DIR . 'personal/cart/'):?>
                                <nav class="show-for-large text-center">
                                    <ul class="breadcrumbs cart">
                                        <li class="active"><div class="float-right"><span>1</span> <?=getMessage('STEP_CART')?></div></li>
                                        <li><div class="float-right"><span>2</span> <?=getMessage('STEP_ORDER')?></div></li>
                                    </ul>
                                </nav>
                                <article class="basket-wrap">
                            <?elseif (strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/order/make/') === 0):?>
                                <nav class="show-for-large text-center">
                                    <ul class="breadcrumbs cart">
                                        <li class="active"><div class="float-right"><a href="<?=SITE_DIR . 'personal/cart/'?>"><span>1</span> <?=getMessage('STEP_CART')?></a></div></li>
                                        <li class="active"><div class="float-right"><span>2</span> <?=getMessage('STEP_ORDER')?></div></li>
                                    </ul>
                                </nav>
                            <?endif;?>
                <?elseif (($APPLICATION->GetCurDir() == SITE_DIR . 'personal/' || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/') === 0) && $USER->IsAuthorized()):?>
                    <div class="advanced-container-medium">
                        <nav>
                            <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
                                    "START_FROM" => "0", 
                                    "PATH" => "", 
                                )
                            );?>
                        </nav>
                        <article class="inner-container">
                            <h1><?$APPLICATION->ShowTitle(false)?></h1>
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "left", array(
                                    "ROOT_MENU_TYPE" => "personal",
                                    "MENU_CACHE_TYPE" => "Y",
                                    "MENU_CACHE_TIME" => "36000000",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => array(
                                    ),
                                    "MAX_LEVEL" => "1",
                                    "USE_EXT" => "N",
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "DELAY" => "N",
                                    "SHOW_NAV" => "Y",
                                ),
                                false
                            );?>
                <?elseif ($isSearch):?>
                    <div class="advanced-container-medium">
                        <nav>
                            <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
                                    "START_FROM" => "0", 
                                    "PATH" => "", 
                                )
                            );?>
                        </nav>
                        <article class="inner-container">
                            <h1><?$APPLICATION->ShowTitle(false)?></h1>
                <?elseif (strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'auth/') === 0):?>
                    <div class="inner-bg">
                        <article class="inner-container float-center table-container">
                <?else:?>
                    <?if ($templateOptions['banner_type']['TOP'] == 1 && \Bitrix\Main\Loader::includeModule('advertising')):?>
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
                    <div class="advanced-container-medium">
                        <nav>
                            <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
                                    "START_FROM" => "0", 
                                    "PATH" => "", 
                                )
                            );?>
                        </nav>
                        <article class="inner-container">
                            <h1><?$APPLICATION->ShowTitle(false)?></h1>
                            <?if ($templateOptions['banner_type']['LEFT'] == 1):?>
                                <nav class="inner-menu columns show-for-xlarge">
                            <?endif;?>
                                <?$APPLICATION->IncludeComponent("bitrix:menu", "left", array(
                                        "ROOT_MENU_TYPE" => "left",
                                        "MENU_CACHE_TYPE" => "Y",
                                        "MENU_CACHE_TIME" => "36000000",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "MENU_CACHE_GET_VARS" => array(
                                        ),
                                        "MAX_LEVEL" => "1",
                                        "USE_EXT" => "N",
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "DELAY" => "N",
                                        "SHOW_NAV" => ($templateOptions['banner_type']['LEFT'] == 1) ? "N" : "Y",
                                    ),
                                    false
                                );?>
                                <?if ($templateOptions['banner_type']['LEFT'] == 1 && \Bitrix\Main\Loader::includeModule('advertising')):?>
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
                                    </nav>
                                <?endif;?>
                            <div class="inner-content <?=BitlateProUtils::getLeftMenu($templateOptions['banner_type']['LEFT'])?>">
                <?endif;?>
        <?endif;?>