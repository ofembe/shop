<?PHP session_start();?>
<!DOCTYPE html>
<!--
Ofembe Eneufei
This is a demo for an e-shop with json used for storage of products
-->
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            #wrapper {
                width:80%;
                margin-left: auto;
                margin-right: auto;
            }
            
            .product {
                display: inline-block;
                padding: 10px;
                border-bottom: 1px solid gray;
            }
            
            .image{
                width: 300px;
                height: 300px;
            }
            .image img{
                width: 242px;
                height: 208px;
            }
            
        </style>
        <title>Simple shop demo</title>
    </head>
    <body>
        <div id="wrapper">
            <div><a href="index.php?reset=true">Reset session</a>
            </div>
            <div><a href="index.php?viewed=true">Viewed</a>
            </div>
        <?php  
        if(!isset($_SESSION['viewed'])){
           $_SESSION['viewed'] = array();
        }
        require 'product.php';
        
        //Aray of products in place of database
        $products_json = '[{"id":0,"description":"Product number 0","price":0,"image":"Image0.jpg"},'
                . '{"id":1,"description":"Product number 1","price":100,"image":"Image1.jpg"},'
                . '{"id":1,"description":"Product number 2","price":200,"image":"Image2.jpg"},'
                . '{"id":3,"description":"Product number 3","price":300,"image":"Image3.jpg"},'
                . '{"id":4,"description":"Product number 4","price":400,"image":"Image4.jpg"},'
                . '{"id":5,"description":"Product number 5","price":500,"image":"Image5.jpg"},'
                . '{"id":6,"description":"Product number 6","price":600,"image":"Image6.jpg"},'
                . '{"id":7,"description":"Product number 7","price":700,"image":"Image7.jpg"},'
                . '{"id":8,"description":"Product number 8","price":800,"image":"Image8.jpg"},'
                . '{"id":9,"description":"Product number 9","price":900,"image":"Image9.jpg"}]';
        //create array from json string
        $db_array = json_decode($products_json,true);
        //reset history
        if(isset($_GET['reset'])){
            unset($_SESSION['viewed']);
            unset($_GET['view']);
        }
        //view single entry
        if(isset($_GET['viewed'])){
            $viewed = array();
            for($i = 0; $i < count($_SESSION['viewed']); $i++){
                $product = $db_array[$_SESSION['viewed'][$i]];
                $viewed[] = $product;
            }
            $products = createProducts($viewed);
            displayProducts($products);
           // displayProducts($viewed); 
        }elseif(isset($_GET['view'])){
            $product = createProduct($_GET['view']);
            displayProducts($product); 
            if(!in_array($product[0]->getId(), $_SESSION['viewed'], true)){
                array_push($_SESSION['viewed'],$product[0]->getId());
            }
        }else{
            unset($_GET['reset']);
            $products = createProducts($db_array);
             displayProducts($products);
             
        }
      
        function createProducts($db_array)
        {
            $products = array();

            for($i = 0; $i < count($db_array); $i++){
               $product = new Product($db_array[$i]['id']);
               $product->setDescription($db_array[$i]['description']);
               $product->setPrice($db_array[$i]['price']);
               $product->setImage($db_array[$i]['image']);
               $products[] = $product;
            }
            
            return $products;
        }
        
        function displayProducts($objectarray){
            $products = $objectarray;
            for($i = 0; $i < count($products); $i++){
                
        ?>
        <div class="product">
            <div class="description"><?php echo $products[$i]->getDescription(); ?></div>
            <div class="image"><img src="<?php echo "images/".$products[$i]->getImage(); ?>"></div>
            <div class="price"><?php echo "$".$products[$i]->getPrice(); ?></div>
            <a href="index.php?view=<?php echo $products[$i]->getId(); ?>"><div class="view">View</div></a>            
        </div>
        <?php
            }
        }
        
        function createProduct($id){
            global $db_array;
            $dummyarray = array();
            $item = $db_array[$id];
            $dummyarray[] = $item;
            $product = createProducts($dummyarray);  
            return $product;
        }
        ?>
        </div>
    </body>
</html>
