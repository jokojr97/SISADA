<?php $this->load->view('adminsuper/_partial/header') ?>
<div class="container">
	<div class="row">
		<div class="col mx-auto">
			<a class="btn btn-primary mb-3" href="<?= base_url('admin/data_desa') ?>"><i class="fas fa-arrow-left"></i> Kembali ke menu Data Penduduk</a>
			<hr>
			<?= $this->session->flashdata('message'); ?>
			<form action="<?= base_url('admin/tambah_penduduk') ?>" method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="nokk" >Nomor KK:</label>         
							<input type="text" class="form-control" id="nokk" placeholder="Masukkan Nomor KK" name="nokk" value="<?= set_value('nokk') ?>">
							<?= form_error('nokk', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="nik" >NIK:</label>         
							<input type="text" class="form-control" id="nik" placeholder="Masukkan Nomor NIK" name="nik" value="<?= set_value('nik') ?>">
							<?= form_error('nik', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="nama" >nama lengkap:</label>         
							<input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap" name="nama" value="<?= set_value('nama') ?>">
							<?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="rt" >rt:</label>         
							<input type="text" class="form-control" id="rt" placeholder="Masukkan RT" name="rt" value="<?= set_value('rt') ?>">
							<?= form_error('rt', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="rw" >rw:</label>         
							<input type="text" class="form-control" id="rw" placeholder="Masukkan RW" name="rw" value="<?= set_value('rw') ?>">
							<?= form_error('rw', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="tempatlahir" >tempat lahir:</label>         
							<input type="text" class="form-control" id="tempatlahir" placeholder="Masukkan tempat lahir" name="tempatlahir" value="<?= set_value('tempatlahir') ?>">
							<?= form_error('tempatlahir', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="tanggallahir" >tanggal lahir:</label>         
							<input type="date" class="form-control" id="tanggallahir" placeholder="Masukkan tanggal lahir" name="tanggallahir" value="<?= set_value('tanggallahir') ?>">
							<?= form_error('tanggallahir', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="statuspajak" >status pajak:</label>         
							<input type="text" class="form-control" id="statuspajak" placeholder="Masukkan status pajak" name="statuspajak" value="<?= set_value('statuspajak') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="tahunpajak" >tahun pajak:</label>         
							<input type="text" class="form-control" id="tahunpajak" placeholder="Masukkan tahun pajak" name="tahunpajak" value="<?= set_value('tahunpajak') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="noaktakelahiran" >Nomor Akta Kelahiran:</label>         
							<input type="text" class="form-control" id="noaktakelahiran" placeholder="Masukkan nomor akta kelahiran" name="noaktakelahiran" value="<?= set_value('noaktakelahiran') ?>">
						</div>
			          	<div class="form-group">
							<label class="control-label h5 text-capitalize" for="golongandarah" >golongan darah:</label>
							<input type="text" class="form-control" id="golongandarah" placeholder="Masukkan Golongan Darah"  name="golongandarah" value="<?= set_value('golongandarah') ?>">
						</div>
						<label class="control-label h5 text-capitalize" for="Nama" >Jenis Kelamin:</label>
						<!-- <textarea  class="form-control" placeholder="Berikan Tanggapan Pada Komentar ..." name="aspirasi"  style="height: 100px" required></textarea> -->								    
		                <div class="form-group">
		                  <label class="radio-inline h5 mt-2 ml-2 font-weight-light"  for="Jk">
		                    <input type="radio" name="jk" value="Laki-Laki" checked> Laki-Laki
		                  :</label>
		                  <label class="radio-inline h5 mt-2 ml-2 font-weight-light" for="Jk">
		                    <input type="radio" name="jk" value="Perempuan" class="ml-2"> Perempuan
		                  :</label>
		                </div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="agama" >agama:</label>         
							<input type="text" class="form-control" id="agama" placeholder="Masukkan agama" name="agama" value="<?= set_value('agama') ?>">
							<?= form_error('agama', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="pendidikan" >pendidikan Terakhir:</label>         
							<input type="text" class="form-control" id="pendidikan" placeholder="Masukkan pendidikan" name="pendidikan" value="<?= set_value('pendidikan') ?>">
							<?= form_error('pendidikan', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="pekerjaan" >pekerjaan:</label>         
							<input type="text" class="form-control" id="pekerjaan" placeholder="Masukkan pekerjaan" name="pekerjaan" value="<?= set_value('pekerjaan') ?>">
							<?= form_error('pekerjaan', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="statusdikeluarga" >Status Hubungan Keluarga:</label>         
							<input type="text" class="form-control" id="statusdikeluarga" placeholder="Masukkan statusdikeluarga" name="statusdikeluarga" value="<?= set_value('statusdikeluarga') ?>">
							<?= form_error('statusdikeluarga', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="statusperkawinan" >status perkawinan:</label>         
							<input type="text" class="form-control" id="statusperkawinan" placeholder="Masukkan status perkawinan" name="statusperkawinan" value="<?= set_value('statusperkawinan') ?>">
							<?= form_error('statusperkawinan', '<small class="text-danger pl-3">', '</small>') ?>
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="noaktaperkawinan" >nomor akta perkawinan:</label>         
							<input type="text" class="form-control" id="noaktaperkawinan" placeholder="Masukkan no akta perkawinan" name="noaktaperkawinan" value="<?= set_value('noaktaperkawinan') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="tanggalperkawinan" >tanggal perkawinan:</label>         
							<input type="text" class="form-control" id="tanggalperkawinan" placeholder="Masukkan tanggal perkawinan" name="tanggalperkawinan" value="<?= set_value('tanggalperkawinan') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="noaktaperceraian" >nomor akta perceraian:</label>         
							<input type="text" class="form-control" id="noaktaperceraian" placeholder="Masukkan nomor akta perceraian" name="noaktaperceraian" value="<?= set_value('noaktaperceraian') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="tanggalperceraian" >tanggal perceraian:</label>         
							<input type="date" class="form-control" id="tanggalperceraian" placeholder="Masukkan tanggal perceraian" name="tanggalperceraian" value="<?= set_value('tanggalperceraian') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="kelainanfisikmental" >Kelainan fisik / mental:</label>         
							<input type="text" class="form-control" id="kelainanfisikmental" placeholder="Masukkan kelainan fisik / mental" name="kelainanfisikmental" value="<?= set_value('kelainanfisikmental') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="cacat" >penyandang cacat:</label>         
							<input type="text" class="form-control" id="cacat" placeholder="Masukkan cacat" name="cacat" value="<?= set_value('cacat') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="namaayah" >nama ayah:</label>         
							<input type="text" class="form-control" id="namaayah" placeholder="Masukkan nama ayah" name="namaayah" value="<?= set_value('namaayah') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="nikayah" >NIK Ayah:</label>         
							<input type="text" class="form-control" id="nikayah" placeholder="Masukkan NIK Ayah" name="nikayah" value="<?= set_value('nikayah') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="namaibu" >nama ibu:</label>         
							<input type="text" class="form-control" id="namaibu" placeholder="Masukkan Nama Ibu" name="namaibu" value="<?= set_value('namaibu') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="nikibu" >NIK Ibu:</label>         
							<input type="text" class="form-control" id="nikibu" placeholder="Masukkan NIK Ibu" name="nikibu" value="<?= set_value('nikibu') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="alamat" >alamat:</label>         
							<input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat" name="alamat" value="<?= set_value('alamat') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="alamatpenduduk" >Alamat Penduduk:</label>         
							<input type="text" class="form-control" id="alamatpenduduk" placeholder="Masukkan Alamat Penduduk" name="alamatpenduduk" value="<?= set_value('alamatpenduduk') ?>">
						</div>
						<div class="form-group">
							<label class="control-label h5 text-capitalize" for="kepalakeluarga" >Nama Kepala Keluarga:</label>         
							<input type="text" class="form-control" id="kepalakeluarga" placeholder="Masukkan Kepala Keluarga" name="kepalakeluarga" value="<?= set_value('statusdikeluarga') ?>">
						</div>
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