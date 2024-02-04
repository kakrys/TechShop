<?php
//var_dump($_POST);
\Up\Services\Repository\ProductService::addProduct($_POST['name'],$_POST["description"],$_POST["price"],
    $_POST["tags"],$_POST["brand"]);