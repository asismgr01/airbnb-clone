<?php 
    function uploadImage($image,$dir_name,$width=350,$height=240,$thumb=null){
      $path=public_path().'/uploads/'.$dir_name;
      if (!File::exists($path)) {
    	  File::makeDirectory($path,0777,true,true);
      }
 	    $filename=ucfirst($dir_name).'-'.date('Ymdhms').rand(0,99).'.'.$image->getClientOriginalExtension();	
 	    Image::make($image)->resize($width,$height,function($constraints){
         $constraints->aspectRatio();
 	    })->save($path.(($thumb == 'thumbnail') ? '/thumbnail-' : '').$filename);
 	    $success=$image->move($path,$filename,60);
 	    if ($success) {
 		    return $filename;
 	    }
 	    else{
 		    return false;
 	    }
    }
 	function uploadMultipleImages($images,$dir_name,$width=400,$height=400){
 		$path=public_path().'/uploads/'.$dir_name;
 		if (!File::exists($path)) {
 			File::makeDirectory($path,0777,true,true);
 		}
 		$filenames=array();
 		foreach ($images as $key => $value) {
 		    $filename=ucfirst($dir_name).date('Ymdhms').rand(0,99).'.'.$images[$key]->getClientOriginalExtension();

 		    Image::make($images[$key])->resize($width,$height,function($constraints){
 		    	$constraints->aspectRatio();
 		    })->save($path.$filename);
            $success=$images[$key]->move($path,$filename);
 		    
            if ($success) {
            	$filenames[$key]=$filename;
            }
            else{
                $filenames[$key]=null;
            }
 		}
 		return $filenames;
 	}
    function setflash($key,$message){
        if (!isset($_SESSION)) {
             session_start();
        }
        $_SESSION[$key]=$message;
    }
    function flash(){
        if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
            echo "<p class='alert alert-danger'>".$_SESSION['error']."</p>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
            echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
            unset($_SESSION['success']);
        }
    }
 
 ?>