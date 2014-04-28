
<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
            'id'=>'slider-form',
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    )); ?>
            
           

            <?php echo $form->errorSummary($model); ?>

                   
             <?php //if($model->scenario!='update'): ?>
                 <div class="row" >
                        <?php echo $form->labelEx($model,'img',array()); ?>         
                        <?php echo CHtml::activeFileField($model, 'img',array('class'=>'noblock','style'=>'width:225px;')); ?>                    
                        <?php echo $form->error($model,'img'); ?>
                 </div> 
                 <div class="hint">
                      <span class="label label-important">Важно</span>  Размер изображения дожен быть <?php echo $model->W.'x'.$model->H; ?>
                 </div>
                <br/>
             <? //endif;?>   
                 <div class="row" >
                        <?php echo $form->labelEx($model,'url'); ?>         
                        <?php echo $form->textField($model, 'url',array('class'=>'span6')); ?>                    
                        <?php echo $form->error($model,'url'); ?>
                 </div> 
                 <div class="hint">
                      Url страницы, на которую будет вести изображение по клику (просто скопируйте и вставте сюда строку из браузера на нужной странице)
                 </div>
                 <div class="row" >
                        <?php echo $form->labelEx($model,'title'); ?>         
                        <?php echo $form->textField($model, 'title',array('class'=>'span6')); ?>                    
                        <?php echo $form->error($model,'title'); ?>
                 </div> 
                  
                 <div class="row">
                        <?php echo $form->textAreaRow($model, "text", array('class'=>'span6', 'rows'=>6)); ?>
                 </div>
                
             

           



            <div class="form-actions">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType'=>'submit',
                            'type'=>'primary',
                            'icon'=>'ok white',
                            'label'=>tt('Save'),
                    )); ?>
            </div>

    <?php $this->endWidget(); ?>
</div>