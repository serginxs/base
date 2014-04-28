<div class="form well">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
            'id'=>'tech-form',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>true,
            'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    )); ?>

    <p class="help-block hint"><?php echo tt('Fields with <span class="required">*</span> are required.');?></p>
    <br/>
            <p>
               <?php /*$this->widget('bootstrap.widgets.TbButton', array(
                        'label'=>'SEO',
                        'icon'=>'icon-chevron-down icon-white',
                        'type'=>'info',
                        'htmlOptions'=>array('class'=>'metatag')
                )); */?>

            </p>

            <?php echo $form->errorSummary($model); ?>
            <!--<div class="tag-form" style="display: none; background: #d3d3d3; padding: 10px 15px;border-radius:5px;">           
                    <em>Метатэги для страницы данной проекта</em>
                    <div class="row">
                            <?php /*echo $form->labelEx($model,'title_tag'); ?>
                            <?php echo $form->textField($model,'title_tag',array('size'=>60,'maxlength'=>128,'style'=>'width:500px')); ?>
                            <?php echo $form->error($model,'title_tag'); ?>
                    </div>

                    <div class="row">
                            <?php echo $form->labelEx($model,'key_words'); ?>
                            <?php echo $form->textArea($model,'key_words',array('rows'=>6, 'cols'=>50,'maxlength'=>255,'style'=>'width:500px')); ?>
                            <?php echo $form->error($model,'key_words'); ?>
                    </div>

                    <div class="row" >
                            <?php echo $form->labelEx($model,'description'); ?>
                            <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'maxlength'=>255,'style'=>'width:500px')); ?>
                            <?php echo $form->error($model,'description'); 
                             ?>
                             
                    </div>
            </div>
            
            
      
        <div class="clearfix">
         <?php if(!$model->isNewRecord)
                    echo CHtml::image($model->ImageThumbUrl);?>
        </div>   
            
	      <div class="row" >
                    <?php echo $form->labelEx($model,'img',array()); ?>         
                    <?php echo CHtml::activeFileField($model, 'img',array('class'=>'noblock','style'=>'width:225px;','rel'=>'popover', 'data-title' =>$model->getAttrTitle('img'), 'data-content' =>$model->getAttrDesc('img'))); ?>                    
                    <?php echo $form->error($model,'img'); */?>
         </div>
          -->     
            
        <div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>80,'maxlength'=>255,'class'=>'span6')); ?> 
		<?php echo $form->error($model,'title'); ?>
	</div>
         
       
        
        <?php /*
         if(!$model->isNewRecord): ?>
         <div class="row">
                <?php echo $form->labelEx($model, 'alias'); ?>
                <?php echo $form->textField($model, 'alias',array('size'=>80,'maxlength'=>255,'class'=>'span6','rel'=>'popover', 'data-title' =>'URL - адрес', 'data-content' =>$model->getAttrDesc('alias'))); ?>
                <?php echo $form->error($model, 'alias');?>
         </div>         
         <br/>
       <?php endif; ?>
         
         <div class="row">
		<?php 
                echo $form->labelEx($model,'short');                        
                 
                $this->widget('ext.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'short',                       
                        'settings'=>array(
                            //'theme' => 'simple',
                            'height' =>'100px'
                        ),                       
                    ));                 
		echo $form->error($model,'short');
                ?>
	      </div><br/> 
         */?>
        
        
	
	<div class="row">
		<?php 
                echo $form->labelEx($model,'text');                        
                 
                $this->widget('ext.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'text',                        
                        'fileManager' => array(
                            'class' => 'ext.elFinder.TinyMceElFinder',
                            'connectorRoute'=>'admin/elfinder/project',
                        ),
                        'settings'=>array(),                       
                    ));                 
		echo $form->error($model,'text');
                ?>
	</div>
        <br/> 
        
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


