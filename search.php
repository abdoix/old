<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
  body{
    max-width: 100%;
    position: relative;
    box-sizing: border-box;
    overflow-x:hidden;
  }
* {
  box-sizing: border-box;
  scroll-behavior: smooth;
}
.form-control:focus {
    color: #495057;
    background-color: #fff !important;
    border-color: #80bdff !important;
    outline: 3px !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
}
*::-webkit-scrollbar {
  width: 6px;               
}
*::-webkit-scrollbar-track {
  background: transparent;        
}
*::-webkit-scrollbar-thumb {
  background-color: #cacaca;   
  border-radius: 20px; 
  }  
   

/*effect*/
.kiki div:hover{
  opacity:1 !important;
}
.box {
  background: hsl(0, 0%, 100%);
  width:50px;
  height:50px;
  outline: none !important;
  border:none !important;
  padding: 16px 16px;
  position: relative;
  border-radius: 50px;
  box-shadow: 0 0 0 0px rgba(0,0,0,.01);
  /* z-index: 999; */
}
.bootstrap-select .dropdown-toggle:focus, .bootstrap-select>select.mobile-device:focus+.dropdown-toggle {
    outline: none !important;
    outline: none !important;
    outline-offset: none;
}
.dropdown-toggle:focus-visible {
    outline:none !important;
}
.box:focus {
    outline: none !important;
}
  .box::after {
    position: absolute;
    content: "";
    left: 0;
    right: 0;
    height: 100%;
    width: 100%;
    transform: scale(2) translateZ(0);
    filter: blur(15px);
    background: linear-gradient(
      to left,
      #ff5770,
      #e4428d,
      #c42da8,
      #9e16c3,
      #6501de,
      #9e16c3,
      #c42da8,
      #e4428d,
      #ff5770
    );
    background-size: 150% 150%;
    animation:inherit;
    z-index: -1;
  }
  .effectactive{
    animation: animateGlow 1.25s linear infinite;
  }
  .content {
    max-width:100%;
    background:url('img/back/features-background.jpg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    z-index: 1;
}
.form-cont{
  z-index:9;
}
/* .content>div{
  z-index: -1;
} */

@keyframes animateGlow {
  0% {
    background-position: 0% 50%;
  }
  100% {
    background-position: 200% 50%;
  }
}

#err
{
  visibility: hidden;
  z-index: 10;
}
.err
{
  visibility: visible !important;
  display:block;
}

.img-edit span{
  margin-top:-40px;
  margin-left:42px;
  opacity:0;
  transition: top 1s,opacity 2s;
}
.img-edit:hover{
  opacity:0.8;
}
.img-edit:hover span{
  display:block;
  opacity:1 !important;
  margin-top:-100px;
}
/* .img-edit:hover span{
  margin-top:15px !important;
} */
</style>
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,400;1,600&family=Roboto&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php

include_once 'modul.php';
// session_destroy();
session_start();

// echo "+******************$$$$$$$$$$$$$*******************************$".isset($_SESSION['user']);
if(! isset($_SESSION['user']))
{
  header("Location: index.php");
}

?>
</head>
<body style='max-width: 100%;'>
<?php
  include_once 'header.php';
  if(isset($_POST["submod"]))
  {
 
    $newimage = $image;
    if(!empty($_FILES['img']['name']))
    {
      $newimage = $_FILES['img']['name'];
      echo "<script>console.log('$newimage')</script>";
    }
    if($_POST['usrmod'] != $user || $_POST['passmod'] != $pass || $_POST['villemod'] != $ville || $_POST['moremod'] != $userage || $newimage != $image)
    {
      if($newimage != $image){
        move_uploaded_file($_FILES['img']['tmp_name'],"img/users/$newimage");
      }
        $newuser = $_POST['usrmod'];
        $newpass = $_POST['passmod'];
        $_SESSION['user'] = $newuser;
        $_SESSION['pass'] = $newpass;
        $villemod = $_POST['villemod'];
        $agenew = $_POST['moremod'];
        
        $mydata = str_replace("$user|$ville|$morea|$pass","$newuser|$villemod|$newimage,$agenew,$gender,$loas|$newpass",$mydata);
        $myfille1 = fopen('BD.txt','w');
        fwrite($myfille1,$mydata);
        fclose($myfille1);
    }
  }
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  

        <form class="form-horizontal d-flex flex-column " action="search.php" enctype="multipart/form-data" method='post'>

        <div class="my-3 mx-auto shadow img-edit" style='box-sizing: border-box;width:100px;height:100px;background:url("img/users/<?=$image?>");border-radius:50px;background-repeat: no-repeat;background-size: cover'>
          <input type='file' style='opacity:0;' name='img' class='my-4'>
          <span class='position-absolute'>
          <i class="fas fa-pencil-alt "></i>
          </span>
        </div>

          <div class="form-group mx-auto w-75">
          <div>
            <input type="text" class="form-control" id="user" name='usrmod' placeholder="Enter new username" require value="<?=$user?>">
            </div>
          </div>
          <div class="form-group mx-auto w-75">
          <div >
          <input type="text" class="form-control" name ='passmod' id="pass" placeholder="Enter new password" require value="<?=$pass?>">
          </div>
          </div>
          <div class="form-group mx-auto w-75">
          <div >
          <input type="text" class="form-control" name ='villemod' id="ville" placeholder="Enter new ville" require value="<?=$ville?>">
          </div>
          </div>
          <div class="form-group mx-auto w-75">
          <div>
          <input type="text" class="form-control" name ='moremod' id="more" placeholder="Enter new age" require value="<?=$userage?>">
          </div>
          </div>
          <button type="submit" class="btn btn-default btn-primary" name="submod">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<section class="py-0 py-xl-5">
	<div class="container">
		<div class="d-felx flex-row justify-content-around row g-4 kiki">
			<!-- Counter item -->
			<div class="col-sm-6 col-xl-3 " style='opacity:80%;'>
				<div class="d-flex justify-content-center align-items-center p-4 bg-warning bg-opacity-15 rounded-3">
					<span class="display-6 lh-1 text-secondry mb-0"><i class="fas fa-tv"></i></span>
					<div class="ms-4 h6 fw-normal">
						<div class="d-flex">
							<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="10" data-purecounter-delay="200" data-purecounter-duration="0">10</h5>
							<span class="mb-0 h5">K</span>
						</div>
						<p class="mb-0 text-white">Online Courses</p>
					</div>
				</div>
			</div>
			<!-- Counter item -->
			<div class="col-sm-6 col-xl-3 " style='opacity:80%;'>
				<div class="d-flex justify-content-center align-items-center p-4 bg-primary bg-opacity-10 rounded-3">
					<span class="display-6 lh-1 text-blue mb-0"><i class="fas fa-user-tie"></i></span>
					<div class="ms-4 h6 fw-normal">
						<div class="d-flex">
							<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="200" data-purecounter-delay="200" data-purecounter-duration="0">200</h5>
							<span class="mb-0 h5">+</span>
						</div>
						<p class="mb-0 text-white">Expert Tutors</p>
					</div>
				</div>
			</div>
			<!-- Counter item -->
			<div class="col-sm-6 col-xl-3 " style='opacity:80%;'>
				<div class="d-flex justify-content-center align-items-center p-4 bg-purple  rounded-3" style='background:#6f42c1;'>
					<span class="display-6 lh-1 text-purple mb-0"><i class="fas fa-user-graduate"></i></span>
					<div class="ms-4 h6 fw-normal">
						<div class="d-flex">
							<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="60" data-purecounter-delay="200" data-purecounter-duration="0">60</h5>
							<span class="mb-0 h5">K+</span>
						</div>
						<p class="mb-0 text-white">Online Students</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>






<div class="content shadow my-5">
<div class="w-50 text-center mx-auto my-2 text-white">
                    <h2 class = "h2-heading">Online service features</h2>
                    <p class = "p-heading text-white">Suspendisse vitae enim arcu. Aliquam convallis risus a felis blandit, at mollis nisi bibendum. Aliquam nec purus at ex blandit posuere nec a odio. Proin lacinia dolor justo</p>
                </div>
  <div class="container form-cont text-left">
    <div class="row justify-content-center">
      <div class="col-md-5">
      <form class="d-flex flex-column" action='search.php' method='POST' id="search-form" >
      <div class="d-flex flex-row " style='gap:1rem;'>
      
      <select id='gate' class="selectpicker form-control shadow my-auto" multiple data-max-options="4" required name='ville[]' >

          <?php
          if(!empty(getdataville()))
          {
            $villearray=getdataville();
            foreach ($villearray as $val) {
              $varupperletter = ucfirst($val);
              echo "<option value=$val>$varupperletter</option>";
            }
          }
          ?>

        </select>
        
      <!-- <input type='text' id="search-field"> -->
      <button  type="button" class="box" id="search-speech"  disabled>
        <i class="fas fa-microphone-alt text-secondary" id='spchicon'></i>
      </button></div>
      <div class='d-flex flex-row my-4 justify-content-between w-100'>

      <input class="btn btn-primary form-control w-50 " type='submit' name='sub' value='submit' id='sub'>
      <a href="search.php?display=all" class='text-white btn btn-warning form-control w-25 mx-auto '>All</a>
      
    
    
    </div>

      </form>

      </div>
    </div>
  </div>



<div class="container my-4" style='border-radius: 10px;background:trapsarent'>
    <div class="d-flex flex-row flex-wrap " style="gap:2%;">
            <?php
                    include_once 'modul.php';
                    if(!empty($_POST['ville']))
                    {
                      $cmp =1; 
                      $cmpaccord =1;  
                      // echo $_POST['ville'];
                        $villesearch = $_POST['ville'];
                        foreach($villesearch as $selectedOption)
                        {
                          if(!empty(search($selectedOption)))
                          {

                            $myarray = search($selectedOption);
  
                            // print_r($myarray);
                            echo "<div class='border p-2 mb-3 bg-white' style='border-radius:10px;width:49%;'><div class='headings d-flex justify-content-center align-items-center mb-3'><h6>The result of <span class='font-weight-bold text-danger'>$selectedOption </span>City</h6></div>";
                            echo "<div id='accord$cmpaccord' class='d-flex flex-column w-100' style='gap:1rem;overflow:auto;height:300px;'>";
                            for($i=0;$i<=count($myarray)-2;$i+=4)
                            {
                                
                              // echo $myarray[$i];
                              // echo $myarray[$i+1];
                              // echo $myarray[$i+2];
                              $indville= $i+1;
                              $moreinfo = explode(',',$myarray[$i+2]);
                              echo "<div class='card mx-auto p-3 w-75 shadow '>
                                  <div id='heading$cmp' class='card-header d-flex justify-content-between align-items-center w-100 h-100'>
                                      <div class='user d-flex flex-row align-items-center'>
                                        <img src='img/users/$moreinfo[0]' width='50' height='50' class='user-img rounded-circle mr-3'>
                                        <span>
                                          <small class='font-weight-bold text-primary'>@$myarray[$i]</small>
                                          <small class='font-weight-bold text-secondary'>From</small>
                                          <small class='font-weight-bold text-dark'>$myarray[$indville]</small>

                                          
                                        </span>
                                      </div>
                                      <small>
                                      <button class='btn btn-link collapsed hover-text-info'  data-toggle='collapse' data-target='#collapse$cmp' aria-expanded='true' aria-controls='collapse$cmp'>
                                      <i class='fas fa-align-right'></i>
                                      </button>
                                    </small>
                                  </div>
                                  <div id='collapse$cmp' class='collapse' style='transition: 1s;' aria-labelledby='heading$cmp' data-parent='#accord$cmpaccord'>
                                    <div class='card-body table-responsive'>
                                    

                                    <table class='table table-sm text-center'>
                                    <thead>
                                      <tr>
                                        <th scope='col'>name</th>
                                        <td>$myarray[$i]</td> 
                                      </tr>
                                      <tr>
                                      <th scope='col'>age</th>

                                      <td>$moreinfo[1]</td>

                                      </tr>
                                      <tr>
                                      <th scope='col'>City</th>
                                      <td>$myarray[$indville]</td>
                                      </tr>

                                      <tr>
                                      <th scope='col'>sexe</th>
                                      <td>$moreinfo[2]</td>

                                      </tr>
                                      <tr>
                                      <th scope='col'>hobbies</th>
                                      <td>$moreinfo[3]</td>

                                      </tr>

                                      
                                    </thead>

                                  </table>


                                    </div>
                                  </div>
                              </div>";
                              $cmp++;
                            }
                            echo'</div></div>';
                            $cmpaccord++;
                          }
                        }
                        // echo testread($_POST['user'],$_POST['pass']);

                    }
                  
                    if(!empty($_GET['display']))
                    {
                      $cmp =1; 
                      $cmpaccord =1;  
                      // echo $_POST['ville'];
                      $villesearch = getdataville();
                        foreach($villesearch as $selectedOption)
                        {
                          if(!empty(search($selectedOption)))
                          {

                            $myarray = search($selectedOption);
  
                            // print_r($myarray);
                            echo "<div class='border p-2 mb-3 bg-white' style='border-radius:10px;width:49%'><div class='headings d-flex justify-content-center align-items-center mb-3'><h6>The result of <span class='font-weight-bold text-danger'>$selectedOption </span>City</h6></div>";
                            echo "<div id='accord$cmpaccord' class='d-flex flex-column w-100' style='gap:1rem;overflow:auto;height:300px;'>";
                            for($i=0;$i<=count($myarray)-2;$i+=4)
                            {
                                
                              // echo $myarray[$i];
                              // echo $myarray[$i+1];
                              // echo $myarray[$i+2];
                              $indville= $i+1;
                              $moreinfo = explode(',',$myarray[$i+2]);
                              echo "<div class='card mx-auto p-3 w-75 shadow '>
                                  <div id='heading$cmp' class='card-header d-flex justify-content-between align-items-center w-100 h-100'>
                                      <div class='user d-flex flex-row align-items-center'>
                                        <img src='img/users/$moreinfo[0]' width='50' height='50' class='user-img rounded-circle mr-3'>
                                        <span>
                                        <small class='font-weight-bold text-primary'>@$myarray[$i]</small>
                                        <small class='font-weight-bold text-secondary'>From</small>
                                        <small class='font-weight-bold text-dark'>$myarray[$indville]</small>
                                        </span>
                                      </div>
                                      <small>
                                      <button class='btn btn-link collapsed hover-text-info'  data-toggle='collapse' data-target='#collapse$cmp' aria-expanded='true' aria-controls='collapse$cmp'>
                                      <i class='fas fa-align-right'></i>
                                      </button>
                                    </small>
                                  </div>
                                  <div id='collapse$cmp' class='collapse' style='transition: 1s;' aria-labelledby='heading$cmp' data-parent='#accord$cmpaccord'>
                                    <div class='card-body'>
                                    

                                    <table class='table table-sm text-center'>
                                    <thead>
                                      <tr>
                                        <th scope='col'>name</th>
                                        <td>$myarray[$i]</td> 
                                      </tr>
                                      <tr>
                                      <th scope='col'>age</th>

                                      <td>$moreinfo[1]</td>

                                      </tr>
                                      <tr>
                                      <th scope='col'>City</th>
                                      <td>$myarray[$indville]</td>
                                      </tr>

                                      <tr>
                                      <th scope='col'>sexe</th>
                                      <td>$moreinfo[2]</td>

                                      </tr>
                                      <tr>
                                      <th scope='col'>hobbies</th>
                                      <td>$moreinfo[3]</td>

                                      </tr>

                                      
                                    </thead>

                                  </table>
      


                                    </div>
                                  </div>
                              </div>";
                              $cmp++;
                            }
                            echo'</div></div>';
                            $cmpaccord++;
                          }
                        }


                    }
            ?>

    </div>
</div>
</div>





<div id='err' class="alert alert-danger w-25 fixed-bottom d-flex mx-auto align-items-center" role="alert">
  <i class="fas fa-exclamation-triangle text-danger display-5 pr-3"></i>
  <div>
  </div>
</div>
<?php
    include_once "fotter.html";
?>
<!-- <link rel="stylesheet" href="fonts/icomoon/style.css"> -->

<link rel="stylesheet" href="css/bootstrap-select.min.css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap-select.min.js"></script>





  <script>
    var voice = {
  // (A) INIT SPEECH RECOGNITION
  sform : null, // HTML SEARCH FORM
  sfield : null, // HTML SEARCH FIELD
  sbtn : document.getElementById("search-speech"), // HTML VOICE SEARCH BUTTON
  recog : null, // SPEECH RECOGNITION OBJECT
  sf:null,
  init : function () {
    // (A1) GET HTML ELEMENTS
    voice.sform = document.getElementById("search-form");
    // voice.sfield = document.getElementById("search-field");
    voice.sf = document.getElementById('gate');
    
    // (A2) GET MICROPHONE ACCESS
    navigator.mediaDevices.getUserMedia({ audio: true }).then((stream) => {
      // (A3) SPEECH RECOGNITION OBJECT + SETTINGS
      const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
      voice.recog = new SpeechRecognition();
      voice.recog.lang = "en-US";
      voice.recog.continuous = false;
      voice.recog.interimResults = false;
      voice.sbtn.onclick = function() {
        voice.start();
      }
      // (A4) POPUPLATE SEARCH FIELD ON SPEECH RECOGNITION
      voice.recog.onresult = (evt) => {
        let said = evt.results[0][0].transcript.toLowerCase();
        document.querySelector(".filter-option-inner-inner").textContent = said;
        // voice.sfield.value = said;
        // aria-expanded
        console.log(said);
        
        voice.sf.value = said;
        // voice.sform.submit();
        // OR RUN AN AJAX/FETCH SEARCH
        voice.stop();
        voice.sbtn.classList.remove('effectactive');
      };

      // (A5) ON SPEECH RECOGNITION ERROR
      voice.recog.onerror = (err) => { console.error(err.error);
      document.querySelector("#err div").textContent = `ERROR:${err.error}.`;

        // document.getElementById("err").children[1].textContent = "Please enable access and attach microphone.";
        document.getElementById("err").classList.add("err");
        setTimeout(()=>{
          document.getElementById("err").classList.remove("err");
        },6000);
      };
 
      // (A6) READY!
      voice.sbtn.disabled = false;
      voice.stop();
    })
    .catch((err) => {
      document.querySelector("#err div").textContent = "Please enable access and attach microphone.";
      document.getElementById("err").classList.add("err");
      setTimeout(()=>{
          document.getElementById("err").classList.remove("err");
        },6000);
      // console.error(err);
      // voice.sbtn.textContent = "Please enable access and attach microphone.";
    });
  },
 
  // (B) START SPEECH RECOGNITION
  start : () => {
    voice.recog.start();
    voice.sbtn.onclick = voice.stop;
    voice.sbtn.classList.add('effectactive');
    document.getElementById("spchicon").classList.remove("text-secondary");
    // voice.sbtn.textContent = "Speak Now Or Click Again To Cancel";
  },
 
  // (C) STOP/CANCEL SPEECH RECOGNITION
  stop : () => {
    voice.recog.stop();
    voice.sbtn.onclick = voice.start;
    voice.sbtn.classList.remove('effectactive');
    document.getElementById("spchicon").classList.add("text-secondary");
    // voice.sbtn.textContent = "Press To Speak";
  }
};
window.addEventListener('DOMContentLoaded', voice.init);


























    let activeelm = document.querySelector('[href="search.php"]');
    let allelm = document.querySelectorAll('.a');
    allelm.forEach(element => {
      element.classList.remove('activeli');
    });
    activeelm.classList.add('activeli');
  </script>
</body>
</html>
