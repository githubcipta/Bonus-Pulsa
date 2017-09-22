    <?php 
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "admin-boniw@bonus-pulsa.com";
        $to = "febryan8912@gmail.com;boniwperez87@gmail.com;vulnwalker@getnada.com;iniganteng@yahoo.com;mbvermont@hotmail.com;lindasabrina92@outlook.com";
        $subject = "cek it out";
        $message = "wadaw snappppp";
        $headers = "From:" . $from;
       $send =  mail($to,$subject,$message, $headers);
        if($send){
			echo "Email Send";
		}else{
			echo "Failed";
		}
    ?>
