<?
__IncludeLang($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . "/lang/" . LANGUAGE_ID . "/ajax.php", false, true);

global $USER;
$name = '';
$phone = '';
if (isset($arResult['post']['id'])) {
    $name = htmlspecialcharsEx($arResult['post']['NAME']);
    $phone = htmlspecialcharsEx($arResult['post']['PHONE']);
} else {
    if ($USER->IsAuthorized()) {
        $dbUser = CUser::GetByID($USER->GetID());
        if ($arUser = $dbUser->fetch()) {
            $name = htmlspecialcharsbx(implode(' ', array($arUser['LAST_NAME'], $arUser['NAME'])));
            $phone = htmlspecialcharsbx($arUser['PERSONAL_PHONE']);
        }
    }
}
$userConsent = COption::GetOptionString("bitlate.proshop", "NL_USER_CONSENT_BUY1CLICK", "N", SITE_ID);
$userConsentId = intval(COption::GetOptionString("bitlate.proshop", "NL_USER_CONSENT_BUY1CLICK_ID", "", SITE_ID));
$userConsentIsChecked = COption::GetOptionString("bitlate.proshop", "NL_USER_CONSENT_IS_CHECKED", "N", SITE_ID);
$userConsentIsLoaded = COption::GetOptionString("bitlate.proshop", "NL_USER_CONSENT_IS_LOADED", "N", SITE_ID);
$buy1ClickTitle = COption::GetOptionString('bitlate.proshop', "NL_MESS_BTN_BUY_1_CLICK_TITLE", false, SITE_ID);
?>
<div id="buy-to-click" class="fancybox-block">
    <div class="fancybox-block-caption"><?=$buy1ClickTitle?></div>
    <?if (isset($arResult['error'])):?>
        <div class="callout text-center error" data-closable><?=implode('<br />', $arResult['error'])?></div>
    <?endif;?>
    <div class="fancybox-block-wrap">
        <?if (isset($arResult['message'])):?>
            <p class="result-text"><?=$arResult['message']?></p>
        <?endif;?>
        <div class="form-block" <?if ($arResult['message']):?>style="display:none;"<?endif;?>>
            <div class="fancybox-text"><?=GetMessage('T_B1C_FORM_DESCRIPTION')?></div>
            <script>
                $(document).ready(function(){
                    initValidate("#buy-to-click-form");
                })
            </script>
            <form  action="<?=POST_FORM_ACTION_URI?>" id="buy-to-click-form" class="form fancybox-block-form" method="post" data-ajax="<?=SITE_DIR?>nl_ajax/buy1click.php">
                <?=bitrix_sessid_post()?>
                <input type="hidden" name="cart" value="<?=htmlspecialcharsEx($arResult['post']['cart'])?>"/>
                <input type="hidden" name="id" value="<?=htmlspecialcharsEx($arResult['post']['id'])?>"/>
                <input type="hidden" name="offer_id" value="<?=htmlspecialcharsEx($arResult['post']['offer_id'])?>"/>
                <input type="hidden" name="props" value="<?=htmlspecialcharsEx($arResult['post']['props'])?>"/>
                <input type="hidden" name="price" value="<?=htmlspecialcharsEx($arResult['post']['price'])?>"/>
                <input type="hidden" name="currency" value="<?=htmlspecialcharsEx($arResult['post']['currency'])?>"/>
                <input type="hidden" name="quantity" value="<?=htmlspecialcharsEx($arResult['post']['quantity'])?>"/>
                <input type="text" name="NAME" value="<?=$name?>" placeholder="<?=GetMessage('T_B1C_FORM_NAME')?>">
                <input type="text" name="PHONE" class="phone" value="<?=$phone?>" placeholder="<?=GetMessage('T_B1C_FORM_PHONE')?>">
                <?if ($userConsent == "Y" && $userConsentId > 0):?>
                    <fieldset class="block-main-user-consent-request checkbox-accept column">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.userconsent.request",
                            "",
                            array(
                                "ID" => $userConsentId,
                                "IS_CHECKED" => $userConsentIsChecked,
                                "AUTO_SAVE" => "Y",
                                "IS_LOADED" => $userConsentIsLoaded,
                                "INPUT_NAME" => 'buy1click_user_consent',
                                "REPLACE" => array(
                                    'button_caption' => GetMessage("T_B1C_FORM_BUTTON"),
                                    'fields' => array(GetMessage("T_B1C_FORM_NAME"), GetMessage("T_B1C_FORM_PHONE")),
                                ),
                            )
                        );?>
                    </fieldset>
                <?endif;?>
                <button type="submit" class="small-12 button small fancybox-button--submit text-center"><?=GetMessage('T_B1C_FORM_BUTTON')?></button>
            </form>
        </div>
    </div>
</div>