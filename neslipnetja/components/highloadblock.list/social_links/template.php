<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
use Bitrix\Main\Config\Option;
if (!empty($arResult['ERROR']))
    return false;

if (!empty($arResult['rows'])):
    $title = Option::get("bitlate.proshop", "NL_SOCIAL_TITLE", false, SITE_ID);
    if ($title):?>
        <div class="footer-line-top-caption"><?=$title?></div>
    <?endif;?>
    <ul class="footer-line-top-social inline-block-container">
        <?foreach ($arResult['rows'] as $arItem):?>
            <li class="inline-block-item icon-social-<?=$arItem['UF_TYPE']?>">
                <a href="<?=$arItem['UF_LINK']?>" target="_blank">
				<?if($arItem['UF_TYPE'] == 'vk'):?>
				<svg width="32" height="19" viewBox="0 0 32 19" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon">
<path fill-rule="evenodd" clip-rule="evenodd" d="M15.95 17.9861H17.8082C18.1264 17.9542 18.4268 17.8256 18.6683 17.6179C18.8352 17.3802 18.9242 17.0973 18.9232 16.8077C18.9232 16.8077 18.9232 14.335 20.0381 13.9773C21.1531 13.6195 22.6503 16.3658 24.2112 17.418C24.7942 17.8837 25.5355 18.1097 26.2819 18.0493L30.4443 17.9861C30.4443 17.9861 32.6212 17.8599 31.5911 16.1658C30.7746 14.8166 29.7293 13.617 28.5011 12.6199C25.8784 10.2209 26.1969 10.6102 29.3825 6.45404C31.2938 3.92876 32.0584 2.38203 31.8248 1.72967C31.5911 1.0773 30.1789 1.2667 30.1789 1.2667H25.4961C25.2883 1.2419 25.0777 1.2785 24.8908 1.37192C24.7129 1.50388 24.5706 1.67738 24.4767 1.87698C23.9908 3.12424 23.4123 4.33408 22.7459 5.49654C20.6222 9.00037 19.8258 9.18976 19.486 8.9688C18.6896 8.46375 18.8913 6.92753 18.8913 5.8122C18.8913 2.40308 19.4116 0.993128 17.8295 0.624858C17.1288 0.474683 16.411 0.418063 15.6951 0.456506C14.3858 0.339685 13.066 0.475468 11.8087 0.856342C11.2672 1.10887 10.8637 1.68758 11.1079 1.71915C11.6398 1.77028 12.1328 2.01825 12.4883 2.4136C12.8195 3.06523 12.9801 3.78883 12.9555 4.518C12.9555 4.518 13.2316 8.52688 12.3078 9.02141C11.6813 9.35811 10.8106 8.66366 8.95234 5.48602C8.324 4.37147 7.76719 3.21878 7.28522 2.03481C7.20029 1.82988 7.06528 1.64909 6.89233 1.50871C6.67742 1.36861 6.43492 1.27536 6.18089 1.23513L1.77418 1.2667C1.77418 1.2667 1.06273 1.27722 0.818506 1.57184C0.574279 1.86645 0.818506 2.35047 0.818506 2.35047C0.818506 2.35047 4.3014 10.4314 8.25151 14.5034C9.22766 15.5784 10.417 16.4425 11.7452 17.0417C13.0734 17.641 14.512 17.9625 15.9712 17.9861" />
</svg>
				<?else:?>
                    <svg class="icon">
                        <use xlink:href="#svg-icon-social-<?=$arItem['UF_TYPE']?>"></use>
                    </svg>
				<?endif;?>
                </a>
            </li>
        <?endforeach;?>
    </ul>
<?endif;?>