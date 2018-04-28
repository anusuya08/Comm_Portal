<?php
session_start();
include 'includes/header.php';
?>
<h2>Search Results</h2>
<?php 
$result  = $_GET['results'];
$parsed_json = json_decode($result, true);
?>
<link rel="stylesheet" href="css\pure-release-1.0.0\pure-min.css">
<table class="pure-table pure-table-bordered" width="800">
            <tr>
			<thead>
               <th><b>First Name</b></th>
               <th><b>Last Name</b></th>
               <th><b>Email</b></th>
			   </thead>
            </tr>    
    <?php 
    foreach ($parsed_json as $user) {
        if($user!=null){
            ?>
            <tr>
               <td><?=$user['firstName']?></td>
               <td><?=$user['lastName']?></td>
               <td><?=$user['email']?></td>
            </tr>
            <?php 
        }
    }
    ?>
    </table><br/><br/>



<?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'superadmin' ):?>
Continue with <a href="modules/user/userlistadmin.php">search again</a>
<?php endif; ?>
<?php if($_SESSION['role'] == 'user'):?>
Continue with <a href="modules/user/userlist.php">search again</a>
<?php endif; ?>

<?php
include 'includes/footer.php';
?>