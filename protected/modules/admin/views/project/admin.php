<?php
$this->pageTitle='Управление проектами'; 
?>

<h2><?php echo 'Управление проектами'; ?></h2>

    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(        
        array('label'=>'Создать проект', 'url'=>array('create')),       
    ))); ?>
<?php Helpers::getFlash(); ?>

 <!--SEO-->
 <?php $this->renderPartial('_tag',array('page'=>$page)); ?>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'project-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'type'=>'striped bordered condensed',
	'afterAjaxUpdate' => 'js:  reinstallDatePicker',
        'template'=>"{headline}{summary}\n{items}\n{pager}",
        'summaryText'=>'Проекты: <strong>{start} - {end}</strong> из <strong>{count}</strong>',
        'selectableRows' => 2,	
       
	'columns'=>array(
		/*array(
                    'name'=>'id',
                    'htmlOptions'=>array(
                        'style'=>'width:25px;text-align:center;'
                    )),                 
                 */
                array(
                        'class'=>'CCheckBoxColumn',
                        'checkBoxHtmlOptions'=>array('class'=>'select-on-check'),               
                        'headerHtmlOptions'=>array('style'=>'width:25px;text-align:center;'),
                        'htmlOptions'=>array(
                        'style'=>'width:25px;text-align:center;',
                        'class'=>'checkbox-column',
                     )),                 
		/* array(
                   'name'=>'img',
                   'type'=>'raw',
                   'value'=>'CHtml::image($data->admintumb.$data->img,$data->img,array( 
                       "title"=>$data->title ,
                       "width"=>"80",
                       "height"=>"80"))',
                   'htmlOptions'=>array(
                        'style'=>'width:85px;text-align:center;'
                    ),
                    'filter'=>false
               ),*/
		array(
                    'name'=>'title',
                    'type'=>'raw',
                    'value'=>  'CHtml::link($data->title,array("update","id"=>$data->id));',
                    'htmlOptions'=>array(                       
                    )),
               
              
               /* 'alias',
                array(
                    'name'=>'text',
                    'type'=>'html',
                    'value'=>'$data->getshort(25)'
                ),
		 array(
                    'name'=>'sorter',
                    'htmlOptions'=>array(
                        'style'=>'width:20px;text-align:center;'
                    )                   
                ),        
                array(
                          'header' => '',
                          'name' => 'sorter',
                          'class' => 'ext.OrderColumn.OrderColumn',
                          'htmlOptions'=>array('class'=>'order-column'),
                ),         
         */
               array(
                        'class' => 'editable.EditableColumn',
                        'name' => 'sorter',                        
                        'editable' => array(                           
                            'url' => $this->createUrl('edit'),                           
                            'placement' => 'left',
                            'inputclass' =>'input-mini',
                            'title'=>'Изменить порядок',
                            'emptytext'=>'Не задан',                            
                            'onSave' => 'js: function(e, params) {$.fn.yiiGridView.update("project-grid");}'
                        ), 
                        'headerHtmlOptions'=>array('title'=>'Очерёдность вывода проектов'),
                        'htmlOptions'=>array('style'=>'text-align:center;width:60px;'),
                        'filter'=>false
                     ),
	       array(
                    'class'=>'JToggleColumn',
                    'name'=>'active',                    
                    'checkedButtonLabel'=>'Не публиковать',
                    'uncheckedButtonLabel'=>'Публиковать', 
                    'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                    'filter'=> CHtml::dropDownList('Project[active]',$_GET[Project][active],array(0=>'Нет',1=>'Да'),array('prompt'=>'Все')), 
                ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',                       
		),             
	),
)); ?>

 
 <?php
$message='Выберите проекты для удаления';
$deleteok='Выбранные проекты успешно удалены';
$confirm='Вы уверены, что желаете удалить выбранные проекты';
echo CHtml::ajaxlink('<i class="icon-trash icon-white"></i> Удалить выбранные',$this->createUrl('deletesome'),
        array(
            'type'=>'post',
            'cache'=>FALSE,
            'data' => "js:{ids:$.fn.yiiGridView.getSelection('project-grid')}",
            'beforeSend'=>"function(data){
                           var ids;
                           ids=$.fn.yiiGridView.getSelection('project-grid');                           
                           if(!ids.length) {alert('$message'); return false};
                           if(!confirm('$confirm')) return false;
                           }",           
            'success'=>'function(){
                            $("#style-grid").yiiGridView.update("project-grid"); return false;
                            }',
            'complete'=>"function(){
                           // alert('Selected images were successfully removed');
                           $('#statusMsg').html('<div class=flash-success>$deleteok</div>');
                            }"
        ),
        array(            
             'class'=>'mybutton',
             'class'=>'btn btn-danger',
             'type' => 'submit',       
             )
 );
?>
