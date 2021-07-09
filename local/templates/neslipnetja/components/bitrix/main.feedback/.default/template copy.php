<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
 
$userConsent = COption::GetOptionString("bitlate.proshop", "NL_USER_CONSENT_FEEDBACK", "N", SITE_ID);
$userConsentId = intval(COption::GetOptionString("bitlate.proshop", "NL_USER_CONSENT_FEEDBACK_ID", "", SITE_ID));
$userConsentIsChecked = COption::GetOptionString("bitlate.proshop", "NL_USER_CONSENT_IS_CHECKED", "N", SITE_ID);
$userConsentIsLoaded = COption::GetOptionString("bitlate.proshop", "NL_USER_CONSENT_IS_LOADED", "N", SITE_ID);
?>
<div class="feedback-container">
    <?if(strlen($arResult["OK_MESSAGE"]) > 0):?>
        <div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div>
    <?elseif (!empty($arResult["ERROR_MESSAGE"]) && count($arResult['ERROR_FIELDS']) > 0):?>
        <?foreach($arResult["ERROR_MESSAGE"] as $v):?>
            <?=$v?>
        <?endforeach;?>
    <?endif;?>
    <script>
        $(document).ready(function(){
            initValidate("#main-feedback-form");
        })
    </script>
    <form action="<?=POST_FORM_ACTION_URI?>" id="main-feedback-form" method="POST" class="form" data-ajax="<?=SITE_DIR?>nl_ajax/main_feedback.php">
        <?=bitrix_sessid_post()?>
        <div class="row">
            <div class="column xxlarge-6">
                <input type="text" name="user_name" placeholder="<?=GetMessage("MFT_NAME")?>" value="<?=$arResult["AUTHOR_NAME"]?>" class="<?=(in_array("NAME", $arResult["ERROR_FIELDS"]) ? 'error' : '')?>">
                <input type="text" name="user_email" placeholder="<?=GetMessage("MFT_EMAIL")?>" value="<?=$arResult["AUTHOR_EMAIL"]?>" class="<?=(in_array("EMAIL", $arResult["ERROR_FIELDS"]) ? 'error' : '')?>">
                <?if($arParams["USE_CAPTCHA"] == "Y"):?>
                    <div class="table-container captha-block">
                        <div class="table-item"><input type="text" name="captcha_word" placeholder="<?=GetMessage("MFT_CAPTCHA")?>" class="<?=(in_array("CAPTCHA", $arResult["ERROR_FIELDS"]) ? 'error' : '')?>"></div>
                        <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
                        <div class="table-item captha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="126" height="38" alt="CAPTCHA" class="photo"></div>
                    </div>
                <?endif;?>
            </div>
            <div class="column xxlarge-6">
                <textarea name="MESSAGE" placeholder="<?=GetMessage("MFT_MESSAGE")?>" class="<?=(in_array("MESSAGE", $arResult["ERROR_FIELDS"]) ? 'error' : '')?>"><?=$arResult["MESSAGE"]?></textarea>
            </div>
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
                            "INPUT_NAME" => 'main_feedback_user_consent',
                            "REPLACE" => array(
                                'button_caption' => GetMessage("MFT_SUBMIT"),
                                'fields' => array(GetMessage("MFT_NAME"), GetMessage("MFT_EMAIL")),
                            ),
                        )
                    );?>
                </fieldset>
            <?endif;?>
        </div>
        <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
        <input type="hidden" name="submit" value="submit">
        <button type="submit" class="button float-right"><?=GetMessage("MFT_SUBMIT")?></button>
    </form>
</div>