<?php
    include('phpqrcode/qrlib.php');

    // how to save PNG codes to server
    
    $tempDir = $dir;
    
    $codeContents = $qrCode;
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = $qrFileName.'.png';

    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;
    
    // generating
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath, 'L', 10, 0);
        //echo '<hr />';
    } else {
        $display ='File already Existed';
        //echo '<hr />';
    }
    
   // echo 'Server PNG File: '.$pngAbsoluteFilePath;
    //echo '<hr />';
    
    // displaying
   // echo '<img src="'.$urlRelativeFilePath.'" />';