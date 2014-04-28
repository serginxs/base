<?php
class ElfinderController extends CController
{
    public function actions()
    {
        return array(
            'news' => array(
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot') . '/images/news/',
                    'URL' => Yii::app()->baseUrl . '/images/news/',
                    'rootAlias' => 'Изображения к новостям',
                    'mimeDetect' => 'none'
                )
            ),
            'page' => array(
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot') . '/images/page/',
                    'URL' => Yii::app()->baseUrl . '/images/page/',
                    'rootAlias' => 'Изображения к страницам',
                    'mimeDetect' => 'none'
                )
            )          
          
        );
    }
}