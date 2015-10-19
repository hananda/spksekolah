<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_sekolah');
	}

	public function index($task = "")
	{
		if (!$task) {
			$task = $this->input->get('task');
		}

		switch ($task) {
			case 'get':
				$this->_get();
				break;
			case 'update':
				$this->_update();
                break;
            case 'delete':
            	$this->_delete();
                break;
            case 'getdesc':
            	$this->_getdesc();
                break;
            case 'formkriteria':
            	$this->_formkriteria();
                break;
			default:
				echo 'no task request';
				break;
		}
	}

	public function _get()
	{
		$records = $this->model_sekolah->_get();
        $this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function _update()
	{
		$records = $this->model_sekolah->_update();
        $this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function _delete()
	{
		$records = $this->model_sekolah->_delete();
        $this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function _getdesc()
	{
		$records = $this->model_sekolah->_getdesc();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function _formkriteria()
	{
		$data = array();
		$data['kriteria'] = $this->model_public->_getKriteria();
		$data['detailkriteria'] = $this->model_public->_getDetailKriteria();
		$this->load->view('view_inputkriteria', $data, FALSE);
	}

}

/* End of file sekolah.php */
/* Location: ./application/controllers/sekolah.php */