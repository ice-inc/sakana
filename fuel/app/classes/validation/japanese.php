<?php

/**
 * 独自バリデーションを追加
 */
class Validation_Japanese
{
    /**
     *
     */
    public static function _validation_hiragana($val)
    {
      if(!empty($val)) {
            if (preg_match("/^[ぁ-んー]+$/u", $val)) {
                return true;
            }
            else {
                return false;
            }
        }
        return true;
    }

    /**
     *
     */
    public static function _validation_katakana($val)
    {
      if(!empty($val)) {
            if (preg_match("/^[ァ-ヶｦ-ﾟー]+$/u", $val)) {
                return true;
            }
            else {
                return false;
            }
        }
        return true;
    }

    public static function _validation_kanji($val)
    {
      if(!empty($val)) {
            if (preg_match("/[一-?朗-鶴]+/u", $val)) {
                return true;
            }
            else {
                return false;
            }
        }
        return true;
    }

    /**
     *
     */
    public static function _validation_hirakata($val)
    {
        if( empty($val) ){ return true; }

        mb_regex_encoding("UTF-8");
        if (preg_match("/^[ 　ぁ-んァ-ヶーｦ-ﾟ｡-ﾟ0-9０-９]+$/u", $val)) {
            return true;
        }

        return false;
    }

    public static function _validation_hirakatakan($val)
    {
        if( empty($val) ){ return true; }

        mb_regex_encoding("UTF-8");
        if (preg_match("/^[ぁ-んァ-ン一-龥]/u", $val)) {
            return true;
        }

        return false;
    }

    public static function _validation_zenkatakana($val)
    {
        if( empty($val) ){ return true; }

        mb_regex_encoding("UTF-8");
        if (preg_match("/^[ァ-ヶー]+$/u", $val)) {
            return true;
        }

        return false;
    }
}
