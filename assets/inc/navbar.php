<?php
    $aid=$_SESSION['user_id'];
    $ret="select first_name from USER where username=?";//fetch details of pasenger
    $stmt= $mysqli->prepare($ret) ;
    $stmt->bind_param('s',$aid);
    $stmt->execute() ;
    $res=$stmt->get_result();
    $row=$res->fetch_object()
?>
<nav class="navbar navbar-expand fixed-top be-top-header">
  <div class="container-fluid">
    <div class="be-navbar-header"><a class="navbar-brand" href="user-dashboard.php"></a>
    </div>
    <div class="be-right-navbar">
      <ul class="nav navbar-nav float-right be-user-nav">
        <li class="nav-item h4 px-2 my-auto mx-auto"><?php echo $aid; ?></li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><img src="assets/img/profile/defaultimg.png" alt="Avatar"></a>
          <div class="dropdown-menu" role="menu">     
            <a class="dropdown-item" href="user-profile.php"><span class="icon"><span class="material-symbols-outlined">person</span></span>Profile</a>
            <a class="dropdown-item" href="user-logout.php"><span class="icon"><span class="material-symbols-outlined">logout</span></span>Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>