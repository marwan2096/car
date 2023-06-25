<?php include('header.php'); ?>
<?php  $page_active = "cars"; ?>
<?php include('nav.php'); ?>




<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary">  ALL CARS </h2>
        </div>
        <?php
$cars = $db->read("SELECT * FROM car_inventory");
if (count($cars) > 0) {
    // Display the table
    ?>
    <div class="col-sm-12">
        <table class="table table-dark">
            <!-- Table headers -->
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Colors</th>
                    <th>Quantity</th>
                    <th>Details</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through the cars and display the data -->
                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td><?php echo strtoupper($car['name']); ?></td>
                        <td><?php echo $car['colors']; ?></td>
                        <td><?php echo strtoupper($car['quantity']); ?></td>
                        <td><?php echo strtoupper($car['details']); ?></td>
                        <td>
                            <a href="edit-employee.php?id=<?php echo $car['id']; ?>" class="text-primary">
                                <i class="fa fa-pencil-square-o fa-2x"></i>
                            </a>
                        </td>
                        <td>
                            <a href="delete-employee.php?id=<?php echo $car['id']; ?>" class="text-danger">
                                <i class="fa fa-times fa-2x"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
} else {
    // Display a message if no data is found
    ?>
    <div class="col-sm-12">
        <h3 class="alert alert-danger mt-5 text-center">No Data Found</h3>
    </div>
    <?php
}
?>



<?php include('footer.php'); ?>


