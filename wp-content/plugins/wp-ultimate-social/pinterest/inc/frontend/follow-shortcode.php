<?php
if(isset($attr['name']) && $attr['name'] != ''){
$name = $attr['name'];
}else{
	$name = 'pinterest';
}

if(isset($attr['button_label']) && $attr['button_label'] !=''){
$button_label = $attr['button_label'];
}else{
	$button_label = 'Follow';
}

?>
<a data-pin-do="buttonFollow" href="http://www.pinterest.com/<?php echo $name; ?>/"><?php echo $button_label; ?></a>