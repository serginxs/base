<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
//class Controller extends CController
 class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
        public $section;
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        public $pageKeywords;
	public $pageDescription;    
        
       // public $defaultAction = 'index';
  
    
       
        
    public function getPage($alias)
   {
            $dependency= new CGlobalStateCacheDependency('Cache.page');
	    $page=  Page::model()->cache(param('cachingTime',3600),$dependency)->find('alias=:ALIAS',array(':ALIAS'=>$alias));
            if($page===null)
                throw new CHttpException(404,'The requested page does not exist.');
             
            $this->pageTitle = $page->title_tag ? $page->title_tag : $page->title;
            $cs=Yii::app()->clientScript;
            $cs->registerMetaTag($page->description,'description');
            $cs->registerMetaTag($page->key_words,'keywords');   
            
            return $page;
     }
     
    /* TextPage by id
     * return page  with metatags ant text content
     */         
    public function getPageById($id)
   {
            $dependency= new CGlobalStateCacheDependency('Cache.page');
	    $page=  Page::model()->cache(param('cachingTime',3600),$dependency)->findByPk($id);
            if($page===null)
                throw new CHttpException(404,'The requested page does not exist.');
             
            $this->pageTitle = $page->title_tag ? $page->title_tag : $page->title;
            $cs=Yii::app()->clientScript;
            $cs->registerMetaTag($page->description,'description');
            $cs->registerMetaTag($page->key_words,'keywords');   
            
            return $page;
     } 
     
      
     public function actions()
        {
                    return array(

                            'captcha'=>array(				
                                    'class'=>'CCaptchaAction',
                                    //'backColor'=>0xFFFFFF,                             
                                    //'foreColor'=>0xa91919,
                                    'foreColor'=>0x1a2f8f,
                                    'transparent'=>true,
                                    'testLimit'=>0,                           
                            ),			
                    );                
        }    
     

    
       
       
}