<?php
class Helpers extends CComponent
{
    
      /*
        * Метод устнавливет флэш сообщение
        */
        public static function setFlash($message,$status='success')
        {            
            Yii::app()->user->setFlash($status,$message);      
        }

        /*
        * Метод выводит флэш сообщение и изчезает
        */
        public static function getFlash($name='success')
        {
          if(Yii::app()->user->hasFlash($name))
              Yii::app()->controller->widget('bootstrap.widgets.TbAlert', array(
                    'block'=>true, // display a larger alert block?
                    'fade'=>true, // use transitions?
                    'closeText'=>'закрыть', // close link text - if set to false, no close link is displayed
                    'alerts'=>array( // configurations per alert type
                        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
                        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
                    )
                 ));           
         }
       
      // Ресайз изображения пропорционально по указаным размерам с обрезанием    
     public static function ResizeBaner($ImagePath ,$name,$width,$height)
        {
            $path=$ImagePath;
            $new_path=$path.$width.'x'.$height.'/';              
            if(!file_exists($new_path))
                 mkdir ($new_path);            
            $image = Yii::app()->image->load($path.$name);
              if($image->__get('width') > $width || $image->__get('height') > $height)
              {
                $image ->resize($width,$height,Image::AUTO)->crop($width,$height)->quality(90)->sharpen(20);               
              }
            $image->save($new_path.$name);           
        }
      
                 
     // Ресайз изображения по указаным размерам для прямоугольных и квадратных превьюшек с обрезанием  
     public static function ResizeImage($ImagePath ,$name,$width,$height)
        {
            $path=$ImagePath;            
            $new_path=$path.'/thumb/';            
            if(!file_exists($new_path))
                 mkdir ($new_path);
            
            $image = Yii::app()->image->load($path.$name);           
           
              if($image->__get('width') > $width || $image->__get('height') > $height)
              {
                  if($image->__get('width') >= $image->__get('height'))
                  {
                      if($image->__get('width')/$image->__get('height')>$width/$height)
                           $image ->resize($width,$height,Image::HEIGHT)->crop($width,$height)->quality(90)->sharpen(20); 
                      else
                           $image ->resize($width,$height,Image::WIDTH)->crop($width,$height)->quality(90)->sharpen(20); 
                  }
                  else
                  {                      
                      $image ->resize($width,$height,Image::WIDTH)->crop($width,$height)->quality(90)->sharpen(20);                      
                  }             
              }
            $image->save($new_path.$name);             
        }
        
                    
     // Ресайз изображения по высоте и ширине  
     public static function ResizeGallery($ImagePath ,$name,$width,$height)
        {
            $path=$ImagePath;            
            $new_path=$path.'/thumb/';            
            if(!file_exists($new_path))
                 mkdir ($new_path);            
            $image = Yii::app()->image->load($path.$name);           
           
              if($image->__get('width') > $width || $image->__get('height') > $height)
              {
                  if($image->__get('width') >= $image->__get('height'))                    
                     $image ->resize($width,$height,Image::WIDTH)->quality(90)->sharpen(20);                
                  else                                      
                     $image ->resize($width,$height,Image::HEIGHT)->quality(90)->sharpen(20);                              
              }
            $image->save($new_path.$name);             
        }
        
  
          
       //Загрузка видео с Vimeo//       
       public static function Vimeo($str)
       {           
            $pattern='/(<iframe.+(player.vimeo.com).+<\/iframe>)/';
            if(!preg_match($pattern, $str,$match))
                return FALSE;            
            $code=str_replace(array('width="500"','height="281"'),array('width="472"','height="265"'),$match[1]);
            return $code;
       }
       public static function YoutubeModal($str)
       {
           $pattern='/youtu.be/';
           if(!preg_match($pattern, $str,$match))
                return FALSE; 
           $replacement='www.youtube.com/v'; 
           $code=preg_replace($pattern, $replacement, $str);
           
           return $code;
       }


       public static function Youtube($str)
       {                  
            $pattern='/(<iframe.+(youtube.com).+<\/iframe>)/';
            if(!preg_match($pattern, $str,$match))
                return FALSE; 
            $pattern=array();
            $pattern[]='/width="\d+"/';
            $pattern[1]='/height="\d+"/';
            $replace=array();
            $replace[]='width="482"';
            $replace[1]='height="271"';
            $code=preg_replace($pattern,$replace,$match[1]);
            return $code;
       }
       
        public static function MailToAdmin($subject,$message,$email='') {
            $siteName= Yii::app()->params['site_name'];
    	    $adminEmail = Yii::app()->params['adminEmail'];
         
            $headers="Content-type: text/plain; charset=\"utf-8\"";
            $headers.="From: {$siteName}\r\nReply-To: {$email}";            
            
            return mail($adminEmail,$subject,$message,$headers);           
          
	}
}       


?>
