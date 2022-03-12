<?php
session_start();
require_once( '../connect.php' );
if ( isset( $_SESSION[ 'adminID' ] ) == '' ) {
    echo 'encoutered log in error TRY_AGAIN';
    header( 'Location: ../login.php' );
}

?>
<!DOCTYPE html>
<html lang = 'en' dir = 'ltr'>

<head>
<title>ALL MEMBERS DETAILS | LIBRARY MANAGEMENT SYSTEM</title>
<meta charset = 'UTF-8'>
<!-- <title> Responsive Drop Down Navigation Menu | CodingLab </title>-->
<link rel = 'stylesheet' href = '../style.css'>
<!-- Boxicons CDN Link -->
<link href = 'https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel = 'stylesheet'>
<link rel = 'stylesheet' type = 'text/css' href = '../index.css' media = 'screen' />
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
</head>

<body>
<nav>
<div class = 'navbar'>
<i class = 'bx bx-menu'></i>
<div>
<img src = "<?php echo '../dashboard/upload/'.$_SESSION['realimage']  ?>" alt = 'Avatar' class = 'avatar'>
</div>
<div class = 'logo'><a href = '#'><?php echo $_SESSION[ 'First_name' ]  ?> <?php echo $_SESSION[ 'Sir_name' ]  ?></a></div>
<div class = 'nav-links'>
<div class = 'sidebar-logo'>
<span class = 'logo-name'>Menu</span>
<i class = 'bx bx-x'></i>
</div>
<ul class = 'links'>
<li><a href = './'>HOME</a></li>
<li>
<a href = '#'>USERS PANEL</a>
<i class = 'bx bxs-chevron-down htmlcss-arrow arrow  '></i>
<ul class = 'htmlCss-sub-menu sub-menu'>
<li><a href = './mem_details.php'>All Member Details</a></li>
<li><a href = './_adminreg.php'>Promote Member</a></li>
<li><a href = '#'>Card Design</a></li>
<li class = 'more'>
<span><a href = '#'>More</a>
<i class = 'bx bxs-chevron-right arrow more-arrow'></i>
</span>
<ul class = 'more-sub-menu sub-menu'>
<li><a href = '#'>Neumorphism</a></li>
<li><a href = '#'>Pre-loader</a></li>
<li><a href = '#'>Glassmorphism</a></li>
</ul>
</li>
</ul>
</li>
<li>
<a href = '#'>LIBRARY PANEL</a>
<i class = 'bx bxs-chevron-down htmlcss-arrow arrow  '></i>
<ul class = 'htmlCss-sub-menu sub-menu'>
<li><a href = '../books/'>Add Book Stock</a></li>
<li><a href = '../books/exist_books.php'>View Existing Books</a></li>
<li><a href = '../dashboard/issue.php'>Borrow Book</a></li>
<li><a href = '../books/my_borrowed_books.php'>My Borrowed Books</a></li>
<li class = 'more'>
<span><a href = '#'>More</a>
<i class = 'bx bxs-chevron-right arrow more-arrow'></i>
</span>
<ul class = 'more-sub-menu sub-menu'>
<li><a href = '#'>Neumorphism</a></li>
<li><a href = '#'>Pre-loader</a></li>
<li><a href = '#'>Glassmorphism</a></li>
</ul>
</li>
</ul>
</li>
<li>
<a href = '#'>USER DETAILS</a>
<i class = 'bx bxs-chevron-down js-arrow arrow '></i>
<ul class = 'js-sub-menu sub-menu'>
<li><a href = './_admin_details.php'>Registration Details</a></li>
<li><a href = '#'>Form Validation</a></li>
<li><a href = '#'>Card Slider</a></li>
<li><a href = '#'>Complete Website</a></li>
</ul>
</li>
<li><a href = '#'>ABOUT US</a></li>
<li><a href = '#'>CONTACT US</a></li>
<li>
<a href = '#'>ACCOUNT</a>
<i class = 'bx bxs-chevron-down Zs-arrow arrow '></i>
<ul class = 'zs-sub-menu sub-menu'>
<li><a href = '../logout.php'>Log Out</a></li>
</ul>
</li>
</ul>
</div>
<div class = 'search-box'>
<i class = 'bx bx-search'></i>
<div class = 'input-box'>
<form action = 'search.php'method = 'post'>
<input type = 'text' name = 'text'placeholder = 'Search...<?php if ( isset( $_SESSION[ 'search' ] ) ) echo $_SESSION[ 'search' ]?>'>
</form>
</div>
</div>

</div>
<div class = 'venom'>
<?php
$query = 'SELECT * FROM users1';

if ( $result = $conn->query( $query ) ) {
    echo "
                <div class ='tab' style='overflow: auto; width: 90%; height:90%;'>
                <table border='1'>
                
                <tr>
                
                <th>Id</th>
                <th>First Name</th>
                <th>Sir Name</th>
                <th>Last Name</th>
                <th>Reg. Number</th>
                <th>ID Number</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Faculty</th>
                
                </tr>";
    $num = 1;
    while ( $row = $result->fetch_assoc() ) {
        echo '<tr>';
        echo'<td>'.$num.'</td>';
        echo '<td>'.$row[ 'Firstname' ].'</td>';
        echo'<td>'.$row[ 'Sirname' ].'</td>';
        echo'<td>'.$row[ 'Lastname' ].'</td>';
        echo '<td>'.$row[ 'RegNumber' ].'</td>';
        echo '<td>'.$row[ 'IDNumber' ].'</td>';
        echo'<td>'.$row[ 'PhoneNumber' ].'</td>';
        echo '<td>'.$row[ 'email' ].'</td>';
        echo '<td>'.$row[ 'Gender' ].'</td>';
        echo'<td>'.$row[ 'Faculty' ].'</td>';
        $num++;
        echo '</tr>';

    }
    echo '</table> </div>';
}

?>
</div>
</div>
</div>
</nav>
</nav>

<script src = '../index.js'></script>
</body>

</html>