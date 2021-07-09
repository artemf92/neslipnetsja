<?$TEMPLATE_THEME = ($PRODUCT_TYPE == 'slider') ? 'slider' : '';
$PAGE_ELEMENT_COUNT = ($PRODUCT_TYPE == 'slider') ? '999999' : '15';?>
<?if ($INIT == "Y"):?>
	<div>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/" . SITE_ID ."/product_tab.php");?>
<?if ($INIT == "Y"):?>
	</div>
<?endif;?>