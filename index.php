<?php 

$NumFiles = 0;

function recurse_copy($src,$dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                //echo (@mime_content_type($file));
                
                if (pathinfo($file, PATHINFO_EXTENSION) == "png"){
                    $im = imagecreatefrompng($file);
                    $im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => 100, 'height' => 200]);
                    
                    if ($im2 !== FALSE) {
                        imagepng($im2,$dst . '/' . $file); 
                        imagedestroy($im2);
                    } 
                } 
                elseif(pathinfo($file, PATHINFO_EXTENSION) == "jpg"){
                    $im = imagecreatefromjpeg($file);
                    $im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => 100, 'height' => 200]);
                    
                    if ($im2 !== FALSE) {
                        imagejpeg($im2,$dst . '/' . $file); 
                        imagedestroy($im2);
                    } 

                }
                else{
                echo "\n\n\n";
                copy($src . '/' . $file,$dst . '/' . $file);
                }
                $GLOBALS['NumFiles'] = $GLOBALS['NumFiles'] + 1;
            }
        }
    }
    closedir($dir);
}


function start(){
    $folderA = "/mnt/webapp/A";
    $folderB = "/mnt/webapp/B";
    recurse_copy($folderA, $folderB);
    echo 'Общее количество: ';
    echo $GLOBALS['NumFiles'];
}

start();
