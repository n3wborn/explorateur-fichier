<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorateur de fichiers</title>
</head>
<body>
    <?php
    require_once("php/printFiles.php");
    require_once("php/cd.php");
    // stock "home" directory path
    $url = getcwd() . DIRECTORY_SEPARATOR . "home";
    $url = json_encode($url);
    cd($url);
    ?>

    <header>
        <nav>
            <ul id="breadcrumb"></ul>
        </nav>
    </header>
    
    <?php
    // print content of home folder
    $content = scandir(getcwd());
    $items = [];
    foreach($content as $item){
        if($item !== "." && $item !== ".."){
            array_push($items, ["name"=>$item, "isFolder"=>is_dir($item)]);
        }
    }
    printItems(json_encode($items));
    ?>

    <script src="script.js"></script>
    <script>
        setSessionUrl(<?=$url?>);
        breadcrumbUpdate(sessionStorage.getItem("url"));
    </script>
</body>
</html>