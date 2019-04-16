<?php
include_once 'server.php';
include_once 'header.php';

$query = 'SELECT tr.name as name, tr.mode as mode, t.date as date, tr.time as time, t.fare as fare, t.status as status, t.id as id FROM `tickets` t, `transport` tr WHERE t.`user_id`= "'.$_SESSION['userId'].'" and t.`transport_id`=tr.`id` ORDER BY `date`';
// echo($query);
$result = mysqli_query($db, $query);




?>

 <div class="container">
   <center><h1>Profile</h1></center>
   <center><table >
      <tr>
        <th style="text-align: right;">Name:&nbsp</th>
        <td><?php echo($_SESSION['name']);  ?></td>

      </tr>
      <tr>
        <th style="text-align: right;">Email:&nbsp</th>
        <td><?php echo($_SESSION['email']); ?></td>
      </tr>

      <tr>
        <th style="text-align: right;">Username:&nbsp</th>
        <td><?php echo($_SESSION['username']); ?></td>
      </tr>
    </table></center>
    <br>
   <hr/>
   <h2>Booking</h2>
   <table class="table table-hover">
     <thead>
       <tr>
         <th>Id</th>
         <th>Name</th>
         <th>Mode</th>
         <th>Date</th>
         <th>Time</th>
         <th>Fare</th>
         <th>status</th>
         <th></th>
       </tr>
     </thead>
     <tbody>
       <?php
       if($result){
         while ($row = mysqli_fetch_assoc($result)) {
           echo('<tr>
             <td>'.$row['id'].'</td>
             <td>'.$row['name'].'</td>');
             if($row['mode']==1){echo('<td>Flight</td>');}
             elseif($row['mode']==2){echo('<td>Bus</td>');}
             else{echo('<td>Train</td>');}
             echo('<td>'.$row['date'].'</td>
             <td>'.$row['time'].'</td>
             <td>'.$row['fare'].'</td>');
             if($row['status']<0){echo('<td>Cancelled and Refunded</td>');}
             elseif ($row['status']==0) {echo('<td>Booking failed</td>');}
             elseif ($row['status']==1) {echo('<td>Booked</td>');}
             else{echo('<td>'.$row['status'].'</td>');}
             if(strtotime($row['date'])>time()){
           //   echo('
           //   <td><form action="cancel.php" method="POST">
           //       <input type="hidden" name="ticket_id" value="'.$row['id'].'">
           //        <button type="submit" class="btn btn-default">Cancel</button>
           //       </form.</td>
           // </tr>');
         echo('<td><button class="btn btn-default" id="'.$row['id'].'" onclick="cancel(this.id)">Cancel</button></td>');}
           else {
             echo('<td>Date passed</td>');
           }
         }
       }
        ?>
     </tbody>
   </table>
 </div>
</body>
</html>
<script>
function cancel( params) {
  if (confirm("You really want to cancel!?")) {
    var method = "post"; // Set method to post by default if not specified.
    var path = "cancel.php";
    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);


        if(params) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "ticket_id");
            hiddenField.setAttribute("value", params);

            form.appendChild(hiddenField);
        }


    document.body.appendChild(form);
    form.submit();
  } else {
    txt = "You pressed Cancel!";
  }

}
</script>
