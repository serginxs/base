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
        <div class="tag-form" style="display: none; background: #d3d3d3; padding: 10px 15px;border-radius:5px;">           

                <div class="row">
                        <?php echo $form->labelEx($model,'title_tag'); ?>
                        <?php echo $form->textField($model,'title_tag',array('size'=>60,'maxlength'=>128,'style'=>'width:374px')); ?>
                        <?php echo $form->error($model,'title_tag'); ?>
                </div>

                <div class="row">
                        <?php echo $form->labelEx($model,'key_words'); ?>
                        <?php echo $form->textArea($model,'key_words',array('rows'=>6, 'cols'=>50,'maxlength'=>255,'style'=>'width:374px')); ?>
                        <?php echo $form->error($model,'key_words'); ?>
                </div>

                <div class="row">
                        <?php echo $form->labelEx($model,'description'); ?>
                        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'maxlength'=>255,'style'=>'width:374px')); ?>
                        <?php echo $form->error($model,'description'); ?>
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
                         'settings'=>array(
                           'theme_advanced_buttons1' => "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,link,unlink,anchor,|,forecolor,|,cleanup,code,|,image,media,|,bullist,numlist,|,undo,redo,"                        
                        ),                         
                    )); 
                  ?>
		<?php echo $form->error($model,'text'); ?>
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