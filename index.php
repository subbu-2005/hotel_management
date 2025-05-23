<?php
include 'config.php';
session_start();
$usermail = $_SESSION['usermail'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/home.css" />
  <title>Hotel Blue Bird</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

  <!-- Sweet Alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <link rel="stylesheet" href="./admin/css/roombook.css" />
  <style>
    #guestdetailpanel {
      display: none;
    }
    #guestdetailpanel .middle {
      height: 450px;
    }
  </style>
</head>

<body>
  <nav>
    <div class="logo">
      <img class="bluebirdlogo" src="./image/bluebirdlogo.png" alt="logo" />
      <p>BLUEBIRD</p>
    </div>
    <ul>
      <li><a href="#firstsection">Home</a></li>
      <li><a href="#secondsection">Rooms</a></li>
      <li><a href="#thirdsection">Facilities</a></li>
      <li><a href="#contactus">Contact Us</a></li>
      <?php if ($usermail): ?>
        <a href="./logout.php"><button class="btn btn-danger">Logout</button></a>
      <?php else: ?>
        <a href="./home.php"><button class="btn btn-success">Login</button></a>
      <?php endif; ?>
    </ul>
  </nav>

  <!-- Carousel Section -->
  <section id="firstsection" class="carousel slide carousel_section" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active"><img class="carousel-image" src="./image/hotel1.jpg" /></div>
      <div class="carousel-item"><img class="carousel-image" src="./image/hotel2.jpg" /></div>
      <div class="carousel-item"><img class="carousel-image" src="./image/hotel3.jpg" /></div>
      <div class="carousel-item"><img class="carousel-image" src="./image/hotel4.jpg" /></div>

      <div class="welcomeline">
        <h1 class="welcometag">Welcome to heaven on earth</h1>
      </div>

      <!-- Book Box -->
      <div id="guestdetailpanel">
        <form action="" method="POST" class="guestdetailpanelform">
          <div class="head">
            <h3>RESERVATION</h3>
            <i class="fa-solid fa-circle-xmark" onclick="closebox()"></i>
          </div>
          <div class="middle">
            <div class="guestinfo">
              <h4>Guest information</h4>
              <input type="text" name="Name" placeholder="Enter Full name" />
              <input type="email" name="Email" placeholder="Enter Email" />

              <select name="Country" class="selectinput">
                <option value selected>Select your country</option>
                <?php
                  $countries = [
                    "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla",
                    "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria",
                    "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize",
                    "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island",
                    "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso",
                    "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands",
                    "Central African Republic", "Chad", "Chile", "China", "Christmas Island",
                    "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo",
                    "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire",
                    "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica",
                    "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea",
                    "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji",
                    "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia",
                    "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar",
                    "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau",
                    "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras",
                    "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq",
                    "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati",
                    "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan",
                    "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia",
                    "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau",
                    "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives",
                    "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte",
                    "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia",
                    "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands",
                    "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue",
                    "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama",
                    "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal",
                    "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda",
                    "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa",
                    "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone",
                    "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia",
                    "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka",
                    "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands",
                    "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China",
                    "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga",
                    "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu",
                    "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States",
                    "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela",
                    "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands",
                    "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"
                  ];                  
                  foreach($countries as $value):
                    echo '<option value="'.$value.'">'.$value.'</option>';
                  endforeach;
                ?>
              </select>
              <input type="text" name="Phone" placeholder="Enter Phone No" />
            </div>

            <div class="line"></div>

            <div class="reservationinfo">
              <h4>Reservation information</h4>
              <select name="RoomType" class="selectinput">
                <option value selected>Type Of Room</option>
                <option value="Superior Room">SUPERIOR ROOM</option>
                <option value="Deluxe Room">DELUXE ROOM</option>
                <option value="Guest House">GUEST HOUSE</option>
                <option value="Single Room">SINGLE ROOM</option>
              </select>
              <select name="Bed" class="selectinput">
                <option value selected>Bedding Type</option>
                <option value="Single">Single</option>
                <option value="Double">Double</option>
                <option value="Triple">Triple</option>
                <option value="Quad">Quad</option>
                <option value="None">None</option>
              </select>
              <select name="NoofRoom" class="selectinput">
                <option value selected>No of Room</option>
                <option value="1">1</option>
              </select>
              <select name="Meal" class="selectinput">
                <option value selected>Meal</option>
                <option value="Room only">Room only</option>
                <option value="Breakfast">Breakfast</option>
                <option value="Half Board">Half Board</option>
                <option value="Full Board">Full Board</option>
              </select>
              <div class="datesection">
                <span><label for="cin">Check-In</label><input name="cin" type="date" /></span>
                <span><label for="cout">Check-Out</label><input name="cout" type="date" /></span>
              </div>
            </div>
          </div>
          <div class="footer">
            <button class="btn btn-success" name="guestdetailsubmit">Submit</button>
          </div>
        </form>

        <!-- PHP: Save Booking -->
        <?php
        if (isset($_POST['guestdetailsubmit'])) {
          if (!$usermail) {
            echo "<script>swal({ title: 'Please login to make a reservation', icon: 'warning' });</script>";
          } else {
            $Name = $_POST['Name'];
            $Email = $_POST['Email'];
            $Country = $_POST['Country'];
            $Phone = $_POST['Phone'];
            $RoomType = $_POST['RoomType'];
            $Bed = $_POST['Bed'];
            $NoofRoom = $_POST['NoofRoom'];
            $Meal = $_POST['Meal'];
            $cin = $_POST['cin'];
            $cout = $_POST['cout'];

            if ($Name == "" || $Email == "" || $Country == "") {
              echo "<script>swal({ title: 'Fill all required details', icon: 'error' });</script>";
            } else {
              $sta = "NotConfirm";
              $sql = "INSERT INTO roombook (Name, Email, Country, Phone, RoomType, Bed, NoofRoom, Meal, cin, cout, stat, nodays)
                      VALUES ('$Name','$Email','$Country','$Phone','$RoomType','$Bed','$NoofRoom','$Meal','$cin','$cout','$sta', DATEDIFF('$cout','$cin'))";
              $result = mysqli_query($conn, $sql);

              if ($result) {
                echo "<script>swal({ title: 'Reservation successful', icon: 'success' });</script>";
              } else {
                echo "<script>swal({ title: 'Something went wrong', icon: 'error' });</script>";
              }
            }
          }
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Room Section -->
  <section id="secondsection">
    <img src="./image/homeanimatebg.svg" />
    <div class="ourroom">
      <h1 class="head">≼ Our room ≽</h1>
      <div class="roomselect">
        <?php
          $rooms = [
            ["Superior Room", "h1", ["wifi", "burger", "spa", "dumbbell", "person-swimming"]],
            ["Deluxe Room", "h2", ["wifi", "burger", "spa", "dumbbell"]],
            ["Guest Room", "h3", ["wifi", "burger", "spa"]],
            ["Single Room", "h4", ["wifi", "burger"]]
          ];
          foreach ($rooms as [$name, $class, $icons]) {
            echo '<div class="roombox">';
            echo '<div class="hotelphoto '.$class.'"></div>';
            echo '<div class="roomdata"><h2>'.$name.'</h2><div class="services">';
            foreach ($icons as $icon) echo "<i class='fa-solid fa-$icon'></i>";
            echo '</div><button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button></div></div>';
          }
        ?>
      </div>
    </div>
  </section>

  <!-- Facilities Section -->
  <section id="thirdsection">
    <h1 class="head">≼ Facilities ≽</h1>
    <div class="facility">
      <div class="box"><h2>Swimming Pool</h2></div>
      <div class="box"><h2>Spa</h2></div>
      <div class="box"><h2>24*7 Restaurants</h2></div>
      <div class="box"><h2>24*7 Gym</h2></div>
      <div class="box"><h2>Heli Service</h2></div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contactus">
    <div class="social">
      <i class="fa-brands fa-instagram"></i>
      <i class="fa-brands fa-facebook"></i>
      <i class="fa-solid fa-envelope"></i>
    </div>
    <div class="createdby">
      <h5>Created by @tushar</h5>
    </div>
  </section>

  <!-- Scripts -->
  <script>
    const bookbox = document.getElementById("guestdetailpanel");
    function openbookbox() { bookbox.style.display = "flex"; }
    function closebox() { bookbox.style.display = "none"; }
  </script>
</body>
</html>