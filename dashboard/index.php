<?php
session_start();
require_once( '../connect.php' );
if ( isset( $_SESSION[ 'user_id' ] ) == '' ) {
    echo 'encoutered log in error TRY_AGAIN';
    header( 'Location: ../login.php' );
}
// get my image
$image = mysqli_query( $conn, "SELECT * FROM images WHERE Username = '".$_SESSION[ 'First_name' ]."' and ID_NUMBER = '".$_SESSION[ 'ID_Number' ]."'" );
if ( $image->num_rows > 0 ) {
    if ( $row = mysqli_fetch_array( $image ) ) {
        $_SESSION[ 'realimage' ] = $row[ 'name' ];
        $_SESSION[ 'uploadok' ] = 0;
    }
} else {
    $_SESSION[ 'uploadok' ] = 1;
    $_SESSION[ 'realimage' ] = 'index.jpeg';
    $_SESSION[ 'image_error' ] = 'No Image Found In Our Database';
}
?>
<!DOCTYPE html>
<!-- Content from CodingNepal - www.codingnepalweb.com -->
<html lang = 'en' dir = 'ltr'>

<head>
<meta charset = 'UTF-8'>
<!-- <title> Responsive Drop Down Navigation Menu | CodingLab </title>-->
<link rel = 'stylesheet' href = '../style.css'>
<!-- Boxicons CDN Link -->
<link href = 'https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel = 'stylesheet'>
<link rel = 'stylesheet' type = 'text/css' href = '../index.css' media = 'screen' />
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
<title>USER DASHBOARD | LIBRARY MANAGEMENT SYSTEM</title>
</head>

<body>
<nav>
<div class = 'navbar'>
<i class = 'bx bx-menu'></i>
<div>
<img src = "<?php echo './upload/'.$_SESSION['realimage']  ?>" alt = 'Avatar' class = 'avatar'>
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
<a href = '#'>LIBRARY PANEL</a>
<i class = 'bx bxs-chevron-down htmlcss-arrow arrow  '></i>
<ul class = 'htmlCss-sub-menu sub-menu'>
<?php if ( isset( $_SESSION[ 'adminID' ] ) ) echo "<li><a href = '../books/index.php'>Add Book Stock</a></li>";
?>
<li><a href = '../books/exist_books.php'>View Existing Books</a></li>
<li><a href = './issue.php'>Borrow Book</a></li>
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
<li><a href = 'reg_details.php'>Registration Details</a></li>
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
<form action = '../admin/search.php'method = 'post'>
<input type = 'text' name = 'text'placeholder = 'Search...<?php if ( isset( $_SESSION[ 'search' ] ) ) echo $_SESSION[ 'search' ]?>'>
</form>
</div>
</div>

</div>
<div class = 'venom'>
<div class = 'geeks'>
<h1> LIBRARY MANAGEMENT SYSTEM</h1>
</div>

<div class = 'container' style = 'margin-top: 70px; width: 100%; height: 40%;'>

<div class = 'text-typing'>

<p>GET ALL YOUR LEARNING MATERIALS HERE. </p>

</div>
</div>
</div>
</nav>

<script src = '../index.js'></script>
</body>

</html>