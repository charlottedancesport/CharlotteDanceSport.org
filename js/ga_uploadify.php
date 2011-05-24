<?php
/*
Uploadify v2.1.0
Release Date: August 24, 2009

Copyright (c) 2009 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];

	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
    $targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
	
	/* Added by Lance Newby 8/30/2010 - Check tha the images files is the accepted dimensions of 960x280*/
	list($width, $height, $type, $attr) = getimagesize($tempFile); 
	
	if($width != 960 || $height != 168) 
	{
	echo "1";
	die("Selected image has incorrect dimensions."); 
	}
	
	move_uploaded_file($tempFile,$targetFile);

        if ( preg_match("/(\.jpg|\.jpeg)$/i",$_FILES['Filedata']['name']) )
        { $img = imagecreatefromjpeg( "../ga_uploads/".$_FILES['Filedata']['name'] ); }
        else if ( preg_match("/\.png$/i",$_FILES['Filedata']['name']) )
        { $img = imagecreatefrompng( "../ga_uploads/".$_FILES['Filedata']['name'] ); }
        else if ( preg_match("/\.gif$/i",$_FILES['Filedata']['name']) )
        { $img = imagecreatefromgif( "../ga_uploads/".$_FILES['Filedata']['name'] ); }
        else if ( preg_match("/\.bmp$/i",$_FILES['Filedata']['name']) )
        { $img = imagecreatefromwbmp( "../ga_uploads/".$_FILES['Filedata']['name'] ); }
		else { echo "1";}
		
         // load image and get image size
         //$width = imagesx( $img );
         //$height = imagesy( $img );

         // calculate thumbnail size
         $new_width = 250;
         $new_height = floor( $height * ( $new_width / $width ) );

         // create a new temporary image
         $tmp_img = imagecreatetruecolor( $new_width, $new_height );

         // copy and resize old image into new image 
         imagecopyresampled( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

         // save thumbnail into a file
         $pathToThumbs = str_replace("{$_REQUEST['folder']}","{$_REQUEST['folder']}"."/ga_thumbs",$targetFile);
		 $pathToThumbs = str_replace('//','/',$pathToThumbs);
		 $pathToThumbs = "../ga_thumbs/".$_FILES['Filedata']['name'];
        if ( preg_match("/(\.jpg|\.jpeg)$/i",$_FILES['Filedata']['name']) )
        { imagejpeg( $tmp_img, "{$pathToThumbs}" ); }
        else if ( preg_match("/\.png$/i",$_FILES['Filedata']['name']) )
        { imagepng( $tmp_img, "{$pathToThumbs}" ); }
        else if (  preg_match("/\.gif$/i",$_FILES['Filedata']['name']) )
        { imagegif( $tmp_img, "{$pathToThumbs}" ); }
        else if ( preg_match("/\.bmp$/i",$_FILES['Filedata']['name']) )
        { imagewbmp( $tmp_img, "{$pathToThumbs}" ); }

 
	/* End addition by Lance Newby */
	
	// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	// if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);

		echo "1";
	// } else {
	// 	echo 'Invalid file type.';
	// }
}
?>
