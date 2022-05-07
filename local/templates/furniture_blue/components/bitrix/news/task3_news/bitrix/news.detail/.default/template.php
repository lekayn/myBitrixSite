<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="article-card">
	<? if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]) : ?>
		<div class="news-date article-card__date"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></div>
	<? endif; ?>

	<div class="article-card__content">
		<? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) : ?>
			<div class="article-card__image sticky">
				<img class="detail_picture" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["NAME"] ?>" title="<?= $arResult["NAME"] ?> data-object-fit=" cover"" />
			</div>
		<? endif; ?>
		<div class="article-card__text">
			

			<div class="block-content" data-anim="anim-3">
				<? if ($arResult["NAV_RESULT"]) : ?>
					<? if ($arParams["DISPLAY_TOP_PAGER"]) : ?><?= $arResult["NAV_STRING"] ?><br /><? endif; ?>
				<? echo $arResult["NAV_TEXT"]; ?>
				<? if ($arParams["DISPLAY_BOTTOM_PAGER"]) : ?><br /><?= $arResult["NAV_STRING"] ?><? endif; ?>
				<? elseif ($arResult["DETAIL_TEXT"] <> '') : ?>
					<? echo $arResult["DETAIL_TEXT"]; ?>
				<? else : ?>
					<? echo $arResult["PREVIEW_TEXT"]; ?>
				<? endif ?>
				<div style="clear:both"></div>
				<br />
				<? foreach ($arResult["FIELDS"] as $code => $value) : ?>
					<?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>
					<br />
				<? endforeach; ?>
				<? foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty) : ?>

					<?= $arProperty["NAME"] ?>:&nbsp;
					<? if (is_array($arProperty["DISPLAY_VALUE"])) : ?>
						<?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
					<? else : ?>
						<?= $arProperty["DISPLAY_VALUE"]; ?>
					<? endif ?>
					<br />
				<? endforeach; ?>
			</div>
		</div>
	</div>
</div>