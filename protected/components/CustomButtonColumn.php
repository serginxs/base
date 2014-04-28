<?php

Yii::import('bootstrap.widgets.TbButtonColumn');


class CustomButtonColumn extends TbButtonColumn 
{
        public $htmlOptions=array( 'style'=>'width:140px;text-align:center;vertical-align:middle;');
	
	public $attrButtonIcon = 'list-alt';    
	public $attrButtonOptions=array('class'=>'btn attr');        
        
        public $upButtonIcon = 'icon-arrow-up';	
	public $upButtonOptions=array('class'=>'btn up');
        
        public $downButtonIcon = 'icon-arrow-down';	
	public $downButtonOptions=array('class'=>'btn down');
	
        
	protected function initDefaultButtons()
	{
		parent::initDefaultButtons();

		if ($this->attrButtonIcon !== false && !isset($this->buttons['attr']['icon']))
			$this->buttons['attr']['icon'] = $this->attrButtonIcon;	
                if ($this->upButtonIcon !== false && !isset($this->buttons['up']['icon']))
			$this->buttons['up']['icon'] = $this->upButtonIcon;
                 if ($this->downButtonIcon !== false && !isset($this->buttons['down']['icon']))
			$this->buttons['down']['icon'] = $this->downButtonIcon;
	}

	
}
