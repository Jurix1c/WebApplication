<?php 

echo phpinfo();
//echo gd_info();
exit;
//require_once 'ralouphie/mimey';

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
                ///echo (@mime_content_type($file));
                if (pathinfo($file, PATHINFO_EXTENSION) == "png"){
                $path_parts = pathinfo($file);

                echo $path_parts['dirname'], "\n";
                echo $path_parts['basename'], "\n";
                echo $path_parts['extension'], "\n";
                echo $path_parts['filename'], "\n";

                //$im = imagecreatefrompng('/users/jurix/php/A/foto.png');
                $im = @imagecreatefromjpeg('/users/jurix/php/A/foto2.jpg');
                }

                /*if (pathinfo($file, PATHINFO_EXTENSION) == "png"){
                    $im = imagecreatefrompng($file);
                    $im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => 100, 'height' => 200]);
                    if ($im2 !== FALSE) {
                    //imagepng($file, 'example-cropped.png');
                    //magedestroy($im2);
                    echo "This is PNG";}
                } */




                echo "\n\n\n";
                copy($src . '/' . $file,$dst . '/' . $file);
                $GLOBALS['NumFiles'] = $GLOBALS['NumFiles'] + 1;
            }
        }
    }
    closedir($dir);
}


function start(){
    $folderA = "/users/jurix/php/A";
    $folderB = "/users/jurix/php/B";

    //$mimes = new \Mimey\MimeTypes;

    //echo $folderA;
    //echo $folderB;
    //echo mime_content_type($folderA);
    //getcwd();
    //echo $mimes->getAllExtensions('image/jpeg');

    recurse_copy($folderA, $folderB);
    echo 'Общее количество: ';
    echo $GLOBALS['NumFiles'];
}

start();
