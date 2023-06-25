<nav class="navbar navbar-expand-lg navbar-light bg-info">
  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item  <?php if($page_active=="home"){echo "active";} ?> ">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item <?php if($page_active=="cars"){echo "active";} ?>">
            <a class="nav-link" href="cars.php">Cars</a>
        </li>
        <li class="nav-item <?php if($page_active=="add-car"){echo "active";} ?>">
            <a class="nav-link" href="add-car.php">Add Car</a>
        </li>
      
        </ul>
    </div>
</nav>
