<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_variabel extends CI_Model {

	public function _get()
	{
		$dataorder = array();
        // $dataorder[3] = "tgl_awal_beasiswa";
        // $dataorder[4] = "tgl_akhir_beasiswa";

		$search = $this->input->post("search");

        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);
        $start = intval($_REQUEST['start']);
        $order = $this->input->post('order');

		$query = "SELECT *
				FROM variabel WHERE variabel_aktif = 'Y'";
		if($search['value'] != ""){
            $query .=preg_match("/WHERE/i",$query)? " AND ":" WHERE ";
			$query .= "(variabel_nama = '". $search['value'] ."')";
		}
        // OR PROGRAM_TAHUN LIKE '%". strtolower($search) ."%'
		// var_dump($order);
		if($order[0]['column']){
            $query.= " order by 
                ".$dataorder[$order[0]["column"]]." ".$order[0]["dir"];
        }

        $iTotalRecords = $this->db->query("SELECT COUNT(*) AS JUMLAH FROM (".$query.") A")->row()->JUMLAH;

        $query .= " LIMIT ". ($start) .",".(($start) + $iDisplayLength);
        
        $data = $this->db->query($query)->result_array();
        $i = $start + 1;
        $result = array();
        foreach ($data as $d) {
            $r = array();
			$r[0] = $d['variabel_id'];
			$r[1] = $i;
			$r[2] = $d['variabel_nama'];
			$r[3] = $d['variabel_range_awal']." - ".$d['variabel_range_akhir'];
			$r[4] = $d['variabel_nilai'];
			$r[5] = '<a class="btnedit" style="cursor:pointer;" title="Edit"><i class="fa fa-edit"></i></a>
			<a class="btndelete" style="cursor:pointer;" title="Hapus"><i class="fa fa-trash"></i></a>';
            array_push($result, $r);
            $i++;
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
	}

    public function _update()
    {
        $id = $this->input->post('idvariabel');
        $nama = $this->input->post('namavariabel');
        $rangeawal = $this->input->post('rangeawal');
        $rangeakhir = $this->input->post('rangeakhir');
        $bobot = $this->input->post('bobot');
        $filter = array('variabel_id'=>$id);
        $data = array(
        	'variabel_nama'=>$nama,
        	'variabel_nilai'=>$bobot,
        	'variabel_range_awal'=>$rangeawal,
        	'variabel_range_akhir'=>$rangeakhir
        );
        
        if ($id) {
            $this->db->where($filter);
            $this->db->update('variabel',$data);
        }else{
            $this->db->insert('variabel', $data);
        }

        if ($this->db->affected_rows()>0) {
            $result['message'] = 'Data berhasil diubah';
            $result['status'] = true;
        }else{
            $result['message'] = 'Data gagal diubah';
            $result['status'] = false;
        }
        return $result;
    }

    public function _delete()
    {
        $id = $this->input->post('idvariabel');
        $filter = array('variabel_id'=>$id);
        $data = array('variabel_aktif'=>'T');
        
        $this->db->where($filter);
        $this->db->update('variabel',$data);

        if ($this->db->affected_rows()>0) {
            $result['message'] = 'Data berhasil dihapus';
            $result['status'] = true;
        }else{
            $result['message'] = 'Data gagal dihapus';
            $result['status'] = false;
        }
        return $result;
    }

}

/* End of file model_variabel.php */
/* Location: ./application/models/model_variabel.php */