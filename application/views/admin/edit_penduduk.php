<?php $this->load->view('adminsuper/_partial/header') ?>
<div class="container">
	<div class="row">
		<div class="col mx-auto">
			<a class="btn btn-primary mb-3" href="<?= base_url('admin/data_desa') ?>"><i class="fas fa-arrow-left"></i> Kembali ke menu Data Penduduk</a>
			<hr>
			<?= $this->session->flashdata('message'); ?>
			<form action="<?= base_url('admin/edit_penduduk') ?>" method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="nokk" >Nomor KK:</label>         
							<input type="text" class="form-control" id="nokk" placeholder="Masukkan Nomor KK" name="nokk" value="<?= $detail["no_kk"] ?>">
							<?= form_error('nokk', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="nik" >NIK:</label>         
							<input type="text" class="form-control" id="nik" placeholder="Masukkan Nomor NIK" name="nik" value="<?= $detail["nik"] ?>">
							<?= form_error('nik', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="nama" >nama lengkap:</label>         
							<input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap" name="nama" value="<?= $detail["nama_penduduk"] ?>">
							<?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="rt" >rt:</label>         
							<input type="text" class="form-control" id="rt" placeholder="Masukkan RT" name="rt" value="<?= $detail["rt"] ?>"> 
							<?= form_error('rt', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="rw" >rw:</label>         
							<input type="text" class="form-control" id="rw" placeholder="Masukkan RW" name="rw" value="<?= $detail["rw"] ?>">
							<?= form_error('rw', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="tempatlahir" >tempat lahir:</label>         
							<input type="text" class="form-control" id="tempatlahir" placeholder="Masukkan tempat lahir" name="tempatlahir" value="<?= $detail["tempat_lahir"] ?>">
							<?= form_error('tempatlahir', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="tanggallahir" >tanggal lahir:</label>         
							<input type="text" class="form-control" id="tanggallahir" placeholder="Masukkan tanggal lahir" name="tanggallahir" value="<?= $detail["tanggal_lahir"] ?>">
							<?= form_error('tanggallahir', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="statuspajak" >status pajak:</label>         
							<input type="text" class="form-control" id="statuspajak" placeholder="Masukkan status pajak" name="statuspajak" value="<?= $detail["status_pajak"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="tahunpajak" >tahun pajak:</label>         
							<input type="text" class="form-control" id="tahunpajak" placeholder="Masukkan tahun pajak" name="tahunpajak" value="<?= $detail["tahun_pajak"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="noaktakelahiran" >Nomor Akta Kelahiran:</label>         
							<input type="text" class="form-control" id="noaktakelahiran" placeholder="Masukkan nomor akta kelahiran" name="noaktakelahiran" value="<?= $detail["no_akta_kelahiran"] ?>">
						</div>
			          	<div class="form-group">
							<label class="control-label h5 text-capitalize" for="golongandarah" >golongan darah:</label>
							<input type="text" class="form-control" id="golongandarah" placeholder="Masukkan Golongan Darah"  name="golongandarah" value="<?= $detail["golongan_darah"] ?>">
						</div>
						<label class="control-label h5 text-capitalize" for="Nama" >Jenis Kelamin:</label>
						<!-- <textarea  class="form-control" placeholder="Berikan Tanggapan Pada Komentar ..." name="aspirasi"  style="height: 100px" required></textarea> -->								    
		                <div class="form-group">
		                  	<?php if ($detail["jenis_kelamin"] == "Perempuan") { ?>
		                  <label class="radio-inline h5 mt-2 ml-2 font-weight-light" for="Jk">
		                    <input type="radio" name="jk" value="Perempuan" class="ml-2"> Perempuan
		                  :</label>
		                  <label class="radio-inline h5 mt-2 ml-2 font-weight-light"  for="Jk">
		                    <input type="radio" name="jk" value="Laki-Laki" checked> Laki-Laki
		                  :</label>
		                  	<?php } else { ?>
		                  <label class="radio-inline h5 mt-2 ml-2 font-weight-light"  for="Jk">
		                    <input type="radio" name="jk" value="Laki-Laki" checked> Laki-Laki
		                  :</label>

		                  <label class="radio-inline h5 mt-2 ml-2 font-weight-light" for="Jk">
		                    <input type="radio" name="jk" value="Perempuan" class="ml-2"> Perempuan
		                  :</label>
		                  	<?php } ?>
		                </div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="agama" >agama:</label>         
							<input type="text" class="form-control" id="agama" placeholder="Masukkan agama" name="agama" value="<?= $detail["agama"] ?>">
							<?= form_error('agama', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="pendidikan" >pendidikan Terakhir:</label>         
							<input type="text" class="form-control" id="pendidikan" placeholder="Masukkan pendidikan" name="pendidikan" value="<?= $detail["pendidikan_terakhir"] ?>">
							<?= form_error('pendidikan', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="pekerjaan" >pekerjaan:</label>         
							<input type="text" class="form-control" id="pekerjaan" placeholder="Masukkan pekerjaan" name="pekerjaan" value="<?= $detail["pekerjaan"] ?>">
							<?= form_error('pekerjaan', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="statusdikeluarga" >Status Hubungan Keluarga:</label>         
							<input type="text" class="form-control" id="statusdikeluarga" placeholder="Masukkan statusdikeluarga" name="statusdikeluarga" value="<?= $detail["status_hubungan_keluarga"] ?>">
							<?= form_error('statusdikeluarga', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="statusperkawinan" >status perkawinan:</label>         
							<input type="text" class="form-control" id="statusperkawinan" placeholder="Masukkan status perkawinan" name="statusperkawinan" value="<?= $detail["status_perkawinan"] ?>">
							<?= form_error('statusperkawinan', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="noaktaperkawinan" >nomor akta perkawinan:</label>         
							<input type="text" class="form-control" id="noaktaperkawinan" placeholder="Masukkan no akta perkawinan" name="noaktaperkawinan" value="<?= $detail["no_akta_perkawinan"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="tanggalperkawinan" >tanggal perkawinan:</label>         
							<input type="text" class="form-control" id="tanggalperkawinan" placeholder="Masukkan tanggal perkawinan" name="tanggalperkawinan" value="<?= $detail["tanggal_perkawinan"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="noaktaperceraian" >nomor akta perceraian:</label>         
							<input type="text" class="form-control" id="noaktaperceraian" placeholder="Masukkan nomor akta perceraian" name="noaktaperceraian" value="<?= $detail["nomor_akta_perceraian"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="tanggalperceraian" >tanggal perceraian:</label>         
							<input type="text" class="form-control" id="tanggalperceraian" placeholder="Masukkan tanggal perceraian" name="tanggalperceraian" value="<?= $detail["tanggal_perceraian"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="kelainanfisikmental" >Kelainan fisik / mental:</label>         
							<input type="text" class="form-control" id="kelainanfisikmental" placeholder="Masukkan kelainan fisik / mental" name="kelainanfisikmental" value="<?= $detail["kelainan_fisik_mental"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="cacat" >penyandang cacat:</label>         
							<input type="text" class="form-control" id="cacat" placeholder="Masukkan cacat" name="cacat" value="<?= $detail["penyandang_cacat"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="namaayah" >nama ayah:</label>         
							<input type="text" class="form-control" id="namaayah" placeholder="Masukkan nama ayah" name="namaayah" value="<?= $detail["nama_ayah"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="nikayah" >NIK Ayah:</label>         
							<input type="text" class="form-control" id="nikayah" placeholder="Masukkan NIK Ayah" name="nikayah" value="<?= $detail["nik_ayah"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="namaibu" >nama ibu:</label>         
							<input type="text" class="form-control" id="namaibu" placeholder="Masukkan Nama Ibu" name="namaibu" value="<?= $detail["nama_ibu"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="nikibu" >NIK Ibu:</label>         
							<input type="text" class="form-control" id="nikibu" placeholder="Masukkan NIK Ibu" name="nikibu" value="<?= $detail["nik_ibu"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="alamat" >alamat:</label>         
							<input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat" name="alamat" value="<?= $detail["alamat"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="alamatpenduduk" >Alamat Penduduk:</label>         
							<input type="text" class="form-control" id="alamatpenduduk" placeholder="Masukkan Alamat Penduduk" name="alamatpenduduk" value="<?= $detail["alamat_penduduk"] ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="kepalakeluarga" >Nama Kepala Keluarga:</label>         
							<input type="text" class="form-control" id="kepalakeluarga" placeholder="Masukkan Kepala Keluarga" name="kepalakeluarga" value="<?= $detail["nama_kepala_keluarga"] ?>">
						</div>
						<input type="hidden" name="id" value="<?= $this->uri->segment(3) ?>">
						<br>
						<button type="submit" class="btn btn-success float-right btn-lg" value="MASUK"><i class="fas fa-save"></i> Simpan</button>
					</div>
				</div>
				<br>					
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('adminsuper/_partial/footer') ?>