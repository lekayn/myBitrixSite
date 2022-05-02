<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arResult["isFormErrors"] == "Y") : ?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>
<?= $arResult["FORM_NOTE"] ?>
<? if ($arResult["isFormNote"] != "Y") {
?>
	<?= $arResult["FORM_HEADER"] ?>
	<div class="contact-form">
		<div class="contact-form__head">
			<? if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y") :
				if ($arResult["isFormTitle"]) :
			?>
					<div class="contact-form__head-title"><?= $arResult["FORM_TITLE"] ?></div>
					<div class="contact-form__head-text"><?= $arResult["FORM_DESCRIPTION"] ?></div>
			<?
				endif;
			endif;
			?>
		</div>

		<form class="contact-form__form" action="/" method="POST">
			<div class="contact-form__form-inputs">
				<div class="input contact-form__input"><label class="input__label" for="medicine_name">
						<div class="input__label-text"><?= $arResult["QUESTIONS"]["NAME"]["CAPTION"]; ?></div>
						<input class="input__input" type="text" id="medicine_name" name="form_text_9" value="" required="">
						<div class="input__notification">Поле должно содержать не менее 3-х символов</div>
					</label></div>
				<div class="input contact-form__input"><label class="input__label" for="medicine_company">
						<div class="input__label-text"><?= $arResult["QUESTIONS"]["COMPANY"]["CAPTION"]; ?></div>
						<input class="input__input" type="text" id="medicine_company" name="form_text_10" value="" required="">
						<div class="input__notification">Поле должно содержать не менее 3-х символов</div>
					</label></div>
				<div class="input contact-form__input"><label class="input__label" for="medicine_email">
						<div class="input__label-text"><?= $arResult["QUESTIONS"]["EMAIL"]["CAPTION"]; ?></div>
						<input class="input__input" type="email" id="medicine_email" name="form_email_11" value="" required="">
						<div class="input__notification">Неверный формат почты</div>
					</label></div>
				<div class="input contact-form__input"><label class="input__label" for="medicine_phone">
						<div class="input__label-text"><?= $arResult["QUESTIONS"]["PHONE"]["CAPTION"]; ?></div>
						<input class="input__input" type="tel" id="medicine_phone" data-inputmask="'mask': '+79999999999', 'clearIncomplete': 'true'" maxlength="12" x-autocompletetype="phone-full" name="form_text_12" value="" required="">
					</label></div>
			</div>
			<div class="contact-form__form-message">
				<div class="input"><label class="input__label" for="medicine_message">
						<div class="input__label-text"><?= $arResult["QUESTIONS"]["MESSAGE"]["CAPTION"]; ?></div>
						<textarea class="input__input" type="text" id="medicine_message" name="medicine_message" value=""></textarea>
						<div class="input__notification"></div>
					</label></div>
			</div>
			<div class="contact-form__bottom">
				<div class="contact-form__bottom-policy"><?= $arResult["QUESTIONS"]["AGREE_NDA"]["CAPTION"]; ?>
				</div>
				<input class="form-button contact-form__bottom-button" data-success="Отправлено" data-error="Ошибка отправки" <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?> type="submit" name="web_form_submit" value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>" />
			</div>
		</form>
	</div>

<?
} //endif (isFormNote)