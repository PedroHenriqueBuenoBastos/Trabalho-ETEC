<?php include('funcoes.php') ?>
<!DOCTYPE html>
<html>
<head>
<title>bem vindo</title>
	<meta charset="UTF-8">

</head>
<body>
   
	  <!-- Header -->
	  <div class="sub-header">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-xs-12">
            <ul class="left-info">
                <li><a href="#">Bem vindo, <?php echo $_SESSION['user']['usuario']; ?></a></li>
                <li><a><?php echo $_SESSION['user']['tipo_usuario']; ?></a></li>
            </ul>
          </div>
        </div>
      </div>
	</div>


</body>
</html>