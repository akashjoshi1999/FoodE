<?php include 'admin_header.php'; ?>
<div id="main-content">
    <h2>Add New Food</h2>
    <form class="post-form"  enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="food_name" />
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="text" name="food_price" />
        </div>
        <div class="form-group">
            <label>Categaries</label>
            <select name="food_cat">
                <option value="" selected disabled>Select Categary of Food</option>
                <option value="pizza">Pizza</option>
                <option value="chinese">Chinese</option>
                <option value="ice_cream">Ice_cream</option>
                <option value="mithai">Mithai</option>
            </select>
        </div>
        <div class="form-group">
            <label>Dicription</label>
            <textarea name="food_dis" cols="43"></textarea>
        </div>
        <div class="form-group">
            <label>Food's Photo</label>
            <input type="file" name="food_image">
        </div>
        <button class="submit" type="submit" name="food_add" value="Add">Add</button>
    </form>
</div>
</div>
</body>
</html>
<?php
require "config.php";
if(isset($_POST['food_add'])){
    if(empty($_POST['food_name'])){
        echo '<div class="alert alert-danger">Food name required.</div>';
    } else {
        $fname = $_POST['food_name'];
    }
    if(empty($_POST['food_price'])){
        echo '<div class="alert alert-danger">Food price required.</div>';
    } else {
        $fprice = $_POST['food_price'];
    }
    if(empty($_POST['food_cat'])){
        echo '<div class="alert alert-danger">Food categary required.</div>';
    } else {
        $fcat = $_POST['food_cat'];
    }
    if(empty($_POST['food_dis'])){
        echo '<div class="alert alert-danger">Food discription required.</div>';
    } else {
        $fdis = $_POST['food_dis'];
    }
    $filename = $_FILES["food_image"]["name"];
    $filetype = pathinfo($filename, PATHINFO_EXTENSION);
    $allowType = array('jpg','png','jpeg','gif');
    if(in_array($filetype, $allowType)){
        $tempname = $_FILES["food_image"]["tmp_name"];   
        $img = addslashes(file_get_contents($tempname));        
        $sql = "INSERT INTO product (fname,fprice,fcat,fdis,fimage) VALUE ('$fname','$fprice','$fcat','$fdis','$img')";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("Location: admin_product.php");
        }
        
    }
    
} 
?>