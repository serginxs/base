<?php

class UserLoginWidget extends CWidget
{
    public $title='Логин';
    public $visible=true; 
 
    public function run()
    {
        if($this->visible)
        {
            $this->renderContent();
        }
    }
 
    protected function renderContent()
    {
        if (Yii::app()->user->isGuest) {
			$model=new UserLogin;			
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];				
				if($model->validate()) {                                        
					$this->lastViset();                                        
                                        $url =$_SERVER['REDIRECT_URL'] ? $_SERVER['REDIRECT_URL'] : $this->controller->createUrl('site/index');                                        
                                        $this->controller->redirect($url);					
				}
			}                      
			$this->render('UserLogin',array('model'=>$model));                 
                       
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
        
    }   
    private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}
}
?>
