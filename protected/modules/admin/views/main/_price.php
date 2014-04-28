<?php $this->pageTitle=tt('Update page').' "'.$model->title.'"'; ?>


<div class="form">

    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                    'id'=>'page-form',
                                    'htmlOptions'=>array('class'=>'well'),
    )); ?>
   <p class="help-block hint"><?php echo tt('Fields with <span class="required">*</span> are required.');?></p>
   <br/>
   <p>
           <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'SEO',
                    'icon'=>'icon-chevron-down icon-white',
                    'type'=>'info',
                    'htmlOptions'=>array('class'=>'metatag')
            )); ?>
    </p>
    <?php echo $form->errorSummary($model); ?>
    <div class="tag-form">  
               
                <div class="row">
                        <?php echo $form->textFieldRow($model, 'title_tag', array('class'=>'span6')); ?>
                </div>

                <div class="row">
                        <?php echo $form->textAreaRow($model, 'key_words', array('class'=>'span6', 'rows'=>6)); ?>
                </div>

                <div class="row">
                       <?php echo $form->textAreaRow($model, 'description', array('class'=>'span6', 'rows'=>6)); ?>
                </div>
      </div>
      <br/>
    
   <div class="row">
		<?php 
                echo $form->labelEx($model,'text');                        
                 
                $this->widget('ext.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'text',
                        'fileManager' => array(
                            'class' => 'ext.elFinder.TinyMceElFinder',
                            'connectorRoute'=>'admin/elfinder/price',
                        ),
                        'settings'=>array(),                       
                    ));                 
		echo $form->error($model,'text');
                ?>
    </div>
    <br/>
    

    <div class="row">
         <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'submit',
                    'icon'=>'ok white',
                    'label'=>tt('Save'),
                    'type'=>'primary',                   
            )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>tt('Reset'))); ?>
    </div>       

    
     <?php $this->endWidget(); ?>
</div><!-- form -->