<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");?>
<div class="contacts-map">
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.store.list",
		"map",
		Array(
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"PATH_TO_ELEMENT" => SITE_DIR."company/shops/#store_id#.html",
			"PHONE" => "Y",
			"SCHEDULE" => "Y",
			"SET_TITLE" => "N",
			"TITLE" => ""
		)
	);?>
	<div class="contacts-content">
		 <?$APPLICATION->IncludeComponent(
			"bitrix:catalog.store.list",
			"main",
			Array(
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"PATH_TO_ELEMENT" => SITE_DIR."company/shops/#store_id#.html",
				"PHONE" => "Y",
				"SCHEDULE" => "Y",
				"SET_TITLE" => "N",
				"TITLE" => ""
			)
		);?>
	</div>
</div>
<div class="requisites">
	ИП Столярова Оксана Викторовна<br>
	<br>
	ИНН 780714312816 \ ОГРНИП 315784700228629&nbsp;<br>
	г. Санкт-Петербург, пр-кт Стачек 99, офис 4 (ТРК Континент)<br>
	Банк: Северо-Западный банк ПАО Сбербанк России&nbsp;<br>
	БИК 044030653&nbsp;<br>
	р/с 40802810755240002620&nbsp;<br>
	к/с 30101810500000000653&nbsp;<br>
</div>
<div class="siction__title appetite-title">Задать вопрос</div>
<div class="row contacts-bottom">
	
	<div class="inner-content-contact-right large-6 xxlarge-8 columns">
		 <?=BitlateProUtils::getGeoContactText();?> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/contacts.php"
	)
);?>
		<div id="bx_main_feedback">
			 <?$frame = new \Bitrix\Main\Page\FrameHelper("bx_main_feedback", false);
            $frame->begin();?> <?require ($_SERVER["DOCUMENT_ROOT"] . SITE_DIR . "include/popup/feedback.php");?> <?$frame->beginStub();?> <?$frame->end();?>
		</div>
	</div>
</div>
 <br>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>