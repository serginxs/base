<?php
$this->pageTitle=tt('Settings'); 
?>

<h2><?php echo tt('Settings'); ?></h2>
<div id="status_msg">
    <?php Helpers::getFlash(); ?>
    <?php Helpers::getFlash('error'); ?>   
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'config-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'type'=>'striped bordered condensed',	
        'template'=>"{items}\n{pager}",        
	'columns'=>array(		
                array(
                    'name'=>'title',
                    'type'=>'html',
                    'value'=>'"<b>".$data->title."</b>"',
                    'headerHtmlOptions' => array('style' => 'width:55%;'), 
                ),
		array(
                    'class' => 'editable.EditableColumn',
                    'name'=>'value',
                    'type'=>'raw',                   
                    'value'=>'$data->ConfigValue',
                    'editable' => array(                           
                            'url' => $this->createUrl('edit'),                           
                            'placement' => 'right',                            
                            'title'=>'Изменить значение',
                            'emptytext'=>'пусто',                           
                       ),                    
                    'filter'=>false,
                    'headerHtmlOptions' => array('style' => 'width:45%;'), 
                    ),             
	),
)); ?>
