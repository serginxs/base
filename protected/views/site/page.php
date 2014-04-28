
  <?php
  $this->breadcrumbs=array($page->title);

  $dependency= new CGlobalStateCacheDependency('Cache.page');
  if($this->beginCache('Page'.$page->alias, array('duration'=>param('cachingTime',3600),'dependency'=>$dependency)))
    {
      echo '<div class="text-color-block l-blue clearfix">'
          .'<h3 class="brown">'.CHtml::encode($page->title).'</h2>'
          .  Yii::app()->format->formatHtml($page->text)
          .'</div>';
  $this->endCache();} ?>
