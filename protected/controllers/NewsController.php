<?php

class NewsController extends Controller
{
    
    
    public function actionIndex()
    {        
        $this->section=13;
        $dependency= new CGlobalStateCacheDependency('Cache.news'); 
        $news = new CActiveDataProvider(News::model()->cache(param('cachingTime',84000),$dependency)->active());
        $page= $this->getPageById(4); 
        
        $this->render('index',array(
        'news'=>$news,
        'alias'=>$alias,        
         ));
       
    }
    
  
    public function actionView($alias)
    {    
        $this->section=13;
        $dependency= new CGlobalStateCacheDependency('Cache.news');
        $news = News::model()->cache(param('cachingTime',3600),$dependency)->find('alias=:ALIAS',array(':ALIAS'=>$alias));        
        $this->render('view',array('news'=>$news));
    }
}
?>
