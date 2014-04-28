<?php

class MultilangHelper
{
    public static function enabled()
    {
        return count(Yii::app()->params['translatedLanguages']) > 1;
    }
 
    public static function suffixList()
    {
        $list = array();
        $enabled = self::enabled();
 
        foreach (Yii::app()->params['translatedLanguages'] as $lang => $name)
        {
            //С префиксом дефолтного языка
             $suffix = '_' . $lang;
             $list[$suffix] = $name;
            
             //Без префикса дефолтного языка            
          /*  $suffix = '_' . $lang;
              if ($lang === Yii::app()->params['defaultLanguage']) {
                $suffix = '';
                $list[$suffix] = $enabled ? $name : '';
            } else {
                $suffix = '_' . $lang;
                $list[$suffix] = $name;
            }           
             */
            
        }
 
        return $list;
    }
 
    public static function processLangInUrl($url)
    {
        if (self::enabled())
        {
            $domains = explode('/', ltrim($url, '/'));
 
            $isLangExists = in_array($domains[0], array_keys(Yii::app()->params['translatedLanguages']));
            $isDefaultLang = $domains[0] == Yii::app()->params['defaultLanguage'];
 
            //if ($isLangExists && !$isDefaultLang) //Без префикса дефолтного языка (ru)
            if ($isLangExists)  //C префиксом дефолтного языка         
            {
                $lang = array_shift($domains);
                Yii::app()->setLanguage($lang);
                Yii::app()->user->setState('lang',$lang);
                $cookie = new CHttpCookie('lang', $lang);
                $cookie->expire = time()+60*60*24*180; // Продолжительность жизни куки(30 дней).
                Yii::app()->request->cookies['lang'] = $cookie;                 
            }
 
            $url = '/' . implode('/', $domains);
        }
 
        return $url;
    }
 
    public static function addLangToUrl($url)
    {
        if (self::enabled())
        {
            //Постоянный префикс текущего языка
            $domains = explode('/', ltrim($url, '/'));
            array_unshift($domains, Yii::app()->getLanguage());
            
            //Без префикса текущего языка
         /* $domains = explode('/', ltrim($url, '/'));
            $isHasLang = in_array($domains[0], array_keys(Yii::app()->params['translatedLanguages']));
            $isDefaultLang = Yii::app()->getLanguage() == Yii::app()->params['defaultLanguage'];
 
            if ($isHasLang && $isDefaultLang)
                array_shift($domains);
 
            if (!$isHasLang && !$isDefaultLang)
                array_unshift($domains, Yii::app()->getLanguage());
         */
            $url = '/' . implode('/', $domains);
        }
 
        return $url;
    }
    
    
}
