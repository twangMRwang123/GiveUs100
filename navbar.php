<div class="topbar-padding">
  <div class="topbar">
    <ul id="header">
      <li><a href="index.php"><img alt="Home" src="img/home.png" width="20" height="20">seniorcitizenconnect</a></li>

      <?php
      if ( isset( $_SESSION[ 'logged_user' ] ) ) {

        $username = $_SESSION[ 'logged_user' ];

        #connect to the database
        require_once 'config.php';
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        $result = $mysqli->query("SELECT * FROM users WHERE username='$username'");

        if ($result && $result->num_rows == 1) {
          $row = $result->fetch_assoc();
          $name = $row['name'];
          $userType = $row['userType'];
          $address = $row['address'];
          $language = $row['language'];
          $age = $row['age'];
          $username = $row['username'];
          $pictureURL = $row['pictureURL'];
          $email = $row['email'];
          $phone = $row['phone'];
          $preferredContact = $row['preferredContact'];
          echo "<li><a href=\"profile.php\"><img class=\"icon\" src=\"$pictureURL\"></a></li>"; ?>

          <form class="bookForm" action = "searchall.php" method="post" enctype="multipart/form-data">
            <li>
              <input type="text" name="search" placeholder="Search...">
              <input type="submit" value="Search">
            </li>
          </form>

          <?php
          echo '<li><a href="logout.php">log out</a></li>';
        }
      }
      else { ?>

        <form class="bookForm" action = "searchall.php" method="post" enctype="multipart/form-data">
          <li>
            <input type="text" name="search" placeholder="Search...">
            <input type="submit" value="Search">
          </li>
        </form>

        <?php echo '<li><a href="login.php">log in</a></li>';
              echo '<li><a href="register.php">register</a></li>';
      }
      ?>

    </ul>
  </div>
</div>

<div class="content">
  <table>
    <tr><td class="twincols-1">

      <?php
      if ( isset( $_SESSION[ 'logged_user' ] ) ) {
        print( "<a href='profile.php'><img class=\"sidebarImg\" alt=\"$username\" src=\"$pictureURL\"></a><br>" );
        print( "<h3>Welcome, $name</h3><br>" );
      }
      ?>

      <ul class="menu">
        <li><a <?php echo ($page == 'home') ? 'id="active"' : '';?> href="index.php">Home</a></li>
        <?php

        echo '<li><a '.(($page == 'profile') ? 'id="active"' : '');
        if ( isset( $_SESSION[ 'logged_user' ] ) ) {
          echo ' href="profile.php"';
        }
        else {
          echo ' href="login.php"';
        }
        echo '>Profile</a></li>';
        ?>

        <li><a class="requestSub" <?php echo ($page == 'volunteer requests') ? 'id="active"' : '';?> href="displayVolunteerRequests.php">Volunteer Requests</a></li>

        <li><a class="requestSub" <?php echo ($page == 'donation requests') ? 'id="active"' : '';?> href="displayDonationRequests.php">Donation Requests</a></li>

        <li><a class="offerSub" <?php echo ($page == 'volunteer offers') ? 'id="active"' : '';?> href="displayVolunteerOffers.php">Volunteer Offers</a></li>

        <li><a class="offerSub" <?php echo ($page == 'donation offers') ? 'id="active"' : '';?> href="displayDonationOffers.php">Donation Offers</a></li>

        <li><a <?php echo ($page == 'help') ? 'id="active"' : '';?> href="help.php">Help</a></li>

        <?php
        if ( isset( $_SESSION[ 'logged_user' ] ) ) {
          if ($userType == 'senior') {
            echo "<li><a ";
            echo ($page == 'requests') ? 'class="active"' : '';
            echo "href=\"makeRequest.php\">Make a Request</a></li>";
          }

          if ($userType == 'volunteer' or $userType == 'career'){
            echo "<li><a ";
            echo ($page == 'offers') ? 'class="active"' : '';
            echo "href=\"makeOffer.php\">Make an Offer</a></li>";
          }
        }
        ?>

      </ul>
    </td>
    <td class="twincols-2">
