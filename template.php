

<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->addExternalCss($templateFolder . "/css/common.css");

// Убедимся, что добавим стили
foreach ($arResult["QUESTIONS"] as &$q) {
    $q["HTML_CODE"] = str_replace('<input', '<input class="input__input"', $q["HTML_CODE"]);
    $q["HTML_CODE"] = str_replace('<textarea', '<textarea class="input__input"', $q["HTML_CODE"]);
    if ($q["REQUIRED"] == "Y") {
        $q["HTML_CODE"] = str_replace('<input', '<input required', $q["HTML_CODE"]);
        $q["HTML_CODE"] = str_replace('<textarea', '<textarea required', $q["HTML_CODE"]);
    }
}
$textarea = $arResult["QUESTIONS"]["SIMPLE_QUESTION_981"];
unset($arResult["QUESTIONS"]["SIMPLE_QUESTION_981"]);
?>

<div class="contact-form">
    <div class="contact-form__head">
        <div class="contact-form__head-title">Связаться</div>
        <div class="contact-form__head-text">Наши сотрудники помогут выполнить подбор услуги и&nbsp;расчет цены с&nbsp;учетом ваших требований</div>
    </div>


<?php
if ($arResult["isFormErrors"] == "Y") {
    echo '<pre style="color:red;">'.$arResult["FORM_ERRORS_TEXT"].'</pre>';
}
?>
    <?= $arResult["FORM_HEADER"] ?>
    <div class="contact-form__form">
        <div class="contact-form__form-inputs">
            <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
                <div class="input contact-form__input">
                    <label class="input__label">
                        <div class="input__label-text"><?= $arQuestion["CAPTION"] ?><?= ($arQuestion["REQUIRED"] == "Y") ? "*" : "" ?></div>
                        <?= $arQuestion["HTML_CODE"] ?>
                        <? if (isset($arResult["FORM_ERRORS"][$FIELD_SID])): ?>
                            <div class="input__notification"><?= $arResult["FORM_ERRORS"][$FIELD_SID] ?></div>
                        <? endif; ?>
                    </label>
                </div>
            <? endforeach; ?>
        </div>

        <div class="contact-form__form-message">
            <div class="input">
                <label class="input__label">
                    <div class="input__label-text"><?= $textarea["CAPTION"] ?></div>
                    <?= $textarea["HTML_CODE"] ?>
                    <? if ($arResult["FORM_ERRORS"]["MESSAGE"]): ?>
                        <div class="input__notification"><?= $arResult["FORM_ERRORS"]["MESSAGE"] ?></div>
                    <? endif; ?>
                </label>
            </div>
        </div>

        <div class="contact-form__bottom">
            <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что ознакомлены и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных данных&raquo;.</div>
            <button class="form-button contact-form__bottom-button" type="submit" name="web_form_submit" value="Y">
    <span class="form-button__title"><?= htmlspecialcharsbx($arResult["arForm"]["BUTTON"] ?: "Оставить заявку") ?></span>
</button>
        </div>
    </div>
    <?= $arResult["FORM_FOOTER"] ?>
</div>
