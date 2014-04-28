<?php
/**
 * Simple widjet for selecting page size of gridviews
 *
 * @author	Aruna Attanayake <aruna470@gmail.com>
 * @version 1.0
 */

class PageSize extends CWidget
{
	public $mPageSizeOptions = array(5=>5, 10=>10, 25=>25, 50=>50, 75=>75, 100=>100);
	public $mPageSize;
	public $mGridId = '';
	public $mDefPageSize;
	
	public function run()
	{			
		Yii::app()->user->setState('pageSize', $this->mPageSize);
		
		$this->mPageSize = null==$this->mPageSize ? $this->mDefPageSize : $this->mPageSize;
		
		echo 'Элементов на страницу: ';
		echo CHtml::dropDownList('pageSize', (int)$this->mPageSize, $this->mPageSizeOptions,array(
                                'class'=>'span1',
				'onchange'=>"$.fn.yiiGridView.update('$this->mGridId',{ data:{pageSize: $(this).val() }})",
		));
	}
}
?>