<?php
class M_admin extends CI_Model{

    function __construct() {
        // Set table name
        $this->table = 'satudata_pendduk';
    }

	function get_profil_by_kode($email){
		$hsl = $this->db->get_where('satudata_user', ['email' => $email])->row_array();
		return $hsl;
	}
	function get_penduduk_by_kode($id){
		$hsl = $this->db->get_where('satudata_pendduk', ['nomor' => $id])->row_array();
		return $hsl;
	}
	function get_profil_by_id($id){
		$hsl = $this->db->get_where('satudata_user', ['id' => $id])->row_array();
		return $hsl;
	}
	function get_aspirasi_by_id($id){
		$hsl = $this->db->get_where('satudata_aspirasi', ['id' => $id])->row_array();
		return $hsl;
	}
	function get_aspirasi_proses(){
		$hsl = $this->db->query("SELECT * FROM `satudata_aspirasi` WHERE `subject` != 'jawaban' AND `is_active` = 1 ORDER BY id DESC");
		return $hsl;
	}
	function get_aspirasi_selesai(){
		$hsl = $this->db->query("SELECT * FROM `satudata_aspirasi` WHERE `subject` != 'jawaban' AND `is_active` = 2 ORDER BY id DESC");
		return $hsl;
	}
	function count_aspirasi_laki2(){
		$this->db->where('role_id', 3);
		$this->db->where('jenis_kelamin', 'Laki-Laki');
		$this->db->from('satudata_aspirasi');
		$hsl = $this->db->count_all_results();
		return $hsl;
	}
	function count_aspirasi_perempuan(){
		$this->db->where('role_id', 3);
		$this->db->where('jenis_kelamin', 'Perempuan');
		$this->db->from('satudata_aspirasi');
		$hsl = $this->db->count_all_results();
		return $hsl;
	}
	function get_pengguna(){
		$hsl = $this->db->get_where('satudata_user', ['is_active' => 1]);
		return $hsl;
	}
	function get_rumah_tangga(){
		$hsl = $this->db->query('SELECT * FROM `satudata_pendduk` GROUP BY `no_kk`');
		return $hsl;
	}
	function get_pendidikan(){
		$hsl = $this->db->query('SELECT * FROM `satudata_pendduk` GROUP BY `pendidikan_terakhir`');
		return $hsl;
	}
	function get_status_perkawinan(){
		$hsl = $this->db->query('SELECT * FROM `satudata_pendduk` GROUP BY `status_perkawinan`');
		return $hsl;
	}
	function get_pekerjaan(){
		$hsl = $this->db->query('SELECT * FROM `satudata_pendduk` GROUP BY `pekerjaan`');
		return $hsl;
	}
	function get_datatable($sql){
		$hsl = $this->db->query($sql);
 		return $hsl;
	}
	function update_status_aspirasi($id){
		$this->db->set('is_active', 2);
		$this->db->where('id', $id);
		$hsl = $this->db->update('satudata_aspirasi');
		return $hsl;
	}
	function nonaktifkan_user($id){
		$this->db->set('is_active', 0);
		$this->db->where('id', $id);
		$hsl = $this->db->update('satudata_user');
		return $hsl;
	}
	function hapus_penduduk($id){
		$this->db->set('is_active', 0);
		$this->db->where('nomor', $id);
		$hsl = $this->db->update('satudata_pendduk');
		return $hsl;
	}
	function edit_user_by_id($id,$uname,$nama,$email,$jk,$role){
		$this->db->set('username', $uname);
		$this->db->set('email', $email);
		$this->db->set('nama', $nama);
		$this->db->set('role_id', $role);
		$this->db->set('jenis_kelamin', $jk);
		$this->db->where('id', $id);
		$hsl = $this->db->update('satudata_user');
		return $hsl;
	}
	function edit_penduduk_by_id($id,$rt,$rw,$nokk,$nik,$nama,$tempatlahir,$tanggallahir,$statuspajak,$tahunpajak, $jk,$noaktakelahiran,$golongandarah,$agama,$pendidikan,$pekerjaan,$statusdikeluarga,$statusperkawinan,$noaktperkawinan,$tanggalperkawinan,$noaktaperceraian,$tanggalperceraian,$kelainanfisikmental,$cacat,$namaayah,$nikayah,$namaibu,$nikibu,$alamat,$alamatpenduduk,$kepalakeluarga)
	{
		$this->db->set('rt', $rt);
		$this->db->set('rw', $rw);
		$this->db->set('no_kk', $nokk);
		$this->db->set('nik', $nik);
		$this->db->set('nama_penduduk', $nama);
		$this->db->set('tempat_lahir', $tempatlahir);
		$this->db->set('status_pajak', $statuspajak);
		$this->db->set('tahun_pajak', $tahunpajak);
		$this->db->set('tanggal_lahir', $tanggallahir);
		$this->db->set('jenis_kelamin', $jk);
		$this->db->set('no_akta_kelahiran', $noaktakelahiran);
		$this->db->set('golongan_darah', $golongandarah);
		$this->db->set('agama', $agama);
		$this->db->set('pendidikan_terakhir', $pendidikan);
		$this->db->set('pekerjaan', $pekerjaan);
		$this->db->set('status_hubungan_keluarga', $statusdikeluarga);
		$this->db->set('status_perkawinan', $statusperkawinan);
		$this->db->set('no_akta_perkawinan', $noaktperkawinan);
		$this->db->set('tanggal_perkawinan', $tanggalperkawinan);
		$this->db->set('nomor_akta_perceraian', $noaktaperceraian);
		$this->db->set('tanggal_perceraian', $tanggalperceraian);
		$this->db->set('kelainan_fisik_mental', $kelainanfisikmental);
		$this->db->set('penyandang_cacat', $cacat);
		$this->db->set('nama_ayah', $namaayah);
		$this->db->set('nik_ayah', $nikayah);
		$this->db->set('nama_ibu', $namaibu);
		$this->db->set('nik_ibu', $nikibu);
		$this->db->set('alamat', $alamat);
		$this->db->set('alamat_penduduk', $alamatpenduduk);
		$this->db->set('nama_kepala_keluarga', $kepalakeluarga);
		$this->db->where('nomor', $id);
		$hsl = $this->db->update('satudata_pendduk');
		return $hsl;
	}


    /*
     * Fetch members data from the database
     * @param array filter data based on the passed parameters
     */
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("nomor", $params)){
                $this->db->where('nomor', $params['nomor']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('nomor', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }
    
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($data = array()) {
        if(!empty($data)){
            // Insert member data
            $insert = $this->db->insert($this->table, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            
            // Update member data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }
}