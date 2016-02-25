<?php
/*
*
* Mykyta P.	
* mp091689@gmail.com
*
*Params:
*	$source - path to the watermark. Watermark should be 'png',
*	$procents - the percentage of the original image to watermark,
*	$min_size - min height/width 'pix' of image for overlay watermark,
*	$position - positioning watermark:
*		0 - center,
*		1 - top-left,
*		2 - top-right,
*		3 - bottom-right,
*		4 - bottom-left,
*	$mrgin - indent from the edge
*
*Параметры:
*	$source - путь к файлу вотермарки. Вотермарка должна быть 'png'
*	$procents - процентное соотношение вотермарки к оригинальному изображению
*	$min_size - минимальная ширина/высота 'pix' изображения накоторое будет наложена вотермарка
*	$position - позиционирование вотермарки:
*		0 - по центру
*		1 - прижать в левый верхний угол
*		2 - прижать в правый верхний угол
*		3 - прижать в правый нижний угол
*		4 - прижать в левый нижний угол
*	$mrgin - отступ вотермарки от края
*
*/
$source = "watermark.png"; // путь к вотермарке, в данном случае тот же каталог что и у wm-config.php
$procents = 45; // % - сколько процентов вотермарк должен занимать на фотографии
$min_size = 100; // pix - накладываем на изображения шириной/высотой свыше заданного кол-ва пикселей
$position = 0; // позиционирование вотермарки: 0-центр,1-лево-верх,2-право-верх,3-право-низ,4-лево-низ
$margin = 0; // pix - отступ вотермарки от краев