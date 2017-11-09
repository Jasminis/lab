<!DOCTYPE html>
<html>

<?php 
include('header.php');
include('config.php');

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);


    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
?>



<header>
<a href="#"> <img class="smallheader" src="bilder/books4.jpg" /></a>
</header>



<section class="maincontent2">

<h2>This is where you can brows books!</h2>
<p class="welcome-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempori ncididunt ut labore <br/> </p>

 <form class="browsbooks" action="lab1_browsbooks.php" method="POST">

    <input type="text" id="title" name="searchtitle" placeholder="Title" value=""><br>

    <input type="text" id="author" name="searchauthor" placeholder="Author" value=""><br>

    <input type="submit" name="submit" value="Submit">

  </form>

<div class="myBook-list">
	<h2>Available books</h2>

<?php


// $books = array();
// $books[] = array("title" => "Get digital", "author" => "Arash Gilan");
// $books[] = array("title" => "PHP the easy way", "author" => "John Bauer");
// $books[] = array("title" => "The big bad wolf", "author" => "R. K. Rowling");
// $books[] = array("title" => "No Idea", "author" => "Nolan Ideos");

$searchtitle = "";
$searchauthor = "";

if (isset($_POST) && !empty($_POST)) {
# Get data from form
    $searchtitle = htmlentities($_POST['searchtitle']);
    $searchtitle = mysqli_real_escape_string($db, $searchtitle);
    $searchtitle = trim($searchtitle);

    $searchauthor = htmlentities($_POST['searchauthor']);
    $searchauthor = mysqli_real_escape_string($db, $searchauthor);
    $searchauthor = trim($searchauthor);
}

//  if (!$searchtitle && !$searchauthor) {
//    echo "You must specify either a title or an author";
//    exit();
//  }

$searchtitle = addslashes($searchtitle);
$searchauthor = addslashes($searchauthor);

# Open the database
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}

# Build the query. Users are allowed to search on title, author, or both

$query = " select * from book";
if ($searchtitle && !$searchauthor) { // Title search only
    $query = $query . " where title like '%" . $searchtitle . "%'";
}
if (!$searchtitle && $searchauthor) { // Author search only
    $query = $query . " where author like '%" . $searchauthor . "%'";
}
if ($searchtitle && $searchauthor) { // Title and Author search
    $query = $query . " where title like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'"; // unfinished
}

//echo "Running the query: $query <br/>"; # For debugging


  # Here's the query using an associative array for the results
//$result = $db->query($query);
//echo "<p> $result->num_rows matching books found </p>";
//echo "<table border=1>";
//while($row = $result->fetch_assoc()) {
//echo "<tr><td>" . $row['bookid'] . "</td> <td>" . $row['title'] . "</td><td>" . $row['author'] . "</td></tr>";
//}
//echo "</table>";
 

# Here's the query using bound result parameters
    // echo "we are now using bound result parameters <br/>";
    $stmt = $db->prepare($query);
    $stmt->bind_result($bookid, $title, $no_pages, $edition, $published, $company, $author, $onloan);
    $stmt->execute();

            #check if the GET/POST has been used, meaning if the Submit button has been pressed.
            // if (isset($_GET) && !empty($_GET)) {
            // # Get data from form
                
            //     $searchtitle = trim($_GET['searchtitle']);
                
            //     $searchtitle = addslashes($searchtitle);

            //     $searchauthor = trim($_GET['searchauthor']);
                
            //     $searchauthor = addslashes($searchauthor);

                #here we create a variable $id and basically say that we want the data from the array matching the search criteria

                // $id = array_search($searchtitle, array_column($books, 'title'));
                 
                // $id2 = array_search($searchauthor, array_column($books, 'author'));
                
                
                #echo $id;

                // echo '<table bgcolor="#bdc0ff" cellpadding="6">';
                // echo '<tr><b><td>Title</td> <td>Author</td> <td>Reserve</td> </b> </tr>';

                #now we check if we have the ID or not in our array. If the search was a hit, it will assign something to our DB, if not, then it will not work.

            //     if ($id !== FALSE || $id2 !== FALSE) {
            //     	$id += $id2;
            //         $book = $books[$id];
            //         $title = $book['title'];
            //         $author = $book['author'];
            //         echo "<tr>";
            //         echo "<td> $title </td><td> $author </td>";
            //         echo '<td><a href="reserve.php?reservation=' .  urlencode($title) . '"> Reserve </a></td>';
            //         echo "</tr>";
            //     }
            //     echo "</table>";
            // } 

            # in this else under, you basically show the book-list.
            # above you checked in the GET method has been set, if it has display the results of the "search"
            # if they have not been set, just display the list instead. In this case "book-list" is insufficient
            # all you have to do is merge book-list.php with book-search.php and create one master page
            # define the array at the start in PHP and manipulate it later on.
            
            // else 
                
            //     {                
            //     echo '<table bgcolor="#bdc0ff" cellpadding="6">';
            //     echo '<tr><b><td>Title</td> <td>Author</td> <td>Reserve</td> </b> </tr>';
            //     foreach ($books as $book) {
            //         $title = $book['title'];
            //         $author = $book['author'];
                //     echo "<tr>";
                //     echo "<td> $title </td><td> $author </td>";
                //     echo '<td><a href="reserve.php?reservation=' . urlencode($title) . '"> Reserve </a></td>';
                //     echo "</tr>";
                // }
                // echo "</table>";
            // }
            
    echo '<table bgcolor="#dddddd" cellpadding="6">';
    echo '<tr><b><td>Title</td> <td>Author</td> <td>Reserve</td> </b> </tr>';
    while ($stmt->fetch()) {
        echo "<tr>";
        echo "<td> $title </td><td> $author </td>";
        echo '<td><a href="reserveBook.php?bookid=' . urlencode($bookid) . '"> Reserve </a></td>';
        echo "</tr>";
    }
    echo "</table>";
            ?>

            </div>

</section>

 

<?php include('footer.php');?>
</section>

</body>
</html>