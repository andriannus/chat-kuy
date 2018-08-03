<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public $options;
	public $pusher;
	public $layout = 'core/layouts/app';

	public function __construct()
	{
		parent::__construct();

		$this->configPusher();
	}

	public function index()
	{
		$this->register();
	}

	public function configPusher()
	{
		$this->options = [
			'cluster' => 'ap1',
			'encrypted' => 'true'
		];

		$this->pusher = new Pusher\Pusher(
			'xx',
			'xx',
			'xx',
			$this->options
		);
	}

	public function register()
	{
		if ($this->session->userdata('login') == true) {
			redirect('site/chat');

		} else {
			$data = [
				'title' => 'Daftar',
				'page' => 'sites/register'
			];

			$this->load->view($this->layout, $data);
		}
	}

	public function registerProcess()
	{
		$username = $this->input->post('username');

		$data = [
			'username' => $username,
			'login' => true
		];

		$this->session->set_userdata($data);
		redirect('site/chat');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('site/register');
	}

	public function chat()
	{
		if ($this->session->userdata('login') == false) {
			redirect('site/register');
		
		} else {
			$data = [
				'title' => 'Ruang Chat',
				'page' => 'sites/chat'
			];

			$this->load->view($this->layout, $data);
		}
	}

	public function sendChat()
	{
		$username = $this->session->userdata('username');
		$message = $this->input->post('message');

		$data['username'] = $username;
		$data['message'] = $message;
		$data['timestamp'] = date('Y-m-d H:i:s');

		$result = $this->pusher->trigger('chat-kuy', 'chat', $data);

		if ($result) {
			return $this->output
									->set_status_header(201)
									->set_output(json_encode([
											'success' => true,
											'message' => 'Message created'
										]));

		} else {
			return $this->output
									->set_status_header(500)
									->set_output(json_encode([
											'success' => false,
											'message' => 'Message failed to create'
										]));
		}
	}

	public function someoneIsTyping()
	{
		$data['username'] = $this->session->userdata('username');

		$result = $this->pusher->trigger('chat-kuy', 'typing', $data);

		if ($result) {
			return $this->output
									->set_status_header(200)
									->set_output(json_encode([
											'success' => true
										]));

		} else {
			return $this->output
									->set_status_header(500)
									->set_output(json_encode([
											'success' => false
										]));
		}
	}
}
