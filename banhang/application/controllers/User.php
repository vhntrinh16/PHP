<?php
    class User extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('user_model');
        }
        function check_email(){
            $email = $this->input->post('email');
            $where = array();
            $where = array('email' => $email);
            if($this->user_model->check_exists($where)){
                $this->form_validation->set_message(__FUNCTION__, 'Email Đã Tồn Tại.!');
                return false;
            }else{
                return true;
            }
        }

        function register(){

            // load ra thu vien form
            $this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
                $this->form_validation->set_rules('name', 'Nhập Họ tên ', 'required' );
                $this->form_validation->set_rules('email', 'Nhập Email ', 'required|valid_email|callback_check_email' );
                $this->form_validation->set_rules('password', 'Nhập password ', 'required|min_length[4]' );
                $this->form_validation->set_rules('rpassword', 'Nhập Nhập lại Password ', 'required|matches[password]' );
                $this->form_validation->set_rules('phone', 'Nhập Số Điện Thoại ', 'required' );
                $this->form_validation->set_rules('adress', 'Nhập Địa Chỉ', 'required' );
                $this->form_validation->set_rules('approved', 'Đồng Ý Với Các Điều Khoản Của Chúng Tôi', 'required' );
                if($this->form_validation->run()){
                    $name = $this->input->post('name');
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $password = md5($password);
                    $phone = $this->input->post('phone');
                    $adress = $this->input->post('adress');
                    $data = array(
                        'name' => $name,
                        'email' => $email,
                        'password' => $password,
                        'phone' => $phone,
                        'adress' => $adress,
                    );
                    if($this->user_model->create($data)){
                        $this->session->set_flashdata('message', 'Đăng Ký Tài Khoản Thành Công');
                        redirect();
                    }else{
                        $this->session->set_flashdata('message', 'Có Lỗi Khi Thêm Mới Tài Khoản');
                    }
                }
            }
            // load view
            $this->data['temp'] = 'site/user/register';
            $this->load->view('site/layout', $this->data);
        }
        function login(){
            if($this->session->userdata('id_user_login')){
                redirect();
            }

            $this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
                $this->form_validation->set_rules('email', 'email bat buoc nhap', 'required');
                $this->form_validation->set_rules('password', 'password vat buoc nhap', 'required');
                $this->form_validation->set_rules('login', 'login', 'callback_check_login');
                if($this->form_validation->run()){
                    $user = $this->_get_user_info();
                    $this->session->set_userdata('id_user_login', $user->id_user);
                    redirect();
                }
            }
            // load view
            $this->data['temp'] = 'site/user/login';
            $this->load->view('site/layout', $this->data);
        }
        // ham kiem tra login
        function check_login(){
            $user = $this->_get_user_info();
            if($user){
                return true;
            }else{
                $this->form_validation->set_message(__FUNCTION__, 'Đang nhập không thành công');
                return false;
            }
        }
        private function _get_user_info(){
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $password = md5($password);
            $where = array(
                'email' => $email,
                'password' => $password,
            );
            $user = $this->user_model->get_info_rule($where);
            return $user;
        }
		
		
		
		
        function index(){
            if(!$this->session->userdata('id_user_login')){
                redirect();
            }
            $id_user = $this->session->userdata('id_user_login');
            $user_info = $this->user_model->get_info($id_user);
            if(!$user_info){
                redirect();
            }
            $this->data['user_info'] = $user_info;
            // load view
            $this->data['temp'] = 'site/user/index';
            $this->load->view('site/layout', $this->data);

        }
        function edit(){
            $id_user = $this->session->userdata('id_user_login');
            if(!$id_user){
                redirect();
            }
            $user_info = $this->user_model->get_info($id_user);
            $this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
                $password = $this->input->post('password');
                if($password){
                    $this->form_validation->set_rules('password', 'Nhập password ', 'required|min_length[4]' );
                }
                $this->form_validation->set_rules('name', 'Nhập Họ tên ', 'required' );
                $this->form_validation->set_rules('phone', 'Nhập Số Điện Thoại ', 'required' );
                $this->form_validation->set_rules('adress', 'Nhập Địa Chỉ', 'required' );
                if($this->form_validation->run()){
                    $name = $this->input->post('name');
                    $phone = $this->input->post('phone');
                    $adress = $this->input->post('adress');
                    $data = array();
                    $data = array(
                        'name' => $name,
                        'phone' => $phone,
                        'adress' => $adress,
                    );
                    if($password){
                        $password = md5($password);
                        $data['password'] = $password;
                    }
                    if($this->user_model->update($id_user, $data)){
                        $this->session->set_flashdata('message_update', 'Cập nhật thành công');
                    }else{
                        $this->session->set_flashdata('message_update', 'Có lỗi khi cập nhật');
                    }
                    redirect('user/index');
                }
            }
            // load view
            $this->data['temp'] = 'site/user/edit';
            $this->load->view('site/layout', $this->data);
        }
        function logout(){
            if($this->session->userdata('id_user_login')){
                $this->session->unset_userdata('id_user_login');
            }
            redirect();
        }
    }
?>