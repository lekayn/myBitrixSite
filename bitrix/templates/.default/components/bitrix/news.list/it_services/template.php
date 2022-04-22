<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$this->addExternalCss("/local/css/common.css"); //добавляем в шаблон news.list свои стили
?>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>


<?php 
// Выводим предложения об ИТ услугах компании
// Услуги записаны в инфоблок Услуг
if(!empty($arResult['ITEMS'])): ?>
	<div id="barba-wrapper">
		<div class="article-list">
		<?php foreach($arResult['ITEMS'] as $arItem): ?>
			<?php if(!empty($arItem['PROPERTIES']['href']['VALUE']) && !empty($arItem['PROPERTIES']['dataAnim']['VALUE'])):?>
				<a class="article-item article-list__item" 
						href=<?=$arItem['PROPERTIES']['href']['VALUE']?> 
						data-anim=<?=$arItem['PROPERTIES']['href']['dataAnim'] ?>>
					<div class="article-item__background">

					<?php if(!empty($arItem['PREVIEW_PICTURE']['SRC']) && !empty($arItem['PROPERTIES']['dataSrc']['VALUE'])):?>
						<img src= <?=$arItem['PREVIEW_PICTURE']['SRC']?>
							data-src= <?=$arItem['PROPERTIES']['dataSrc']['VALUE']?>
							alt=""/>
					<?php endif; ?>
					</div>
					<div class="article-item__wrapper">
						<div class="article-item__title"><?=isset($arItem['NAME']) ? $arItem['NAME'] : '' ?></div>
						<div class="article-item__content"><?=isset($arItem['PREVIEW_TEXT']) ? $arItem['PREVIEW_TEXT'] : '' ?>
						</div>
					</div>
    			</a>
			<?php endif; ?>
		<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

</div>
