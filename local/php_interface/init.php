<?php

use Bitrix\Main\Diag\Debug;

AddEventHandler("iblock", "OnAfterIBlockElementAdd", array("Ilog", "addLog"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", array("Ilog", "addLog"));
class Ilog
{
   public static $iblockLogId = 8; //ид инфоблока Лог
   public static function addLog(&$arFields): bool
   {
      //если ид инфоблока != ид инфоблока Лог
      if ($arFields["IBLOCK_ID"] !== self::$iblockLogId) {
         // Debug::dumpToFile($arFields, 'Logging', 'LogArticle');
         //проверка на наличие папки для логируемого элемента
         if (self::hasntSubdir4Log($arFields['IBLOCK_ID'], $arFields['IBLOCK_SECTION'][0])) {
            //    self::createSubdir4Log($arFields['IBLOCK_ID'], $arFields['IBLOCK_SECTION']);
            // }
            // //записываем изменение элемента в ИБ Лог
            // $el = new CIBlockElement;
            // $arLoadLogArray = array(
            //    "IBLOCK_SECTION" => self::getIblockSection4Log($arFields['IBLOCK_SECTION']),
            //    "IBLOCK_ID" => self::$iblockLogId,
            //    "NAME" => $arFields['ID'],
            //    "PREVIEW_TEXT" => "dir->subdir->elem",
            //    "ACTIVE_FROM"=> "currentDate",
            // );
            // if ($res = $el->Add($arLoadLogArray)) {
            //    return true;
            // } else {
            // return false;
         } else {
            Debug::dumpToFile("Подпапки на месте!", 'New new Log', 'LogArticle');
         }
         return true; //есть ли в Лог подраздел с именем ИБ, ид ИБ =  $arFields["IBLOCK_ID"] ? создать
         // создаем новый элемент в подразделе: 
         // имя = $arFields["ID"], дата = текущая, описание анонса = имя раздела->.. подраздела-> элемент
      } else {
         return false;
      }
   }
   private function getIblockSection4Log(int $iblockSectionId): int
   {
      return -1;
   }
   public static function hasntSubdir4Log(int $iblockId, $iblockSectionId): bool
   {
      $rsParentSection = CIBlockSection::GetList(
         array('name' => 'asc'),
         array('IBLOCK_ID' => 2, 'ACTIVE' => 'Y')
      );
      while ($arParentSection = $rsParentSection->GetNext()) {
         Debug::dumpToFile($arParentSection['NAME'], 'Start log', 'LogArticle');
         $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'], '>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'], '<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'], '>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
         $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilter);
         while ($arSect = $rsSect->GetNext()) {
            Debug::dumpToFile($arSect['NAME'], 'Continue log', 'LogArticle');
         }
      }
      return true;
   }
   private function createSubdir4Log(int $iblockId, int $iblockSectionId): bool
   {
      // $res = CIBlockElement::GetByID($arFields['ID']);
      // if ($ar_res = $res->GetNext())
      return true;
   }
}
