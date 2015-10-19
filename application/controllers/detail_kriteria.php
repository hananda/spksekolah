<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_kriteria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_detailkriteria');
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
			default:
				echo 'no task request';
				break;
		}
	}

	public function _get()
	{
		$records = $this->model_detailkriteria->_get();
        $this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function _update()
	{
		$records = $this->model_detailkriteria->_update();
        $this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

	public function _delete()
	{
		$records = $this->model_detailkriteria->_delete();
        $this->output->set_content_type('application/json')->set_output(json_encode($records));
	}

}

/* End of file detail_kriteria.php */
/* Location: ./application/controllers/detail_kriteria.php */