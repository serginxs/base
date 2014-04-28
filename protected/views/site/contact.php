<?php $this->breadcrumbs = array('Контакты'); ?>



  <div class="text-color-block l-blue">
    <h3 class="brown">Наши контакты</h3>
    <?php echo Yii::app()->format->formatHtml($page->text); ?>

    <h3 class="brown">Мы на карте</h3>
    <p>
      <?php echo $page->text1; ?>
    </p>


    <h3 class="brown">Форма обратной связи</h3>
    <div class="form">

      <?php
      $form = $this->beginWidget('CActiveForm', array(
        'id' => 'contact-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
          'validateOnSubmit' => true,
        ),
        'htmlOptions' => array('role' => 'form')
      ));
      ?>


        <?php //echo $form->errorSummary($model);  ?>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'name'); ?>
<?php echo $form->textField($model, 'name', array('class' => 'form-control', 'size' => '25', 'maxlength' => 50, 'style' => 'width:350px;')); ?>
<?php echo $form->error($model, 'name'); ?>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'email'); ?>
<?php echo $form->textField($model, 'email', array('class' => 'form-control', 'size' => '25', 'maxlength' => 50, 'style' => 'width:350px;')); ?>
<?php echo $form->error($model, 'email'); ?>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'subject'); ?>
<?php echo $form->textField($model, 'subject', array('class' => 'form-control', 'size' => 60, 'maxlength' => 128, 'style' => 'width:350px;')); ?>
<?php echo $form->error($model, 'subject'); ?>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model, 'body'); ?>
<?php echo $form->textArea($model, 'body', array('class' => 'form-control', 'rows' => 6, 'cols' => 50, 'style' => 'width:350px;')); ?>
      <?php echo $form->error($model, 'body'); ?>
      </div>

        <?php if (CCaptcha::checkRequirements()): ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'verifyCode'); ?>
          <div>                    
            <?php
            $this->widget('CCaptcha', array(
              //'captchaAction'=>Yii::app()->controller->id.'/captcha',
              // 'clickableImage'=>true,
              'showRefreshButton' => true,
              'buttonLabel' => CHtml::image(Yii::app()->baseUrl . '/css/images/refresh.png', '', array('title' => 'Нажмите чтобы обновить код', 'style' => 'margin-bottom:5px;')),
              'imageOptions' => array('style' => 'display:inline',
                'alt' => 'Картинка с кодом валидации',
              // 'title'=>'Нажмите чтобы обновить код'
            )));
            ?>		
          </div>
        <?php echo $form->textField($model, 'verifyCode', array('class' => 'form-control', 'style' => 'width:350px;')); ?>
  <?php echo $form->error($model, 'verifyCode'); ?>
        </div>
        <?php endif; ?>

      <div class="form-group">
      <?php echo CHtml::submitButton('Отправить', array('class' => 'btn btn-info')); ?>
      </div>

<?php $this->endWidget(); ?>

    </div><!-- form -->
  </div>
</div>