<!doctype html>
<!-- header and menu -->
<html lang="en">
     <head>
          <meta charset="utf-8">
          <title>mSupply Material Calculator</title>
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
          <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
          <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

          <link rel="stylesheet" href="../css/style.css">
          <script src="../js/avish-script.js"></script>
          <script src="angular.min.js"></script>
     </head>
     
     <body>  
          <div class = "container av-calc" > 
              <div class="logo-row">
				<div><img src='../images/logo.png'></div>
			  </div>
				<a href="http://www.msupply.com/" class="go-home"><img src='../images/home_icon.png'></a>
                   <div class = "col-lg-2 col-md-2 col-sm-2 menu-left" style="margin-top: 2px;">
                       <div class="row" style="margin-top:0px;">
                         <nav class="navbar navbar-default">
                              <div class="container-fluid">
                                   <!-- Brand and toggle get grouped for better mobile display -->
                                   <div class="navbar-header">
                                        <h5 class="cal_header">Calculators</h5>
										<button type="button" class="navbar-toggle collapsed dropdown-toggle" data-toggle="collapse" data-target="#calculator-menu" aria-expanded="false">
                                             <span class="sr-only">Toggle navigation</span>
                                             <span class="icon-bar"></span>
                                             <span class="icon-bar"></span>
                                             <span class="icon-bar"></span>
                                        </button>
                                        <!--<a class="navbar-brand col-xs-12 col-md-12 heading-text" href="#" style="text-align: center;">Calculators</a>-->
                                        
                                        <!-- Collect the nav links, forms, and other content for toggling -->
                                        <div class="collapse navbar-collapse" id="calculator-menu">
                                             <ul class="nav navbar-nav">
                                                  <li <?php
                                                  if ($current == 'plain_cement_concrete') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../plain_cement_concrete">Concrete-PCC </a></li>
                                                  <li <?php
                                                  if ($current == 'concrete-rcc') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../concrete-rcc">Concrete-RCC </a></li>
                                                  <li <?php
                                                  if ($current == 'rebar-tmt-steel') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../rebar-tmt-steel">TMT Steel / Rebar calc </a></li>

<!--                                                  <li <?php
                                                  if ($current == 'random_rubble_masonry') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../random_rubble_masonry">Stone wall(SSM/RRM)  </a></li>-->
                                                  <li <?php
                                                  if ($current == 'block-work') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../block-work">Brick/Block </a></li>
<!--                                                  <li <?php
                                                  if ($current == 'plaster') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../plaster">Plaster</a></li>
                                                  <li <?php
                                                  if ($current == 'building-material') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../soling">Soling</a></li>

                                                  <li <?php
                                                  if ($current == 'electrical-points-switches') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../electrical-points-switches">Electrical Points/Switches</a></li>
                                                  
                                                    <li <?php
                                                  if ($current == 'light-fan-fittings') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../light-fan-fittings">Light & fan fittings</a></li>
                                                    
                                                      <li <?php
                                                  if ($current == 'kitchen-solution') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../kitchen-solution">Kitchen Solution</a></li>
                                                      
                                                      <li <?php
                                                  if ($current == 'bath-room-fittings') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../bath-room-fittings">Bath room fittings</a></li>-->

                                                  <li <?php
                                                  if ($current == 'flooring-tiles') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../flooring-tiles">Ceramic/Vitrified tile Flooring </a></li>
                                                  <li <?php
                                                  if ($current =='flooring-granite') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../flooring-granite"> Granite/Marble Flooring </a></li>
<!--                                                  <li <?php
                                                  if ($current == 'Wooden-floooring') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../Wooden-floooring">Wooden floooring</a></li>
                                                  <li <?php
                                                  if ($current == 'paving') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../paving">Interlock pavers</a></li>
                                                  <li <?php
                                                  if ($current == 'carpentery-works') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../carpentery-works">Carpentery(interiors)</a></li>
                                                  
                                                  <li <?php
                                                  if ($current == 'doors') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../doors">Doors</a></li>
                                                  
                                                    <li <?php
                                                  if ($current == 'windows') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../windows">Windows</a></li>
                                                    
                                                  <li <?php
                                                  if ($current == 'Paints-emulsion/texture/distemper') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../Paints-emulsion/texture/distemper">Paints</a></li>
                                            
                                                  <li <?php
                                                  if ($current == 'roofing') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../roofing">Roofing</a></li>
                                                  
                                                  <li <?php
                                                  if ($current == 'hardware') {
                                                       echo 'class="current"';
                                                  }
                                                  ?>><a href="../hardware">Hardware</a></li>-->
                                             </ul>
                                        </div>
                                   </div><!-- /.navbar-collapse -->
                              </div><!-- /.container-fluid -->
                         </nav>
                       </div>
                       </div> <!--menu ends here -->