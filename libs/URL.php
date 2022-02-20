<?php
    class URL{
        public static function createURL($module,$controller, $action,$params = null){
            $text = '';
            if(!empty($params)){
                foreach ($params as $key => $value) {
                    $text .= '&'.$key.'='.$value;
                }
            }
            return 'index.php?module='.$module.'&controller='.$controller.'&action='.$action.''.$text;
        }
        public static function redirect($link){
            header('location: ' . $link);
            exit();
        }

        public static function checkRefreshPage($value, $module, $controller, $action, $option = null){
            if(Session::get('token') == $value){
				Session::delete('token');
				URL::redirect(URL::createURL($module,$controller,$action));
			}else{
				Session::set('token',$value) ;
			}
        }
    }


?>