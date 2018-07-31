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

		$data['message'] = 'Hello World';
		$this->pusher->trigger('my-channel', 'my-event', $data);
	}

	public function register()
	{
		$data = [
			'title' => 'Daftar',
			'page' => 'sites/register'
		];

		$this->load->view($this->layout, $data);
	}

	public function chat()
	{
		$data = [
			'title' => 'Ruang Chat',
			'page' => 'sites/chat'
		];

		$this->load->view($this->layout, $data);
	}
}
