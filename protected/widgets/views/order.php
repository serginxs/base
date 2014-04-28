<?php echo CHtml::link(CHtml::image('/css/images/order.png'),'#order',array('id'=>'order-form'));?>

<?php if($model->hasErrors()): ?>
        <script type="text/javascript">
        $(document).ready(function() {
        $("#order-form").fancybox({'overlayShow':true,'scrolling':false,'overlayColor':'#000','padding':'25px', }).trigger('click');
         });
       </script> 
<?php endif; ?>   
       
<div style="display:none;">          
     <div id="order" >
         <div class="form-wrap">  
             
                    <h3>Заказать экскурсию</h3>               
                    <div class="form">
                        <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'orders-form',
                                'enableClientValidation'=>true,
                                'clientOptions'=>array(
                                        'validateOnSubmit'=>true,
                                ),
                        )); ?>  
                                                
                        
                              <div class="row">
                                    <?php echo $form->labelEx($model,'name',array()); ?>
                                    <?php echo $form->textField($model,'name',array('size'=>'25','maxlength'=>50,'style'=>'width:300px;')); ?>  
                                    <?php echo $form->error($model,'name'); ?>
                              </div> 
                        
                              <div class="row">
                                    <?php echo $form->labelEx($model,'email',array()); ?>
                                    <?php echo $form->textField($model,'email',array('size'=>'25','maxlength'=>50,'style'=>'width:300px;')); ?>  
                                    <?php echo $form->error($model,'email'); ?>
                              </div> 
                             
                             
                        
                              <div class="row">
                                    <?php echo $form->labelEx($model,'phone',array()); ?>
                                    <?php echo $form->textField($model,'phone',array('size'=>'25','maxlength'=>50,'style'=>'width:300px;')); ?>  
                                    <?php echo $form->error($model,'phone'); ?>
                              </div>  
                        
                                                    
                             
                               
                              <div class="row">
                                    <?php echo $form->labelEx($model,'body',array()); ?>
                                    <?php echo $form->textArea($model,'body',array('rows'=>'5','style'=>'width:300px;')); ?>  
                                    <?php echo $form->error($model,'body'); ?>
                              </div>
                        
                               
                           
                                 <?php                                  
                                // if(CCaptcha::checkRequirements()): ?>      
                                              <div class="row">
                                                      <div style="color:#999999;">
                                                         Введите защитный код:
                                                      </div>
                                                      <div>                    
                                                          <?php $this->widget('CCaptcha', array(
                                                                 'captchaAction'=>Yii::app()->controller->id.'/captcha',
                                                                // 'clickableImage'=>true,
                                                                 'showRefreshButton'=>true,
                                                                 'buttonLabel' => CHtml::image(Yii::app()->baseUrl. '/css/images/refresh.png','',array('title'=>'Нажмите чтобы обновить код','style'=>'margin-bottom:5px;')),
                                                                 'imageOptions'=>array('style'=>'/*display:block;*/',
                                                                 'alt'=>'Картинка с кодом валидации',
                                                                // 'title'=>'Нажмите чтобы обновить код'
                                                                     )));
                                                          ?>		
                                                      </div>
                                                      <?php echo $form->textField($model,'verifyCode',array('size'=>24)); ?>
                                                      <?php echo $form->error($model,'verifyCode'); ?>
                                              </div>
                                          <?php// endif; ?>
                               
                               
                               <div class="row submit">
                                  <?php echo CHtml::submitButton('Отправить',array('class'=>'btn btn-info')); ?>
                               </div>

                        <?php $this->endWidget(); ?>
                    </div><!-- form -->      
             </div>
     </div>
</div>
   <?php $this->widget('application.extensions.fancybox.EFancyBox', array(
        'target'=>'a#order-form',
        'config'=>array(
                'scrolling' => FALSE,
                'titleShow' => FALSE,
                'type'=>'inline',                
                'padding'=>'25px',                
        ))
);?>
