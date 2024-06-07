<?php

session_start();
include 'db.php'; // Include your database configuration file

// Handle image upload
if (isset($_POST['upload'])) {
  $target_dir = "assets/img/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  
  // Check if file upload is successful
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      // Save the file path to the database
      $stmt = $conn->prepare("INSERT INTO gallery (image_path) VALUES (?)");
      $stmt->bind_param("s", $target_file);
      
      // Execute the prepared statement
      if ($stmt->execute()) {
          // File inserted successfully
          echo "File uploaded and inserted into database successfully.";
      } else {
          // Error inserting file into the database
          echo "Error: " . $stmt->error;
      }
    }
  }
// Handle image deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Get the file path from the database
    $stmt = $conn->prepare("SELECT image_path FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($image_path);
    $stmt->fetch();
    $stmt->close();
    
    // Delete the file from the server
    

    // Delete the record from the database
    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Handle review addition
if (isset($_POST['add_review'])) {
  $review_content = $_POST['review_content'];
  $stmt = $conn->prepare("INSERT INTO reviews (content) VALUES (?)");
  $stmt->bind_param("s", $review_content);
  if ($stmt->execute()) {
      echo "Review added successfully.";
  } else {
      echo "Error: " . $stmt->error;
  }
}

// Handle review editing
if (isset($_POST['edit_review'])) {
  $review_id = $_POST['review_id'];
  $review_content = $_POST['review_content'];
  $stmt = $conn->prepare("UPDATE reviews SET content = ? WHERE id = ?");
  $stmt->bind_param("si", $review_content, $review_id);
  if ($stmt->execute()) {
      echo "Review updated successfully.";
  } else {
      echo "Error: " . $stmt->error;
  }
}

// Handle review deletion
if (isset($_GET['delete_review'])) {
  $review_id = $_GET['delete_review'];
  $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
  $stmt->bind_param("i", $review_id);
  $stmt->execute();
}

// Fetch gallery images
$gallery_result = $conn->query("SELECT * FROM gallery");

// Fetch reviews
$review_result = $conn->query("SELECT * FROM reviews");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Probe</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon" />

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="assets/vendor/aos.css/aos.css" />
  <link rel="stylesheet" href="assets/vendor/flickity.css/flickity.css" />

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="assets/css/style.css" />



</head>

<body>
  <!-- ======= Header ======= -->
  <div class="nav">
    <a data-scroll data-easing="easeInQuint" href="#beranda" data-aos="fade-down" data-aos-duration="400"
      data-aos-delay="50">Home</a>
    <a data-scroll data-easing="easeInQuint" href="#tentang" data-aos="fade-down" data-aos-duration="400"
      data-aos-delay="100">About Us</a>
    <a data-scroll data-easing="easeInQuint" href="#menu" data-aos="fade-down" data-aos-duration="400"
      data-aos-delay="150">Cases</a>
    <img src="assets/img/logo.png" alt="" data-aos="fade-down" data-aos-duration="1500">
    <a data-scroll data-easing="easeInQuint" href="#review" data-aos="fade-down" data-aos-duration="400"
      data-aos-delay="150">Review</a>
    <a data-scroll data-easing="easeInQuint" href="#lokasi" data-aos="fade-down" data-aos-duration="400"
      data-aos-delay="100">HQ</a>
    <a data-scroll data-easing="easeInQuint" href="#lokasi" data-aos="fade-down" data-aos-duration="400"
      data-aos-delay="50">Gallery</a>
    <img src="assets/img/menu.png" alt="" id="btn-nav" data-aos="fade-down" data-aos-duration="700" data-aos-delay="50">
    
  </div>


  <!-- ======= Navbar ======= -->
  <div class="nav-menu">
    <div class="btn-menu">
      <img src="assets/img/close.png" alt="" id="btn-menu">
    </div>
    <a id="nav-link" data-scroll data-easing="easeInQuint" href="#beranda">Home</a>
    <a id="nav-link1" data-scroll data-easing="easeInQuint" href="#tentang">About Us</a>
    <a id="nav-link2" data-scroll data-easing="easeInQuint" href="#menu">Cases</a>
    <a id="nav-link3" data-scroll data-easing="easeInQuint" href="#review">Review</a>
    <a id="nav-link4" data-scroll data-easing="easeInQuint" href="#partnership">HQ</a>
    <a id="nav-link5" data-scroll data-easing="easeInQuint" href="#lokasi">Gallery</a>
  </div> <!-- End Header -->

  <!-- ======= Home Start ======= -->
  <div class="beranda" id="beranda">
    <span id="typed" data-aos="fade-up" data-aos-duration="500"></span>
  </div>
  <!-- ======= Home End ======= -->

  <!-- ======= About Start ======= -->
  <div class="tentang container" id="tentang">
    <img src="assets/img/prb.png" alt="" data-aos="fade-down" data-aos-duration="1500" data-aos-delay="200">
    <div class="area-tentang" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="200">
      <h1 class="judul">About Us</h1>
      <p>
         Probe was Founded in 1920 in Indonesia , we are dedicated to uncovering the truth and delivering comprehensive investigative solutions to our clients. With a team of experienced professionals, cutting-edge technology, and a commitment to integrity, we strive to provide unmatched investigative services tailored to meet your specific needs.
      </p>
      <p>. . .</p>
    </div>
  </div>
  <!-- ======= About End ======= -->

  <!-- ======= visi Start ======= -->
  <div class="visi container">
    <h1 class="judul">Vision & Mission</h1>
    <div class="area-visi">
      <div class="visi-kiri">
        <div class="box-visi" data-aos="fade-up" data-aos-duration="500">
          <img src="assets/img/pelayan.jpeg" alt="">
          <h1>Integritas Utama </h1>
          <p>Melakukan penyelidikan yang teliti dengan integritas tinggi untuk memberikan informasi yang akurat kepada klien.
          </p>
        </div>
        <div class="box-visi" data-aos="fade-up" data-aos-duration="500">
          <img src="assets/img/bahan.jpeg" alt="">
          <h1>Pendekatan Klien</h1>
          <p> Memahami dan memenuhi kebutuhan unik setiap klien untuk membangun hubungan yang berdasarkan kepercayaan dan kerahasiaan.</p>
        </div>
        <div class="box-visi" data-aos="fade-up" data-aos-duration="500">
          <img src="assets/img/suasana.jpeg" alt="">
          <h1>Keunggulan Hasil</h1>
          <p>Menggunakan teknologi dan keahlian terkini untuk memberikan hasil penyelidikan yang efektif dan tepat waktu..</p>
        </div>
      </div>
      <div class="main-carousel">
        <div class="carousel-cell">
          <img src="assets/img/toko.jpg" alt="">
        </div>
        <div class="carousel-cell">
          <img src="assets/img/toko1.jpg" alt="">
        </div>
        <div class="carousel-cell">
          <img src="assets/img/toko2.jpg" alt="">
        </div>
        <div class="carousel-cell">
          <img src="assets/img/toko3.jpg" alt="">
        </div>
      </div>
    </div>
  </div>
  <!-- ======= visi End ======= -->

  <!-- ======= Menu Start ======= -->
  <div class="menu container" id="menu">
    <h1 class="judul" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="200">Cases</h1>
    <div class="carousel">
      <div class="box-menu carousel-cell">
        <img src="assets/img/coockies.png" alt="">
        <div class="area-menu">
          <h1 class="judul">Cybersecurity Incidents</h1>
          <p>Investigating cybersecurity incidents such as data breaches, hacking, malware attacks, phishing scams, or insider threats to protect sensitive data and systems.</p>
          <h1 class="harga"></h1>
        </div>
      </div>
      <div class="box-menu carousel-cell">
        <img src="assets/img/croissant.png" alt="">
        <div class="area-menu">
          <h1 class="judul">Health and Safety Issues</h1>
          <p>Investigating workplace accidents, injuries, or health and safety violations to ensure compliance with occupational health and safety regulations.
          </p>
          <h1 class="harga"></h1>
        </div>
      </div>
      <div class="box-menu carousel-cell">
        <img src="assets/img/baguette.jpg" alt="">
        <div class="area-menu">
          <h1 class="judul">Confidential Breaches</h1>
          <p>Investigating breaches of confidentiality, data leaks, unauthorized disclosures of sensitive information, or mishandling of confidential data.</p>
          <h1 class="harga"></h1>
        </div>
      </div>
      <div class="box-menu carousel-cell">
        <img src="assets/img/pretzels.png" alt="">
        <div class="area-menu">
          <h1 class="judul">Corporate Investigations </h1>
          <p>Uncover fraud, misconduct, or security breaches within your organization.</p>
          <h1 class="harga"></h1>
        </div>
      </div>
      <div class="box-menu carousel-cell">
        <img src="assets/img/sourdough.png" alt="">
        <div class="area-menu">
          <h1 class="judul">Background Checks</h1>
          <p> Verify credentials, assess reputations, and mitigate risks in hiring or business partnerships.</p>
          <h1 class="harga"></h1>
        </div>
      </div>
      <div class="box-menu carousel-cell">
        <img src="assets/img/donuts.png" alt="">
        <div class="area-menu">
          <h1 class="judul">Environmental Violations</h1>
          <p>Investigating environmental violations, pollution incidents, waste management issues, or non-compliance with environmental regulations.</p>
          <h1 class="harga"></h1>
        </div>
      </div>
      <div class="box-menu carousel-cell">
        <img src="assets/img/muffin.png" alt="">
        <div class="area-menu">
          <h1 class="judul">Surveillance</h1>
          <p> Monitor individuals or activities discreetly and gather actionable intelligence.
          </p>
          <h1 class="harga"></h1>
        </div>
      </div>
    </div>
  </div>
  <!-- ======= Menu End ======= -->

  <!-- ======= Review Start ======= -->
  <div class="review container" id="review">
    <h1 class="judul" data-aos="zoom-in-up" data-aos-duration="1000">Review</h1>
    <div class="area-review">
        <?php 
        while ($row = $review_result->fetch_assoc()): 
            ?>
            <div class="box-review" data-aos="fade-up" data-aos-duration="1500">
                <p><?php echo $row['content']; ?></p>
                <?php 
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true):
                    ?>
                    <!-- Edit and Delete buttons -->
                    
                    <a href="index.php?delete_review=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
                <?php 
                endif; 
                ?>
            </div>
        <?php 
        endwhile; 
        ?>
    </div>
    <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true):
        ?>
        
    <?php 
    endif; 
    ?>
</div>

<!-- Add Review Modal -->



  <!-- ======= Review End ======= -->

  

  <!-- ======= Outlet Start ======= -->
  <div class="lokasi container" id="lokasi">
    <h1 class="judul" data-aos="fade-up" data-aos-duration="500">HeadQuarter</h1>
    <iframe id="map" data-aos="fade-up" data-aos-duration="500" data-aos-delay="800"
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63416.93319726684!2d106.75154283533377!3d-6.577288373915765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5b819ba00ed%3A0xe785b9e550d4ae5d!2sMarkas%20Besar%20Bogor%20Underground!5e0!3m2!1sen!2sid!4v1714760026537!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
     </iframe>"
  </div>
  <!-- ======= Outlet End ======= -->

 <!-- ======= Gallery Start ======= -->
<div class="gallery container" id="gallery">
    <h1 class="judul">Gallery</h1>
    <div class="gallery-grid">
        <?php 
        while ($row = $gallery_result->fetch_assoc()): 
            ?>
            <div class="gallery-item">
                <img src="<?php echo $row['image_path']; ?>" alt="Gallery Image">
                <?php 
                // Check if the user is logged in
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true):
                    ?>
                    <!-- If logged in, show the delete button for each image -->
                    <a href="index.php?delete=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
                <?php 
                endif; 
                ?>
            </div>
        <?php 
        endwhile; 
        
        // If logged in, display the "Add" button to upload images
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true):
            ?>
            <div class="gallery-item">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="image" id="image" required>
                    <button type="submit" name="upload" class="upload-button">Add</button>
                </form>
            </div>
        <?php 
        endif; 
        ?>
    </div>
</div>
<!-- ======= Gallery End ======= -->




  <!-- ======= Footer Start ======= -->
  <div class="footer">
    <div class="footer-1">
      <div class="footer-logo" data-aos="fade-down" data-aos-duration="800">
        <img src="assets/img/logo.png" alt="">
        <h1>Probe</h1>
      </div>
      <p data-aos="fade-up" data-aos-duration="800">Provide The Best Service <br> Carful And Precise.</p>
      <div class="sosial-media">
        <a href="">
          <img src="assets/img/facebook.png" alt="" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="200">
        </a>
        <a href="https://www.instagram.com/msn.production/">
          <img src="assets/img/instagram.png" alt="" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="250">
        </a>
        <a href="https://wa.me/6281212542767?text=Hello%2C%20I%27m%20interested%20in%20your%20services%21" target="_blank">
          <img src="assets/img/twitter.png" alt="" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="300">
        </a>
      </div>
    </div>

    <div class="footer-2">
      <h1 data-aos="fade-down" data-aos-duration="800" data-aos-delay="200">Contact</h1>
      <a href="" data-aos="fade-up" data-aos-duration="800" data-aos-delay="250">+62 812-1254-2767</a>
      <a href="" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">rasyamrrr@gmail.com</a>
      <!-- Add Review Section -->
    <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="350">
        <h2>Add a Review</h2>
        <form action="index.php" method="post">
            <textarea name="review_content" required placeholder="Write your review here..."></textarea>
            <button type="submit" name="add_review">Add Review</button>
        </form>
    </div>
</div>

    <div class="footer-3">
      <h1 data-aos="fade-down" data-aos-duration="800" data-aos-delay="300">Operational Time</h1>
      <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="350">Mon - Wed 05 Am - 09 Pm</p>
      <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">Thu - Sat 05 Am - 08 Pm</p>
      <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="450">Sun 04 Am - 08 Pm</p>
    </div>

    <div class="footer-4" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
      <h1>Link</h1>
      <a data-scroll data-easing="easeInQuint" href="#beranda">Home</a>
      <a data-scroll data-easing="easeInQuint" href="#tentang">About Us</a>
      <a data-scroll data-easing="easeInQuint" href="#menu">Menu</a>
      <a data-scroll data-easing="easeInQuint" href="#review">Review</a>
      <a data-scroll data-easing="easeInQuint" href="#lokasi">Partnership</a>
      <a data-scroll data-easing="easeInQuint" href="#lokasi">Location</a>
      <a href="login.php" class="login-button">Admin</a>
    <a href="logout.php" class="login-button">Log out</a>
    </div>
  </div>
  <footer>
    <h1>&copy; Copyright 2024, <a href="">Rathalos</a> Company Profile</h1>
  </footer>
  <!-- ======= Footer End ======= -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery.js/jquery.js"></script>
  <script src="assets/vendor/type.js/type.js"></script>
  <script src="assets/vendor/aos.js/aos.js"></script>
  <script src="assets/vendor/flickity.js/flickity.pkgd.min.js"></script>
  <script src="assets/vendor/smoth-scroll.js/smoth-scroll.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>