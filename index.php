<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

  <div class="container mt-2 mb-4 p-2 shadow bg-white">
    <form action="CRUDquery.php" method="POST">
        <div class="form-row justify-content-center">
            <div class="col-auto">
                <input type="text" name="username" class="form-control" id="username" placeholder="User Name">
            </div>
            <div class="col-auto">
                <input type="text" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="col-auto">
                <button type="submit" name="save" class="btn btn-info">Save</button>
            </div>
        </div>
    </form>
  </div>
<!-- popup alert vide le champs-->
  <?php  require_once("CRUDquery.php"); ?>

  <div class="container">
    <?php  if(isset($_SESSION['msg'])):  ?>
    <div class="<?= $_SESSION['alert']; ?>">
      <?= $_SESSION['msg']; 
      unset($_SESSION['msg']);  ?>
     
    </div>
    <?php endif; ?>

  <!-- Otable pour afficher le resultat -->

  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>User Name</th>
        <th>Password</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <form action="CRUDquery.php" method="POST">

      <?php  
      #coding for display user's data
      $sQuery = "SELECT * FROM account LIMIT 20";
      $result = $conn->query($sQuery);
      $x = 1;

    while($row = $result->fetch_assoc()): ?>
      <tr>
        <td> <?= $row['id']; ?></td>
        <td> <?= $row['username']; ?></td>
        <td> <?= $row['password']; ?></td>
        <td style="width:15%">
        <button type="submit" name="delete" value="<?= $row['id']; ?>" class="btn btn-danger">Delete</button>
        <button type="button" name="edit" value="<?= $x; $x++; ?>" class="btn btn-primary">Edit</button>
        </td>
      </tr>
      
    <?php endwhile; ?>
    </form>
      
    </tbody>
  </table>
  </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

 <!-- setTimeout pour enlever le popup alert le champs est vide  -->
  <script type="text/javascript">
    $(document).ready(function(){
      setTimeout(function(){
        $(".alert").remove();
      }, 3000);

      $(" .btn-primary").click(function() {
        $(".table").find('tr').eq(this.value).each(function () {
          $("#username").val($(this).find('td').eq(1).text());
          $("#password").val($(this).find('td').eq(2).text());
          $(".btn-info").val($(this).find('td').eq(0).text());

        })

        $(".btn-info").attr("name", "edit")
      });

    });
  </script>



  </body>
</html>