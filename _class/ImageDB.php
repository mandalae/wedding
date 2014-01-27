<?php
class ImageDB {
    
    private $image = null;
    
    function __construct($imageId = null){
        $this->image = new Image($imageId);
    }
    
    public function getJS(){
        $html[] = '<script type="text/javascript">
                       function select_image(id, name, path){
                           $("#" + name).val(id);

                           $("#image_" + name + " img").attr("src", path);
                       }

                       function select_multiple_images(json, name){
                           $(".imagedb_multiple_image").remove();
                           for (var i in json){
                               var item = json[i];
                               $("#images").append(getImageHTML(item.id, item.path, name, parseInt(i)+1));
                           }
                           $(".js-empty").remove();
                       }
                       function getImageHTML(imageId, path, name, list){
                           if (typeof list == \'undefined\') list = 1;
                           return \'<div class="imagedb_multiple_image">\' +
                                   \'<input id="image_id" type="hidden" name="image_id[]" value="\' + imageId + \'">\' +
                                   \'<a id="image_\'+name+\'" class="imagedb_multiple" href="#">\' +
                                   \'<img width="80" height="80" alt="" src="\'+path+\'">\' +
                                   \'</a>\' +
                                   \'<input class="small" type="text" name="list[\'+imageId+\']" value="\'+list+\'">\' +
                                   \'<input type="checkbox" name="remove_image[]" value="">\' +
                                   \'<label for="remove_image">Fjern</label>\' +
                                   \'</div>\';
                       }
                       
                    </script>';
    
        return join("", $html);
    }
    
    public function getSingleHTML($name){
        $html[] = '<script type="text/javascript">
                        $(function(){
                            $(".form-element").on("click", ".imagedb_single", function(e){
                                e.preventDefault();
                                
                                window.open("/admin/imagedb/?selector='.$name.'", "imagedb", "height=760,width=1075,menubar=no,resizable=yes,scrollbars=yes,toolbar=no");
                            });
                        });
                    </script>';
        if ($this->image->isNew()){
            $html[] = '<input type="hidden" value="0" name="'.$name.'" id="'.$name.'" />';
            $html[] = '<a href="#" class="imagedb_single" id="image_'.$name.'"><img src="/_gfx/blank.gif" width="80" height="80" /></a>';
        } else {
            $html[] = '<input type="hidden" value="'.$this->image->getId().'" name="'.$name.'" id="'.$name.'" />';
            $html[] = '<a href="#" class="imagedb_single" id="image_'.$name.'">'.$this->image->getTag(80, 80).'</a>';
        }
        
        return join("", $html);
    }
    
    public function getMultipleHTML($name, $images = array()){
        $html[] = '<script type="text/javascript">
                        $(function(){
                            $(".form-element").on("click", ".imagedb_multiple", function(e){
                                e.preventDefault();
                                
                                var images = "";
                                $(".imagedb_multiple_image [type=\'hidden\']").each(function(){
                                    images += $(this).val() + ";";
                                });
                                window.open("/admin/imagedb/?selector='.$name.'&multiple=true&images=" + images, "imagedb", "height=760,width=1075,menubar=no,resizable=yes,scrollbars=yes,toolbar=no");
                            });
                        });
                    </script>';

        if (count($images) == 0){
            $html[] = '<input type="hidden" value="0" name="'.$name.'" id="'.$name.'" />';
            $html[] = '<a href="#" class="imagedb_multiple js-empty" id="image_'.$name.'"><img src="/_gfx/blank.gif" width="80" height="80" /></a>';
        } else {
            foreach ($images as $prodImage){
                $image = new Image($prodImage->getImage_id());
                if (!$image->isNew()){
                    $html[] = '<div class="imagedb_multiple_image">';
                    $html[] = '<input type="hidden" value="'.$image->getId().'" name="'.$name.'['.$prodImage->getId().']" id="'.$name.'" />';
                    $html[] = '<a href="#" class="imagedb_multiple" id="image_'.$name.'">'.$image->getTag(80, 80).'</a>';
                    $html[] = '<input type="text" value="'.$prodImage->getList().'" name="list['.$image->getId().']" class="small" />';
                    $html[] = '<input type="checkbox" value="'.$prodImage->getId().'" name="remove_image[]" /><label for="remove_image">Fjern</label>';
                    $html[] = '</div>';
                } else {
                    $html[] = '<div class="imagedb_multiple_image">';
                    $html[] = '<input type="hidden" value="0" name="'.$name.'['.$prodImage->getId().']" id="'.$name.'" />';
                    $html[] = '<a href="#" class="imagedb_multiple" id="image_'.$name.'"><img src="/_gfx/blank.gif" width="80" height="80" /></a>';
                    $html[] = '<input type="text" value="'.$prodImage->getList().'" name="list[]" class="small" />';
                    $html[] = '<input type="checkbox" value="'.$prodImage->getId().'" name="remove_image[]" /><label for="remove_image">Fjern</label>';
                    $html[] = '</div>';
                }
            }
        }
        
        return join("", $html);
    }
}