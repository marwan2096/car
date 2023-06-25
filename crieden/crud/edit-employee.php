<?php include('header.php'); ?>
<?php include('nav.php'); ?>


<?php  $row = $db->find('car_inventory',$_GET['id']); ?>
<?php if(isset($_GET['id']) && is_numeric($_GET['id']) && $row):  ?>

<?php 

    $error = '';
    $success = '';
?>


<?php

    if(isset($_POST['submit']))
    {
      $name       = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
      $colors       = filter_var($_POST['colors'],FILTER_SANITIZE_STRING);
      $quantity     = filter_var($_POST['quantity'],FILTER_SANITIZE_STRING);
      $details       = filter_var($_POST['details'],FILTER_SANITIZE_STRING);

        if(empty($name) )
        {
            $error = "Please Fill All Fields";
        }
        else 
        {
            if(strlen($name) >= 3)
            {
            
          
                            $sql = "UPDATE car_inventory SET `name`='$name',`colors`='$colors',`quantity`='$quantity',
                            `details`='$details' WHERE `id`='$row[id]' ";
                            $success = $db->update($sql);
                        
                        
                    }
                  
          
            else 
            {
                $error = "name Must be Grater Than 3 chars !";
            }
        }
    }

?>


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary">  Edit Car </h2>
        </div>


        <div class="col-sm-12">
            <?php if($error !=''): ?>
            <h2 class="p-2 col text-center mt-5  alert alert-danger"> <?php echo $error; ?>  </h2>
            <?php endif; ?>

            <?php if($success !=''): ?>
            <h2 class="p-2 col text-center mt-5  alert alert-success"> <?php echo $success; ?>  </h2>
            <?php endif; ?>
        </div>
        <div class="col-sm-12">
            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="<?php echo $row['name']; ?>"   class="form-control" id="name"  placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="colors">Colors</label>
                    <input type="text" name="colors" value="<?php echo $row['colors']; ?>" class="form-control" id="department"  placeholder="Enter department">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Quantity</label>
                    <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>


                <div class="form-group">
                    <label for="exampleInputDetails">Details</label>
                    <input type="text" value="<?php echo $row['details']; ?>"name="details" class="form-control" id="exampleInputPassword1" placeholder="Details">
                </div>
            
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>


<?php else: ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="alert alert-danger mt-5 text-center"> Not Found </h3>
            </div>
        </div>
    </div> 
    

<?php  endif;  ?>

<?php include('footer.php'); ?>



  