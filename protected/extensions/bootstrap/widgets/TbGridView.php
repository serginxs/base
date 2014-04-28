<?php
/**
 * TbGridView class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('zii.widgets.grid.CGridView');
Yii::import('bootstrap.widgets.TbDataColumn');

/**
 * Bootstrap Zii grid view.
 */
class TbGridView extends CGridView
{
       public $mPageSizeOptions = array(5=>5,10=>10, 25=>25, 50=>50, 75=>75, 100=>100);
       public $mPageSize; 
       public $defaultPageSize = 10;
       
      


       // Table types.
	const TYPE_STRIPED = 'striped';
	const TYPE_BORDERED = 'bordered';
	const TYPE_CONDENSED = 'condensed';
	const TYPE_HOVER = 'hover';

	/**
	 * @var string|array the table type.
	 * Valid values are 'striped', 'bordered' and/or 'condensed'.
	 */
	public $type;
	/**
	 * @var string the CSS class name for the pager container. Defaults to 'pagination'.
	 */
	public $pagerCssClass = 'pagination';
	/**
	 * @var array the configuration for the pager.
	 * Defaults to <code>array('class'=>'ext.bootstrap.widgets.TbPager')</code>.
	 */
	public $pager = array('class'=>'bootstrap.widgets.TbPager');
	/**
	 * @var string the URL of the CSS file used by this grid view.
	 * Defaults to false, meaning that no CSS will be included.
	 */
	public $cssFile = false;

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
               /* Устанавливаем PageSize: */
              $this->dataProvider->pagination->pageSize = $this->mPageSize = (Yii::app()->request->getParam('pageSize') !== null)
                    ? Yii::app()->request->getParam('pageSize')
                    : Yii::app()->user->getState('pageSize', $this->defaultPageSize);                      
                    
              
		parent::init();    
                

		$classes = array('table');

		if (isset($this->type))
		{
			if (is_string($this->type))
				$this->type = explode(' ', $this->type);

			if (!empty($this->type))
			{
				$validTypes = array(self::TYPE_STRIPED, self::TYPE_BORDERED, self::TYPE_CONDENSED, self::TYPE_HOVER);

				foreach ($this->type as $type)
				{
					if (in_array($type, $validTypes))
						$classes[] = 'table-'.$type;
				}
			}
		}

		if (!empty($classes))
		{
			$classes = implode(' ', $classes);
			if (isset($this->itemsCssClass))
				$this->itemsCssClass .= ' '.$classes;
			else
				$this->itemsCssClass = $classes;
		}
              
                
              //  $this->template = "{headline}" . $this->template ;
	}

	/**
	 * Creates column objects and initializes them.
	 */
	protected function initColumns()
	{
		foreach ($this->columns as $i => $column)
		{
			if (is_array($column) && !isset($column['class']))
				$this->columns[$i]['class'] = 'bootstrap.widgets.TbDataColumn';
		}

		parent::initColumns();
	}

	/**
	 * Creates a column based on a shortcut column specification string.
	 * @param mixed $text the column specification string
	 * @return \TbDataColumn|\CDataColumn the column instance
	 * @throws CException if the column format is incorrect
	 */
	protected function createDataColumn($text)
	{
		if (!preg_match('/^([\w\.]+)(:(\w*))?(:(.*))?$/', $text, $matches))
			throw new CException(Yii::t('zii', 'The column must be specified in the format of "Name:Type:Label", where "Type" and "Label" are optional.'));

		$column = new TbDataColumn($this);
		$column->name = $matches[1];

		if (isset($matches[3]) && $matches[3] !== '')
			$column->type = $matches[3];

		if (isset($matches[5]))
			$column->header = $matches[5];

		return $column;
	}
        
        public function renderHeadline()
        {
            $this->mPageSize = Yii::app()->request->getParam('pageSize');            
            $this->mPageSize = null == $this->mPageSize ? Yii::app()->user->getState('pageSize') : $this->mPageSize;
            Yii::app()->user->setState('pageSize', $this->mPageSize);
            
            
            foreach ($this->mPageSizeOptions as $pageSize)
            $buttons[] = array(
                'label'       => $pageSize,
                'active'      => $pageSize == $this->mPageSize,
                'htmlOptions' => array(
                    'class' => 'pageSize',
                    'rel'   => $pageSize,
                ),
                'url'         => '#',
            );            
            
            echo '<div align="right" class="row" style="margin-bottom:2px"> Отображать по: ';                
                $this->widget(
                'bootstrap.widgets.TbButtonGroup', array(
                    'size'    => 'small',
                    'type'    => 'action',
                    'toggle'  => 'radio',
                    'buttons' => $buttons,
                )
            );               
            echo '</div>';
            
        /* Скрипт передачи PageSize: */
         Yii::app()->getClientScript()->registerScript(
             __CLASS__ . '#' . $this->getId() . 'ExHeadline',
            'jQuery(document).ready(function($) {
                $(document).on("mousedown", ".pageSize", function() {
                    $("#' . $this->getId() . '").yiiGridView("update",{
                        url: $(window)[0].location.href,
                        data: "pageSize=" + $(this).attr("rel")
                    });
                });
            });', CClientScript::POS_BEGIN
        );
        }
                
}
