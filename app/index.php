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
                <img src="../resources/images/corey2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>test</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus quidem, mollitia nisi doloribus corporis aliquid provident cupiditate aperiam, dolorum nihil quisquam labore officia repellat qui fugiat, iste quaerat ea a?</p>
                    <button type="button" class="btn btn-light btn-lg"><a class="nav-link text-dark ps-3" href="#">BOOK NOW</a></button>
                </div>
            </div>
            <!-- end of first image for carousel -->
            <!-- start of second image for carousel -->
            <div class="carousel-item">
                <img src="../resources/images/qcitizen_id_back.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>test</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate labore, natus quibusdam, rerum modi dicta tempora sint suscipit deserunt amet dolore corporis voluptates eaque facilis, quaerat voluptas commodi. Quo, eum?</p>
                    <button type="button" class="btn btn-light btn-lg"><a class="nav-link text-dark ps-3" href="#">BOOK NOW</a></button>
                </div>
            </div>
            <!-- end of second image for carousel -->
            <!-- start of third image for carousel -->
            <div class="carousel-item">
                <img src="../resources/images/martino2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>test</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio molestias, ut sed iusto amet iste facere, ad, asperiores earum voluptate blanditiis deleniti repellat ab odit deserunt inventore illo dolores dolorum.</p>
                    <button type="button" class="btn btn-light btn-lg"><a class="nav-link text-dark ps-3" href="#">BOOK NOW</a></button>
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
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <h1 class="text-center" id="test">test</h1>
    </div>
    <?php
        require_once 'footer.php';
    ?>
</body>
<!-- end of body tag -->
</html>