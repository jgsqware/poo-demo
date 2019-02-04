<html>
<head>
    <title>Test PHP</title>
</head>
<body>

<?php
autoload();
include_once("main.php");

Main::start();

function autoload(){

    spl_autoload_register(function ($class) {
        $arr = array("model","helpers");
        foreach ($arr as $folder) {
            $path = './'.$folder.'/' . strtolower($class) . '.php';
            if (file_exists($path) && is_readable($path)) {
                include $path;
            }
        }
    });
}
?>

</body>
</html>