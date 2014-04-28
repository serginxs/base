<?php

class MainController extends ModuleAdminController
{
        
         /**
	 * Редактирование текста главной страницы .
	 */
	public function actionIndex()
	{
		$model=Page::model()->findByPk(1);
                $model->scenario='main';
                $title='Редактирование главной страницы';
                $model->scenario='main';
                $page='_index';
                
		if(isset($_POST['Page']))
		{
                     $model->attributes=$_POST['Page'];                    
		     if($model->save())              
                         Helpers::setFlash (tt('All data updated successfully'));                   
		}
                
		$this->render('index',array(
			'model'=>$model,
                        'title'=>$title,
                        'page'=>$page,                        
		));
	}        
   
      
       /*** Редактирование всех текстовых страниц.*/
        public function actionPage($id)
	{            
            $model=Page::model()->findByPk($id); 
            $model->scenario='page';
            $name=$model->title;         
            $title="Редактирование страницы '{$name}'"; 
            $page= '_page';
             
            if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];                         
			if($model->save())               
                           Helpers::setFlash (tt('All data updated successfully'));                                              
		}
		$this->render('index',array(
			'model'=>$model,
                        'title'=>$title,
                        'page'=>$page
		));
	}

	
              
        
        
           /**
	 * Редактирование текста страницы Контакты.
	 */
	public function actionContact()
	{
		$model=Page::model()->findByPk(3);
                $model->scenario='contact';
                $title='Редактирование страницы Контакты';
                $page='_contact';                
                
		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];                        
                        if($model->save())
                                {                            
                                       Helpers::setFlash ('Cтраница Контактов успешно отредактирована');
                                       $this->refresh();
                                }                            
		}

		$this->render('index',array(
			'model'=>$model,
                        'title'=>$title,
                        'page'=>$page,
		));
	}
        
          /*
         * Изменение пароля админа
         */
        public function actionChangeAdminPass()
        {
                $model=User::model()->findByPk(Yii::app()->user->id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.'); 
                if(isset($_POST['User']))
                {
                    
                    $model->scenario = 'changeAdminPass';
                    $model->old_password = $_POST['User']['old_password'];
                    if(CPasswordHelper::verifyPassword($model->old_password,$model->password)){
                       
                        $model->attributes=$_POST['User'];
                        if($model->validate()){
                            $model->password = CPasswordHelper::hashPassword($model->password);
		            $model->save(false);
                            Helpers::setFlash('Ваш пароль успешно изменён');
                            $this->redirect(array('config/admin'));
                        }
                    }
                    else                       
                       $model->addError('old_password', 'Неверный пароль админа! Попробуйте ещё раз');
                      
                }
                $this->render('change_pass', array('model' => $model));                
        }
        
          public function actionDeleteimg()
        {
                    $req=Yii::app()->request;
                    $ids=$req->getPost('Id');                   
                    $studio_id=$req->getQuery('id');                    
                    foreach ($ids as $id=>$v)
                    {
                            $img=  StudioPhoto::model()->findByPk($id);
                            @unlink($img->fotoPath.$img->img);
                            @unlink($img->smallFotoPath.$img->img);
                            $img->delete();                         
                    }                   
                    Yii::app()->cache->flush();                                 
                    $model=new StudioPhoto;
                    echo $model->getGoodImagesWithCheckbox($studio_id);
                    Yii::app()->end();                  
            if(!Yii::app()->request->isAjaxRequest){
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
        }
        
         public function actionClearCache()
        {
           Configuration::clearCache();  
           Yii::app()->cache->flush();       
           
           //Удаление файлов кэша.
           $folder= Yii::getPathOfAlias("application.runtime.cache"); 
           $handle = opendir($folder);
           while (false !== ($file = readdir($handle))) {                    
                     if ($file != '.' && $file != '..')                     
                          @unlink("{$folder}/{$file}");     
           }            
           closedir($handle);
            
           Helpers::setFlash ('Кэш успешно очищен.');
           $this->render('cache');
        }
        

        public function actionTest()
        {
            
            $this->render('test');
        }
	
}