<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
    crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
    crossorigin="anonymous"></script>
  <script src="script.js"></script>
  <title>Doctor Search</title>
</head>

<body>
  <nav>
    <ul class="sidebar" id="sidebar1">
      <li onclick="hideSideBar()">
        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26">
            <path
              d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
          </svg></a>
      </li>
      <li><a href="#" style="font-size:20px">Dr connect</a></li>
      <li><a href="#">Home</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#">Services</a></li>
      <li><a href="#contactus">Contact</a></li>
      <li><a href="#">Login</a></li>
    </ul>
    <ul>

      <li><a href="#" style="font-size:30px">Dr connect</a></li>
      <li class="hideOnMobile"><a href="#">Home</a></li>
      <li class="hideOnMobile"><a href="#">About</a></li>
      <li class="hideOnMobile"><a href="#">Services</a></li>
      <li class="hideOnMobile"><a href="#">Contact</a></li>
      <li class="hideOnMobile"><a href="#">Login</a></li>
      <l1 onclick=showSideBar() class="menu-button"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26"
            viewBox="0 -960 960 960" width="26">
            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
          </svg></a></l1>
    </ul>
  </nav>
  <main>
    <section id="home">
      <div class="container" style="display:flex; padding-bottom:100px;">
        <img src="assets/images/hero.jpg" style="margin-top: 30px;padding-left:200px; " alt="hero image" />
        <div class="text"
          style="padding-left:20px; margin-top:10%; text-aligin:center; justfy-content:center; padding-right:40px;">
          <h2>Welcome To Dr Connect</h2>
          <p style="margin:10px; font-weight: semi-bold; font-size:18px;">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sunt magni nostrum corrupti adipisci ratione
            dignissimos fugit doloremque voluptatum! Repudiandae, illo libero. Quos optio, corrupti facilis nihil
            doloremque corporis veniam quam deserunt atque sint quidem, eaque ex odit dolorum animi consequatur nesciunt
            minima repellat consequuntur beatae tempore neque odio? Incidunt, maiores.
          </p>
          <button style="margin-top:20px;" href="#search">Get Started</button>
        </div>
      </div>
    </section>
    <section id="search">
      <h2>Search for a Doctor</h2>
      <div class="search">
        <form class="d-flex" method="post">
          <input class="form-control me-2" type="text" placeholder="Search by Name or Speciality or City"
            aria-label="Search" name="search" />
          <button class="btn btn-success" name='searchBtn'>Search</button>
        </form>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h4>Search Result</h4>
            <div class="table-responsive" id="dynamic_content">
              <?php
              if (isset($_POST['search'])) {
                $search = $_POST['search'];
                $query = "SELECT * FROM `doctors1` WHERE location = '$search' OR specialization LIKE '%$search%' OR name LIKE '%$search%'";
                $search_result = mysqli_query($con, $query);

                if ($search_result !== false) { // Check for explicit false
                  $availability = mysqli_num_rows($search_result);

                  echo "<h2 class='text-" . ($availability > 0 ? 'success' : 'danger') . "'>Available Doctors: $availability</h2>";

                  if ($availability > 0) {
                    echo "<table class='table'>
                    <thead>
                        <tr>
                            <th>Doctor Name</th>
                            <th>Location</th>
                            <th>Specialization</th>
                            <th>Book Appointment</th>
                        </tr>
                    </thead>
                    <tbody>";

                    while ($row = mysqli_fetch_assoc($search_result)) {
                      echo "<tr>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['location'] . "</td>
                        <td>" . $row['specialization'] . "</td>
                        <td><a href='#" . $row['id'] . "' class='btn btn-success'>Book Appointment</a></td>
                    </tr>";
                    }

                    echo "</tbody></table>";
                  } else {
                    echo '<h2 class="text-danger">No result found</h2>';
                  }
                } else {
                  echo '<h2 class="text-danger">Error in the query</h2>';
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="about" style="border:1px solid black; margin-left:300px; margin-right:300px; ">
      <h1 style="text-align:center;padding-top:10px ">About Us</h1>
      <h2 style="text-align:center; padding-top:25px">Learn more about our company and our mission.</h2>
      <h2 style="padding-left:15%; padding-top:10px; padding-right:20%">Our Story: </h2>
      <p style="padding-left:20%; padding-right:20%">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
        ullamcorper, erat eu tincidunt luctus, turpis
        sem aliquet nisi, id blandit mi tortor vel justo. Fusce at dolor sit amet leo volutpat suscipit vel eget elit.
        Vestibulum vel consectetur libero. Proin et metus vitae urna tristique feugiat. Sed nec dolor ut quam varius
        hendrerit. Integer et odio nec libero aliquet mattis non eget quam. Duis posuere hendrerit laoreet.</p>
      <h2 style="padding-left:15%; padding-top:10px; padding-right:20%">Our Mission:</h2>
      <p style="padding-left:20%; padding-right:20%; padding-bottom:30px">Our mission is to provide high-quality
        products/services to our customers. We are committed to innovation,
        sustainability, and customer satisfaction. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
        ullamcorper, erat eu tincidunt luctus, turpis sem aliquet nisi, id blandit mi tortor vel justo.</p>
    </section>

    <section id="contactus">
      <div class="container" id="c1">
        <h1 style="text-align:center;">Contact Us</h1>
        <form action="" method="post" class="form">
          <label for="fname">First Name</label>
          <input type="text" id="fname" name="firstname" placeholder="Your name..">
          <label for="lname">Last Name</label>
          <input type="text" id="lname" name="lastname" placeholder="Your last name..">
          <label for="country">Issue</label>
          <select id="country" name="country">
            <option value=" ">Select option</option>
            <option value="australia">Goa</option>
            <option value="canada">Maharashtra</option>
            <option value="Andhra Pradesh">Andhra Pradesh</option>
            <option value="Assam">Assam</option>
            <option value="Gujarat">Gujarat</option>
            <option value="other">other</option>
          </select>
          <label for="subject">Subject</label>
          <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
          <button>Submit</button>
        </form>
      </div>
    </section>

  </main>
  <footer style="display: relative; bottom:0;">
    <p>&copy; 2024 Doctor Coonect. All rights reserved.</p>
  </footer>

</body>

</html>

