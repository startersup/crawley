<?php
session_destroy() ;
session_start();
include("connect.php");
if(!$conn)
{
    echo("Server Connection failed");
    
}

else
{
 
    if (isset($_REQUEST['pick'])&& isset($_REQUEST['drop'])&& isset($_REQUEST['np'])&& isset($_REQUEST['nl'])&& isset($_REQUEST['date'])) {
    
    $src = $_REQUEST['pick'];
    $des = $_REQUEST['drop']; 
     $via= $_REQUEST['via']; 
     $np = $_REQUEST['np']; 
        $nl=$_REQUEST['nl']; 
         $date=$_REQUEST['date']; 
        $phrs=$_REQUEST['hrs'];
        $pmin=$_REQUEST['min'];
        $tt=":";
        $ptime=$phrs.$tt.$_REQUEST['min']; 
       $q=explode(" ",$date);
  $date=$q[0];
  $ptime=$q[1];
  
   $q=explode(":",$ptime);
   $phrs=$q[0];
   $pmin=$q[1];
        
   //   echo($src);
        
    }
    
   
 
    $rdate="";
    $rptime="";
    
    if (isset($_REQUEST['rdate'])&& isset($_REQUEST['rnp'])&& isset($_REQUEST['rnl']))
 {   
     $rdate=$_REQUEST['rdate']; 
        $rnp=$_REQUEST['rnp'];
        $rnl=$_REQUEST['rnl'];
   //  echo($rdate);    
       //   $rptime=$rphrs.$tt.$_REQUEST['rmin']; 
}
   
    $q=explode(" ",$rdate);
  $rdate=$q[0];
  $rptime=$q[1];
  
$_SESSION["rdate"]=$rdate;
    $_SESSION["rtime"]=$rptime;
 //   echo($rdate);
 //   echo($rptime);
 
 
  //  echo($rpmin);
    
    $jan=5;
    
        date_default_timezone_set('Europe/London');
$thrs = date("H");
$tmin = date("i");
 $tdate= date("m/d/Y");
// echo($date);
$tmin=$tmin-5;


$temp="g-20,g-30,g-40,g-50,g-60,g-75,g-90,g-105,g-120,g-140,g-160,g-180,g-200,g-230,g-260,g-290,g-320,g-350,g-400";

$field = explode(',', $temp);

$per=1;

   if($date<$tdate)
 {
     $per=0;
     
 }
 else
 {
     if($date==$tdate)
     {
         if($phrs<$thrs)
         {
             $per=0;
         }
         else
         {
            if($phrs==$thrs)
         { 
             
             
           if($pmin<$tmin)
           {
               $per=0;
           }
         }  
         }
     }
 }
 $per=1;
 if(($per==0))
    {
        //echo($thrs);
        echo('<center><div class="alert alert-success" style="width:60%;margin-top:90px;">
   <h3>Date/Time You entered has expired please enter a valid date/time</h3>
</div></center>');
    }
    else
    {
 
 
 
    
  // echo($via);
   $cc="  ";
   
       $s="";
     $d="";
     $v="";
     $tst="";
     

for($i=0;$i<strlen($src);$i++)
 {
     $a=ord($src[$i]);
     if((($a>96)&&($a<123)) || (($a>64)&&($a<91)) || (($a>47)&&($a<58)))
     {
         $s=$s.$src[$i];
     }
     else
     {
         $s=$s."%20";
     }
 }
 
 
 for($i=0;$i<strlen($des);$i++)
 {
     $a=ord($des[$i]);
     //echo('</br>');
    // echo($des[$i]);
     if((($a>96)&&($a<123)) || (($a>64)&&($a<91)) || (($a>47)&&($a<58)))
     {
         $d=$d.$des[$i];
     }
     else
     {
         $d=$d."%20";
     }
 }
 
 
 
 
 for($i=0;$i<strlen($via);$i++)
 {
     $a=ord($via[$i]);
     //echo('</br>');
    // echo($des[$i]);
     if((($a>96)&&($a<123)) || (($a>64)&&($a<91)) || (($a>47)&&($a<58)))
     {
         $v=$v.$via[$i];
     }
     else
     {
         $v=$v."%20";
     }
 }
 
 

 
 
 $test="Gatwick Airport Station, Crawley, United Kingdom";
 
 for($i=0;$i<strlen($test);$i++)
 {
     $a=ord($test[$i]);
     //echo('</br>');
    // echo($des[$i]);
     if((($a>96)&&($a<123)) || (($a>64)&&($a<91)) || (($a>47)&&($a<58)))
     {
         $tst=$tst.$test[$i];
     }
     else
     {
         $tst=$tst."%20";
     }
 }
 
// echo($d);

   // echo($geocode);
 $q = "https://maps.googleapis.com/maps/api/directions/json?origin=".$s."&destination=".$tst."&key=AIzaSyCV_e29ZNv8f0S3-2IzNwIPqc-ycslxNBE"; 

  
      //    echo($q);
                
    $json = file_get_contents($q);
   //echo($json);
    $details = json_decode($json);
   // echo($details);
   //$distance=int();
    $distance=$details->routes[0]->legs[0]->distance->value;
    $time=$details->routes[0]->legs[0]->duration->text;
        $th=1609.344;
   $distance=$distance/$th;
   //echo($distance);
  $distancesrc=round($distance,2);
  
   $q = "https://maps.googleapis.com/maps/api/directions/json?origin=".$s."&destination=".$tst."&key=AIzaSyCV_e29ZNv8f0S3-2IzNwIPqc-ycslxNBE"; 


 
  // echo($q);
                
    $json = file_get_contents($q);
   //echo($json);
    $details = json_decode($json);
   // echo($details);
   //$distance=int();
    $distance=$details->routes[0]->legs[0]->distance->value;
    $time=$details->routes[0]->legs[0]->duration->text;
        $th=1609.344;
   $distance=$distance/$th;
   //echo($distance);
  $distancedes=round($distance,2);
    
    
    
    if(1)
    {
/*-----------------------------------------done check----------------------------------------------*/
    
   // echo($geocode);

 $q = "https://maps.googleapis.com/maps/api/directions/json?origin=".$s."&destination=".$d."&key=AIzaSyCV_e29ZNv8f0S3-2IzNwIPqc-ycslxNBE"; 

  
        //         echo("<br>");
    $json = file_get_contents($q);
        
  // echo($json);
  //  echo("<br>");
        
    $details = json_decode($json);
        
   //echo($details);
  //   echo("<br>");
        
   //$distance=int();
    $distance=$details->routes[0]->legs[0]->distance->value;
    $time=$details->routes[0]->legs[0]->duration->text;
        $th=1609.344;
   $distance=$distance/$th;
   //echo($distance);
  $distance=round($distance,2);
        
      // echo($distance);
  
if($via!="")
{
    
 $q = "https://maps.googleapis.com/maps/api/directions/json?origin=".$s."&destination=".$v."&key=AIzaSyCV_e29ZNv8f0S3-2IzNwIPqc-ycslxNBE"; 

     
          // echo($q);
                
    $json = file_get_contents($q);
   //echo($json);
    $details = json_decode($json);
   // echo($details);
   //$distance=int();
   $distance=$details->routes[0]->legs[0]->distance->value;
   // $time=$details->rows[0]->elements[0]->duration->text;
        $th=1609.344;
   $distance=$distance/$th;
   //echo($distance);
  $distance=round($distance,2);
  
     
   
      $q = "https://maps.googleapis.com/maps/api/directions/json?origin=".$v."&destination=".$d."&key=AIzaSyCV_e29ZNv8f0S3-2IzNwIPqc-ycslxNBE"; 
          //  echo($q);
                echo("<br>"); 
    $json = file_get_contents($q);
  //echo($json); echo("<br>");
    $details = json_decode($json);
  //  echo($details); echo("<br>");
   //$distance=int();
    $distance2=$details->routes[0]->legs[0]->distance->value;

  // $time=$details->rows[0]->elements[0]->duration->text;
        $th=1609.344;
   $distance2=$distance2/$th;
   //echo($distance);
  $distance2=round($distance2,2);
  
  $distance=$distance+$distance2;
    
   // echo($distance);
     
 }
 
 $row=0;
 
 
  
  if(($distance<=60)&&($distance>20))
  {
      $myd=20;
      while($myd<$distance)
      {
          $myd +=10;
          $row +=1;
          $reduction=0.15;
      }
  }
  else
  {
      if(($distance<=120)&&($distance>60))
  {
      $myd=60;
      $row=4;
      while($myd<$distance)
      {
          $myd +=15;
          $row +=1;
          $reduction=0.02;
      }
  }
  
   else
   {
       if(($distance<=200)&&($distance>120))
  {
      $myd=120;
      $row=8;
      while($myd<$distance)
      {
          $myd +=20;
          $row +=1;
                $reduction=-0.10;
      }
  }
  
  else
  {
       if(($distance<=350)&&($distance>200))
  {
      $myd=200;
      $row=12;
      while($myd<$distance)
      {
          $myd +=30;
          $row +=1;
                        $reduction=-0.15;
  
      }
  }
  else
  {
      if($distance<=400)
      {
          $row=18;
                        $reduction=-0.20;
  
      }
      else
      {
            $row=19;
                          $reduction=0.10;
  
      }
  }
      
  }
  
   }
  }
  
  
   // echo($np);
   // ec//ho($nl);
    
if(($np<5)&&($nl<5))
{
    $result=  mysqli_query($conn,"SELECT * from cars WHERE (`status` =2) or (`status` =3) or (`status` =4)  ORDER BY status ASC");
  $result2=  mysqli_query($conn,"SELECT * from cars WHERE (`status` =2) or (`status` =3) or (`status` =4) ORDER BY status ASC");
}
else
{
    if(($np<7)&&($nl<6))
    {
        $result=  mysqli_query($conn,"SELECT * from cars WHERE (`status` =6) or (`status` =7) ORDER BY status ASC");
        $result2=  mysqli_query($conn,"SELECT * from cars WHERE (`status` =6) or (`status` =7) ORDER BY status ASC");
  
    }
    else
    {
         $result=  mysqli_query($conn,"SELECT * from cars WHERE `status` =8 ORDER BY status ASC");
         $result2=  mysqli_query($conn,"SELECT * from cars WHERE `status` =8 ORDER BY status ASC");
 
    }
}
  
  
  
  //echo($cost);
  //Use round()


    
   // echo(number_format($ditance*6.21371, 0));
  
  
 /** while ($row= mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 
                        $agency = $row["agency"];
			$type= $row["type"];
                        // $team["price"] = $row["price"];
		echo($agency);
		echo($type);
    
 }**/
 
 if($distance>0)
 {
 
?> 



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gatwick Airport Taxis </title>
   <link rel="icon" href="./images/icon.png" type="image/gif" sizes="16x16">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css?family=Muli|Niramit|Open+Sans|Roboto" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>  
<body>

<section class="quote">
<div class="row">
 
<div class="col-md-8 nopadding heighto">
       <div class="card">
           
                                               <?php                           
                       if(($rdate=="")&&($rptime==""))
  {
  ?>
           
           <p class="dynamic">Taxi Booking From <b> <?php echo $src; ?> </b> to <b><?php echo $des; ?> </b> on <?php echo($date); ?> Time:<?php echo($time); ?>  </p>
       <?php
  }
     else
     {
         ?>
           
          <p class="dynamic">Taxi Booking From <b> <?php echo $src; ?> </b> to <b><?php echo $des; ?> </b> at <?php echo($time); ?> on <?php echo($date); ?></p>
           
         <p class="dynamic">Taxi Booking Return From <b> <?php echo $des; ?> </b> to <b><?php echo $src; ?> </b> at <?php echo($rptime); ?> on <?php echo($rdate); ?></p>
           
              <?php         
         
          
     }
                       ?>  
           
       </div>
    
       <div class="booknow Container">
           
          <?php
    while ($rowss= mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 
            $agency = $rowss["agency"];
			$type= $rowss["type"];
			$status=$rowss["status"];
     
     if($agency=="Britannia Cars")
     {
    
			
    ?>           
           
       <div class="card inspad" style="margin-top:-10px;">
         <center> 20% Discount on christmas ( Minimum Debit Payment Required )</center>
       </div>
       <div class="card infopad"><div class="row"><div class="col-md-2 col-xs-3"><center><img class="taxi" src="https://heathrowairport-taxis.co.uk/images/images/<?php echo ($status); ?>.png" ></center></div>
       <div class="col-md-2 col-xs-4"><?php echo ($agency); ?><br>
           
           
           <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span></div>
   
              <?php  
   
   $cost=($rowss["base"]/2)+0.2356;
   
   if(($distance>1)&&($distance<5))
   {
      
       $cost=$cost+($distance*2);
       
   }
   
   if(($distance>=5)&&($distance<11))
   {
      
       $cost=$cost*2;
       
   }
   else
   {
      
       if(($distance>10)&&($distance<21))
   {
       $cost=($rowss["base"])+0.2356;
       $cost=$cost-5+$distance;
   }
       
       if($distance>20)
       {
       $cost=0;
       $req=$row-1;
       $req=$field[$req];
       $price=$rowss[$req];
      // echo($price);
       
       $price=$price-$reduction+($status/100);
     // echo($reduction);
       // echo($price);  
       $cost=$distance*$price;
       
       }
   }
                   
                //   if(($distance>20)&&($distance<=100))
                //   {
                //       $cost=$distance+25;
                //   }
                   
                //   if(($distance>100)&&($distance<=200))
                //   {
                //       $cost=$distance+40;
                //   }
                   
                //   if(($distance>200)&&($distance<=300))
                //   {
                //       $cost=$distance+65;
                //   }
                   
                //   if(($distance>300)&&($distance<=400))
                //   {
                //       $cost=$distance+85;
                //   }
                   
                   
                   
                   
                  
            /*       offer or poromocode management
            
                   $discount=$cost/100;
                   $discount=$discount*5;
                   $cost=$cost+$discount;
                   */
                   
                  // echo($date);
                  if($date=="12/24/2017")
                  {
                     // echo($date);
                      if($phrs>=18)
                      {
                         // echo($date);
                           $cost=$cost*(1.5);
                      }
                  
                   //echo("dd");
                  }
                    if($date=="12/25/2017")
                  {
                      
                           $cost=$cost*2;
                      
                  
                   //echo("dd");
                  }
                  
                    if($date=="12/26/2017")
                  {
                      
                           $cost=$cost*(1.5);
                   //echo("dd");
                  }
                  
                    if($date=="12/31/2017")
                  {
                      if(($phrs>=18)&&($phrs<=21))
                      {
                           $cost=$cost*(1.5);
                      }
                      else
                      {
                          if($phrs>21)
                          {
                              $cost=$cost*2;
                          }
                      }
                  
                   //echo("dd");
                  }
                  
                 $cost= $cost;
                 $check1="london";
                 $check2="London";
                 $check3="LONDON";
                 $check=0;
                 if ((strpos($src, $check1) !== false)||(strpos($src, $check2) !== false)||(strpos($src, $check3) !== false))
  {
      $check=1;
      
     // echo("taddadada");
  }
                 
                        if ((strpos($des, $check1) !== false)||(strpos($des, $check2) !== false)||(strpos($des, $check3) !== false))
  {
      $check=1;
  }
  
  if($check==1)
  {
     // $cost=$cost*1.35;
  }
 // echo($rptime);
  if(($rdate=="")&&($rptime==""))
  {
  
              // echo("check1");
                $cost=number_format($cost,2);
  }
     else
     {
         
          // echo("check2");
         $cost=$cost*2;
          $cost=number_format($cost,2);
     }
                       ?>
  
  
 
           
        <div class="col-md-2 col-xs-5">Saloon Car<br><i class="fa fa-user"></i>x 4 <i class="fa fa-suitcase"></i> x 2</div>
        <div class="col-md-2 col-xs-4">Total Fare<br>£<?php echo ($cost); ?></div>
           
           
        <div class="col-md-3 col-xs-8">
            
             <form id="book" action="book_taxi.php" method="POST">
                                         <input type="hidden" value="<?php echo $src; ?>" name="start">
                                             <input type="hidden" value="<?php echo $des; ?>" name="end">
                                             <input type="hidden" value="<?php echo $via; ?>" name="via">
                                             <input type="hidden" value="<?php echo $np; ?>" name="np">
                                             <input type="hidden" value="<?php echo $nl; ?>" name="nl">
                                             
                                               <input type="hidden" value="<?php echo $distance; ?>" name="dist">
                                             
                                             <input type="hidden" value="<?php echo ($date); ?>" name="dt">
                                             <input type="hidden" value="<?php echo ($ptime); ?>" name="pt">
                                             <input type="hidden" value="<?php echo $time; ?>" name="time">
                                             
                                             <input type="hidden" value="<?php echo $type; ?>" name="type">
                                             <input type="hidden" value="<?php echo $agency; ?>" name="agency">
                                             
                                             <input type="hidden" value="<?php echo ($cost); ?>" name="fare">
                                                          
                      <center><button class="btn btn-success rigid">Book Now</button> <button class="btn btn-primary rigid">Email Quote</button></center>
                          </form>
            
            </div><br><br>
    </div></div>
           
                     
 
 <?php }
    else
     {
    
			
    ?>                  
      <br>
                    
       <div class="card inspad" style="margin-top:-10px;">
         <center> 20% Discount on christmas ( Minimum Debit Payment Required )</center>
       </div>
       <div class="card infopad"><div class="row"><div class="col-md-2 col-xs-3"><center><img class="taxi" src="https://heathrowairport-taxis.co.uk/images/images/<?php echo ($status); ?>.png" ></center></div>
       <div class="col-md-2 col-xs-4"><?php echo ($agency); ?><br>
           
           
           <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span></div>
   
              <?php  
   
   $cost=($rowss["base"]/2)+0.2356;
   
   if(($distance>1)&&($distance<5))
   {
      
       $cost=$cost+($distance*2);
       
   }
   
   if(($distance>=5)&&($distance<11))
   {
      
       $cost=$cost*2;
       
   }
   else
   {
      
       if(($distance>10)&&($distance<21))
   {
       $cost=($rowss["base"])+0.2356;
       $cost=$cost-5+$distance;
   }
       
       if($distance>20)
       {
       $cost=0;
       $req=$row-1;
       $req=$field[$req];
       $price=$rowss[$req];
      // echo($price);
       
       $price=$price-$reduction+($status/100);
     // echo($reduction);
       // echo($price);  
       $cost=$distance*$price;
       
       }
   }
                   
                //   if(($distance>20)&&($distance<=100))
                //   {
                //       $cost=$distance+25;
                //   }
                   
                //   if(($distance>100)&&($distance<=200))
                //   {
                //       $cost=$distance+40;
                //   }
                   
                //   if(($distance>200)&&($distance<=300))
                //   {
                //       $cost=$distance+65;
                //   }
                   
                //   if(($distance>300)&&($distance<=400))
                //   {
                //       $cost=$distance+85;
                //   }
                   
                   
                   
                   
                  
            /*       offer or poromocode management
            
                   $discount=$cost/100;
                   $discount=$discount*5;
                   $cost=$cost+$discount;
                   */
                   
                  // echo($date);
                  if($date=="12/24/2017")
                  {
                     // echo($date);
                      if($phrs>=18)
                      {
                         // echo($date);
                           $cost=$cost*(1.5);
                      }
                  
                   //echo("dd");
                  }
                    if($date=="12/25/2017")
                  {
                      
                           $cost=$cost*2;
                      
                  
                   //echo("dd");
                  }
                  
                    if($date=="12/26/2017")
                  {
                      
                           $cost=$cost*(1.5);
                   //echo("dd");
                  }
                  
                    if($date=="12/31/2017")
                  {
                      if(($phrs>=18)&&($phrs<=21))
                      {
                           $cost=$cost*(1.5);
                      }
                      else
                      {
                          if($phrs>21)
                          {
                              $cost=$cost*2;
                          }
                      }
                  
                   //echo("dd");
                  }
                  
                 $cost= $cost;
                 $check1="london";
                 $check2="London";
                 $check3="LONDON";
                 $check=0;
                 if ((strpos($src, $check1) !== false)||(strpos($src, $check2) !== false)||(strpos($src, $check3) !== false))
  {
      $check=1;
      
     // echo("taddadada");
  }
                 
                        if ((strpos($des, $check1) !== false)||(strpos($des, $check2) !== false)||(strpos($des, $check3) !== false))
  {
      $check=1;
  }
  
  if($check==1)
  {
     // $cost=$cost*1.35;
  }
 // echo($rptime);
  if(($rdate=="")&&($rptime==""))
  {
  
              // echo("check1");
                $cost=number_format($cost,2);
  }
     else
     {
         
          // echo("check2");
         $cost=$cost*2;
          $cost=number_format($cost,2);
     }
                  
            $ran=mt_rand(2,6);      
         $cost= $cost+$ran;
         
           ?>
  
  
 
           
        <div class="col-md-2 col-xs-5">Saloon Car<br><i class="fa fa-user"></i>x 4 <i class="fa fa-suitcase"></i> x 2</div>
        <div class="col-md-2 col-xs-4">Total Fare<br>£<?php echo ($cost); ?></div>
           
           
        <div class="col-md-3 col-xs-8">
            
             <form id="book" action="book_taxi.php" method="POST">
                                         <input type="hidden" value="<?php echo $src; ?>" name="start">
                                             <input type="hidden" value="<?php echo $des; ?>" name="end">
                                             <input type="hidden" value="<?php echo $via; ?>" name="via">
                                             <input type="hidden" value="<?php echo $np; ?>" name="np">
                                             <input type="hidden" value="<?php echo $nl; ?>" name="nl">
                                             
                                               <input type="hidden" value="<?php echo $distance; ?>" name="dist">
                                             
                                             <input type="hidden" value="<?php echo ($date); ?>" name="dt">
                                             <input type="hidden" value="<?php echo ($ptime); ?>" name="pt">
                                             <input type="hidden" value="<?php echo $time; ?>" name="time">
                                             
                                             <input type="hidden" value="<?php echo $type; ?>" name="type">
                                             <input type="hidden" value="<?php echo $agency; ?>" name="agency">
                                             
                                             <input type="hidden" value="<?php echo ($cost); ?>" name="fare">
                                                          
                      <center><button class="btn btn-success rigid">Book Now</button> <button class="btn btn-primary rigid">Email Quote</button></center>
                          </form>
            
            </div><br><br>
    </div></div>
           
          <?php
         
         }
 }
     ?>
           
       </div>
    </div>
    <div class="col-md-4 nopadding">
            <div id="map"></div>
</div>
</div>
</section>
   <?php
	
	if($via!="")
	{
	
	?>
  <script>
    var directionsDisplay;
    var directionsService;
    var map;

    function initMap() {
      directionsService = new google.maps.DirectionsService;
       var myLatLng = {lat: 51.5287352, lng: -0.3817888};
      var chicgo = new google.maps.LatLng(51.5287352, -0.3817888);
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center:myLatLng
      });
      directionsDisplay = new google.maps.DirectionsRenderer({
        map: map
      });
      calcRoute();
    }
    
   
    var waypoints = [];
    var address="<?php echo($via); ?>";
    waypoints.push({
            location: address,
            stopover: true
        });
       

    function calcRoute() {
      var start = "<?php echo($src); ?>";
      var end =  "<?php echo($des); ?>";
     // var via="<?php echo($via); ?>";
      var request = {
        origin: start,
        destination: end,
      waypoints: waypoints,
      optimizeWaypoints: true,
       travelMode: google.maps.DirectionsTravelMode.DRIVING
      };
      directionsService.route(request, function(result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
         directionsDisplay.setDirections(result);
        }
      });
    };
  </script>
  
  <?php }
  
  else
  
  {
  
  
  ?> 	
  <script>
    var directionsDisplay;
    var directionsService;
    var map;

    function initMap() {
      directionsService = new google.maps.DirectionsService;
        var myLatLng = {lat: 51.5287352, lng: -0.3817888};
      var chicgo = new google.maps.LatLng(51.5287352, -0.3817888);
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center:myLatLng
      });
      directionsDisplay = new google.maps.DirectionsRenderer({
        map: map
      });
      calcRoute();
      
      
   
    }

    function calcRoute() {
      var start = "<?php echo($src); ?>";
      var end =  "<?php echo($des); ?>";
      var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING
      };
      directionsService.route(request, function(result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(result);
        }
      });
    };
  </script>

<?php } ?>
    
     <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCV_e29ZNv8f0S3-2IzNwIPqc-ycslxNBE&callback=initMap"></script>
</body></html>
   
 <?php }
        
        else
        
        {
             echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Sorry!!!! Your internet is too slow Kindly refresh...');
    
    </SCRIPT>");
        }
    }
        
        else
        {
         
       echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Sorry!!!! Provider not available from your location...');
    window.location.href='index.html';
    </SCRIPT>");
    }

    
}

}?>




