<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Image Gallery</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
	background: #45464b;
  }
  .gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  .gallery img {
    margin: 10px;
    max-width: 200px;
    cursor: pointer;
  }
  #lightbox {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 9999;
    text-align: center;
  }
  #lightbox img {
    max-width: 80%;
    max-height: 80%;
    margin-top: 5%;
  }
  .lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #fff;
    cursor: pointer;
  }
  .lightbox-nav.prev {
    left: 15px;
  }
  .lightbox-nav.next {
    right: 15px;
  }
</style>
</head>
<body>

<div class="gallery">
  <?php
  // Get all image files from the current directory
  $images = glob("*.{jpg,jpeg,png,gif}", GLOB_BRACE);
  
  foreach ($images as $image) {
      echo "<img src='$image' alt='Gallery Image' onclick='openLightbox(\"$image\")'>";
  }
  ?>
</div>

<div id="lightbox">
  <span class="lightbox-nav prev" onclick="prevImage()">&#10094;</span>
  <span class="lightbox-nav next" onclick="nextImage()">&#10095;</span>
  <span onclick="closeLightbox()" style="position: absolute; top: 15px; right: 15px; cursor: pointer; color: #fff; font-size: 30px;">&times;</span>
  <img id="lightbox-image">
</div>

<script>
var images = <?php echo json_encode($images); ?>;
var currentIndex = 0;

function openLightbox(imageSrc) {
  currentIndex = images.indexOf(imageSrc);
  document.getElementById("lightbox-image").src = imageSrc;
  document.getElementById("lightbox").style.display = "block";
}

function closeLightbox() {
  document.getElementById("lightbox").style.display = "none";
}

function prevImage() {
  currentIndex = (currentIndex - 1 + images.length) % images.length;
  document.getElementById("lightbox-image").src = images[currentIndex];
}

function nextImage() {
  currentIndex = (currentIndex + 1) % images.length;
  document.getElementById("lightbox-image").src = images[currentIndex];
}
</script>

</body>
</html>
