<?php
Yii::import('zii.widgets.CListView');
class ListView extends CListView
{
   public $template = "{items}\n{pager}";                               
   public $pager = 'LinkPager';
   public $pagerCssClass = 'pagenator';
   
}
?>
