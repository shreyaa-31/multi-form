<?php




function imageStore($image){
    
    $imageName = time() . '.' . $image->extension();
   
   
    $image->move(public_path('storage/images'), $imageName);
    
    if (!empty($imageName)) {
        return $imageName;
    }
    return false;
}

?>
