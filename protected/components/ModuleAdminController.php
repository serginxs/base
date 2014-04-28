<?php

class ModuleAdminController extends Controller
{
       public $layout='//layouts/admin'; 
       public $modelName;    //Имя главной модели
       public $foreign_key; // Поле внешний ключ
       public $relation;    // Имя отношения
       public $relativeModelName; //Имя реалиционной модели       
       public $images=false;  //Есть ли загрузка изображения
       public $page_id;   //ID для текстовой страницы для SEO и меню
       public $create_message; //Приветсвие после успешного сохранения модели.
       public $scenario;    //Имя сценария
      
       




       public function init(){
               // Подключение Bootstrap
               Yii::app()->bootstrap->register();
              	
	}
          
        
        public function filters()
        {
            return array(
                'accessControl',
            );
        }
        
             public function accessRules()
        {
            return array(
                        array('allow', //all action allow for admin				
				'expression' => 'Yii::app()->user->getState("isAdmin")',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
            );
        } 
        
        public function actions()
        {
            return array(
              'order' => array(
                  'class' => 'ext.OrderColumn.OrderAction',
                  'modelClass' => $this->modelName,
                  'pkName'  => 'id',
                  ),
            );
        }
     
      

        public function actionAdmin()
	{            
         if($this->page_id)
         {
                 $page=Page::model()->findByPk($this->page_id);
                 if(isset($_POST['ajax']) && $_POST['ajax']==='page-form')
		{
			echo CActiveForm::validate($page);
			Yii::app()->end();
		}
                 if(isset($_POST['Page']))
                    {
                        $page->attributes=$_POST['Page'];
                        if($page->save())
                        {
                            Helpers::setFlash ('SEO - тэги успешно отредактированы');                                                     
                        }
                    }
         }        
	 $model=new $this->modelName('search');
	 $model->unsetAttributes();  
	 if(isset($_GET[$this->modelName]))
			$model->attributes=$_GET[$this->modelName];
	 $this->render('admin',array(
			'model'=>$model,
                        'page'=>isset($page)?$page:null
                        
		));
	}     
        
        
        
        
        
	public function actionCreate()
	{
		$model=new $this->modelName('create');               
               // $model->scenario=$this->scenario?$this->scenario:'create';                        

		if(isset($_POST[$this->modelName]))
		{
			$model->attributes=$_POST[$this->modelName];              
                       
			if($model->save())
                        {                            
                             Helpers::setFlash ($this->create_message); 
                             $this->redirect(array('admin'));
                        }
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        
         
         
      public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $model->scenario=$this->scenario?$this->scenario:'update'; 
                
		if(isset($_POST[$this->modelName]))
		{
			$model->attributes=$_POST[$this->modelName];                       
			if($model->save())
		        {                            
                             Helpers::setFlash ("Все данные успешно обновлены"); 
                             $this->redirect(array('admin'));
                        }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        
        public function actionView($id)
        {
            $this->render('view',array(
                'model'=>$this->loadModel($id)
            ));
        }
        
       
       
       public function actionToggle($id,$attribute)
        {            
           if(Yii::app()->request->isPostRequest)
           {             
                $model = $this->loadModel($id);                		
                $model->$attribute = ($model->$attribute==0)?1:0;               
                if($this->modelName == 'Category')                   
                    $model->saveNode();
                else
                    $model->save(false);               
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
             }
               else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');           
       }
       
       
       public function actionEdit()
	{
            
             $es = new EditableSaver($this->modelName); 
             $es->update();              
	}   
       
       
       
       
       public function loadModel($id)
	{                
		$model=CActiveRecord::model($this->modelName)->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        
        
        
        
        
	public function actionDelete($id)
	{
            if (Yii::app()->request->isPostRequest) {
		$model=$this->loadModel($id);
                $model->delete();               
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
            else
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}
        
        
        
	public function actionDeleteSome()
        {
                    $req=Yii::app()->request;
                    $ids=$req->getPost('ids');           
                    foreach ($ids as $id)
                    {
                        $model = CActiveRecord::model($this->modelName)->findByPk($id);
                        $model->delete();
                    }   
            if(!Yii::app()->request->isAjaxRequest){
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
        }
        
     public function actionMove($id,$move)
    {
       $model = $this->loadModel($id);
       
       if($move=='up')
       {
              $prev=$model->getPrevSibling();
              if (!is_null($model) && !is_null($prev))              
                  $model->moveBefore($prev);              
       }
       elseif($move=='down')
       {
             $next=$model->getNextSibling();
              if (!is_null($model) && !is_null($next))              
                  $model->moveAfter($next);              
       }       
     // if AJAX request, we should not redirect the browser
     if(!isset($_GET['ajax']))
         $this->redirect(array('admin'));
    }
        
        
        
        
        public function getTabularFormTabs($form, $model)
        {
            $tabs = array();
            $count = 0;
            foreach (array('ru'=>tt('Russian'),'en'=>'English') as $locale => $language)
            {
                $tabs[] = array(
                    'active'=>$count++ === 0,
                    'label'=>$language,
                    'content'=>$this->renderPartial('_tabular', array(
                        'form'=>$form,
                        'model'=>$model,
                        'locale'=>$locale,
                        'language'=>$language,
                        ), true),
                );
            }
            return $tabs;
        }
        
        protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']===strtolower($this->modelName).'-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}