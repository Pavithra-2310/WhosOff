<!doctype html>
 <html class="no-js " lang="en"> 
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- Site Meta -->
    <title>WhosOff</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/college_logo.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/college_logo.png">

	<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i" rel="stylesheet"> 
	
    <!-- Custom & Default Styles -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/carousel.css">
    <link rel="stylesheet" href="css/animate.css">
   
   
<style>
  @font-face {
    font-family: "Flaticon";
    src: url("fonts/Flaticon.eot");
    src: url("fonts/Flaticon.eot?#iefix") format("embedded-opentype"), url("fonts/Flaticon.woff") format("woff"), url("fonts/Flaticon.ttf") format("truetype"), url("fonts/Flaticon.svg#Flaticon") format("svg");
    font-weight: normal;
    font-style: normal;
}

@media screen and (-webkit-min-device-pixel-ratio:0) {
    @font-face {
        font-family: "Flaticon";
        src: url("fonts/Flaticon.svg#Flaticon") format("svg");
    }
}

body {
  margin: 0px;
  padding: 0px;
}

.img-section {
  position: relative;
  width: 100vw;
  height: 100vh;
  background-image: url("images/clg2.jpeg");
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  margin: 0;
  padding: 0;
}

.img-section::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  filter: brightness(30%);
}


      h1{
        color:antiquewhite;
      }
      

.section {
    background-color: #ffffff;
    padding: 8rem 0;
    position: relative;
    display: block;
}

.section-title {
    margin-bottom: 45px;
}


.section-title p {
    max-width: 800px;
    margin: 0 auto;
    padding: 0;
    font-size: 16px;
    font-family: 'Droid Serif', sans-serif;
    font-style: italic;
}

.section.gb {
    background-color: #f6f6f6;
}

.section.db {
    background-color: #000000;
}
.home-text-wrapper {
    display: table;
    width: 100%;
    height: 100%;
    max-width: 900px;
    position: relative;
    text-align: center;
    z-index: 11;
}

.home-content {
    position: relative;
}

.home-message {
    display: table-cell;
    height: 100%;
    vertical-align: middle;
}

.home-message p {
    font-size: 54px;
    color: white;
    padding: 0;
    margin: 0;
    font-weight: 700;
}

.home-message small {
    font-size: 16px;
    font-family: 'Droid Serif', sans-serif;
    font-style: italic;
    display: block;
    padding: 20px 0 35px;
    margin: 0;
    color:white;
}

.section.footer {
    width:1530px;
    background-color: #000
}

.loader {
    display: block;
    margin: 20px auto 0;
    vertical-align: middle;
}

#preloader {
    width: 100%;
    height: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: #fff;
    z-index: 11000;
    position: fixed;
    display: block
}

.preloader {
    position: absolute;
    margin: 0 auto;
    left: 1%;
    right: 1%;
    top: 47%;
    width: 65px;
    height: 65px;
    background: center center no-repeat none;
    background-size: 65px 65px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%
}
@media (max-width: 992px) {
    
    .container {
        min-width: 100% !important;
    }
    
}

@media (max-width: 768px) {
    
    .home-message p {
        font-size: 28px;
    }
    
}

    


form {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 30px;
    }

    button {
      padding: 15px 30px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      margin-bottom: 10px;
      cursor: pointer;
      background-color: #555555;
      color: #fff;
      transition: background-color 0.3s ease;
      width: 200px;
    }

    button:hover {
      background-color: #333333;
    }

</style>
</head>
<body>  
<?php 
include 'nav.php';
?>
    <!-- LOADER -->
    <div id="preloader">
        <img class="preloader" src="images/loader.gif" alt="">
    </div><!-- end loader -->
    <!-- END LOADER -->

    <div id="wrapper">
        
        

        <section id="home" class="img-section">
            <div class="overlay"></div>
            <div class="home-text-wrapper relative container">
                <div class="home-message">
                    
                    <p>WhosOff</p>
                    <h1>Leave Management System</h1>
                    <small>Whosoff is a robust PHP-based leave management system designed to simplify and automate the process of managing student leaves, providing an efficient solution for tracking and approving duty leave requests within organizations.</small>
                    
                </div>
            </div>
            
        </section>

       
       

        

        <footer class="section footer noover">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                    <h1>Select the Admin Type</h1>

<form>
   <button type="button" onclick="redirectToPrin()">Principal</button> 
   <button type="button" onclick="redirectTodd()">DEAN</button> 
   <button type="button" onclick="redirectTohh()">HOD</button>
   <button type="button" onclick="redirectTost()">Staff Advisor</button>
  <button type="button" onclick="redirectToss()">Student</button>
</form></div><!-- end col -->

                    
</div></div>

<script>
  function redirectToPrin() {
    window.location.href = "modules/prin.php";
  }

  function redirectTodd() {
    window.location.href = "modules/dd.php";
  }

  function redirectTohh() {
    window.location.href = "modules/hh.php";
  }

  function redirectTost() {
    window.location.href = "modules/ss.php";
  }

  function redirectToss() {
    window.location.href = "modules/st.php";
  }
</script>
                    
                    
       

                    
    <!-- jQuery Files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/carousel.js"></script>
    <script src="js/animate.js"></script>
    <script src="js/custom.js"></script>
    <!-- VIDEO BG PLUGINS -->
    

</body>
</html>