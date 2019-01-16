<?php
// Load all classes
function __autoload($class){
    require_once "classes/$class.php";
}
$notification = "";
// Delete Products
if(isset($_POST['delete'])){
    if(isset($_POST['id'])){
        foreach ($_POST['id'] as $id){
            $product = new Product();
            $product->delete($id);
        }
    }else{
        $notification = "<p class='notification'>Select at least 1 product</p>";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Products</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
        <div class="header">
            <h1>Product List</h1> 
            <a href="create.php">Add new product</a>
            <div class="action">
                <label for="">Mass delete action</label>
                <button type="submit" name="delete">Apply</button>
            </div>
            <?php echo $notification; ?>
        </div>
        <div class="products">
            <?php
            // Declaration of a class
            $product = new Product();
            // Call select function in Product classs
            $rows = $product->select();

            if($rows != null){

            foreach($rows as $row){
                // Call select function in Type classs
                $types = new Type();
                $type = $types->selectType($row['type']);

                ?>
                <div class="col-3">
                    <div class="product">
                        <input type="checkbox" name="id[]" value="<?php echo $row['id']; ?>">
                        <p><?php echo $row['sku']; ?></p>
                        <h2><?php echo $row['name']; ?></h2>
                        <p><?php echo $row['price']; ?> $</p>
                        <p><span><?php echo $type['attr']; ?>: </span><?php echo $row['type_info']; ?> <?php echo $type['unit']; ?></p>
                    </div>
                </div>
            <?php }} ?>
        </div>
        </form>
    </div>
</body>
</html>