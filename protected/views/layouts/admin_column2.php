<?php $this->beginContent('//layouts/admin'); ?>
<div class="span-19">
	<div id="content">
            <div class="content-wraper">
		<?php echo $content; ?>
            </div>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
            
                <?php
                        $this->beginWidget('zii.widgets.CPortlet', array(
                                'title'=>  Yii::t('main','Operations'),
                        ));
                        $this->widget('zii.widgets.CMenu', array(
                                'items'=>$this->menu,
                                'htmlOptions'=>array('class'=>'operations'),
                        ));
                        $this->endWidget();                        
                ?>
               <br/>
               <?php echo $this->clips['registration_settings']; ?>
               
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>