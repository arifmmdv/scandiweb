<?php
// Load all classes
function __autoload($class){
    require_once "classes/$class.php";
}
// Add new product to database
if(isset($_POST['submit'])){

    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $type_info = $_POST['type-info'];

    $fields = [
        'sku'=>$sku,
        'name'=>$name,
        'price'=>$price,
        'type'=>$type,
        'type_info'=>$type_info
    ];

    // Declaration of new class
    $product = new Product();
    // Calling insert function of Product Class
    $product->insert($fields);

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
    <title>Add product</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <div class="header">
                <h1>Add Product</h1>
                <div class="action">
                    <button type="submit" name="submit">Save</button>
                </div>
            </div>
            <div class="add-product">

                <div class="form-group">
                    <label for="sku">SKU</label>
                    <input type="text" name="sku">
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" required >
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" required>
                </div>

                <div class="form-group switcher">
                    <label for="price">Type Switcher</label>
                    <select name="type" id="price">
                        <?php
                        $type = new Type();
                        $rows = $type->select();

                        foreach($rows as $row){

                        ?>
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="types">
                <div class='form-group'>
                    <label>Size</label>
                    <input type='text' name='type-info' reqired>
                    <p>Please provide size of 'DVD-Disc' in MB</p></div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#price').on('change', function() {
            if(this.value == 1){
                $(".types").html("<div class='form-group'><label>Size</label><input type='text' name='type-info' reqired><p>Please provide size of 'DVD-Disc' in MB</p></div>");
            }else if(this.value == 3){
                $(".types").html("<input type='hidden' name='type-info' class='type-info'><div class='form-group'><label>Height</label><input type='text' name='height' class='height' reqired></div><div class='form-group'><label>Width</label><input type='text' class='width' name='width' reqired></div><div class='form-group'><label>Length</label><input type='text' class='length' name='length' reqired><p>Please provide dimensions in HxWxL format.</p></div>");
            }else if(this.value == 2){
                $(".types").html("<div class='form-group'><label>Weight</label><input type='text' name='type-info' reqired><p>Please provide weight of a book in Kg.</p></div>");
            }

            $(".width").keyup(function(){
                $(".type-info").val($(".height").val()+"x"+$(".width").val()+"x"+$(".length").val());
            });

            $(".length").keyup(function(){
                $(".type-info").val($(".height").val()+"x"+$(".width").val()+"x"+$(".length").val());
            });

            $(".height").keyup(function(){
                $(".type-info").val($(".height").val()+"x"+$(".width").val()+"x"+$(".length").val());
            });
        });
    });
    </script>
</body>
</html>