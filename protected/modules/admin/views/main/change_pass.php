<?php $this->pageTitle=tt('Change admin password'); ?>
<h2><?php echo tt('Change admin password'); ?></h2>


<div class="form well">
<?php 
	$model->scenario = 'changeAdminPass';
	$model->password = '';
	$model->password_repeat = '';
	
        $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'enableAjaxValidation'=>false,
	));
	?>
    <?php Helpers::getFlash('error'); ?>
    

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'old_password'); ?>
        <?php echo $form->passwordField($model,'old_password',array('size'=>20,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'old_password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password_repeat'); ?>
        <?php echo $form->passwordField($model,'password_repeat',array('size'=>20,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'password_repeat'); ?>
    </div>

    <div class="form-actions">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType'=>'submit',
                            'type'=>'primary',
                            'icon'=>'ok white',
                            'label'=>$model->isNewRecord ? tt('Create') :tt('Save'),
                    )); ?>
    </div>

<?php $this->endWidget(); ?>

</div>
    