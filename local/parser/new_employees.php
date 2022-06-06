<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
if (!$USER->IsAdmin()) {
    LocalRedirect('/');
}
\Bitrix\Main\Loader::includeModule('iblock');

/* Настройки */
$importFile = "test.csv";
$separator = ";";
$row = 1;
$IBLOCK_ID = 7;

$elem = new CIBlockElement;
$arProps = [];

// записать свойства типа список элемента инфоблока $IBLOCK_ID в $arProps
$rsProp = CIBlockPropertyEnum::GetList(
    ["SORT" => "ASC", "VALUE" => "ASC"],
    ['IBLOCK_ID' => $IBLOCK_ID]
);
while ($arProp = $rsProp->Fetch()) {
    $key = trim($arProp['VALUE']);
    $arProps[$arProp['PROPERTY_CODE']][$key] = $arProp['ID'];
}

/*
// удалить элементы инфоблока $IBLOCK_ID
$rsElements = CIBlockElement::GetList([], ['IBLOCK_ID' => $IBLOCK_ID], false, false, ['ID']);
while ($element = $rsElements->GetNext()) {
    CIBlockElement::Delete($element['ID']);
}
*/


if (($handle = fopen($importFile, "r")) !== false) {
    while (($data = fgetcsv($handle, 1000, $separator)) !== false) {
        if ($row == 1) {
            $row++;
            continue;
        }
        $row++;

        $PROP['imya'] = $data[2];
        $PROP['otchestvo'] = $data[3];
        $PROP['otdel'] = $data[4];
        $PROP['dolghnost'] = $data[5];
        $PROP['email'] = $data[6];
        $PROP['mobile_phone'] = $data[7];
        $PROP['city_phone'] = $data[8];
        $PROP['intra_phone'] = $data[9];
        $PROP['home_phone'] = $data[10];
        $PROP['login'] = $data[11];
        $PROP['password'] = $data[12];

        $data[13] = strtolower($data[13]);
        foreach($arProps['marital'] as $key => $value){
            if($data[13] == $key) {
                $PROP['marital'] = $value;
                break;
            }
        }
        
        foreach ($PROP as $key => &$value) {
            $value = trim($value);
            $value = str_replace('\n', '', $value);
        }

        $arLoadProductArray = [
            "MODIFIED_BY" => $USER->GetID(),
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => $IBLOCK_ID,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => $data[1],
            "ACTIVE" => end($data) ? 'Y' : 'N',
        ];

        if ($PRODUCT_ID = $elem->Add($arLoadProductArray)) {
            echo "Добавлен элемент с ID : " . $PRODUCT_ID . "<br>";
        } else {
            echo "Error: " . $elem->LAST_ERROR . '<br>';
        }
        
    }
    fclose($handle);
}
