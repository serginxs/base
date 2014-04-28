<?php
/**********************************************************************************************
*                            CMS Open Business Card
*                              -----------------
*	version				:	1.0.0
*	copyright			:	(c) 2012 Monoray
*	website				:	http://www.monoray.ru/
*	contact us			:	http://www.monoray.ru/contact
*
* This file is part of CMS Open Business Card
*
* Open Business Card is free software. This work is licensed under a GNU GPL.
* http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
* Open Business Card is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
* Without even the implied warranty of  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
***********************************************************************************************/


Yii::import('zii.widgets.CBreadcrumbs');
class Breadcrumbs extends CBreadcrumbs {
    
    public $tagName='div';
    public $crumbs = array();
    public $separator = '';
    public $encodeLabel = true;
 
    public function run()
	{
		if(empty($this->links))
			return;

			echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";
				echo CHtml::openTag($this->tagName,array('class' => 'inside'))."\n";
					$links=array();

					if($this->homeLink===null)
						$links[]=CHtml::link('<span>'.Yii::t('zii','Home').'</span>',Yii::app()->homeUrl,array('class' => 'first'));
					else if($this->homeLink!==false)
						$links[]=$this->homeLink;

					
					foreach($this->links as $label=>$url)
					{
						if(is_string($label) || is_array($url)){
							$links[]=CHtml::link('<span>'.CHtml::encode($label).'</span>', $url);
						}
						else {
							$links[]=CHtml::link('<span class="breadcrumbs-inactive">'.CHtml::encode($url).'</span>', '#', array('class' => 'last last-child'));
						}									
					}
				echo implode($this->separator,$links);
			echo CHtml::closeTag($this->tagName);
		echo CHtml::closeTag($this->tagName);
	}
}
?>