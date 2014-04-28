<?php

class ProjectController extends Controller
{
    
    
    public function actionIndex()
    {        
        $this->section=7;
        $dependency= new CGlobalStateCacheDependency('Cache.project'); 
        $news = new CActiveDataProvider(Project::model()->cache(param('cachingTime',84000),$dependency)->active(),array(                    
                    'pagination'=>array('pageSize'=>1)));
        $page= $this->getPageById(7); 
        
        $this->render('index',array(
        'news'=>$news,
        'alias'=>$alias,        
         ));
       
    }
    
  
    public function actionView($alias)
    {    
        $this->section=4;
        $dependency= new CGlobalStateCacheDependency('Cache.project');
        $news = Project::model()->cache(param('cachingTime',8400),$dependency)->find('alias=:ALIAS',array(':ALIAS'=>$alias));        
        $this->render('view',array('news'=>$news));
    }
}
?>
