<div class="login-block">
    <?$APPLICATION->IncludeComponent(
        "bitrix:system.auth.form",
        "errors",
        Array(
            "REGISTER_URL" => "",
            "FORGOT_PASSWORD_URL" => "",
            "PROFILE_URL" => "/personal/",
            "SHOW_ERRORS" => "Y"
        )
    );?>
    <?$APPLICATION->IncludeComponent("bitrix:system.auth.registration","",Array("STATIC_FORM" => (isset($_REQUEST['static']) && $_REQUEST['static'] == "Y") ? "Y" : "N"));?>
</div>