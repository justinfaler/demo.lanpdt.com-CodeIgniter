<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/third_party/sendgrid/vendor/autoload.php';

class Home extends CI_Controller {

	function __construct() {

       // ini_set('display_errors', 1);
        parent::__construct();
        
        $this->load->library('facebook');
        $this->load->model('front_model');
        $this->load->model('sys_model');

        //if($this->session->userdata('userdata_list') == FALSE) redirect(base_url('admin'));
    }
    public function index(){
    	  
        $this->load->view('home');
    }

    public function call_register(){

        $land_quas = $this->input->post('land_quas');
        $this->session->set_userdata('land_quas', $land_quas);
        redirect(base_url().'register');
    }

    public function send_email(){

        // // Load PHPMailer library
        // $this->load->library('phpmailer_lib');
        
        // // PHPMailer object
        // $mail = $this->phpmailer_lib->load();
        
        // // SMTP configuration
        // $mail->isSMTP();
        // $mail->Host     = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'metizdev@gmail.com';
        // $mail->Password = '123metizdev$';
        // $mail->SMTPSecure = 'tls';
        // $mail->Port     = 587;
        
        // $mail->setFrom('kaushik.parmar@metizsoft.com', 'CodexWorld');
        // $mail->addReplyTo('jignesh.gambhava@metizsoft.com', 'CodexWorld');
        
        // // Add a recipient
        // $mail->addAddress('jignesh.gambhava@metizsoft.com');
        
        // // Add cc or bcc 
        // //$mail->addCC('cc@example.com');
        // //$mail->addBCC('bcc@example.com');
        
        // // Email subject
        // $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // // Set email format to HTML
        // $mail->isHTML(true);
        
        // // Email body content
        // $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
        //     <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        // $mail->Body = $mailContent;
        
        // // Send email
        // if(!$mail->send()){
        //     echo 'Message could not be sent.';
        //     echo 'Mailer Error: ' . $mail->ErrorInfo;
        // }else{
        //     echo 'Message has been sent';
        // }


        // $this->load->library('email');
        //     $config = array(
        //         'protocol'  => 'smtp',
        //         'smtp_host' => 'ssl://smtp.googlemail.com',
        //         'smtp_port' => 465,
        //         'smtp_user' => 'metizdev@gmail.com',
        //         'smtp_pass' => '123metizdev$',
        //         'mailtype'  => 'html',
        //         'charset'   => 'utf-8'
        //     );
        //     $this->email->initialize($config);
        //     $this->email->set_mailtype("html");
        //     $this->email->set_newline("\r\n");

        //     //Email content
        //     $htmlContent = '<h1>Sending email via SMTP server</h1>';
        //     $htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';

        //     $this->email->to('jignesh.gambhava@metizsoft.com');
        //     $this->email->from('kaushik.parmar@metizsoft.com','kaushik');
        //     $this->email->subject('How to send email via SMTP server in CodeIgniter');
        //     $this->email->message($htmlContent);

        //     //Send email
        //     $this->email->send();

        //      echo $this->email->print_debugger();



             
        $this->load->library('email');

        $config['mailpath']      = '/usr/sbin/sendmail';
        $config['charset']       = 'utf-8';
        $config['protocol']      = 'smtp';
        $config['smtp_host']     = 'smtp.yandex.com';
        $config['smtp_port']     = '587';
        $config['smtp_crypto']   = 'tls';
        $config['smtp_user']     = 'shopify@metizsoft.com';
        $config['smtp_pass']     = 'abc@123_4';
        $config['newline']       = "\r\n";
        $config['wordwrap']      = TRUE;
        $config['mailtype']      = 'html';

        $this->email->initialize($config);
        $this->email->from('kaushik.parmar@metizsoft.com', 'kaushik');
        // $ci->email->to('kaushik.parmar@metizsoft.com');
        $this->email->to('jignesh.gambhava@metizsoft.com');

        $this->email->subject('Subject');
        $this->email->message('Message body');

        $sent = $this->email->send();
        return $sent;

    }    


    public function send_email_t(){
        //$email_address, $subject, $htmlContent, $from_name, $from_email

        send_email_test();
        echo"ssss";
        // $email_address = "jignesh.gambhava@metizsoft.com";
        // $subject = 'Subject';
        // $htmlContent = 'Content data';
        // $from_name = "fromname";
        // $from_email = "fromemail@gmail.com";

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
        //     echo 'Caught exception: '. $e->getMessage() ."\n";
        // }
    }
}
