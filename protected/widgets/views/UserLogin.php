    <!-- Виджет входа на сайт-->    
    
        <?php if($model->hasErrors() || isset($_GET['access'])): ?>
        <script type="text/javascript">
        $(document).ready(function() {
        $("#invite").fancybox({'overlayShow':true}).trigger('click');
         });
       </script> 
       <?php endif; ?>
       
       
<div style="display:none;">  
        <div id="login-form">


        <h1><?php echo UserModule::t("Login"); ?></h1>

        <?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

        <div class="success">
                <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
        </div>

        <?php endif; ?>

        <p>Вы можете войти использую логин: demo и пароль:demo. Также работает регистрация.</p>

        <div class="form">
        <?php echo CHtml::beginForm(); ?>

                <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

                <?php echo CHtml::errorSummary($model); ?>

                <div class="row">
                        <?php echo CHtml::activeLabelEx($model,'username'); ?>
                        <?php echo CHtml::activeTextField($model,'username') ?>
                        <?php echo CHtml::error($model,'username'); ?>
                </div>

                <div class="row">
                        <?php echo CHtml::activeLabelEx($model,'password'); ?>
                        <?php echo CHtml::activePasswordField($model,'password') ?>
                        <?php echo CHtml::error($model,'password'); ?>
                </div>

                <div class="row">
                        <p class="hint">
                        <?php echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
                        </p>
                </div>

                <div class="row rememberMe">
                        <?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
                        <?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
                </div>

                <div class="row submit">
                        <?php echo CHtml::submitButton(UserModule::t("Login")); ?>
                </div>

        <?php echo CHtml::endForm(); ?>
        </div><!-- form -->
       </div>
 </div>
   <?php $this->widget('application.extensions.fancybox.EFancyBox', array(
        'target'=>'a#invite',
        'config'=>array(
                'scrolling' => FALSE,
                'titleShow' => FALSE,
                'type'=>'inline',
                'overlayShow'=>FALSE,
        ))
);?>
