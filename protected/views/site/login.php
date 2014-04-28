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
     






