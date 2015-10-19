<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function kriteria()
	{
		$data = array();
		$data['content'] = $this->load->view('view_kriteria', $data,TRUE);
		$this->load->view('main', $data, FALSE);
	}

	public function user()
	{
		$data = array();
		$data['content'] = $this->load->view('view_user', $data,TRUE);
		$this->load->view('main', $data, FALSE);
	}

	public function detail_kriteria()
	{
		$data = array();
		$datacontent = array();
		$datacontent['kriteria'] = $this->model_public->_getKriteria();
		$data['content'] = $this->load->view('view_detailkriteria', $datacontent,TRUE);
		$this->load->view('main', $data, FALSE);
	}

	public function variabel()
	{
		$data = array();
		$data['content'] = $this->load->view('view_variabel', $data,TRUE);
		$this->load->view('main', $data, FALSE);
	}

	public function sekolah()
	{
		$data = array();
		$data['content'] = $this->load->view('view_sekolah', $data,TRUE);
		$this->load->view('main', $data, FALSE);
	}

}

/* End of file master.php */
/* Location: ./application/controllers/master.php */