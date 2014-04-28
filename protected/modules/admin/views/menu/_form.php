<div class="form well">
  <?php
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'menu-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
  ));
  ?>

  <p class="help-block hint"><?php echo tt('Fields with <span class="required">*</span> are required.'); ?></p>



  <?php echo $form->errorSummary($model); ?>                

       <div class='control-group'>
                <?php echo $form->labelEx($model,'title', array('class'=>'control-label')); ?>               
                <?php echo $form->textField($model, 'title', array('size'=>80,'maxlength'=>129,'class'=>'span6')); ?>
                <?php echo $form->error($model,'title'); ?>
               
        </div> 
        <br/>




    <div class='control-group'>
      <?php echo $form->labelEx($model, 'url'); ?>
      <?php echo $form->textField($model, 'url', array('size' => 80, 'maxlength' => 128, 'class' => 'span6')); ?>
      <?php echo $form->error($model, 'url'); ?>
    </div> 
    <div class="hint">Адрес ссылки меню в формате Yii вида controller/action.<br/> Для ссылки на простую текстовую страницу заполните поле строкой <b>/site/page</b></div>
    <br/>
    
    <div class='control-group'>
      <?php echo $form->labelEx($model, 'get'); ?>
      <?php echo $form->textField($model, 'get', array('size' => 80, 'maxlength' => 128, 'class' => 'span6')); ?>
      <?php echo $form->error($model, 'get'); ?>
    </div> 
    <div class="hint">Для ссылки на простую текстовую страницу заполните поле алиасом нужной страницы <?php echo CHtml::link('Управление страницами',array('/admin/page/admin'));?></div>
    <br/>
  

  <div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
      'buttonType' => 'submit',
      'type' => 'primary',
      'icon' => 'ok white',
      'label' => $model->isNewRecord ? tt('Create') : tt('Save'),
    ));
    ?>
  </div>

  <?php $this->endWidget(); ?>
</div>


