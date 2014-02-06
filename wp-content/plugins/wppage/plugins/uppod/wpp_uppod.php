<?php
/*

*/

// SETTINGS
$wpp_uppod_settings['uppod.swf']= plugins_url().'/wppage/plugins/uppod/uppod.swf';
$wpp_uppod_settings['swfobject.js']='http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js';
$wpp_uppod_settings['adobe_update']='Необходимо обновить <a href="http://get.adobe.com/flashplayer/" target="_blank">Adobe Flash Player</a>';
$wpp_uppod_settings['wmode']='transparent';

//VIDEO
$wpp_uppod['video']['style']= plugins_url().'/wppage/plugins/uppod/video47_black.txt';
$wpp_uppod['video']['width']='640';
$wpp_uppod['video']['height']='360';

$wpp_uppod['video']['style2']='';
$wpp_uppod['video']['width2']='400';
$wpp_uppod['video']['height2']='300';

//AUDIO
$wpp_uppod['audio']['style']='';
$wpp_uppod['audio']['width']='500';
$wpp_uppod['audio']['height']='33';

//PHOTO
$wpp_uppod['photo']['style']='';
$wpp_uppod['photo']['width']='400';
$wpp_uppod['photo']['height']='300';

function wpp_uppod($atts, $content = null){
    global $wpp_uppod;
	global $wpp_uppod_settings;
    $o='';
    $fv='';
    if($atts['video']){
		$m='video';
		$wpp_uppod['video']['width'] = $atts['width'];
		$wpp_uppod['video']['height'] = $atts['height'];
		
	}
	if($atts['audio']){
		$m='audio';
		if($atts['autoplay'] == 'on'){
			if($atts['color'] == 'black') $wpp_uppod['audio']['style']= plugins_url().'/wppage/plugins/uppod/audio47_black_autoplay.txt';
			else $wpp_uppod['audio']['style']= plugins_url().'/wppage/plugins/uppod/audio47_white_autoplay.txt';
		}else{
			if($atts['color'] == 'black') $wpp_uppod['audio']['style']= plugins_url().'/wppage/plugins/uppod/audio47_black.txt';
			else $wpp_uppod['audio']['style']= plugins_url().'/wppage/plugins/uppod/audio47_white.txt';
			}

	}
	if($atts['photo']){
		$m='photo';
	}
	$atts['type']?$t=$atts['type']:$t='';
	foreach($atts as $k => $value) {
		$k!=$m?$fv.=',"'.$k.'":"'.$value.'"':'';
	}
	$num=rand(0,1000);
    if($atts['autoplay'] == 'on'){
		$wpp_uppod['video']['style']= plugins_url().'/wppage/plugins/uppod/video47_black_autoplay.txt';
		}else{
			$wpp_uppod['video']['style']= plugins_url().'/wppage/plugins/uppod/video47_black.txt';
			}
	
	if(isset($m)){
    	strpos($atts[$m],',')===false?(strpos($atts[$m],'.txt')==strlen($atts[$m])-4?$fv.=',"pl":"'.$atts[$m].'"':$fv.=',"file":"'.$atts[$m].'"'):$fv.=',"pl":"'.wpp_uppod_pl($atts[$m]).'"';
    	if($wpp_uppod_settings['uppod.swf']=='http://'|$wpp_uppod_settings['uppod.swf']==''){
    		$o='Ошибка: в настройках плагина Uppod не указана ссылка на плеер (<a href="http://uppod.ru/player/faq/wordpress/">Видео урок</a>)';
    	}else{
			
			$o='<div id="'.$m.'player'.$num.'">'.$wpp_uppod_settings['adobe_update'].'</div><script type="text/javascript">var flashvars = {'.($wpp_uppod[$m]['style'.$t]!=''?'"st":"'.$wpp_uppod[$m]['style'.$t].'"':'"m":"'.$m.'"').$fv.'};var params = {allowFullScreen:"true", allowScriptAccess:"always",id:"'.$m.'player'.$num.'"'.($wpp_uppod_settings['wmode']!=''?',"wmode":"'.$wpp_uppod_settings['wmode'].'"':'').'}; new swfobject.embedSWF("'.$wpp_uppod_settings['uppod.swf'].'", "'.$m.'player'.$num.'", "'.$wpp_uppod[$m]['width'.$t].'", "'.$wpp_uppod[$m]['height'.$t].'", "10.0.0.0", false, flashvars, params);</script>';
		}
	}
    return $o;
}
function wpp_uppod_swfobject() {
	global $wpp_uppod_settings;
	echo '<script src="'.$wpp_uppod_settings['swfobject.js'].'" type="text/javascript"></script>';
}
function wpp_uppod_pl($str) {
	$pl="{'playlist':[";
	$obj=split(',',$str);
	for($i=0;$i<count($obj);$i++){
		$pl.="{'file':'".$obj[$i]."'},";
	}
	return chop($pl,',')."]}";
}
add_action('wppage_head', 'wpp_uppod_swfobject');
add_shortcode('wpp_uppod', 'wpp_uppod');
?>