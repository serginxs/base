<?php

class LinkPager extends CLinkPager
{     
     public $header ='';
     public $nextPageLabel = '&nbsp;';
     public $prevPageLabel = '&nbsp;';  
     
     
     public function __construct($owner=null)
    {        
        $this->cssFile = Yii::app()->getBaseUrl(true).'/css/pager.css';
        parent::__construct($owner);
    }
}
?>
