<?php
    $file='./cache.tw';

    if (file_exists($file) && date ("Ymd", filemtime($file))==date("Ymd") ) {
        $xmlData = file_get_contents($file);
        echo $xmlData;
        echo "<!-- cacheado -->";
    }
    else
    {
        @unlink($file);
        $xmlData = file_get_contents('https://www.towebs.com/remotecontent/linux/newsite');
        $f = fopen($file,'x+');
        $xmlData.= "\n\n<!-- Generado el " . date("Y-m-d His") . " -->\n";
        fwrite($f,$xmlData,strlen($xmlData));
        fclose($f);
        echo $xmlData;
    }
?>
