<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet"> 
<?php include('config.php');?>
<title>Book Club</title>
</head>


<html>
<body>
<section class="allt">

<nav class="topmenu">
 <a href="lab1.php"><img class="logo-img" src="bilder/logotype4.png"></a>
<ul>
 
  <li><a class="<?php echo ($current_page == 'lab1.php' || $current_page == '') ? 'active' : NULL ?>" href="lab1.php">Home</a></li>
  <li><a class="<?php echo ($current_page == 'lab1_browsbooks.php') ? 'active' : NULL ?>" href="lab1_browsbooks.php">Brows Books</a></li>
  <li><a class="<?php echo ($current_page == 'lab1_mybooks.php') ? 'active' : NULL ?>" href="lab1_mybooks.php">My Books</a></li>
  <li><a class="<?php echo ($current_page == 'lab1_aboutus.php') ? 'active' : NULL ?>" href="lab1_aboutus.php">About Us</a></li>
  <li><a class="<?php echo ($current_page == 'lab1_contact.php') ? 'active' : NULL ?>" href="lab1_contact.php">Contact</a></li>
  </ul>
  </nav>

  
  

