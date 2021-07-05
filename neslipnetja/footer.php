<?IncludeTemplateLangFile(__FILE__);
use Bitrix\Main\Config\Option;
if (!CModule::IncludeModule('bitlate.proshop')) return false;
if (!$templateOptions) {
    $templateOptions = BitlateProUtils::initTemplateOptions();
}
BitlateProUtils::setOgDescription();
$requestCallbackTitle = Option::get('bitlate.proshop', "NL_REQUEST_CALLBACK_TITLE", false, SITE_ID);
$isSearch = ($APPLICATION->GetCurDir() == $templateOptions['url_catalog_search'] && isset($_REQUEST['q']));?>
        <?if ((strpos($APPLICATION->GetCurDir(), $templateOptions['url_catalog']) === false || $isSearch)):?>
                <?if ($APPLICATION->GetCurDir() == SITE_DIR):?>
                <?elseif ($APPLICATION->GetCurDir() == SITE_DIR . 'personal/cart/' || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/order/make/') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/order/payment/') === 0):?>
                        <?if ($APPLICATION->GetCurDir() == SITE_DIR . 'personal/cart/'):?>
                            </article>
                        <?endif;?>
                        </div>
                    </div>
                <?elseif (strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'auth/') === 0):?>
                    <?if (ERROR_404 != "Y"):?>
                            </article>
                        </div>
                    <?endif;?>
                <?elseif ($APPLICATION->GetCurDir() == SITE_DIR . 'personal/' || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/') === 0):?>
                        </article>
                    </div>
                <?elseif ($isSearch):?>
                        </article>
                    </div>
                <?else:?>
                    <?if (ERROR_404 != "Y"):?>
                                </div>
                            </article>
                        </div>
                        <?if ($templateOptions['banner_type']['BOTTOM'] == 1 && \Bitrix\Main\Loader::includeModule('advertising')):?>
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
                    <?endif;?>
                <?endif;?>
            </section>
        <?endif;?>
        <?if ($templateOptions['banner_type']['FOOTER'] == 1 && \Bitrix\Main\Loader::includeModule('advertising')):?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:advertising.banner",
                "main",
                Array(
                    "CACHE_TIME" => "0",
                    "CACHE_TYPE" => "A",
                    "NOINDEX" => "Y",
                    "QUANTITY" => "1",
                    "TYPE" => "BITLATE_BOTTOM_FOOTER",
                )
            );?>
        <?endif;?>
        <footer>
            <?/*<div class="footer-line-top">
                <div class="advanced-container-medium footer-line-top-container row large-up-2 xlarge-up-3">
                    <div class="column" id="bx_subscribe_small">
                        <?$frame = new \Bitrix\Main\Page\FrameHelper("bx_subscribe_small", false);
                        $frame->begin();?>
                            <?require($_SERVER["DOCUMENT_ROOT"] . SITE_DIR . "include/popup/subscribe_small.php");?>
                        <?$frame->beginStub();?>
                        <?$frame->end();?>
                    </div>
                </div>
            </div>*/?>
            <div class="footer-main">
                <div class="advanced-container-medium inline-block-container text-center">
                    <div class="footer-info inline-block-item">
                        <a href="<?=SITE_DIR?>" class="footer-info-logo">
                            <?$APPLICATION->IncludeFile(
                                SITE_DIR . "include/logo.php",
                                Array(
                                    "PATH_TO_LOGO" => "/local/templates/" . SITE_TEMPLATE_ID . "/themes/" . $templateOptions['theme'] . "/images/logo.png",
                                )
                            );?>
                        </a>
                        <div class="footer-info-phone">
                            <?$phone = BitlateProUtils::getGeoPhone();?>
                            <div class="footer-info-phone-number"><?if ($phone):?><?=$phone?><?else:?><?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "PATH" => SITE_DIR . "include/phone.php"
                                    )
                                );?><?endif;?></div>
                            <div class="footer-info-phone-link"><a href="#request-callback" class="fancybox"><?=$requestCallbackTitle?></a></div>
                        </div>
                        <?$orderEmail = COption::GetOptionString("sale", "order_email");
                        if ($orderEmail):?>
                            <a class="footer-info-mail" href="mailto:<?=$orderEmail?>"><?=$orderEmail?></a>
                        <?endif;?>
                        <div class="show-for-large column">
                            <?$APPLICATION->IncludeFile(
                                SITE_DIR . "include/social_links.php",
                                Array()
                            );?>
                        </div>
                        <div class="footer-line-top-caption">Способы оплаты</div>
                        <ul class="pay-system-list small inline-block-container">
                            <li class="inline-block-item"><img src="/local/templates/bitlate_pro/images/pay-4.png" alt=""></li>
                            <li class="inline-block-item"><img src="/local/templates/bitlate_pro/images/pay-2.png" alt=""></li>
                            <? /*?><li class="inline-block-item"><img src="/local/templates/bitlate_pro/images/pay-3.png" alt=""></li>
                            <li class="inline-block-item"><img src="/local/templates/bitlate_pro/images/pay-1.png" alt=""></li><?*/?>
                        </ul>
                    </div>
                    <!--noindex-->
                    <nav class="footer-main-menu inline-block-item show-for-xlarge">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu", 
                            "footer", 
                            array(
                                "ROOT_MENU_TYPE" => "main_bottom",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "36000000",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "2",
                                "USE_EXT" => "Y",
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "bottom",
                                "DELAY" => "N"
                            ),
                            false
                        );?>
                    </nav>
                    <!--/noindex-->
                </div>
            </div>
            <div class="footer-copyright">
                <div class="advanced-container-medium">
                    <div class="footer-copyright-company"><?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "PATH" => SITE_DIR . "include/copyright.php"
                        )
                    );?></div>
                    <div class="footer-copyright-design"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
	"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"PATH" => SITE_DIR."include/developer.php"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?></div>
                </div>
            </div>
        </footer>
        <a href="javascript:;" class="scroll-up-down button">
            <svg class="icon">
                <use xlink:href="#svg-icon-up-down"></use>
            </svg>
        </a>
        <div id="bx_fancybox_blocks">
            <?$frame = new \Bitrix\Main\Page\FrameHelper("bx_fancybox_blocks");
            $frame->begin();?>
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", 
                    array(
                        "AREA_FILE_SHOW" => "file", 
                        "PATH" => SITE_DIR."include/popup/service_order.php"
                    ),
                false);?>
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", 
                    array(
                        "AREA_FILE_SHOW" => "file", 
                        "PATH" => SITE_DIR."include/popup/request_call.php"
                    ),
                false);?>
                <?$APPLICATION->IncludeFile(
                    SITE_DIR . "include/favorites.php",
                    Array(
                        'USER_FAVORITES' => array(),
                    )
                );?>
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/popup/buy1click.php"
                ),
                false);?>
                <div id="subscribe-success" class="fancybox-block">
                    <div class="fancybox-block-caption"></div>
                    <div class="fancybox-block-wrap">
                        <p class="result-text"></p>
                    </div>
                </div>
                <div id="subscribe-add" class="fancybox-block">
                    <div class="fancybox-block-caption"></div>
                    <div class="fancybox-block-wrap">
                        <div class="fancybox-block-wrap-form"></div>
                        <p class="result-text"></p>
                    </div>
                </div>
                <?if (!$USER->IsAuthorized()):?>
                    <?$APPLICATION->IncludeComponent("bitrix:main.include", "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR."include/popup/login.php"
                        ),
                    false);?>
                    <?$APPLICATION->IncludeComponent("bitrix:main.include", "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR."include/popup/registration.php"
                    ),
                    false);?>
                    <?$APPLICATION->IncludeComponent("bitrix:main.include", "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR."include/popup/forgotpasswd.php"
                    ),
                    false);?>
                <?endif;?>
            <?$frame->beginStub();?>
            <?$frame->end();?>
        </div>
    </div>
    <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_element_custom_menu.php");?>
    <?$APPLICATION->IncludeComponent("bitlatepro:cookies.info","",Array());?>
    <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/footer_body.php");?>
</body>
</html>