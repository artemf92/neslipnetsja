<?$APPLICATION->IncludeComponent(
    "bitrix:main.feedback", 
    ".default", 
    array(
        "USE_CAPTCHA" => "Y",
        "OK_TEXT" => "Спасибо, ваш вопрос принят.",
        "EMAIL_TO" => "#NL_SITE_EMAIL#",
        "REQUIRED_FIELDS" => array(
            0 => "NAME",
            1 => "EMAIL",
            2 => "MESSAGE",
        ),
        "EVENT_MESSAGE_ID" => array(
        )
    ),
    false
);?>