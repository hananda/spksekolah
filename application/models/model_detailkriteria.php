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
				LEFT JOIN detail_kriteria ON kriteria_id = detail_kriteria_id_kriteria AND detail_kriteria_aktif = 'Y' AND (detail_kriteria_parent = -1 OR detail_kriteria_parent = 0)
				WHERE kriteria_aktif = 'Y'";
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
        $query.="
                ORDER BY detail_kriteria_id_kriteria ASC";

        $iTotalRecords = $this->db->query("SELECT COUNT(*) AS JUMLAH FROM (".$query.") A")->row()->JUMLAH;

        $query .= " LIMIT ". ($start) .",".(($start) + $iDisplayLength);
        
        $data = $this->db->query($query)->result_array();
        $i = $start + 1;
        $result = array();
        foreach ($data as $d) {
            if ($d['detail_kriteria_parent'] == -1) {
                $title = 'Aktifkan';
                $valparent = '0';
                $icon = 'fa-check';
            }else if($d['detail_kriteria_parent'] == 0){
                $title = 'Non Aktifkan';
                $valparent = '-1';
                $icon = 'fa-remove';
            }

            $r = array();
			$r[0] = $d['detail_kriteria_id'];
			$r[1] = $d['detail_kriteria_id_kriteria'];
			$r[2] = $i;
			$r[3] = $d['kriteria_nama'];
            if ($d['detail_kriteria_parent'] == 0) {
                $r[4] = '<a href="'.base_url().'master/sub_kriteria/'.$d['detail_kriteria_id'].'" style="color:#0000ff;" data-asli="'.$d['detail_kriteria_nama'].'" >'.$d['detail_kriteria_nama'].'</a>';
            }else{
                $r[4] = $d['detail_kriteria_nama'];
            }
            
			$r[5] = $d['detail_kriteria_bobot'];
			$r[6] = '<a class="btnedit" style="cursor:pointer;" title="Edit"><i class="fa fa-edit"></i></a>
			<a class="btndelete" style="cursor:pointer;"  title="Hapus"><i class="fa fa-trash"></i></a>
            <a class="btnsub" style="cursor:pointer;"  title="'.$title.' Sub" data-val="'.$valparent.'"><i class="fa '.$icon.'"></i></a>';
            array_push($result, $r);
            $i++;
        }

        $records["data"] = $result;
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        return $records;
	}

    public function _getsub()
    {
        $idsub = $this->input->get('idsub');
        $dataorder = array();

        $search = $this->input->post("search");

        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);
        $start = intval($_REQUEST['start']);
        $order = $this->input->post('order');

        $query = "SELECT detail_kriteria.*
                FROM detail_kriteria
                WHERE detail_kriteria_aktif = 'Y' AND detail_kriteria_parent = ".$idsub;
        if($search['value'] != ""){
            $query .=preg_match("/WHERE/i",$query)? " AND ":" WHERE ";
            $query .= "(detail_kriteria_nama like '%".$search['value']."%')";
        }
        // OR PROGRAM_TAHUN LIKE '%". strtolower($search) ."%'
        // var_dump($order);
        if($order[0]['column']){
            $query.= " order by 
                ".$dataorder[$order[0]["column"]]." ".$order[0]["dir"];
        }
        $query.="
                ORDER BY detail_kriteria_id_kriteria ASC";

        $iTotalRecords = $this->db->query("SELECT COUNT(*) AS JUMLAH FROM (".$query.") A")->row()->JUMLAH;

        $query .= " LIMIT ". ($start) .",".(($start) + $iDisplayLength);
        
        $data = $this->db->query($query)->result_array();
        $i = $start + 1;
        $result = array();
        foreach ($data as $d) {

            $r = array();
            $r[0] = $d['detail_kriteria_id'];
            $r[1] = $i;
            $r[2] = $d['detail_kriteria_nama'];
            $r[3] = $d['detail_kriteria_bobot'];
            $r[4] = '<a class="btnedit" style="cursor:pointer;" title="Edit"><i class="fa fa-edit"></i></a>
            <a class="btndelete" style="cursor:pointer;"  title="Hapus"><i class="fa fa-trash"></i></a>
            ';
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
            'detail_kriteria_bobot'=>$nilai,
            'detail_kriteria_parent'=>-1
        );
        
        if ($id) {
            $this->db->where($filter);
            $this->db->update('detail_kriteria',$data);
            $msg = 'diubah';
        }else{
            $this->db->insert('detail_kriteria', $data);
            $msg = 'disimpan';
        }

        if ($this->db->affected_rows()>0) {
            $result['message'] = 'Data berhasil '.$msg;
            $result['status'] = true;
        }else{
            $result['message'] = 'Data gagal '.$msg;
            $result['status'] = false;
        }
        return $result;
    }

    public function _updatesub()
    {
        $id = $this->input->post('iddetailkriteria');
        $idparent = $this->input->post('idsubkriteria');
        $nama = $this->input->post('namadetailkriteria');
        $nilai = $this->input->post('nilaidetailkriteria');
        $idkriteria = $this->input->post('idkriteria');
        $filter = array('detail_kriteria_id'=>$id);
        $data = array(
        	'detail_kriteria_nama'=>$nama,
        	'detail_kriteria_id_kriteria'=>$idkriteria,
            'detail_kriteria_bobot'=>$nilai,
            'detail_kriteria_parent'=>$idparent
        );
        
        if ($id) {
	        $this->db->where($filter);
	        $this->db->update('detail_kriteria',$data);
            $msg = 'diubah';
        }else{
        	$this->db->insert('detail_kriteria', $data);
            $msg = 'disimpan';
        }

        if ($this->db->affected_rows()>0) {
            $result['message'] = 'Data berhasil '.$msg;
            $result['status'] = true;
        }else{
            $result['message'] = 'Data gagal '.$msg;
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

    public function _setsub()
    {
        $id = $this->input->post('iddetailkriteria');
        $valparent = $this->input->post('val');
        if ($valparent == '-1') {
            $msg = 'dinon aktifkan';
        }else if($valparent == '0'){
            $msg = 'di aktifkan';
        }

        $filter = array('detail_kriteria_id'=>$id);
        $data = array('detail_kriteria_parent'=>$valparent);
        
        $this->db->where($filter);
        $this->db->update('detail_kriteria',$data);

        if ($this->db->affected_rows()>0) {
            $result['message'] = 'Sub Detail Kriteria berhasil '.$msg;
            $result['status'] = true;
        }else{
            $result['message'] = 'Sub Detail Kriteria gagal '.$msg;
            $result['status'] = false;
        }
        return $result;
    }

}

/* End of file model_detailkriteria.php */
/* Location: ./application/models/model_detailkriteria.php */