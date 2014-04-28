<?php $this->pageTitle=tt('Settings'); ?>


<?php if($ajax){ ?>
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Редактирование параметра :<br/>"<?php echo $model->title; ?>"</h3>
    </div>

    <div class="modal-body">
<?php } ?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'config-form',
	'enableAjaxValidation'=>true,
)); ?>

       <input type="hidden" name="config_id" id="config_id" value="<?php echo $model->id; ?>">
	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textArea($model,'value',array('rows'=>3, 'cols'=>50,'id' => 'config_value')); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>
       

<?php $this->endWidget(); ?>

</div><!-- form -->
