<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_public extends CI_Model {

	public function _getKriteria($filter = array(),$select='*')
	{
		if (count($filter) > 0) {
			foreach ($filter as $field => $value) {
				$this->db->where($field, $value);
			}
		}
		$this->db->where('kriteria_aktif', 'Y');
		$this->db->select($select);
		$data = $this->db->get('kriteria');
		return $data;
	}

	public function _getDetailKriteria($filter = array(),$select='*')
	{
		if (count($filter) > 0) {
			foreach ($filter as $field => $value) {
				$this->db->where($field, $value);
			}
		}
		$this->db->where('detail_kriteria_aktif', 'Y');
		$this->db->select($select);
		$data = $this->db->get('detail_kriteria');
		return $data;
	}

	public function _getSekolah($filter = array(),$select='*')
	{
		if (count($filter) > 0) {
			foreach ($filter as $field => $value) {
				$this->db->where($field, $value);
			}
		}
		$this->db->where('sekolah_aktif', 'Y');
		$this->db->select($select);
		$data = $this->db->get('sekolah');
		return $data;
	}

	public function upload($inputName, $path = "",$nama_file="",$overwrite=false){
		if (!$path) {
			 $path ='foto_sekolah/';
		}
		$result = array();

		if (isset($_FILES[$inputName])) {
			if (!is_dir($path)) {
				mkdir($path, 0755, TRUE);
			}
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';
			$config['max_size'] = '0';

			if ($overwrite) {
				$config['overwrite'] = 'TRUE';
			}

			if($nama_file!=""){
				$config['overwrite'] = 'TRUE';
	            $config['file_ext_tolower'] = 'TRUE';
	            $config['ext_not_overwrite'] = 'TRUE';
	            $config['file_name'] = $nama_file;
	        }

			$this->load->library('upload');
			$this->upload->initialize($config);

			$json['file'] = $_FILES[$inputName]['name'];
			if (!$this->upload->do_upload($inputName)) {
				$error = array('error' => $this->upload->display_errors());
				$result = array(
					'stats' => false,
					'data' => $error
				);
			} else {
				//$upload_data = $this->upload->data();
				$result = array(
					'stats' => true,
					'nama' => $json['file']
				);
			}
		}else{
			$result = array(
				'stats' => false,
				'data' => array('error'=>'No file selected')
			);
		}
		return $result;
	}

}

/* End of file model_public.php */
/* Location: ./application/models/model_public.php */