<?php include_once "header.php";
error_reporting(E_ALL);
ini_set('display_errors', 'on');
 ?>

  <div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">

      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>


      <div class="carousel-inner" style="height:500px">
        <div class="item active">
          <img src="1.jpg" alt="Los Angeles">
        </div>

        <div class="item">
          <img src="2.jpg" alt="Chicago">
        </div>

        <div class="item">
          <img src="3.jpg" alt="New York" >
        </div>
      </div>


      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <div><br><br></div>

    <div class="row">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-8">
        <form action="search.php" method="post">
          <div class="form-group row">
            <div class="col-xs-6">
              <label for="email">Source:</label>
              <select class="form-control" name="source">

                  <?php
                  // echo("hello");
                  $query = 'SELECT * FROM `city`';
                  $result = mysqli_query($db,$query);
                  // $result1= $result;
                  // echo(mysqli_num_rows($result));
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo('<option value="'.$row['id'].'">'.$row['city'].'</option>');
                  }
                   ?>
              </select>
            </div>
            <div class="col-xs-6">
              <label for="email">Destination:</label>
              <select class="form-control" name="destination">
                <?php
                $query = 'SELECT * FROM `city`';
                $result = mysqli_query($db,$query);
                $result1= $result;
                // echo(mysqli_num_rows($result));
                while ($row = mysqli_fetch_assoc($result)) {
                  echo('<option value="'.$row['id'].'">'.$row['city'].'</option>');
                }
                 ?>
              </select>
            </div>

          </div>
          <div class="form-group">
            <label for="email">Mode:</label>
            <select class="form-control" name="mode">
              <option value="1">Flight</option>
              <option value="2">Bus</option>
              <option value="3">Train</option>
            </select>
          </div>
          <div class="form-group">
            <label>Date</label>
      			<input class="form-control" type="date" name="date">
          </div>
          <button type="submit" class="btn btn-default" name="search">Submit</button>
        </form>
      </div>
      <div class="col-sm-2">
      </div>

    </div>

  </div>

</body>

</html>
