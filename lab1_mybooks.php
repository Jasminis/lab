<!DOCTYPE html>
<?php include('header.php');?>
<?php include('config.php');?>


<header>
<a href="#"> <img class="smallheader" src="bilder/books5.jpg" /></a>
</header>



<section class="maincontent2">

<?php 

# Open the database
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}

# Build the query. Users are allowed to search on title, author, or both

$query = " select * from book where onloan=1";



 

# Here's the query using bound result parameters
    // echo "we are now using bound result parameters <br/>";
    $stmt = $db->prepare($query);
    $stmt->bind_result($bookid, $title, $no_pages, $edition, $published, $company, $author, $onloan);
    $stmt->execute();

            
    echo '<table bgcolor="#dddddd" cellpadding="6">';
    echo '<tr><b><td>Title</td> <td>Author</td> <td>Return</td> </b> </tr>';
    while ($stmt->fetch()) {
        echo "<tr>";
        echo "<td> $title </td><td> $author </td>";
        echo '<td><a href="returnBook.php?bookid=' . urlencode($bookid) . '"> Return </a></td>';
        echo "</tr>";
    }
    echo "</table>";
            ?>

</section>




<?php include('footer.php');?>
</section>

</body>
</html>