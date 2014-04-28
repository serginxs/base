<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="col-md-3"> 
       <?php $this->widget('CatalogMenu');?>   
    </div>
    <div class="col-md-9">
        <div id="content">
            <?php
            if(isset($this->breadcrumbs))
              $this->widget('BreadCrumbs', array('links'=>$this->breadcrumbs)); ?>
            <?php echo $content; ?><!-- content -->
        </div>
    </div>
</div>
<?php $this->endContent(); ?>