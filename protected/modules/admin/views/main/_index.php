<?php $this->pageTitle=tt('Update page').' "'.$model->title.'"'; ?>


<div class="form well">

 <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
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
		<?php echo $form->labelEx($model,'text'); ?>
		 <!--TinyMce-->                
                 <?php
                    $this->widget('ext.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'text',
                         'fileManager' => array(
                            'class' => 'ext.elFinder.TinyMceElFinder',
                            'connectorRoute'=>'admin/elfinder/page',
                        ),
                        'settings'=>array('height'=>'400px'),                       
                    ));
                  ?>
		<?php echo $form->error($model,'text'); ?>
	</div>
   <br/>   
       
        <div class="row">
                <?php echo $form->labelEx($model,'text1'); ?>
		 <!--TinyMce-->                
                <?php
                    $this->widget('ext.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'text1',
                         'fileManager' => array(
                            'class' => 'ext.elFinder.TinyMceElFinder',
                            'connectorRoute'=>'admin/elfinder/page',
                        ),
                        'settings'=>array('height'=>'400px'),                       
                    ));
                  ?>
		            <?php echo $form->error($model,'text1'); ?>
        </div>   
        <br/> 
        

       
       
      
	<div class="row buttons">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'submit',
                    'icon'=>'ok white',
                    'label'=>'Сохранить',
                    'type'=>'primary',                   
            )); ?>		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->