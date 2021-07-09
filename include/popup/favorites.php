<?if (CModule::IncludeModule('bitlate.proshop')) {
    $APPLICATION->IncludeFile(
        SITE_DIR . "include/favorites.php",
        Array(
            'USER_FAVORITES' => BitlateProUtils::getFavorits(),
        )
    );
    die();
}?>