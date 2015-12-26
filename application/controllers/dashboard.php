<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data = array();
        $data['kriteria'] = $this->model_public->_getKriteria();
		$this->load->view('dashboard', $data, FALSE);
	}

    public function getdatasekolah($pages=1,$iddetail=0)
    {
        // $pages = ($this->input->get('pages')) ? $this->input->get('pages') : 1;
        $numperpage = 6;
        $start_from = ($pages-1) * $numperpage; 
        $data['curr_page'] = $pages;
        $data['countsekolah'] = $this->model_public->_getSekolahdash(0,0,$iddetail)->num_rows;
        $data['page'] = ceil($data['countsekolah'] / $numperpage); 
        $data['numperpage'] = $numperpage;
        $data['sekolah'] = $this->model_public->_getSekolahdash($numperpage,$start_from,$iddetail);
        $this->load->view('datadashboard', $data, FALSE);
    }

	public function detail($id='')
	{
		$data = array();
		$this->db->order_by('sekolah_updated_date', 'desc');
		$data['id'] = $id;
		$data['sekolah'] = $this->model_public->_getSekolah(array('sekolah_id'=>$id))->row();
		$this->load->view('detailsekolah', $data, FALSE);
	}

	public function sekolah_typeahead()
	{
		$result = array();
		$result['result'] = $this->model_public->sekolah_typeahead();
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

    public function getdetail($idkriteria=0)
    {
        $data = $this->model_public->_getDetailKriteria(array("detail_kriteria_id_kriteria"=>$idkriteria))->result();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

	public function compare()
	{
		$arridsekolah = $this->input->post('arr');
		$arridsekolah = implode(",", $arridsekolah);

		$result = array();
        $arralternatif = array();
        $arrkriteria = array();
        $arrperbandingan = array();
        $arrhasilakhir = array();
        $urutanalternatif = 0;

        $sqlalternatif = "select * from sekolah where sekolah_aktif = 'Y' AND sekolah_id IN(".$arridsekolah.")";
        $sqlkriteria = "SELECT kriteria_id FROM kriteria WHERE kriteria_aktif = 'Y'";
        $sqltransaksikriteria = "SELECT
									*, (
										SELECT
											variabel_nilai
										FROM
											variabel
										WHERE
											A.nilai BETWEEN variabel_range_awal
										AND variabel_range_akhir
									) AS bobot
								FROM
									(
										SELECT
											t_kriteria_sekolah_id,
											t_kriteria_kriteria_id,
											SUM(detail_kriteria_bobot) AS nilai
										FROM
											v_detail_kriteria
										WHERE t_kriteria_sekolah_id IN (".$arridsekolah.")
										GROUP BY
											t_kriteria_sekolah_id,
											t_kriteria_kriteria_id
									) A";
        $queryalternatif = $this->db->query($sqlalternatif);
        $querykriteria = $this->db->query($sqlkriteria);
        $querytransaksikriteria = $this->db->query($sqltransaksikriteria)->result();
        
        //proses ambil alternatif yang tersedia pada periode yang terpilih
        if ($queryalternatif->num_rows > 0) {
            foreach ($queryalternatif->result() as $r) {
                // array_push($arralternatif, $r->sekolah_id);
                $arralternatif[$r->sekolah_id] = array();
                // $urutanalternatif++;
            }
        }else
        {
            $result['msg'] = "System tidak memiliki alternatif pendukung SPK !";
            $result['status'] = false;
            return $result;
        }

        // proses ambil kriteria spk yang ada pada system
        if($querykriteria->num_rows > 0){
            foreach ($querykriteria->result() as $r) {
                array_push($arrkriteria, $r->kriteria_id);
            }
        }else{
            $result['msg'] = "System tidak memiliki kriteria pendukung SPK !";
            $result['status'] = false;
            return $result;
        }

        // mengambil bobot setiap kriteria pada masing masing alternatif
        foreach ($arralternatif as $index => $val) { 
            for ($j=0; $j < count($arrkriteria); $j++) { 
                foreach ($querytransaksikriteria as $r) {
                    if($r->t_kriteria_kriteria_id == $arrkriteria[$j] && $r->t_kriteria_sekolah_id == $index)
                    {
                        array_push($arralternatif[$index], $r->bobot);
                        break;
                    }
                }
            }
        }

        // inisialisasi tempat nilai leavingflow dan enteringflow pada masing masing alternatif
        foreach ($arralternatif as $alternatif => $bobot) {
            $arrperbandingan[$alternatif]["leavingflow"] = array();
            $arrperbandingan[$alternatif]["enteringflow"] = array(); 
        }


        //menghitung perbandingan kriteria antar masing masing alternatif
        foreach ($arralternatif as $alternatif => $bobot) {
            
            foreach ($arralternatif as $alternatif1 => $bobot1) {
                if($alternatif == $alternatif1)
                    continue;

                $jumlahperbandingankriteria = 0;
                for ($i=0; $i < count($arrkriteria); $i++) { 
                    $hitung = $bobot[$i] - $bobot1[$i];
                    if($hitung > 0)
                        $hasil = 1;
                    else if($hitung <= 0)
                        $hasil = 0;
                    $jumlahperbandingankriteria += $hasil;
                }
                $nilaiakhir = $jumlahperbandingankriteria / count($arrkriteria);
                array_push($arrperbandingan[$alternatif]["leavingflow"],$nilaiakhir);
                array_push($arrperbandingan[$alternatif1]["enteringflow"],$nilaiakhir);
            } 
        }

        //menghitung hasil akhir / net flow melalui rumus leaving flow - entering flow
        foreach ($arrperbandingan as $alternatif => $lev_ent) {
            $sumlev = array_sum($lev_ent["leavingflow"]);
            $sument = array_sum($lev_ent["enteringflow"]);
            $pembagi = (count($arralternatif) - 1);
            $leavingflow = $sumlev / $pembagi;
            $enteringflow = $sument / $pembagi;
            $netflow = $leavingflow - $enteringflow;
            $arrhasilakhir[$alternatif] = $netflow;
        }

        // setelah mendapat hasil akhir, insert ke database tabel ranking
        // $this->db->query("DELETE FROM ranking WHERE id_transaksi_beasiswa = ".$idperiode);
        $data = array();
        $i = 0;

        foreach ($queryalternatif->result_array() as $r) {
	        foreach ($arrhasilakhir as $alternatif => $netflow) {
	        	if ($r["sekolah_id"] == $alternatif) {
	        		$r["nilai_akhir"] = $netflow;
	        	}
	        	$data[$i] = $r;
	        }
	        $i++;
        }

        //sorting data
        $sort = array();
		foreach($data as $k=>$v) {
		    $sort['nilai_akhir'][$k] = $v["nilai_akhir"];
		}

		array_multisort($sort['nilai_akhir'], SORT_DESC, $data);
  //       for ($i = count($data) - 1; $i > 1; $i--)
		// {
		//     $first = 0;
		//     for ($j=1; $j<=$i; $j++)
		//     {
		//        	if ($data[$j]->nilai_akhir < $data[$first]->nilai_akhir)
		// 		$first = $j;
		//     }
		//     $temp = $data[$first];
		//     $data[$first] = $data[$i];
		//     $data[$i] = $temp;
		// }
        // var_dump($arralternatif);
        // var_dump($arrkriteria);
        // var_dump($arrperbandingan);
        // var_dump($arrhasilakhir);
        $result['msg'] = "Perhitungan SPK Beasiswa dengan metode promete berhasil dilakukan";
        $result['status'] = true;
        $result['data'] = $data;
        $this->load->view('v_hasil_spk',$result, FALSE);
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */