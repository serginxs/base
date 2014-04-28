<?php

class Configuration extends CComponent 
{
    public $cachingTime; 
    public static $cacheName = 'configuration_model';
    
    public function init()
    {
        $this->cachingTime = Yii::app()->params['cachingTime'] ? (int)Yii::app()->params['cachingTime']*60 : 5184000; // default caching for 60 days
        $this->loadConfig();       
    }

    
    private function loadConfig() 
    {
        Yii::import('application.models.Config');
        $config = Yii::app()->cache->get(self::$cacheName);
        if($config === false)
        {
           $config=Config::model()->findAll(array('select'=>'name,value'));
           Yii::app()->cache->set(self::$cacheName, $config, $this->cachingTime);
        }
        foreach ($config as $value) 
            Yii::app()->params[$value->name]=$value->value;    
    }
    
    
    public static function clearCache()
    {
         Yii::app()->cache->delete(self::$cacheName);
    }
}
?>
