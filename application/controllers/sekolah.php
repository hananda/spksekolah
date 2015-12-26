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
            case 'insertkriteria':
            	$this->_insertkriteria();
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

	public function _insertkriteria()
	{
		$records = $this->model_sekolah->_insertkriteria();
		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function _formkriteria()
	{
		$data = array();
		$data['idsekolah'] = $this->input->post('idsekolah');
		$data['kriteria'] = $this->model_public->_getKriteria();
		$data['detailkriteria'] = $this->db->query("select detail_kriteria.*,(case when t_kriteria_id is null then 0 else 1 end) as selected from detail_kriteria
									LEFT JOIN t_kriteria ON detail_kriteria_id = t_kriteria_detail_kriteria_id and t_kriteria_sekolah_id = ".$data['idsekolah']."
									 where detail_kriteria_aktif = 'Y'");
		$this->load->view('view_inputkriteria', $data, FALSE);
	}

}

/* End of file sekolah.php */
/* Location: ./application/controllers/sekolah.php */