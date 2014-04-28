<h4>Все фото проекта <?php echo $model->title;?></h4>
<?php
 $this->widget('GalleryManager', array(
                'gallery' => $model->galleryBehavior->getGallery(),
                'controllerRoute' => '/admin/gallery',
            ));
 ?>