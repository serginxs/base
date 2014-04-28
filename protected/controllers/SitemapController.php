<?php
class SitemapController extends Controller
{
    const ALWAYS = 'always';
    const HOURLY = 'hourly';
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const NEVER = 'never';
    
    public function actionIndex()
    {
        if (!$xml = Yii::app()->cache->get('sitemap'))
        {
            $items = array(); 
            $mainPages = array(
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/site/index/'))),'changefreq'=>self::DAILY,'priority'=>1),
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/tour/index'))),'changefreq'=>self::DAILY,'priority'=>0.9),
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/site/page',array('alias'=>'about')))),'changefreq'=>self::DAILY,'priority'=>0.5),
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/site/page',array('alias'=>'egypt')))),'changefreq'=>self::DAILY,'priority'=>0.5),
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/guide/index'))),'changefreq'=>self::DAILY,'priority'=>0.5),
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/hotel/index'))),'changefreq'=>self::DAILY,'priority'=>0.5),
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/tour/index'))),'changefreq'=>self::DAILY,'priority'=>0.5),
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/country/index'))),'changefreq'=>self::DAILY,'priority'=>0.5),
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/cruise/index'))),'changefreq'=>self::DAILY,'priority'=>0.5),
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/site/contact'))),'changefreq'=>self::DAILY,'priority'=>0.5),
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/site/page',array('alias'=>'excursion')))),'changefreq'=>self::DAILY,'priority'=>0.5),
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/site/page',array('alias'=>'transfer')))),'changefreq'=>self::DAILY,'priority'=>0.5),
                array('models'=>array(array('url'=>Yii::app()->createAbsoluteUrl('/site/page',array('alias'=>'activity')))),'changefreq'=>self::DAILY,'priority'=>0.5),
             );
            $items = CMap::mergeArray($items, $mainPages);
            $classes = array(
                'Tour' => array(self::DAILY, 0.7),
                'Partner' => array(self::DAILY, 0.6),
                'Hotel' => array(self::DAILY, 0.5), 
                'Country' => array(self::WEEKLY, 0.4),                       
                'Cruise' => array(self::WEEKLY, 0.3),      
            );

            foreach ($classes as $class=>$options){
                $items[] = array(
                    'models' => CActiveRecord::model($class)->active()->findAll(),
                    'changefreq' => $options[0],
                    'priority' => $options[1],
                );
            }
             $xml = $items;     
             Yii::app()->cache->set('sitemap', $xml, 3600*6);
        }
         header('Content-Type: application/xml');
         $this->renderPartial('sitemapxml', array(            
                                     'items'=>$xml,
                 ));   
        
    }
}