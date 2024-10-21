<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JasaanKnown</title>
    <script src="https://kit.fontawesome.com/c1df782baf.js" crossorigin="anonymous"></script>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap');

*{
    font-family: 'Nunito', sans-serif;
    margin:0; padding:0;
    box-sizing: border-box;
    outline: none; border:none;
    text-decoration: none;
    text-transform: capitalize;
    transition:all .2s linear;
  }
  
  html{
    font-size: 62.5%;
    overflow-x: hidden;
    scroll-behavior: smooth;
    scroll-padding-top: 6rem;
  }

  header{
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: white;
    padding: 1.5rem 7%;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    width: 100%;
    position: fixed;
    z-index: 100;
  }
  .logo{
    width: 50px;
  }
  .logo img{
    width: 100%;
  }
  header-icon img{
    width: 100px;
    position: sticky;
    top: 0;
    left: 20%;
    animation: headericon 5s infinite;
  }
  
  @keyframes headericon {
    0% {left: 20%;}
    50% {left: 25%;}
    100% {left: 20%;}
  }

  .navbar a{
    padding: 1rem;
    margin: 0.5rem;
    color:#3a4d68;
    font-size: 1.7rem;
    position: relative;
    transition: 0.5s;
  }
  .navbar a:hover{
    color: #3a4d68;
  }
  .navbar a::after{
    content: "";
    background-color: #3a4d68;
    width: 0;
    height: 2px;
    left: 0;
    top: 100%;
    position: absolute;
    transition: 0.5s;
  }
  .navbar a:hover::after{
    width: 100%;
  
  }
  .header-icons{
    display: flex;
    align-items: center;
    justify-content: space-between;
   
  }
  .header-icons i{
    font-size: 2.5rem;
    color: #3a4d68;
    margin: 0 0.5rem;
    padding: 0.5rem;
    
  }
  .header-icons i:hover{
    color:#3a4d68;
    cursor: pointer;
  }
  #bar{
    font-size: 2.5rem;
    color: #3a4d68;
    margin-left: 1rem;
    display: none;
  }
  #bar:hover{
    color: #3a4d68;
  }
/* home section started */
.main-home{
  width: 100%;
  background-image: url(images/imma.jpg);
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  height: 100vh;
  padding: 2rem 7%;
}
.inner-home{
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 1.5rem;
  padding-top: 6%;
}
.main-inner-home{
  flex: 1 1 45rem;
}

.main-inner-home .right-img img{
  width: 100%;
}
.left-content{
  padding: 0 3rem;
}
.left-content h3{
  color:#3a4d68;
  font-size: 5rem;
}
.left-content h1{
  color: #3a4d68;
  font-size: 11rem;
}
.left-content p{
  color: #3a4d68;
  font-size: 1.7rem;
  padding: 1rem 0;
}
.btn{
  font-size: 1.5rem;
  display: inline-block;
  border-radius: 10px;
  position: relative;
  padding: 1.5rem 2rem;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.1);
  transition: 0.5s all ease;
  z-index: 1;
  cursor: pointer;
  background: #3a4d68;
  color: white;
  margin-top: 2rem;
}
.btn:hover{
  color: white;
}
.btn::before{
  content: "";
  color: white;
  transition: 0.5s all ease;
  top: 50%;
  bottom: 50%;
  left: 0;
  right: 0;
  opacity: 0;
  z-index: -1;
  position: absolute;
}
.btn:hover:before{
  top: 0;
  bottom: 0;
  opacity: 1;
  background: white;
  
}
.home-icons-below{
  padding: 1rem 7%;
  margin-top: -50px;
}
.main-home-icons{
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 2rem;
}
.home-icon-box{
  flex: 1 1 230px;
  padding: 1rem;
  text-align: center;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  background-color:#3a4d68;
  border: 2px solid #1680dd;
  transition: 0.5s;
}


.home-icon-box:hover{
  background-color:#3a4d68;
  border-top-left-radius: 30px;
  border: 2px solid #67cff5;
}
.home-icon-box:hover h2{
  color: white;
}

.home-icon-box:hover p{
  color: white;
}

.home-icon-box h2{
  font-size: 2rem;
  padding: 1rem 0;
}
.home-icon-box p{
  font-size: 1.5rem;
  padding: 1.5rem 0;
}



.overflowimg img{
  position: absolute;
  width: 100px;
  left: -4%;
  animation: myimg 5s infinite;
  top: 10%;
}
@keyframes myimg {
  0% {top: 10%;}
  50% {top: 40%;}
  100% {top: 0%;}
}
/* Our Services */
/* Officials Section */

.main-officials {
    padding: 3rem 7%;
    background-color: #f0f0f0;
    position: relative;
}

.officials-heading {
    text-align: center;
    padding-bottom: 3rem;
}

.officials-heading h1 {
    font-size: 45px;
    color: #3a4d68;
}

.main-inner-officials {
    display: flex;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.officials-box {
    flex: 1 1 300px;
    padding: 3rem 2rem;
    border: 2px solid #3a4d68;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    text-align: center;
    transition: 0.3s ease-in-out;
    position: relative;
    transition: 0.5s ease;
    background: white;
}


.officials-icon {
    padding: 2rem;
    background-color: #1680dd;
    width: 80px;
    height: 80px;
    line-height: 50px;
    margin: 0 auto;
    transition: 0.4s;
    cursor: pointer;
}

.officials-box:hover .officials-icon {
    border-radius: 100%;
    background-color: #3a4d68;
}

.officials-icon i {
    font-size: 3rem;
    color: white;
}

.officials-box h2 {
    font-size: 2rem;
    padding: 2rem 0;
}

.officials-content p {
    font-size: 1.5rem;
    padding: 1rem 0;
    line-height: 2rem;
}

.officials-image {
    width: 100%; /* Adjust the width as needed */
    border-radius: 8px; /* Add rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a shadow */
}

/* Add hover effect on image */
.officials-box:hover .officials-image {
    transform: scale(1.1); /* Scale up the image on hover */
    transition: transform 0.3s ease; /* Smooth transition */
}


.main-population {
    padding: 3rem 7%;
    background-color: #edeef2;
    position: relative;
}

.population-heading {
    text-align: center;
}

.population-heading h1 {
    font-size: 45px;
    color: #3a4d68;
    padding-bottom: 3rem;
}

.main-inner-population {
    display: flex;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.population-box {
    flex: 1 1 300px;
    padding: 3rem 2rem;
    border: 2px solid #3a4d68;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    text-align: center;
    transition: 0.3s ease-in-out;
    position: relative;
    transition: 0.5s ease;
    background: white;
}

.population-box:hover {
    margin-top: -10px;
    border-bottom: 2px solid #1680dd;
    border: 0;
    border-radius: 20px;
    border-left: 5px solid #3a4d68;
}

.population-box-icon {
    padding: 2rem;
    background-color: #1680dd;
    width: 80px;
    height: 80px;
    line-height: 50px;
    margin: 0 auto;
    transition: 0.4s;
    cursor: pointer;
}

.population-box:hover .population-box-icon {
    border-radius: 100%;
    background-color: #3a4d68;
}

.population-box-icon i {
    font-size: 3rem;
    color: white;
}

.population-box h2 {
    font-size: 2rem;
    padding: 2rem 0;
}

.population-content p {
    font-size: 1.5rem;
    padding: 1rem 0;
    line-height: 2rem;
}


@keyframes servicimg {
  0% {top: 10%;}
  50% {top: 80%;}
  100% {top: 0%;}
}

/* our gallery */

.main-gallery-section{
  padding: 3rem 7%;
  background-image: url(background.png);
}
.gallery-heading{
  text-align: center;
  padding-bottom: 2rem;
}
.gallery-heading h1{
  font-size: 45px;
  color:#3a4d68;
}
.gallery-heading h1 span{
  color:#3a4d68;
}
.main-inner-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Adjust the gap between images as needed */
        }

        .inner-gallery {
            flex: 0 0 calc(33.33% - 20px); /* Adjust the width of each image container */
            position: relative;
            overflow: hidden;
        }

        .inner-gallery img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s ease;
        }

        .inner-gallery:hover img {
            transform: scale(1.05); /* Zoom in on hover */
        }

        .image-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            color: #fff;
            text-align: center;
            transition: opacity 0.3s ease;
            opacity: 0; /* Initially hidden */
        }

        .inner-gallery:hover .image-caption {
            opacity: 1; /* Show caption on hover */
        }
.official-card {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .official-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
        }

        .official-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .official-details {
            flex: 1;
        }

        .official-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .official-position {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .official-year,
        .official-age,
        .official-department {
            font-size: 14px;
            margin-bottom: 5px;
        }

        h3 {
            font-size: 24px; /* Adjust the font size as needed */
            font-weight: bold; /* Optionally, you can make the text bold */
        }

        p {
            font-size: 18px; /* Adjust the font size as needed */
        }

/* Footer */

.main-history {
    padding: 3rem 7%;
    background-color: #f0f0f0;
    position: relative;
}

.history-heading {
    text-align: center;
    padding-bottom: 3rem;
}

.history-heading h1 {
    font-size: 45px;
    color: #3a4d68;
}

.main-inner-history {
    display: flex;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.history-box {
    flex: 1 1 300px;
    padding: 3rem 2rem;
    border: 2px solid #3a4d68;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    text-align: center;
    position: relative;
    transition: 0.5s ease;
    background: white;
}



.history-icon {
    padding: 2rem;
    background-color: #1680dd;
    width: 80px;
    height: 80px;
    line-height: 50px;
    margin: 0 auto;
    transition: 0.4s;
    cursor: pointer;
}

.history-box:hover .history-icon {
    border-radius: 100%;
    background-color: #3a4d68;
}

.history-icon i {
    font-size: 3rem;
    color: white;
}

.history-box h2 {
    font-size: 2rem;
    padding: 2rem 0;
}

.history-content p {
    font-size: 1.5rem;
    padding: 1rem 0;
    line-height: 2rem;
}

.history-image {
    width: 100%; /* Adjust the width as needed */
    border-radius: 8px; /* Add rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a shadow */
}

/* Add hover effect on image */
.history-box:hover .history-image {
    transform: scale(1.1); /* Scale up the image on hover */
    transition: transform 0.3s ease; /* Smooth transition */
}

h2 {
    font-size: 25px;
}


/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: var(--color1); 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: var(--color3); 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: var(--color5); 
}

@media (max-width:768px) {
    
  html{
    font-size: 55%;
  }
   
  header{
    padding: 1rem 3rem;
  }
  #bar{
    display: initial;
  }

  .navbar{
    position: absolute;
    top: 100%;
    left: -100%;
    width: 100%;
    height: 100vh;
    background: #3a4d68;
    
  }
  .navbar.active{
    left: 0;
  }
  .navbar a{
    display: block;
    margin: 2rem;
    padding: 1rem;
    border: 1px solid ;
    font-size: 1.7rem;
  }
  .main-home{
    height: auto;
    padding-top: 30%;
    }

    .home-icons-below{
      margin-top: 0;
      padding: 4rem 2rem;
    }
    .home-icon-box{
      padding: 2rem;
    }

    /* Service section */

    .service-box{
      padding: 2rem;
    }

    .background-container {
    background-color: #f0f0f0; /* Background color */
    padding: 20px; /* Padding */
    border-radius: 10px; /* Rounded corners */
}




}
    </style>
</head>

<body>

    <header>
        <div class="logo"><img src="image/logo.png" alt=""></div>        
        <div class="navbar">
            <a href="#">Home</a>
            <a href="#population">Population</a>
            <a href="#gallery">Events</a>
            <a href="#officials">Officials</a>
            <a href="#history">History</a>
        </div>

    </header>

    <!-- home section started -->

    <div id="home" class="main-home">

        <div class="inner-home">
            <div class="main-inner-home left">
                <div class="left-content">
                    <h3>WELCOME TO UPPER JASAAN</h3>
                    <p>Enjoy our new dental offers and travel destinations, they’re online immediately. Choose your service or destination and start smiling again!</p>
                </div>
            </div>
            <div class="main-inner-home right">
                <div class="right-img">
                </div>
            </div>
        </div>

    </div>

                <!--<img src="images/icon1.jpeg" alt=""> -->

            </div>
    <!-- population us section -->

  <!-- population us section -->
<div class="main-population" id="population">
    <div class="population-heading">
        <h1>Our <span>Population</span></h1>
    </div>
    <div class="main-inner-population">
        <div class="population-box">
            <div class="population-box-icon">
                <i class="fas fa-users"></i>
            </div>
            <h2>Demographics</h2>
            <div class="population-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lobortis est id lacus ultrices vestibulum.</p>
            </div>
        </div>
        <div class="population-box">
            <div class="population-box-icon">
                <i class="fas fa-chart-pie"></i>
            </div>
            <h2>Economic Status</h2>
            <div class="population-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lobortis est id lacus ultrices vestibulum.</p>
            </div>
        </div>
        <div class="population-box">
            <div class="population-box-icon">
                <i class="fas fa-globe"></i>
            </div>
            <h2>Cultural Diversity</h2>
            <div class="population-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lobortis est id lacus ultrices vestibulum.</p>
            </div>
        </div>
    </div>
</div>



    <!-- our gallery -->

    <div class="main-gallery-section" id="gallery">
        
        <div class="gallery-heading">
            <h1>Our <span>Events</span></h1>
        </div>

        <div class="main-inner-gallery">

            <div class="inner-gallery">
                <img src="images/evnt1uj.jpg" alt="">
            <div class="image-caption">
            <h3>ZUMBA</h3>
            <p>january 5, 2024</p>
        </div>
        </div>

            <div class="inner-gallery">
                <img src="images/evnt2uj.jpg" alt="">
                <div class="image-caption">
            <h3>LIVE BAND</h3>
            <p>Febraury 15, 2024</p>
            </div>
            </div>

            <div class="inner-gallery">
                <img src="images/evnt3uj.jpg" alt="">
                <div class="image-caption">
            <h3>BASKETBALL LEANGUE</h3>
            <p>Febraury 20, 2024</p>
            </div>
            </div>

            <div class="inner-gallery">
                <img src="images/evnt4uj.jpg" alt="">
                <div class="image-caption">
            <h3>MISS UPPER JASAAN</h3>
            <p>Febraury 22, 2024</p>
            </div>
            </div>

            <div class="inner-gallery">
                <img src="images/evnt5uj.jpg" alt="">
                <div class="image-caption">
            <h3>DISCO</h3>
            <p>Febraury 26, 2024</p>
            </div>
            </div>

            <div class="inner-gallery">
                <img src="images/evnt6uj.jpg" alt="">
                <div class="image-caption">
            <h3>CLEAN UP DRIVE</h3>
            <p>March 1, 2024</p>
            </div>
            </div>

        </div>

    </div>
        
    <!-- our gallery end -->

    
    <!-- Officials Section -->
<div class="main-officials" id="officials">
    <div class="officials-heading">
        <h1>Our <span>Officials</span></h1>
    </div>
    <div class="main-inner-officials">
        <div class="officials-box">
        <div class="official-card" style="background-color: #f9c2ff;">
    <div class="official-picture">
        <img src="images/shaiwo.jpg" alt="Official Picture">
    </div>
    <div class="official-details">
        <div class="official-name">John Doe</div>
        <div class="official-position">Mayor</div>
        <div class="official-year">Year of Term: 2022 - 2026</div>
        <div class="official-age">Age: 45</div>
        <div class="official-department">Department: Administration</div>
    </div>
</div>

        <!-- Add more officials boxes as needed -->
    </div>
</div>

<div class="main-inner-officials">
        <div class="officials-box">
        <div class="official-card" style="background-color: #f9c2ff;">
    <div class="official-picture">
        <img src="images/shaiwo.jpg" alt="Official Picture">
    </div>
    <div class="official-details">
        <div class="official-name">Shairo James</div>
        <div class="official-position">Vice-Mayor</div>
        <div class="official-year">Year of Term: 2022 - 2026</div>
        <div class="official-age">Age: 45</div>
        <div class="official-department">Department: Administration</div>
    </div>
</div>

        <!-- Add more officials boxes as needed -->
    </div>
</div>

                

    <!-- footer -->

    <div class="main-history" id="history">
    <div class="history-heading">
        <h1>Our <span>History</span></h1>
    </div>
    <div class="main-inner-history">
        <div class="history-box">
        <img src="images/uj.png" alt="">
            </div>
            <h2>Jasaan is believed to have been already a municipality during the establishment of the Immaculate Conception Parish in 1840. The old church bells (four of them, excluding the one now at the San Agustin Cathedral at Cagayan de Oro) of the Immaculate Conception Church of Jasaan bore these inscriptions around its outer rim: "Para El Pueblo de Jasaan 1860" [more or less], which suggests that the Spanish government had recognized Jasaan as a town.</h2>
        </div>
        <!-- Add more officials boxes as needed -->
    </div>
</div>
    </div>

    
    <script src="Script.js"></script>
</body>
</html>