<?php
    require_once 'includes/session.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php
        require_once 'header.php';
    ?>
    <!-- start of carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <!-- start of carousel indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <!-- end of carousel indicators -->
        <!-- start of div for carousel inner -->
        <div class="carousel-inner">
            <!-- start of first image for carousel -->
            <div class="carousel-item active">
                <img src="../resources/images/dog4.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-dark">
                    <!-- <h1>Anti-rabies</h1>
                    <p class="fs-2">Prevent them from acquiring the disease from wildlife, and thereby prevent possible transmission to your family or other people.</p> -->
                    <button type="button" class="btn btn-dark btn-lg"><a class="nav-link text-white ps-3" href="calendar.php">BOOK NOW</a></button>
                </div>
            </div>
            <!-- end of first image for carousel -->
            <!-- start of second image for carousel -->
            <div class="carousel-item">
                <img src="../resources/images/veterinary2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-dark">
                    <!-- <h1>test</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate labore, natus quibusdam, rerum modi dicta tempora sint suscipit deserunt amet dolore corporis voluptates eaque facilis, quaerat voluptas commodi. Quo, eum?</p> -->
                    <button type="button" class="btn btn-dark btn-lg"><a class="nav-link text-white ps-3" href="calendar.php">BOOK NOW</a></button>
                </div>
            </div>
            <!-- end of second image for carousel -->
            <!-- start of third image for carousel -->
            <div class="carousel-item">
                <img src="../resources/images/dog3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-dark">
                    <!-- <h1>test</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio molestias, ut sed iusto amet iste facere, ad, asperiores earum voluptate blanditiis deleniti repellat ab odit deserunt inventore illo dolores dolorum.</p> -->
                    <button type="button" class="btn btn-dark btn-lg"><a class="nav-link text-white ps-3" href="calendar.php">BOOK NOW</a></button>
                </div>
            </div>
            <!-- end of third image for carousel -->
        </div>
        <!-- end of div for carousel inner -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- end of carousel -->
    <!-- start of description -->
    <!-- start of first row -->
    <div class="row mt-5">
        <!-- start of image on left side -->
        <div class="col-sm-6">
            <div class="card text-bg-dark guitar">
                <img src="../resources/images/veterinary1.jpg" class="card-img" alt="random img">
                <div class="card-img-overlay pt-5 ps-5 mt-5 ms-5">
                    <h3><a class="nav-link card-title text-dark float-start" href="#">Trusted Care by Skilled Professionals.</a></h3>
                    <!-- <p><a class="nav-link card-title text-dark float-start" href="#">random text</a></p> -->
                </div>
            </div>
        </div>
        <!-- end of image on left side -->
        <!-- start of description on right side -->
        <div class="col-sm-6">
            <div class="container text-start">
                <h1 class="text-start">Experienced Veterinarians</h1>
                <p class="fs-3">Experienced veterinarians work with pets of all kinds, from dogs and cats to exotic animals and wildlife. They have a keen eye for detail and can quickly identify the source of an animal's problem, whether it's an infection, disease, or injury. They also perform surgeries and other medical procedures that are necessary for the treatment of animals. Additionally, experienced veterinarians provide pet owners with valuable advice on how to care for their pets, such as proper diet and exercise routines.</p>
            </div>
        </div>
        <!-- end of description on right side -->
    </div>
    <!-- end of first row -->
    <!-- start of second row -->
    <div class="row mt-5">
        <!-- start of description on left side -->
        <div class="col-sm-6">
            <div class="container text-end">
                <h1 class="text-end">Clean Facility</h1>
                <p class="fs-3">Our top priority is to provide a clean and safe environment for all pets that visit our facility. We understand the importance of maintaining a sanitary and hygienic space, especially in a setting where many animals are in close proximity to each other. Our facility is equipped with state-of-the-art cleaning equipment and staffed with trained professionals who take pride in ensuring that our space is always clean and welcoming.</p>
            </div>
        </div>
        <!-- end of description on left side -->
        <!-- start of image on right side -->
        <div class="col-sm-6">
            <div class="card text-bg-dark guitar">
                <img src="../resources/images/facility.jpg" class="card-img" alt="random img">
                <div class="card-img-overlay pt-5 ps-5 mt-5 ms-5">
                    <h3><a class="nav-link card-title text-dark float-start" href="#">Spotless and Sanitized Pet Haven.</a></h3>
                    <!-- <p><a class="nav-link card-title text-dark float-start" href="#">Spotless and Sanitized Pet Haven.</a></p> -->
                </div>
            </div>
        </div>
        <!-- end of image on right side -->
    </div>
    <!-- end of second row -->
    <!-- end of description -->
    <br><br>
    <div class="container">
        <!-- <h1 class="text-center" id="test">test</h1> -->
    </div>
    <?php
        require_once 'footer.php';
    ?>
</body>
<!-- end of body tag -->
</html>