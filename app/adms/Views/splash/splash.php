<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<style type="text/css">
* {box-sizing: border-box;}
body {
 margin: 0;
 padding: 0;
 font-family: monospace;
}
.preload{
 width: 100%;
 height: 100%;
 background: #f2f1f1;
 position: fixed;
 top: 0;
 left: 0;
 z-index: 1;
}
.logo {
 
 width: 200px;
 height: 70px;
 margin: 150px  50px auto;
 font-size: 50px;
 text-shadow: -1px 2px 2px #000;
 text-align: center;
 color: white;
}
.loader-frame {
 width: 70px;
 height: 70px;
 margin: auto;
 position: relative;
}
.loader1, .loader2 {
 position: absolute;
 border: 5px solid transparent;
 border-radius: 50%;
}
.loader1 {
 width: 70px;
 height: 70px;
 border-top: 5px solid azure;
 border-bottom: 5px solid azure;
 animation: clockwisespin 2s linear 3;
}
.loader2 {
 width: 60px;
 height: 60px;
 border-left: 5px solid darkturquoise;
 border-right: 5px solid darkturquoise;
 top: 5px; left: 5px;
 animation: anticlockwisespin 2s linear 3;
}


@keyframes clockwisespin {
 from {transform: rotate(0deg);}
 to {transform: rotate(360deg);}
}
@keyframes anticlockwisespin {
 from {transform: rotate(0deg);}
 to {transform: rotate(-360deg);}
}
@keyframes fadeout {
 from {opacity: 1;}
 to {opacity: 0;}
}
    </style>



 </head>

 <body>

<div class = "preload" id = "preload">
  <div class ="logo" align="center">
     <!-- <img class="mb-4" style="width: 1240px; height: 380px;" src="<?php echo URLADM . 'assets/imagens/icone/gepro.png'; ?>" alt="FAA" >!-->
    
      </div><br>
   <div class = "loader-frame">
    <div class = "loader1" id = "loader1"></div>
    <div class = "loader2" id = "loader2"></div>
   </div><br><br><br><br><br><br><br><br><br>><br><br><br>
   <footer align="center">
       &copy; Direcção de Informática - EMG Todos Direitos Reservados
    </footer>
 </div>

<script type="text/javascript">

(function(){
 
 var preload = document.getElementById("preload");
 var loading = 0;
 var id = setInterval(frame, 64);

 function frame(){
  if(loading == 100) {
   clearInterval(id);
   window.open("http://localhost/gepro/home/index", "_self");
  }
  else {
   loading = loading + 1;
   if(loading == 90) {
    preload.style.animation = "fadeout 1s ease";
   }
  }
 }


})();


    </script>
    
   
 </body>
