<?php

    class Helper{
        public static function createButton($name='', $id='#', $link='#', $icon='fas fa-location-arrow',$color='primary',$type='new'){
            $xhtml = '';
            if($type == 'new'){
                $xhtml =    '<a href="'.$link.'" id = "'.$id.'">
                                <button type="button" class="btn btn-'.$color.'">
                                    <i class="'.$icon.'"></i> '.$name.'
                                </button>
                            </a>';
                            
            }else if($type == 'submit'){
                $xhtml =    '<a href="#" id = "'.$id.'" onclick="javascript:submitForm(\''.$link.'\')">
                                <button type="button" class="btn btn-'.$color.'">
                                    <i class="'.$icon.'"></i> '.$name.'
                                </button>
                            </a>';
                            
            }
            return $xhtml;
        }

        public static function formatDate($date,$type='d-m-Y'){
            return ($date == '0000-00-00')? '' : date($type,strtotime(($date)));
        }

        public static function statusBtn($value, $link, $id){
            return ($value==1)  
                                ? '<a type="button" id="status-'.$id.'" href="javascript:changeStatus(\''.$link.'\')" class="btn btn-success"><i class="fas fa-check-circle"></i></a>' 
                                : '<a type="button" id="status-'.$id.'" href="javascript:changeStatus(\''.$link.'\')" class="btn btn-danger"><i class="fas fa-ban"></i></a>';
        }
        public static function specialBtn($value, $link, $id){
            return ($value==1) 
                                ? '<a type="button" id="special-'.$id.'" href="javascript:changeSpecial(\''.$link.'\')" class="btn btn-success"><i class="fas fa-check-circle"></i></a>' 
                                : '<a type="button" id="special-'.$id.'" href="javascript:changeSpecial(\''.$link.'\')" class="btn btn-danger"><i class="fas fa-ban"></i></a>';
        }

        public static function groupACPBtn($value, $link, $id){
            return ($value==1) 
                                ? '<a type="button" id="group_acp-'.$id.'" href="javascript:changeGroupACP(\''.$link.'\')" class="btn btn-success"><i class="fas fa-check-circle"></i></a>' 
                                : '<a type="button" id="group_acp-'.$id.'" href="javascript:changeGroupACP(\''.$link.'\')" class="btn btn-danger"><i class="fas fa-ban"></i></a>';
        }

        //Create title sort
        public static function cmsLinkSort($name, $column, $columnPost, $orderPost){
            // <a href="#" onclick="javascript:submit()">ID <i class="fas fa-sort-amount-down-alt"></i></a>
            $icon   = '';
            $order  = ($orderPost == 'asc')?'desc':'asc';
            $classIcon = '';
            if($order == 'desc'){
                $icon   = 'fa-sort-amount-down-alt';
            }else if($order == 'asc') {
                $icon   = 'fa-sort-amount-down';
            }
            if($column == $columnPost){
                $classIcon = '<i class="fas '.$icon.'"></i>';
            }
            // echo $order;
            $xhtml = '<a href="#" onclick="javascript:sortList(\''.$column.'\',\''.$order.'\')">'.$name.' '.$classIcon.'</a>';
            return $xhtml;
        }
        
        
        //Create MESSAGE
        public static function cmsCreateMessage($message){
            // $message = array('class' => 'class','content'=> 'content');
            $strMessage = '';
            if(!empty($message)){
                $icon = ($message['class'] == 'success') ? 'fas fa-check-circle "></i> <strong>Thành công:</strong> ' : 'fas fa-exclamation-circle"></i> <strong>Cảnh báo:<strong> ';
                $strMessage = '<div class="alert alert-'.$message['class'].'">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class=" '.$icon.$message['content'].'
                </div>';
            }
            
            return $strMessage;
        }
        

        //Create select BOX FILTER
        public static function cmsCreateSelectBox($name, $class, $arrValue, $keySelect = 0){
            $xhtml = '  <select class="'.$class.'" name="'.$name.'">';
            foreach ($arrValue as $key => $value) {
                if($key == $keySelect){
                    $xhtml .= '<option selected = "selected" value="'.$key.'">'.$value.'</option>';
                }else{
                    $xhtml .= '<option value="'.$key.'">'.$value.'</option>';
                }
            }
            $xhtml .=   '</select> ';

            return $xhtml;
        }

        
	    // Create Selectbox INPUT
        public static function cmsSelectInput($lable,$name, $class, $arrValue, $keySelect = 'default', $style = null){

            $xhtml = '      <div class="form-group '.$class.'"><label for="">'.$lable.'</label>
                                <select name="'.$name.'" class="form-control" >';
            foreach($arrValue as $key => $value){
 
                if($key == $keySelect && is_numeric($keySelect)){
                    $xhtml .= '<option selected="selected" value = "'.$key.'">'.$value.'</option>';
                }else{
                    $xhtml .= '<option value = "'.$key.'">'.$value.'</option>';
                }
            }
            $xhtml .='</select></div>';
            return $xhtml;
        }

        // CREATE INPUT     CREATE INPUT    CREATE INPUT    CREATE INPUT    CREATE INPUT    CREATE INPUT
        // CREATE INPUT     
        // CREATE INPUT     CREATE INPUT    CREATE INPUT    CREATE INPUT    CREATE INPUT    CREATE INPUT
        // CREATE INPUT     
        // CREATE INPUT     CREATE INPUT    CREATE INPUT    CREATE INPUT    CREATE INPUT    CREATE INPUT

        public static function createInput($label, $type, $name, $id, $value, $need = false , $class = null, $size = null){

            $strSize	=	($size==null) ? '' : "size='$size'";
            $strClass	=	($class==null) ? '' : "class='$class'";
            $star       =   ($need) ? ' <span style="color: red;">*</span>' : '';
            $xhtml ='<div class="form-group">
                        <label for="">'.ucfirst($label).$star.'</label>
                        <input  type="'.$type.'" 
                                class="form-control '.$strClass.'" 
                                name="'.$name.'" 
                                value="'.$value.'" 
                                id="'.$id.'" 
                                placeholder="Mời bạn nhập '.strtolower($label).'">
                    </div>';
                        
            return $xhtml;
        }



    }
?>
