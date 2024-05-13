<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Mart</title>
  <link rel="stylesheet" href="style.css">
  <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
  integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
  />
</head>

<body>

  <header>
    <div class="head"><a href="index.php?page=login">Login</a></div>
    <nav>
      <ul>
        <li><a href="">Home</a></li>
        <li id="dropdown">
          <a href="#">Menu</a>
          <ul id="menu">
            <li><a href="index.php?page=product"><i class="fas fa-th-list"></i>&nbsp;Product</a></li>
            <li><a href="index.php?page=purcase"><i class="fas fa-th-list"></i>&nbsp;Purcase</a></li>
            <li><a href="index.php?page=history"><i class="fas fa-th-list"></i>&nbsp;History</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>

  <main>
    <div class="left">
      <div class="card">
        <i class="fas fa-th-list"></i>&nbsp;Profile<hr>
        <table>
          <tr>
            <th><img src="image/profile.png" class="profile-img"></th>
            <td>
              <?php session_start(); 
              if(isset($_SESSION['username'])) {
                ?>
                <p><?php echo $_SESSION['username']; ?></p>
                <p><?php echo $_SESSION['userid']; ?></p>
                <p><a href="index.php?page=logout">Logout</a></p>
              <?php } ?>
            </td>
          </tr>
        </table>
      </div>
      <div class="card"><i class="fas fa-th-list"></i>&nbsp;Cart<hr>
        <div id="cartline"><?php include "cart.php"; ?></div>
        <hr>
        <a href="index.php?page=purcase">
          <button type="button">Purcase</button>
        </a>
      </div>
      <div class="card"><i class="fas fa-th-list"></i>&nbsp;Etalase<hr>
        <ul onclick="toggleDropdown1()"><i class="fas fa-list"></i>&nbsp;Electonics</ul>
        <div id="myDropdown1" class="dropdown-content">
          <li><a href="google.com">Laptop</a></li>
          <li>Mouse</li>
          <li>Printer</li>
          <li>Camera</li>
          <li>Speaker</li>
          <li>Smartphone</li>
        </div>
        <ul onclick="toggleDropdown2()"><i class="fas fa-list"></i>&nbsp;Stationery</ul>
        <div id="myDropdown2" class="dropdown-content">
          <li>Pencil</li>
          <li>Book</li>
          <li>Pen</li>
          <li>Notebook</li>
        </div>
        <ul onclick="toggleDropdown3()"><i class="fas fa-list"></i>&nbsp;Beverage</ul>
        <div id="myDropdown3" class="dropdown-content">
          <li>Soda Drink</li>
          <li>Mineral Water</li>
        </div>
      </div>
    </div>

    <div class="center" id="product-container"> 
      <?php
      include "sql_connection.php"; 
      $page = isset($_GET['page']) ? $_GET['page'] : 'product';

      switch ($page) {
        case 'cart':
        include('cart.php'); 
        break;
        case 'cart-add':
        include('cart-add.php'); 
        break;
        case 'history':
        include('history.php'); 
        break;
        case 'purcase':
        include('purcase.php'); 
        break;
        case 'purchase-up':
        include('purchase-up.php'); 
        break;
        case 'register':
        include('register.php'); 
        break;
        case 'login':
        include('login.php'); 
        break;
        case 'logout':
        include('logout.php'); 
        break;
        default:
        include('product.php'); 
        break;
      }
      ?> 
    </div>

    <div class="right">
      <div class="card">
        <?php include "product-best.php"; ?>
      </div>
      <div class="card">
        <i class="fas fa-th-list"></i>&nbsp;Sales<hr>
        <?php include "product-sales.php"; ?>
      </div>

    </main>

    <footer>
      <p>&#169; 2024</p>
    </footer>

    <script src="script.js"></script>

  </body>
  </html>