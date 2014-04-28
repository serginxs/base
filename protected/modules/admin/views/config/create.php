<?php $this->pageTitle='Создание параметра'; ?>


<h2><?php echo 'Создание параметра'; ?></h2>

    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(
        array('label'=>'Общие настройки', 'url'=>array('admin')),       
    ))); ?>


<div class="form well">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'config-form',	
)); ?>

       
	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>50)); ?>
    
        <?php echo $form->dropDownList($model,'type',array(''=>'Выберите тип','str'=>'Строка','int'=>'Число','email'=>'Email'),array('class'=>'span2','maxlength'=>255)); ?>
    
        <?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>
    
        <?php echo $form->dropDownList($model,'section',array(''=>'Выберите тип','0'=>'Главный параметр','2'=>'Дополнительный параметр',),array('class'=>'span2','maxlength'=>255)); ?>
        
        <?php echo $form->textFieldRow($model,'value',array('class'=>'span5','maxlength'=>255)); ?>
    
     <div class="form-actions">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType'=>'submit',
                            'type'=>'primary',
                            'icon'=>'ok white',
                            'label'=>$model->isNewRecord ? tt('Create') :tt('Save'),
                    )); ?>
        </div>
       

<?php $this->endWidget(); ?>

</div><!-- form -->