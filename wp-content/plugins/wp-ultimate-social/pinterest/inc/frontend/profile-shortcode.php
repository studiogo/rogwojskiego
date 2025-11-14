<?php
/*
var_dump($profile_attr);
array
  'profile' => string 'shovanjaya55' (length=12)
  'custom_size' => string 'square' (length=6)
  'image_width' => string '250' (length=3)
  'board_height' => string '350' (length=3)
  'board_width' => string '350' (length=3)
*/

if(isset($profile_attr['profile'])){
$profile 		= isset($profile_attr['profile']) ? $profile_attr['profile'] : 'pinterest';  
}else{
  $profile = 'pinterest';
}

$custom_size 	= isset($profile_attr['custom_size']) ? $profile_attr['custom_size'] : 'square';
	switch ($custom_size) {
                case 'square':
                    $image_width    = '80';
                    $board_height   = '320';
                    $board_width    = '400';
                    break;
                
                case 'sidebar':
                    $image_width    = '60';
                    $board_height   = '800';
                    $board_width    = '150';
                    break;

                case 'header':
                    $image_width    = '115';
                    $board_height   = '120';
                    $board_width    = '900';
                    break;

                case 'custom': 
                	$image_width 	= isset($profile_attr['image_width']) ? $profile_attr['image_width'] : '80' ;
					$board_height 	= isset($profile_attr['board_height']) ? $profile_attr['board_height'] : '320' ;
					$board_width 	= isset($profile_attr['board_width']) ? $profile_attr['board_width'] : '400' ;
                	break;

                default:
                   	$image_width 	= isset($profile_attr['image_width']) ? $profile_attr['image_width'] : '80' ;
					$board_height 	= isset($profile_attr['board_height']) ? $profile_attr['board_height'] : '320' ;
					$board_width 	= isset($profile_attr['board_width']) ? $profile_attr['board_width'] : '400' ;
                    break;
            }

?>
<a data-pin-do="embedUser" href="http://www.pinterest.com/<?php echo $profile; ?>" data-pin-scale-width="<?php echo $image_width; ?>" data-pin-scale-height="<?php echo $board_height; ?>" data-pin-board-width="<?php echo $board_width; ?>"></a>