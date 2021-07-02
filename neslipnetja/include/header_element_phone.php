<?if ($templateOptions['header_version'] != 'v2'):?>
    <div class="inline-block-container">
    <svg class="icon">
        <use xlink:href="#svg-icon-phone"></use>
    </svg>
    <div class="inline-block-item">
<?endif;
use Bitrix\Main\Config\Option;
$requestCallbackTitle = Option::get('bitlate.proshop', "NL_REQUEST_CALLBACK_TITLE", false, SITE_ID);?>
        <div class="header-phone-number">
            <div class="inline-block">
                <?$phone = BitlateProUtils::getGeoPhone();?>
                <?if ($phone):?>
                    <?=$phone?>
                <?else:?>
                    <?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"PATH" => SITE_DIR."include/phone-new.php",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
                <?endif;?>
            </div>
        </div>
       <!-- <div class="header-phone-link"><a href="#request-callback" class="fancybox"><?=$requestCallbackTitle?></a></div> -->
       <div class="header-phone-link"><a href="#"><?=getMessage('WORK_TIME')?></a></div>
<?if ($templateOptions['header_version'] != 'v2'):?>
        </div>
    </div>
<?endif;?>