<?php
/*
*
*	Mykyta P.	
*	mp091689@gmail.com
*
* All configurations are done in the file wm-config.php
*
*/

waterMark($_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']);
function waterMark( $original ) {
	require 'wm-config.php'; // custom configuration file
	$original = urldecode($original);
	$info_o = @getImageSize($original);
	if (!$info_o)
		return false;
	$info_w = @getImageSize($source);
	if (!$info_w)
		return false;
	header("Content-Type: ".$info_o['mime']);
	$original = @imageCreateFromString(file_get_contents($original));
	$out = imageCreateTrueColor($info_o[0],$info_o[1]);
	$src = ImageCreateFromPNG ($source);
	$w_proc = ceil(($info_o[0]*$procents)/100);// % от ширины оригинальной фотографии(ширина будущей вотермарки)
	$koef = $info_w[0]/$w_proc;// получили пропорцию ширины относительно высоты будущей вотермарки
	$h_proc_koef = ceil($info_w[1]/$koef);// высота будущей вотермарки по коэфициенту(относительно 30%)
	$new_watermark = imagecreatetruecolor($w_proc, $h_proc_koef);// Создаем полноцветное изображение
	imagealphablending($new_watermark, false);// Отключаем режим сопряжения цветов
	imagesavealpha($new_watermark, true);// Включаем сохранение альфа канала
	imagecopyresampled($new_watermark, $src, 0, 0, 0, 0, $w_proc, $h_proc_koef, $info_w[0], $info_w[1]);//ресайз
	imageCopyMerge($out, $original, 0, 0, 0, 0, $info_o[0], $info_o[1], 100);
	if( ($info_o[0] > $min_size) && ($info_o[1] > $min_size) ) { // Водяной знак накладываем только на изображения больше $min_size пикселей по вертикали и по горизонтали
		switch ( $position ) {
			case 0: imageCopy($out, $new_watermark, ($info_o[0]-$w_proc)/2, ($info_o[1]-$h_proc_koef)/2, 0, 0, $w_proc, $h_proc_koef);
					break;
			case 1: imageCopy($out, $new_watermark, 0+$margin, 0+$margin, 0, 0, $w_proc, $h_proc_koef);
					break;
			case 2: imageCopy($out, $new_watermark, $info_o[0]-$w_proc-$margin, 0+$margin, 0, 0, $w_proc, $h_proc_koef);
					break;
			case 3: imageCopy($out, $new_watermark, $info_o[0]-$w_proc-$margin, $info_o[1]-$h_proc_koef-$margin, 0, 0, $w_proc, $h_proc_koef);
					break;
			case 4: imageCopy($out, $new_watermark, 0+$margin, $info_o[1]-$h_proc_koef-$margin, 0, 0, $w_proc, $h_proc_koef);
					break;
		}
	}
	switch ( $info_o[2] ) {
		case 1:
			imageGIF($out);
			break;
		case 2:
			imageJPEG($out);
			break;
		case 3:
			imagePNG($out);
			break;
		default:
			return false;
	}
	imageDestroy($out);
	imageDestroy($original);
	imageDestroy($new_watermark);
	return true;
}
?>