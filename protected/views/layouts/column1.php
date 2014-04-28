<?php $this->beginContent('//layouts/main'); ?>
<div id="content">
  <div class="container">
      <?php
            if(isset($this->breadcrumbs) && $this->id!='collection')
              $this->widget('BreadCrumbs', array('links'=>$this->breadcrumbs)); ?>
    
      <?php echo $content; ?>
  </div>
</div><!-- content -->
<?php $this->endContent(); ?>