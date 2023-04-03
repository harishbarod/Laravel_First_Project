<!DOCTYPE html>
<html>
<head>
    <title>IQ Tester Result</title>
</head>  
<body>       
                        <?php             
                         $score_data = $data['score']['points'] ;
                        $out_of = $data['score']['total_points'];
                         ?>

               <div class="congrats">
               	<h1>Congratulations!</h1>
               </div>   
               <img src="https://bit.ly/20qKWK0" style="display:none">

              <h2> have Scored      ( {{ $score_data }} /{{  $out_of *10}})  </h2>   
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
     
    <p>Thank you</p>
</body>
</html> 