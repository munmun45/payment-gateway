<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <title>MUNMUN's Payment Getway</title>
</head>

<body style="background-color: #02162b; color: white;">








    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="background-color: #00283a !important;">
        <div class="container-fluid container">
            <a class="navbar-brand" href="../">MUNMUN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link " href="../">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../contact.php">Contact / Help</a>
                    </li>
                </ul>
                <div class="d-flex" style="gap: 10px;">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#donateModal">
                        DONATE <i class="fas fa-heart"></i>
                    </button>
                    <a href="./auth/index" type="button" class="btn btn-primary ">Login</a>
                    <a href="./auth/register" class="btn btn-success ml-1">Register</a>
                </div>
            </div>
        </div>
    </nav>








    <main class="container">




        <br>
        <br>
        <br>


        <div class="modal fade" id="donateModal" tabindex="-1" aria-labelledby="donateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="donateModalLabel" style="color: black;">Donate Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="color: black;">
                        <form action="./donate.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label" style="color: black;">Name *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label" style="color: black;">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label" style="color: black;">Amount *</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Write Message" ></textarea>
                            </div>


                            <button type="submit" class="btn btn-primary">Donate Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>








        <div id="carouselExampleIndicators" class="carousel slide mt-3" data-bs-ride="carousel" style="border-radius: 10px; overflow: hidden;">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./assets/my/1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./assets/my/2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./assets/my/3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>







        <div class="bd-callout bd-callout-info mt-5">
            <h1 id="conveying-meaning-to-assistive-technologies">Upi Payment Gateway</h1>
            <p>
                The Unified Payments Interface (UPI) is a real-time payment system in India that allows instant money
                transfers between bank accounts. Developed by the NPCI, UPI is secure, user-friendly, and operates 24/7.
                It uses a Virtual Payment Address (VPA) for transactions, eliminating the need for bank details.
                Businesses can easily integrate UPI, offering customers a quick and efficient payment method. UPI is
                cost-effective, widely compatible with numerous banks, and enhances both security and customer
                convenience.
            </p>
            <p class="mt-3">
                Scan and Pay Feature. Accept All UPI Apps. <br>
                No Transaction Charge. Instant Settlements.<br>
                Enable Multiple UPI Accounts.
            </p>

            <div style="display: flex; align-items: center; gap: 18px;">

                <button type="button" class="btn btn-primary btn-lg " style="font-weight: 900;">Try For Free</button>
                <div style="width: 100px; height: 3px; background-color: #ffffff; border-radius: 100px; flex-grow: 1;"></div>

            </div>


        </div>



        <br>
        <br>
        <br>


        <div class="alert alert-success " role="alert" style="font-weight: 900; text-align: center;">
            Accepting Payments Made Easy, Simple & FREE!
        </div>

        <br>


        <div class="alert alert-success " role="alert" style="font-weight: 900; text-align: center;">
            Contact Us : +91 6370599093
        </div>






        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>









    </main>



















    <?php require("./footer.php") ?>
































    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>