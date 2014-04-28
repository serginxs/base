<?php
$this->pageTitle=tt('Manage news'); 


Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker(jQuery.datepicker.regional['ru']);
    $('a[rel=\'tooltip\']').tooltip(); $('div.tooltip-arrow').remove(); $('div.tooltip-inner').remove();
        }");
?>

<h2><?php echo tt('Manage news'); ?></h2>

    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', 
    'stacked'=>false, 
    'items'=>array(        
        array('label'=>tt('Create news'), 'url'=>array('create')),       
    ))); ?>
<?php Helpers::getFlash(); ?>

 <!--SEO-->
 <?php $this->renderPartial('_tag',array('page'=>$page)); ?>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'news-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'type'=>'striped bordered condensed',
	'afterAjaxUpdate' => 'js:  reinstallDatePicker',
        'template'=>"{headline}{summary}\n{items}\n{pager}",
        'summaryText'=>'Новости: <strong>{start} - {end}</strong> из <strong>{count}</strong>',
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
                  array(
                        'name' => 'create_time',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model'=>$model, 
                            'attribute'=>'create_time', 
                            'language' => 'ru',
                            'i18nScriptFile' => 'jquery-ui-i18n.min.js', // (#2)
                            'htmlOptions' => array(
                                'id' => 'datepicker_for_due_date',
                                'size' => '10',
                            ),
                            'defaultOptions' =>$model->datepickerOptions,
                       ), 
                            true),
                      'value'=>'date("d.m.Y",strtotime($data->create_time))',
                      'htmlOptions'=>array(
                        'style'=>'width:110px;text-align:center;'
                     )
                     ),
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
                    'class'=>'JToggleColumn',
                    'name'=>'active',                    
                    'checkedButtonLabel'=>'Не публиковать',
                    'uncheckedButtonLabel'=>'Публиковать', 
                    'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                    'filter'=> CHtml::dropDownList('News[active]',$_GET[News][active],array(0=>'Нет',1=>'Да'),array('prompt'=>'Все')), 
                ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',                       
		),             
	),
)); ?>

 
 <?php
$message='Выберите новости для удаления';
$deleteok='Выбранные новости успешно удалены';
$confirm='Вы уверены, что желаете удалить выбранные новости';
echo CHtml::ajaxlink('<i class="icon-trash icon-white"></i> Удалить выбранные',$this->createUrl('deletesome'),
        array(
            'type'=>'post',
            'cache'=>FALSE,
            'data' => "js:{ids:$.fn.yiiGridView.getSelection('news-grid')}",
            'beforeSend'=>"function(data){
                           var ids;
                           ids=$.fn.yiiGridView.getSelection('news-grid');                           
                           if(!ids.length) {alert('$message'); return false};
                           if(!confirm('$confirm')) return false;
                           }",           
            'success'=>'function(){
                            $("#style-grid").yiiGridView.update("news-grid"); return false;
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
