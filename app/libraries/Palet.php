<?php
	Class Palet
	{
		function __construct() {
		}

		public static function inverseHex($color)
		{
		     $color       = trim($color);
		     $prependHash = FALSE;
		 
		     if(strpos($color,'#') !== FALSE) {
		          $prependHash = TRUE;
		          $color       = str_replace('#',NULL,$color);
		     }
		 
		     switch($len=strlen($color)) {
		          case 3:
		               $color=PREG_REPLACE("/(.)(.)(.)/","\\1\\1\\2\\2\\3\\3",$color);
		          case 6:
		               break;
		          default:
		               $color = "#fff";
		     }
		 
		     IF(!preg_match('/[a-f0-9]{6}/i',$color)) {
		          $color = htmlentities($color);
		          $color = "#fff";
		     }
		 
		     $r = dechex(255-hexdec(substr($color,0,2)));
		     $r = (strlen($r)>1)?$r:'0'.$r;
		     $g = dechex(255-hexdec(substr($color,2,2)));
		     $g = (strlen($g)>1)?$g:'0'.$g;
		     $b = dechex(255-hexdec(substr($color,4,2)));
		     $b = (strlen($b)>1)?$b:'0'.$b;
		 
		     return ($prependHash?'#':NULL).$r.$g.$b;
		}
		 
		public static function getPalet()
		{
			
			
			$info  = ShopType::getShopInfo();
			$palet = json_decode(stripslashes($info->color_palet));
			
			//echo css rules

			foreach($palet as $key => $val){
				echo '.'.$key.'{';
					echo 'background-color : '.$val->background_color.' !important;';
					echo 'color: '.$val->color.' !important;';
				echo '}';

				echo '.'.$key.' a{';
					echo 'color: '.$val->color.' !important;';
				echo '}';
				echo '.'.$key.' a:hover{';
					echo 'color: '.Palet::inverseHex($val->color).' !important;';
				echo '}';

				echo '.'.$key.'-text{';
					echo 'color: '.$val->background_color.' !important;';
				echo '}';
			}
			if (!empty($info->store_banner)) {
				echo '.banner{ background-image: url(template/'.$info->template.'/images/banner/'.$info->store_banner.') !important; }';
			}
		}
		
	}