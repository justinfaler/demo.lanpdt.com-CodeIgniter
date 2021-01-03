<?php

require APPPATH . '/third_party/sendgrid/vendor/autoload.php';

function exp_month() {

    $month = array('01','02','03','04','05','06','07','08','09','10','11','12');
    return $month;
}

function exp_year(){

    $curr_year = date("Y"); 
    
    $years = array();
    for($i=0; $i<=10; $i++){
        $years = $curr_year+$i;
        $years_arr[] = $years;
    }
    return $years_arr;
}
//to generate an image tag, set tag to true. you can also put a string in tag to generate the alt tag



function pre($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

// function getstore($field = '') {
//     $CI = & get_instance();

//     if ($field != '') {
//         $storedata = $CI->session->userdata('store');
//         return isset($storedata->$field) ? $storedata->$field : 0;
//     }
//     return $CI->session->userdata('store');
// }

function errorpage($data) {
    $CI = & get_instance();
    $CI->view('error_404', $data);
}

function formatdate($date = '', $format = 'd, M Y') {

    $date = date_create($date);
    echo date_format($date, $format);
}




// Function to set array of all apps


function aasort (&$array, $key) {

    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {

        $ret[]=$array[$ii];
    }
    return $ret; 
}


function get_font_family(){

    $fonts_list = array(
      "Abel", "Abril Fatface", "Acme", "Alegreya", "Alex Brush", "Amaranth", "Amatic SC", "Anton", "Arbutus Slab", "Architects Daughter", "Archivo", "Archivo Black", "Arima Madurai", "Asap", "Bad Script", "Baloo Bhaina", "Bangers", "Berkshire Swash", "Bitter", "Boogaloo", "Bree Serif", "Bungee Shade", "Cantata One", "Catamaran", "Caveat", "Caveat Brush", "Ceviche One", "Chewy", "Contrail One", "Crete Round", "Dancing Script", "Exo 2", "Fascinate", "Francois One", "Freckle Face", "Fredoka One", "Gloria Hallelujah", "Gochi Hand", "Great Vibes", "Handlee", "Inconsolata", "Indie Flower", "Kaushan Script", "Lalezar", "Lato", "Libre Baskerville", "Life Savers", "Lobster", "Lora", "Luckiest Guy", "Marcellus SC", "Merriweather", "Merriweather Sans", "Monoton", "Montserrat", "News Cycle", "Nothing You Could Do", "Noto Serif", "Oleo Script Swash Caps", "Open Sans", "Open Sans Condensed", "Oranienbaum", "Oswald", "Poppins", "PT Sans", "PT Sans Narrow", "PT Serif", "Pacifico", "Patrick Hand", "Peralta", "Permanent Marker", "Philosopher", "Play", "Playfair Display", "Playfair Display SC", "Poiret One", "Press Start 2P", "Prosto One", "Quattrocento", "Questrial", "Quicksand", "Raleway", "Rancho", "Righteous", "Roboto", "Roboto Condensed", "Roboto Slab", "Rubik", "Rye", "Satisfy", "Shadows Into Light", "Shojumaru", "Sigmar One", "Skranji", "Slabo 27px", "Special Elite", "Tinos", "Ultra", "UnifrakturMaguntia", "VT323", "Yanone Kaffeesatz");
    return $fonts_list; 
}

function browser_list(){

    $u_agent = $_SERVER['HTTP_USER_AGENT'];

    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    } 

    return $ub;
}

function send_email($email, $htmlContent, $subject){
    $CI = & get_instance();
   
    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'exs.developer@gmail.com',
        'smtp_pass' => 'Esolution@123',
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1'
    );
     $CI->load->library('email', $config);
     $CI->email->set_newline("\r\n");
    $CI->email->set_header('Content-Type', 'text/html');
     $CI->email->to($email);
    //$CI->email->from('cpa2go@lanpdt.com','CPA2GO');
    $CI->email->from('no-reply@cpa2go.com','CPA2GO');
    $CI->email->subject($subject);
    $CI->email->message($htmlContent);

    if($CI->email->send())
    {
        return; 
    }else{
        show_error($CI->email->print_debugger()); 
    }
}


function send_email_live($email_address, $htmlContent, $subject){

    $CI = & get_instance();
 
    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'exs.developer@gmail.com',
        'smtp_pass' => 'Esolution@123',
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1'
    );
     $CI->load->library('email', $config);
     $CI->email->set_newline("\r\n");
     $CI->email->set_header('Content-Type', 'text/html');
    $CI->email->to($email_address);
    //$CI->email->from('cpa2go@lanpdt.com','CPA2GO');
    $CI->email->from('no-reply@cpa2go.com','CPA2GO');
    
    $CI->email->subject($subject);
    $CI->email->message($htmlContent);

    if($CI->email->send())
    {
        return; 
    }else{
      //  show_error($CI->email->print_debugger()); 
    }

    // $from_name = "cpa2go";
    // $from_email = "cpa2go@lanpdt.com";
     
    //  // $header = "From:cpa2go@lanpdt.com \r\n";
    //  // //$header .= "Cc:afgh@somedomain.com \r\n";
    //  // $header .= "MIME-Version: 1.0\r\n";
    //  // $header .= "Content-type: text/html\r\n";
     
    //  // $retval = mail ($email,$subject,$htmlContent,$header);

    //  // if( $retval == true ) {
    //  //    return;
    //  // }else {
    //  //    echo "Message could not be sent...";
    //  // }


    // // $email_address = "jignesh.gambhava@metizsoft.com";
    // $email = new \SendGrid\Mail\Mail(); 
    // $email->setFrom($from_email, $from_name);
    // $email->setSubject($subject);
    // $email->addTo($email_address, "");
    // $email->addContent(
    //     "text/html", $htmlContent
    // );
    // $sendgrid = new \SendGrid('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');
    // try {
    //     $response = $sendgrid->send($email);
    //     // print $response->statusCode() . "\n";
    //     // print_r($response->headers());
    //     // print $response->body() . "\n";
    // } catch (Exception $e) {
    //     echo $e->getMessage();
    // }


}


function send_email_contact($email_address, $htmlContent, $subject, $from_name, $from_email){

    $CI = & get_instance();
  
    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'exs.developer@gmail.com',
        'smtp_pass' => 'Esolution@123',
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1'
    );
     $CI->load->library('email', $config);
     $CI->email->set_newline("\r\n");
     $CI->email->set_header('Content-Type', 'text/html');
    $CI->email->to($email_address);
    $CI->email->from($from_email,$from_name);
    $CI->email->subject($subject);
    $CI->email->message($htmlContent);

    if($CI->email->send())
    {
        return; 
    }else{
       // show_error($CI->email->print_debugger()); 
    }

     // $header = "From:".$from_name."<".$from_email.">\r\n";
     // //$header .= "Cc:afgh@somedomain.com \r\n";
     // $header .= "MIME-Version: 1.0\r\n";
     // $header .= "Content-type: text/html\r\n";
     
     // $retval = mail ($email,$subject,$htmlContent,$header);

     // if( $retval == true ) {
     //    return;
     // }else {
     //    echo "Message could not be sent...";
     // }

    //$email_address = "marsshow101@gmail.com";


    // $email = new \SendGrid\Mail\Mail(); 
    // $email->setFrom($from_email, $from_name);
    // $email->setSubject($subject);
    // $email->addTo($email_address, "");
    // $email->addContent(
    //     "text/html", $htmlContent
    // );
    // $sendgrid = new \SendGrid('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');
    // try {
    //     $response = $sendgrid->send($email);
    //     //  print $response->statusCode() . "\n";
    //     //  print_r($response->headers());
    //     //  print $response->body() . "\n";
    // } catch (Exception $e) {
    //    // echo 'Caught exception: '. $e->getMessage() ."\n";
    // }

}


function get_retting_avg($avg_ratting=''){

    $avg_rattings = 0;
    if($avg_ratting <= 0.5){
        $avg_rattings = 0.5;
    }
    if($avg_ratting > 0.5 AND $avg_ratting <= 1){
        $avg_rattings = 1;
    }
    if($avg_ratting > 1 AND $avg_ratting <= 1.5){
        $avg_rattings = 1.5;
    }
    if($avg_ratting > 1.5 AND $avg_ratting <= 2){
        $avg_rattings = 2;
    }
    if($avg_ratting > 2 AND $avg_ratting <= 2.5){
        $avg_rattings = 2.5;
    }
    if($avg_ratting > 2.5 AND $avg_ratting <= 3){
        $avg_rattings = 3;
    }
    if($avg_ratting > 3 AND $avg_ratting <= 3.5){
        $avg_rattings = 3.5;
    }
    if($avg_ratting > 3.5 AND $avg_ratting <= 4){
        $avg_rattings = 4;
    }
    if($avg_ratting > 4 AND $avg_ratting <= 4.5){
        $avg_rattings = 4.5;
    }
    if($avg_ratting > 4.5 AND $avg_ratting <= 5){
        $avg_rattings = 5;
    }

    return $avg_rattings;
}

function front_ratting_avg($rate_no=''){

    if($rate_no == 1){
        return 1;
    }
    if($rate_no == 1.5){
        return 2;
    }
    if($rate_no == 2){
        return 2;
    }
    if($rate_no == 2.5){
        return 3;
    }if($rate_no == 3){
        return 3;
    }if($rate_no == 3.5){
        return 4;
    }
    if($rate_no == 4){
        return 4;
    }
    if($rate_no == 4.5){
        return 5;
    }
    if($rate_no == 5){
        return 5;
    }
}

    
    //$u_agent = $_SERVER['HTTP_USER_AGENT'];

    // if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    // {
    //     $bname = 'Internet Explorer';
    //     $ub = "MSIE";
    // }
    // elseif(preg_match('/Firefox/i',$u_agent))
    // {
    //     $bname = 'Mozilla Firefox';
    //     $ub = "Firefox";
    // }
    // elseif(preg_match('/Chrome/i',$u_agent))
    // {
    //     $bname = 'Google Chrome';
    //     $ub = "Chrome";
    // }
    // elseif(preg_match('/Safari/i',$u_agent))
    // {
    //     $bname = 'Apple Safari';
    //     $ub = "Safari";
    // }
    // elseif(preg_match('/Opera/i',$u_agent))
    // {
    //     $bname = 'Opera';
    //     $ub = "Opera";
    // }
    // elseif(preg_match('/Netscape/i',$u_agent))
    // {
    //     $bname = 'Netscape';
    //     $ub = "Netscape";
    // } 

    // return $ub;

