<div class="float-right header-lk__right inline-block-container">
    <?if ($templateOptions['use_compare'] == "Y"):?>
        <div class="inline-block relative">
            <?$TYPE = '';?>
            <?require($_SERVER["DOCUMENT_ROOT"] . SITE_DIR . "include/compare_list.php");?>
        </div>
    <?endif;?>
    <div class="inline-block relative">
        <?$APPLICATION->IncludeComponent("bitlatepro:catalog.favorite.line", "favorite", Array(
	
	),
	false
);?>
    </div>
    <div class="inline-block">
        <div class="inline-block-item relative" id="bx_personal_menu">
            <?$frame = new \Bitrix\Main\Page\FrameHelper("bx_personal_menu", false);
            $frame->begin();?>
                <a href="<?if ($USER->IsAuthorized()):?><?=SITE_DIR?>personal/<?else:?>#login<?endif;?>" class="button transparent header-line-top-profile<?if (!$USER->IsAuthorized()):?> fancybox<?endif;?>"<?if ($USER->IsAuthorized()):?> data-toggle="profile-dropdown"<?endif;?>>
                    <svg class="icon">
                        <use xlink:href="#svg-icon-profile"></use>
                    </svg>
                    <?if ($USER->IsAuthorized()):?>
                        <?=getMessage('PERSONAL_CABINET')?>
                    <?else:?>
                        <?=getMessage('ENTER')?>
                    <?endif;?>
                </a>
                <?if ($USER->IsAuthorized()):?>
                    <div class="dropdown-pane bottom" id="profile-dropdown" data-dropdown data-hover="true" data-hover-pane="true">
                        <ul>
                            <li><a href="<?=SITE_DIR?>personal/"><?=getMessage('PERSONAL_CABINET')?></a></li>
                            <li><a href="<?=$APPLICATION->GetCurPageParam('logout=yes', array('logout'));?>"><?=getMessage('EXIT')?></a></li>
                        </ul>
                    </div>
                <?endif;?>
            <?$frame->beginStub();?>
                <a href="#" class="button transparent header-line-top-profile">
                    <svg class="icon">
                        <use xlink:href="#svg-icon-profile"></use>
                    </svg>
                    <?=getMessage('ENTER')?>
                </a>
            <?$frame->end();?>
        </div>
    </div>
</div>