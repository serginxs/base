<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="language" content="en" />
	
	<title>Админка</title>
	
	<!--<link rel="shortcut icon" href="/favicon.ico"/>-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login-admin.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />   
</head>

<body>
    <div class="log-admin">
        <fieldset>
            <div class="form">
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'login-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                    ),
            )); ?>
                       
                    <div class="row">
                            <?php echo $form->labelEx($model,'username'); ?>
                            <?php echo $form->textField($model,'username'); ?>
                            <?php echo $form->error($model,'username'); ?>
                    </div>
                    <div class="clear"></div>
                    
                    
                    <div class="row">
                            <?php echo $form->labelEx($model,'password'); ?>
                            <?php echo $form->passwordField($model,'password'); ?>
                            <?php echo $form->error($model,'password'); ?>                            
                    </div>
                    <div class="clear"></div>

                   
                    <div class="row b-submit">
                            <?php echo CHtml::submitButton('Войти',array('class'=>'button')); ?>
                    </div>

            <?php $this->endWidget(); ?>
         </div><!-- form -->
       </fieldset>
   </div>


	
</body>
</html>





