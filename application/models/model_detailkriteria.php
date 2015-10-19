<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_detailkriteria extends CI_Model {

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

		$query = "SELECT detail_kriteria.*,kriteria.kriteria_nama
				FROM kriteria
				JOIN detail_kriteria ON kriteria_id = detail_kriteria_id_kriteria AND detail_kriteria_aktif = 'Y'
				WHERE kriteria_aktif = 'Y'
				ORDER BY detail_kriteria_id_kriteria ASC";
		if($search['value'] != ""){
            $query .=preg_match("/WHERE/i",$query)? " AND ":" WHERE ";
			$query .= "(kriteria_nama like '%". $search['value'] ."%'
						OR detail_kriteria_nama like '%".$search['value']."%')";
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
			$r[0] = $d['detail_kriteria_id'];
			$r[1] = $d['detail_kriteria_id_kriteria'];
			$r[2] = $i;
			$r[3] = $d['kriteria_nama'];
            $r[4] = $d['detail_kriteria_nama'];
			$r[5] = $d['detail_kriteria_bobot'];
			$r[6] = '<a class="btnedit" style="cursor:pointer;" title="Edit"><i class="fa fa-edit"></i></a>
			<a class="btndelete" style="cursor:pointer;"  title="Hapus"><i class="fa fa-trash"></i></a>';
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
        $id = $this->input->post('iddetailkriteria');
        $nama = $this->input->post('namadetailkriteria');
        $nilai = $this->input->post('nilaidetailkriteria');
        $idkriteria = $this->input->post('idkriteria');
        $filter = array('detail_kriteria_id'=>$id);
        $data = array(
        	'detail_kriteria_nama'=>$nama,
        	'detail_kriteria_id_kriteria'=>$idkriteria,
            'detail_kriteria_bobot'=>$nilai
        );
        
        if ($id) {
	        $this->db->where($filter);
	        $this->db->update('detail_kriteria',$data);
        }else{
        	$this->db->insert('detail_kriteria', $data);
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
        $id = $this->input->post('iddetailkriteria');
        $filter = array('detail_kriteria_id'=>$id);
        $data = array('detail_kriteria_aktif'=>'T');
        
        $this->db->where($filter);
        $this->db->update('detail_kriteria',$data);

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

/* End of file model_detailkriteria.php */
/* Location: ./application/models/model_detailkriteria.php */