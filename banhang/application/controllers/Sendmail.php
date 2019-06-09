<?php
class Sendmail extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

	}

	function index()
	{
		
		$this->load->view('email/index');
	}

	function send()
	{
		
		$from_email = "vutrinh52953@gmail.com"; //Email khi khách hàng nhận mail và bấm reply -> sẽ gửi tới dchi này
        $to_email = $this->input->post('to_email');//email nhận
        $subject = $this->input->post('subject');
        $body 	= $this->input->post('message');
        //echo "$from_email <br> $to_email <br> $subject <hr>";  print_r($_POST);
		//exit; 
		//echo "== to: $to_email ==";       
		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		//$config['smtp_host'] = 'tls://smtp.googlemail.com';
		$config['smtp_user'] = 'vutrinh52953@gmail.com';
		$config['smtp_pass'] = 'vhnt12345678916'; 
		$config['smtp_port'] = 465;
		//$config['smtp_port'] = 579;
		$config['mailtype']  = 'html';
        $config['starttls']  = true;
        $config['newline']   = "\r\n";

		$this->load->library('email', $config);
		$this->email->initialize($config);
        $this->email->from($from_email, 'Identification');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($body);
      
        //Send mail
        if($this->email->send())
        {
            $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        }
        else{
            $this->session->set_flashdata("email_sent","You have encountered an error");
             ob_start();
			  $this->email->print_debugger();
			  $error = ob_end_clean();
			  $errors[] = $error;
			  print_r($errors);

        }
        $this->load->view('email/index');

	}
}