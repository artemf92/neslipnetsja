<?$APPLICATION->IncludeComponent("bitrix:subscribe.form", ".default", array(
	"USE_PERSONALIZATION" => "Y",
		"PAGE" => "/personal/subscribe/subscr_edit.php",
		"SHOW_HIDDEN" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>