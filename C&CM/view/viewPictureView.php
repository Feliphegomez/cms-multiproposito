<?php 

#echo json_encode($picture);
if(!$picture->isValid()){
	echo "Error";
	exit();
}
$b = $picture;

/*
"echo 'OK';

*/

$pictureData = json_encode($b->getData());
#echo "<img src=\"{$pictureData}\" />";
$data = json_decode(preg_replace('#^data:image/\w+;base64,#i', '', $pictureData));


exit(0);


/*
$im = ImageCreateFromString($data);

if ($im !== false){
	header('Content-Type: image/png');
	$width = (isset($_GET['w']) && $_GET['w'] > 0) ? (int) $_GET['w'] : 150;
	$height = (isset($_GET['h']) && $_GET['h'] > 0) ? (int) $_GET['h'] : (ImageSY($im) * $width / ImageSX($im));
	$output = ImageCreateTrueColor($width, $height);
	ImageCopyResampled($output, $im, 0, 0, 0, 0, $width, $height, ImageSX($im), ImageSY($im));
	# ImageJPEG($output, "temp/images/{$picture->name}", 95);
	imagepng($output);
	imagedestroy($output);
}*/

function base64ToImage($base64_string, $output_file) {
    $file = fopen($output_file, "wb");

    $data = explode(',', $base64_string);

    fwrite($file, base64_decode($data[1]));
    fclose($file);

    return $output_file;
}

$imd = base64ToImage($pictureData, 'temp/images/temp.png');
header('Content-Type: image/png');
require_once $imd;
exit(0);





$pictureData = @explode('data:', $b->getData());
if(isset($pictureData[1]) && $b->id > 0){
	$Base64ImgTemp = @explode(';base64,', $pictureData[1]);
	
	if(isset($Base64ImgTemp[0]) && isset($Base64ImgTemp[1])){
		$im = ImageCreateFromString(base64_decode($Base64ImgTemp[1]));
		if ($im !== false) 
			{
				header('Content-Type: image/png');
				if(isset($_GET['w']) && $_GET['w'] == 'original')
					{
						imagepng($im);
						imagedestroy($im);
					} 
				else if(!isset($_GET['thumb']) || $_GET['thumb'] == false)
					{
						$height = true;
						$width = 150;
						if(isset($_GET['w']) && $_GET['w'] > 0){ $width = (int) $_GET['w']; }
						$height = $height === true ? (ImageSY($im) * $width / ImageSX($im)) : $height;
						$output = ImageCreateTrueColor($width, $height);
						ImageCopyResampled($output, $im, 0, 0, 0, 0, $width, $height, ImageSX($im), ImageSY($im));
						# ImageJPEG($output, "temp/images/{$picture->name}", 95);
						imagepng($output);
						imagedestroy($output);
					} 
				else
					{
						echo 'Ocurrió un error. 3';
						echo json_encode($Base64ImgTemp);
						exit();
					}
			}
		else
			{
				echo 'Ocurrió un error.';
			}
	}
}
 else if(!isset($pictureData[1]) && $b->id > 0 && $b->getData() != ""){
		$data = $b->getData();
		//$data = base64_decode($data);
		$im = ImageCreateFromString($data);
		if ($im !== false) 
			{				
				if(isset($_GET['w']) && $_GET['w'] == 'original')
					{
						header('Content-Type: image/png');
						imagepng($im);
						imagedestroy($im);
					} 
				else if(!isset($_GET['thumb']) || $_GET['thumb'] == false)
					{
						header('Content-Type: image/png');
						$height = true;
						$width = 150;
						if(isset($_GET['w']) && $_GET['w'] > 0){ $width = (int) $_GET['w']; }
						$height = $height === true ? (ImageSY($im) * $width / ImageSX($im)) : $height;
						$output = ImageCreateTrueColor($width, $height);
						ImageCopyResampled($output, $im, 0, 0, 0, 0, $width, $height, ImageSX($im), ImageSY($im));
						# ImageJPEG($output, "temp/images/{$picture->name}", 95);
						imagepng($output);
						imagedestroy($output);
					} 
				else
					{
						header('Content-Type: image/png');
						imagepng($im);
						imagedestroy($im);
					}	
			}
		else
			{
				echo 'Ocurrió un error. 2';
			}
} else {
	echo 'Ocurrió un error.';
}