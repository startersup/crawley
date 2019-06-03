<?php

session_start();

include("connect.php");
if(!$conn)
{
    echo("Server Connection failed");
    
}

else
{
    
   // $src="dsdg"; 
    if (isset($_REQUEST['start'])&&isset($_REQUEST['end'])&&isset($_REQUEST['via'])&& isset($_REQUEST['dt'])&& isset($_REQUEST['pt'])&& isset($_REQUEST['np'])&& isset($_REQUEST['nl'])&& isset($_REQUEST['type'])&& isset($_REQUEST['time'])&& isset($_REQUEST['agency'])&& isset($_REQUEST['fare'])&& isset($_REQUEST['dist'])) 
    {
    $src = $_REQUEST['start'];
    $des = $_REQUEST['end']; 
    $dt= $_REQUEST['dt']; 
     $pt= $_REQUEST['pt']; 
     $np = $_REQUEST['np']; 
        $nl=$_REQUEST['nl']; 
         $type=$_REQUEST['type']; 
        $time=$_REQUEST['time'];
       $agency= $_REQUEST['agency'];
         $fare=$_REQUEST['fare'];
       $dist=$_REQUEST['dist'];
        $via=$_REQUEST['via'];
    }
    
    $src = $_REQUEST['start'];
    $des = $_REQUEST['end']; 
    $dt= $_REQUEST['dt']; 
     $pt= $_REQUEST['pt']; 
     $np = $_REQUEST['np']; 
        $nl=$_REQUEST['nl']; 
         $type=$_REQUEST['type']; 
        $time=$_REQUEST['time'];
       $agency= $_REQUEST['agency'];
         $fare=$_REQUEST['fare'];
       $dist=$_REQUEST['dist'];
        $via=$_REQUEST['via'];
    
     $apply=$_REQUEST['promo'];
    
    if($via=="")
    {
        $via="N/A";
    }
    
    
$rdate=$_SESSION["rdate"];
$rptime=$_SESSION["rtime"];
  // echo($src);echo($des);echo($dt);echo($np);echo($nl);echo($type);echo($time);echo($src);echo($agency);
   //echo($via);
 
 $cc=" ";
   
 ?>  
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Crawley Taxis</title>
    <meta charset="utf-8">
    <link rel="icon" sizes="57x57" href="./assets/images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
<link rel="stylesheet" href="./assets/css/media.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                </button>
                <a class="navbar-brand" href="#">Crawley <span>Taxis</span></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="#">Home</a>
                    </li>
                    <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">Services <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Airport Transfers</a></li>
            <li><a href="#">Train Station Transfers</a></li>
              <li><a href="#">Cruise Station Transfers</a></li>
              <li><a href="#">School Transfers</a></li>
              <li><a href="#">Corporate Bookings</a></li>
          </ul>
        </li>
           <li><a href="#">Areas covering</a>
                    </li>
                    <li><a href="#">Counties</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Sign Up</a>
                    </li>
                    <li><a href="#"> Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
 <!--mainsection-->
 <section class="info container">
        <div class="row">
            <div class="col-md-7">
                <form action="conform.php" method="Request" style=" background-color:#f4f4f4;">
                    <h3 class="text-secondary">Journey Information</h3>
        <input type="hidden" value="<?php echo $src; ?>" name="start">
                                             <input type="hidden" value="<?php echo $des; ?>" name="end">
                                              <input type="hidden" value="<?php echo $via; ?>" name="via">
                                             <input type="hidden" value="<?php echo $np; ?>" name="np">
                                             <input type="hidden" value="<?php echo $nl; ?>" name="nl">
                                             
                                             <input type="hidden" value="<?php echo $dt; ?>" name="dt">
                                             <input type="hidden" value="<?php echo $pt; ?>" name="pt">
                                             <input type="hidden" value="<?php echo $time; ?>" name="time">
                                              <input type="hidden" value="<?php echo $dist; ?>" name="dist">
                                             <input type="hidden" value="<?php echo $type; ?>" name="type">
                                             <input type="hidden" value="<?php echo $agency; ?>" name="agency">
                                             
                                             <input type="hidden" value="<?php echo ($fare); ?>" name="fare">
                   <div class="card infotab">
                       
         <?php       if($_SESSION["access"]!=="give")
                                      {
                                          ?>   
                                            <input type="hidden" value="<?php echo ($fare); ?>" id="fare" name="fare">
                                            
                                           <?php
                                           
                                           }
                                        else
                                        {
                                        
                                        ?>
                          
                          <div class="row">
                           <label>Fare:</label>
                   <input type="text" class="controls" id="fare" name="fare" placeholder="Enter Passenger Name">
                          </div>
                          
                            <?php
                                        }
                                        ?>
                          
                          
                       <div class="row">
               <div class="col-md-6 ">
                   <label>Passenger Name:</label>
                   <input type="text" name="name" class="controls" placeholder="Enter Passenger Name" required >
                       </div>
                               <div class="col-md-6">
                   <label >Passenger  Email:</label>
                   <input type="email" class="controls" name="mail"  placeholder="Enter Passenger Email" required >
                       </div></div> 
                        <div class="row">
                             <div class="col-md-6 ">
                   <label >Contact Number:</label>
                   <input type="text" class="controls" name="number1"  placeholder="Enter Passenger Contact" value="+44" required  >
                       </div>
                            <div class="col-md-6 ">
                   <label >Alternate Number:</label>
                   <input type="text" class="controls" name="number2"   placeholder="Enter Alternate Contact" value="+44" required  >
                            </div></div>
                           <div class="row">
                             <div class="col-md-6">
                   <label >Pickup Full Address:</label>
                   <input type="text" class="controls" name="address1"  placeholder="Eg:Building Number, Flat No" required  >
                       </div>
                            <div class="col-md-6">
                   <label >Dropoff Full Address:</label>
                   <input type="text" name="address2" class="controls" placeholder="Eg:Building Number, Flat No" required  >
                            </div></div>
                          
                             <div class="row">
                             <div class="col-md-6">
                   <label >Meet & Greet(£10.00):</label>
                   <select  name="check"  class="select selectit controls">
               <option value="0">No I don't Need </option>
               <option value="10">Yes I Need Meet & Greet.</option>
             </select>
                       </div>
                            <div class="col-md-6 ">
                   <label >Child Seat(£5.00 each):</label>
                   <select  name="child"  class="select selectit controls">
<option value="0" disabled ><!--select--></option>
               <option value="1">1 </option>
               <option value="2">2</option>
             </select>
                            </div></div>
                             <div class="row">
                             <div class="col-md-6 ">
                   <label >Flight Details:</label>
                   <input type="text"  name="pickup" class="controls"  placeholder="Eg: B789" >
                       </div>
                            <div class="col-md-6 ">
                   <label >Payment Mode:</label>
             <select  name="payment" class="select selectit controls" required  >
<option value="0" disabled ><!--select--></option>
                 <option value="debit">Debit / Credit Card (3% Admin Charges)</option>
               <option value="paypal">Paypal Transaction(5% Card Charges)</option>
               <option value="cash">Cash on Ride (Deposit Required)</option>
             </select>
                            </div></div>
                                 <div class="row">
                                       <div class="col-md-12"><br>
                                 <label >Special information to us (optional):</label>
                                   <textarea class="select controls textarea" name="info" rows="8" id="comment"></textarea>
                                     </div></div>
                           <div class="row container1 ">
                             <div class="col-md-8 col-xs-7">
      <input id="origin-input" class="controls left" type="text" placeholder="Enter Promocode" name="open" id="open" ></div>
                             <div class="col-md-4 col-xs-5"> <div class="buttonexplore green" onclick="myFunction12()" >Apply <i class="fa fa-chevron-right hiiden-sm hidden-xs"></i></div></div>
                               
                  <script>
                var x,y,c;
                
function myFunction12() {

//
// y = document.getElementById("origin-input").value;
//    x = document.getElementById("fare").value; 
//    c=(x/10).toFixed(2);
//    c=x-c;
//    alert(c);
   
  
    
}
</script>             
                               
                               
      </div>
                       
                      <div class="checkbox">
             <label><input type="checkbox" value="" required> I Agree the <a href="index.html">Terms and Conditions</a> Mentioned by your Company</label>
           </div><br>
                    <center> <button class="btn btn-primary">Book Now</button></center>   
        

            </div>
                
                </form>    
                
        </div>
        <div class="col-md-5">
               <div class="card headingtab"><h3 class="text-secondary">Details Provided</h3></div>
                    <div class="card infotab">
                      <table>
         <tr>
           <td>Pickup From:</td>
           <td><?php echo $src; ?> </td>
         </tr>
         <tr>
           <td>Dropoff To:</td>
           <td><?php echo $des; ?></td>
         </tr>
         <tr>
           <td>Passengers:</td>
           <td><?php echo $np; ?></td>
         </tr>
         <tr>
           <td>Luggages:</td>
           <td><?php echo $nl; ?></td>
         </tr>
           <tr>
           <td>Cab Type:</td>
           <td><?php echo $type; ?> x 1</td>
         </tr>            
         <tr>
           <td>Date & Time:</td>
           <td><?php echo ($dt." & ". $pt); ?></td>
         </tr>
                       
            <?php  if(!(($rdate=="")&&($rptime=="")))
        {
        
        ?>      
                        <tr>
           <td>Return Date & Time:</td>
           <td><?php echo ($rdate." & ". $rptime); ?></td>
         </tr>
                       
            <?php  } ?>            
                       
         <tr>
           <td>Total Fare:</td>
           <td>£<?php echo $fare; ?></td>
         </tr>
       </table>                
   
             </div>
             <div class="card headingtab"><h3 class="text-secondary">Booking Note</h3></div>
             <div class="card infotab">
                 <ul>
                <li> <p>All Bookings made in the website needs further confirmation through email by <b>tapping the button </b>on your booking information Email, which will be automatically sent when you booked a Cab.</p></li>
                <li> <p> Bookings made with Cash on Ride requires <b>minimum 10% Deposit </b>as the booking confirmation fails to pay deposit leads to cancellation of booking.</p></li>
                <li> <p> In case of any cancellation of the booking should be made<b> before 24 hours of the journey </b>fails to do leads to Admin charges and refund the Balance ( applicable for paid Bookings).
                    </p></li></ul>
             </div>
             <div class="card headingtab"><h3 class="text-secondary">Need any help?</h3></div>
             <div class="card infotab">
                   <ul>
                           <li> <p><b>For Bookings: </b>+44 01293344804</p></li>
                           <li> <p><b>For instant Reply:</b> Initiate Live Chat</p></li>
                           <li> <p><b>For Complaints:</b> complaints@gatwick-airporttaxis.com</p></li>
                 </ul>
             </div>
               </div>
               </div>
               </section>
 <!--mainsection-->
<footer class="footer">
<div class="container">
 <div class="row ">
<div class="col-md-3 col-sm-6 hidden-xs">
 <h5>Locations</h5>
     <ul>  
            <li><a href="#">Heathrow Taxi</a></li>
        <li><a href="#">Gatwick Taxi</a></li>
        <li><a href="#">Birmingham Taxi</a></li>
        <li><a href="#">Liverpool Taxi</a></li>
        <li><a href="#">Manchester Taxi</a></li>
        <li><a href="#">London Taxi</a></li>
        <li><a href="#">Cardiff Taxi</a></li>
        <li><a href="#">Norwich Taxi</a></li>
        <li><a href="#">Lincoln Taxi</a></li>
        <li><a href="#">Plymouth Taxi</a></li>
        <li><a href="#">Guildford Taxi</a></li>
        <li><a href="#">Doncaster Taxi</a></li>
        <li><a hrf="">Leicestershire Taxi</a></li>
        <li><a hrf="">Aberdeen Taxi</a></li>
        <li><a hrf="">Sheffield Taxi</a></li>
        <li><a hrf="">Oxford Taxi</a></li>
    </ul>
</div>
     <div class="col-md-3 col-sm-6 col-xs-6 hidden-xs">
 <h5>Airports</h5>
      <ul>  
            <li><a href="#">Heathrow Airport Taxi</a></li>
        <li><a href="#">Gatwick Airport Taxi</a></li>
        <li><a href="#">Birmingham Airport Taxi</a></li>
        <li><a href="#">London Airport Taxi</a></li>
        <li><a href="#">Stansted Airport Taxi</a></li>
        <li><a href="#">Luton Airport Taxi</a></li>
        <li><a href="#">London City Airport Taxi</a></li>
        <li><a href="#">Manchester Airport Taxi</a></li>
        <li><a href="#">Edinburgh Airport Taxi</a></li>
        <li><a href="#">Glasgow Airport Taxi</a></li>
        <li><a href="#">Birmingham Airport Taxi</a></li>
        <li><a href="#">Liverpool Airport Taxi</a></li>
    </ul>
</div>
<div class="col-md-3 col-sm-6 col-xs-6">
 <h5>Services</h5>
     <ul class="aligner">
            <li><a href="#">Airport Transfers</a></li>
            <li><a href="#">Train Station Transfers</a></li>
              <li><a href="#">Cruise Station Transfers</a></li>
              <li><a href="#">School Transfers</a></li>
              <li><a href="#">Corporate Bookings</a></li>
          </ul>
</div>

<div class="col-md-3 col-sm-6 col-xs-6">
 <h5>Company</h5>
     <ul>  
        <li><a href="#">About Us</a></li>
        <li><a href="#">Locations</a></li>
        <li><a href="#">Discounts</a></li>
        <li><a href="#">Book a Ride</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms & Conditions</a></li>
    </ul>
</div>
</div></div></footer>
  <footer class="footmain">
    <div class="container">
    <center><p>Powered by Minicabee Travel Solutions</p></center>
        
      </div>  </footer>
    </body></html>
        
     <?php

}

?>  