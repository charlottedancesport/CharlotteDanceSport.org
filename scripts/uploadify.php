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
	
	// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	// if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
	
		move_uploaded_file($tempFile,$targetFile);
	
	//$fh = fopen($targetFile, 'r') or die("Can't open file");
	
        $info = pathinfo($targetFile);

        if ( strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg' )
        { $img = imagecreatefromjpeg( $targetFile ); }
	else if ( strtolower($info['extension']) == 'png' )
	{ $img = imagecreatefrompng( $targetFile ); }
	else if ( strtolower($info['extension']) == 'gif' )
        { $img = imagecreatefromgif( $targetFile ); }
	else if ( strtolower($info['extension']) == 'bmp' )
        { $img = imagecreatefromwbmp( $targetFile ); }

         // load image and get image size
         $width = imagesx( $img );
         $height = imagesy( $img );

         // calculate thumbnail size
         $new_width = 150;
         $new_height = floor( $height * ( $thumbWidth / $width ) );

         // create a new temporary image
         $tmp_img = imagecreatetruecolor( $new_width, $new_height );

         // copy and resize old image into new image 
         imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

         // save thumbnail into a file
	 $pathToThumbs = str_replace($_REQUEST['folder'],$_REQUEST['folder'] . '/thumbs',$targetFile);

	if ( strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg' )
        { imagejpeg( $tmp_img, "{$pathToThumbs}" ); }
        else if ( strtolower($info['extension']) == 'png' )
        { imagepng( $tmp_img, "{$pathToThumbs}" ); }
        else if ( strtolower($info['extension']) == 'gif' )
        { imagegif( $tmp_img, "{$pathToThumbs}" ); }
        else if ( strtolower($info['extension']) == 'bmp' )
        { imagewbmp( $tmp_img, "{$pathToThumbs}" ); }

	//fclose($fh);

		echo "1";
	// } else {
	// 	echo 'Invalid file type.';
	// }
}
?>
