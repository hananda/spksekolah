<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_sekolah extends CI_Model {

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
				FROM sekolah WHERE sekolah_aktif = 'Y'";
		if($search['value'] != ""){
            $query .=preg_match("/WHERE/i",$query)? " AND ":" WHERE ";
			$query .= "(sekolah_nama = '". $search['value'] ."')";
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
            $image = ($d['sekolah_foto']) ? 'foto_sekolah/'.$d['sekolah_foto'] : 'assets/images/no_image.jpg';
			$r[0] = $d['sekolah_id'];
            $r[1] = $i;
            $r[2] = '<img src="'.base_url().$image.'" width="128 height="128" />';
            $r[3] = $d['sekolah_nama'];
			$r[4] = '<a class="btnkriteria" style="cursor:pointer;" title="Kriteria"><i class="fa fa-cog"></i></a>&nbsp;
            <a class="btnedit" style="cursor:pointer;" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
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
        $id = $this->input->post('idsekolah');
        $nama = $this->input->post('namasekolah');
        $desc = $this->input->post('desc');
        $filter = array('sekolah_id'=>$id);
        $data = array('sekolah_nama'=>$nama,'sekolah_desc'=>$desc);
        $result = $this->model_public->upload("fotosekolah");
        if ($result['stats']) {
            $data['sekolah_foto'] = $result['nama'];
        }
        
        if ($id) {
            $this->db->where($filter);
            $this->db->update('sekolah',$data);
        }else{
            $data['sekolah_user'] = $this->session->userdata('user_id');
            $this->db->set('sekolah_created_date', "'".date('Y-m-d H:i:s')."'",false);
            $this->db->set('sekolah_updated_date', "'".date('Y-m-d H:i:s')."'",false);
            $this->db->insert('sekolah', $data);
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
        $id = $this->input->post('idsekolah');
        $filter = array('sekolah_id'=>$id);
        $data = array('sekolah_aktif'=>'T');
        
        $this->db->where($filter);
        $this->db->update('sekolah',$data);

        if ($this->db->affected_rows()>0) {
            $result['message'] = 'Data berhasil dihapus';
            $result['status'] = true;
        }else{
            $result['message'] = 'Data gagal dihapus';
            $result['status'] = false;
        }
        return $result;
    }

    public function _getdesc()
    {
        $idsekolah = $this->input->post('idsekolah');
        $result = $this->db->query('SELECT sekolah_desc from sekolah WHERE sekolah_id = '.$idsekolah)->row();
        return $result;
    }

    public function _insertkriteria()
    {
        $idsekolah = $this->input->post('idsekolah');
        $this->db->where('t_kriteria_sekolah_id', $idsekolah);
        $this->db->delete('t_kriteria');
        $kriteria = $this->model_public->_getKriteria();
        if ($kriteria->num_rows > 0) {
            foreach ($kriteria->result() as $r) {
                $detailkriteria = $this->input->post('kategori_'.$r->kriteria_id);
                for ($i=0; $i < count($detailkriteria); $i++) { 
                    $data = array(
                        't_kriteria_sekolah_id'=>$idsekolah,
                        't_kriteria_kriteria_id'=>$r->kriteria_id
                    );

                    $data['t_kriteria_created_date'] = date('Y-m-d H:i:s');
                    $data['t_kriteria_detail_kriteria_id'] = $detailkriteria[$i];
                    $data['t_kriteria_user'] = $this->session->userdata('user_id');
                    $this->db->insert('t_kriteria', $data);
                }   
            }
        }

        if ($this->db->affected_rows()>0) {
            $result['message'] = 'Data berhasil disimpan';
            $result['status'] = true;
        }else{
            $result['message'] = 'Data gagal disimpan';
            $result['status'] = false;
        }
        return $result;
    }

}

/* End of file model_sekolah.php */
/* Location: ./application/models/model_sekolah.php */