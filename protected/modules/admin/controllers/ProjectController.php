<?php

class ProjectController extends ModuleAdminController
{
	
        public $modelName='Project';
        public $page_id = 7;             
        public $create_message = "Проект  успешно создан";   
        
       public function actionChange()
       {
         $models = Project::model()->findAll();
         foreach($models as $model) $model->galleryBehavior->changeConfig();
       }
}
