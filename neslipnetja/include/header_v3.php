<?use Bitrix\Main\Config\Option;
//$catalogMenuTitle = Option::get('bitlate.proshop', "NL_CATALOG_MENU_TITLE", false, SITE_ID);
$catalogMenuTitle = 'Каталог';
?>
<div class="header-line-center">
    <div class="advanced-container inline-block-container relative header-mobile-fixed">
        <a href="javascript:;" class="header-mobile-toggle inline-block-item vertical-middle hide-for-xlarge">
            <svg class="icon">
                <use xlink:href="#svg-icon-m-toggle"></use>
            </svg>
        </a>
        <a href="<?=SITE_DIR?>" class="header-logo inline-block-item vertical-middle">
            <?$APPLICATION->IncludeFile(
                SITE_DIR . "include/logo.php",
                Array("PATH_TO_LOGO" => SITE_TEMPLATE_PATH . "/themes/" . $templateOptions['theme'] . "/images/logo.png")
            );?>
        </a>
        <div class="header-block-right show-for-xlarge">
            <div class="inline-block-item" id="title-search">
                <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_element_search_title.php");?>
            </div>
            <div class="header-phone inline-block-item">
                <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_element_phone.php");?>
            </div>
            <div class="header-cart header-block-info inline-block-item">
                <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_element_basket.php");?>
            </div>
        </div>
        <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_element_fixed_block.php");?>
    </div>
</div>
<div class="header-line-bottom show-for-xlarge header-menu-fixed">
    <div class="advanced-container inline-block-container relative">
        <div class="header-line-bottom-menu table-container float-left">
            <a href="javascript:;" data-toggle="header-main-menu-wrap" class="header-main-menu-button table-item"><?=$catalogMenuTitle?></a>
            <div id="header-main-menu-wrap" class="dropdown-pane main-menu-dropdown-wrap" data-dropdown data-close-on-click="true" data-v-offset="1">
                <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_element_catalog_menu.php");?>
            </div>
            <div class="table-item">
                <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_element_geolocation.php");?>
            </div>
            <div class="inline-block">
                <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_element_top_menu.php");?>
            </div>
        </div>
        <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_element_personal_menu.php");?>
    </div>
</div>