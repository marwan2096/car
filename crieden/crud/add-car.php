<?php include('header.php'); ?>
<?php $page_active = "add-car"; ?>
<?php include('nav.php'); ?>

<?php
$error = '';
$success = '';
?>

<?php
if (isset($_POST['submit'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $colors = filter_var($_POST['colors'], FILTER_SANITIZE_STRING);
    $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_STRING);
    $details = filter_var($_POST['details'], FILTER_SANITIZE_STRING);

    if (empty($name)) {
        $error = "Please Fill All Fields";
    } else {
        if (strlen($name) >= 3) {
            $db = new Database();

            // Check if the car already exists in the database
            $existingCar = $db->read("SELECT * FROM car_inventory WHERE name='$name' AND colors='$colors'");

            if ($existingCar) {
                // If the car already exists, update the quantity
                $existingQuantity = $existingCar[0]['quantity'];
                $newQuantity = $existingQuantity + $quantity;

                $sql = "UPDATE car_inventory SET quantity='$newQuantity' WHERE name='$name' AND colors='$colors'";
                $success = $db->update($sql);
            } else {
                // If the car doesn't exist, insert a new entry
                $sql = "INSERT INTO car_inventory (`name`,`colors`,`quantity`,`details`) 
                            VALUES ('$name','$colors','$quantity','$details') ";
                $success = $db->insert($sql);
            }
        } else {
            $error = "Name must be greater than 3 characters!";
        }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary">Add CAR</h2>
        </div>

        <div class="col-sm-12 mb-4">
            <?php if ($error != '') : ?>
                <h2 class="p-2 col text-center mt-5 alert alert-danger"><?php echo $error; ?></h2>
            <?php endif; ?>

            <?php if ($success != '') : ?>
                <h2 class="p-2 col text-center mt-5 alert alert-success"><?php echo $success; ?></h2>
            <?php endif; ?>
        </div>

        <div class="col-sm-12">
            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="colors">Colors</label>
                    <input type="text" name="colors" class="form-control" id="colors" placeholder="Enter colors">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Enter quantity">
                </div>
                <div class="form-group">
                    <label for="details">Details</label>
                    <input type="text" name="details" class="form-control" id="details" placeholder="Enter details">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Add Car</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>








