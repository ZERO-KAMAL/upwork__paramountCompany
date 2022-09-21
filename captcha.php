<?php

session_start();

//echo '<pre>';

//print_r($_POST);die;



$errorMSG = "";

if($_POST["name"]!=''){

	$name = $_POST["name"];

}else{

	$errorMSG = "<li>Name is required</<li>";

}

if($_POST["phone"]!=''){

	$phone = $_POST["phone"];

}else{

	$errorMSG = "<li>Phone is required</li>";

}

if($_POST["email"]!=''){

	$email = $_POST["email"];

}elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){

	$errorMSG .= "<li>Email is required</li>";

}else{

	$errorMSG .= "<li>Email is required</li>";

}

if($_POST["comments"]!=''){

	$comments = $_POST["comments"];

}else{

	$errorMSG = "<li>Comments is required</li>";

}





if ($_POST["captcha_input"] == $_SESSION["pass"]) {

    // *** They passed the test! ***

    // *** This is where you would post a comment to your database, etc ***

    echo "<div class=\"container\" align=\"left\">";

    echo "<img src='./images/logo.png'>";

    echo "</div>";

    echo "<div align:center style=\"background:#333333; text-align:center; margin:150 auto; font-size:24px; font-family:\'Lato\', sans-serif; padding:10px; color:#fff\"><br>";

    echo "Thank you for submitting your information! <br><br>";

    echo "One of our representatives will contact you as soon as possible.<br><br>";



    echo "This is what you sent  <br><br>";





    echo "Your Name: \"" . $_POST["name"] . "\" <br>";



    echo "Your email: \"" . $_POST["email"] . "\" <br>";



    echo "Your Telephone: \"" . $_POST["phone"] . "\" <br>";



    echo "Your Comments: \"" . $_POST["comments"] . "\" <br>";

	

	 echo '<br><a href="index.html">Click Here</a> to return to main website';

     echo "</div>";





if(empty($errorMSG)){  

$to = "tlemay@paramountweb.ca";

$subject = "Online Quote Form";



$message = "

<html>

<head>

<title>Drop Us a Line Form Enquiry</title>

</head>

<body>

<table>

<tr>

<td>Name:</td>

<td>".$name."</td>

</tr>

<tr>

<td>Email:</td>

<td>".$email."</td>

</tr>

<tr>

<td>Phone:</td>

<td>".$phone."</td>

</tr>

<tr>

<td>Project Details:</td>

<td>".$comments."</td>

</tr>



</table>

</body>

</html>

";



$headers = array('From' => $email,

        'To' => $to,

        'Subject' => $subject,

        'Reply-To' => $email);

		

// Always set content-type when sending HTML email

$headers = "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";



// More headers

//$headers .= 'From: <$from>' . "\r\n";

$headers .= "From: <$email>". "\r\n";



//$headers .= 'Cc: myboss@example.com' . "\r\n";



//Honeypot Test

    $first_name = $_POST["first_name"];

    $last_name = $_POST["last_name"];



    if (!empty($first_name) || !empty($last_name)) {

        die("Error: Bot Detected!");

    } else { 

        $mail = mail($to,$subject,$message,$headers);

        if (PEAR::isError($mail)) { 

            echo("<p>" . $mail->getMessage() . "</p>");

        } else {

            echo '<br><a href="index.html">Click Here</a> to return to main website';

            echo "</div>";

        }

    }





//mail($to,$subject,$message,$headers);

//$msg = "Thanks for getting in touch. Someone will respond to you shortly.";

	//echo json_encode(['code'=>200, 'msg'=>$msg]);

	exit;

}



}else{

    // *** The input text did not match the stored text, so they failed ***

    // *** You would probably not want to include the correct answer, but

    //	unless someone is trying on purpose to circumvent you specifically,

    //	its not a big deal.  If someone is trying to circumvent you, then

    //	you should probably use a more secure way besides storing the

    //	info in a cookie that always has the same name! :) ***

    

	

	 echo "<div class=\"container\" align=\"left\">";

    echo "<img src='./images/logo.png'>";

    echo "</div>";

    echo "<div align:center style=\"background:#333333; text-align:center; margin:150 auto; font-size:24px; font-family:\'Lato\', sans-serif; padding:10px; color:#fff\"><br>";

    

	echo "Sorry, you did not pass the CAPTCHA test.<br><br>";

    echo "You said " . $_POST["captcha_input"];

    echo " while the correct answer was " . $_SESSION["pass"];



    echo "    - Please click back in your browser and try again <br><br>";

	 echo '<br><a href="index.html">Click Here</a> to return to main website';

     echo "</div>";

}





