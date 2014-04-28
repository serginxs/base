<?php   Yii::app()->clientScript->registerScript('search', "
$('.metatag').click(function(){
	$('.tag-form').slideToggle();       
	return false;
});
");
?>
<?php Helpers::getFlash(); ?> 
 <p>
        <?php 
        if($page->hasErrors())
            $style='display: block; background: #d3d3d3; padding: 10px 15px;border-radius:5px;';
        else 
            $style='display: none; background: #d3d3d3; padding: 10px 15px;border-radius:5px;';     
        ?>
</p>
<p>
           <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'SEO',
                    'icon'=>'icon-chevron-down icon-white',
                    'type'=>'info',
                    'htmlOptions'=>array('class'=>'metatag')
            )); ?>
</p>
<div class="tag-form" style="<?php echo $style; ?>">        
        <div class="form">
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id'=>'page-form',
                        'enableAjaxValidation'=>true, 
                )); ?>

                    <?php echo $form->errorSummary($page); ?>
                   <em>Метатэги для общей страницы новостей</em><br/>
                           
                            <div class="row">                                   
                                    <?php echo $form->textFieldRow($page,'title_tag',array('class'=>'span6','maxlength'=>128)); ?>                                    
                            </div>
                   
                   
                            <div class="row">                                    
                                    <?php echo $form->textAreaRow($page, "key_words", array('class'=>'span6', 'rows'=>6)); ?>                                    
                            </div>
                   
                   
                            <div class="row">                                   
                                    <?php echo $form->textAreaRow($page, "description", array('class'=>'span6', 'rows'=>6)); ?>                                    
                            </div>
                  
                           
                            <div class="row buttons">
                                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                                            'buttonType'=>'submit',
                                            'icon'=>'ok white',
                                            'label'=>tt('Save'),
                                            'type'=>'primary',                   
                                    )); ?>		
	                    </div>

             <?php $this->endWidget(); ?>
         </div>
</div>
