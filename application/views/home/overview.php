<?php $this->load->view('home/_partial/header') ?>
  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-container wow fadeIn">
      <h1 class="mb-4 pb-0">SISTEM INFORMASI SATU <span>DATA</span></h1>
      <p class="mb-4 pb-0">Desa Tlogorejo, Kecamatan Kepohbaru, Kabupaten Bojonegoro</p>
      </a>
      <a href="#publikasi" class="about-btn scrollto">Data Terbuka</a>
    </div>
  </section>

  <main id="main">

    <!--==========================
      Speakers Section
    ============================-->
    <section id="ttgAplikasi" class="wow fadeInUp mt-3 mb-3 p-3">
      <div class="container mt-3">
        <div class="section-header">
          <h2>Tentang Aplikasi</h2>
          <p>Sistem Informasi Satu Data Desa Tlogorejo</p>
        </div>

        <div class="row">
          <div class="row">
           <div class="col-md-7">
             <p style="font-size: 18px"><b>SISADA (Sistem Informasi Satu Data)</b> Merupakan Sistem Informasi yang mengintegrasikan data-data yang ada di Desa Tlogorejo termasuk data kependudukan, penerima PKH, dll</p>
           </div>
           <div class="col-md-5">
             <img src="<?= base_url() ?>/assets/home/img/pengertian-sistem.png" class="img-fluid">
           </div>
          </div>
        </div>
      </div>

    </section>

    <!--==========================
      Schedule Section
    ============================-->
    <section id="layanan" class="section-with-bg">
      <div class="container wow fadeInUp mt-3 mb-3 p-3">
        <div class="section-header">
          <h2>Layanan</h2>
          <p>Sistem Informasi Satu Data Desa Tlogorejo</p>
        </div>
        <div class="container">
        <div class="row text-center">
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-code-branch fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading mt-3">Integrasi Data</h4>
            <p class="text-muted">Mengintegrasikan data yang ada di Desa Tlogorejo mulai dari data kependudukan, data penerima PKH, dll</p>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-chart-bar fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading mt-3">Analisis Data</h4>
            <p class="text-muted">Selain Mengintegrasikan data, data tersebt juga akan dianalisa menjadi Grafik atau Statistik</p>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading mt-3">Publikasi Data</h4>
            <p class="text-muted">Mempublikasikan data yang telah diolah menjadi sebuah grafik atau statistik</p>
          </div>
        </div>
      </div>
        </div>

      </div>

    </section>

    <!--==========================
      Venue Section
    ============================-->
    <section id="publikasi" class="wow fadeInUp">

      <div class="container wow fadeInUp ">

        <div class="section-header mt-3 mb-3 p-3">
          <h2>Data terbuka</h2>
          <p>Sistem Informasi Satu Data Desa Tlogorejo</p>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="speaker">
            <img class="img-fluid" src="<?= base_url() ?>assets/home/img/portfolio/01-thumbnail.jpg" alt="">
              <div class="details mt-2">
                <h3>
                  <a href="<?= base_url() ?>home/publikasi/penduduk"><h4>Data Penduduk</h4></a>
                </h3>
                <p>Data Penduduk Desa Tlogorejo</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker">
            <img class="img-fluid" src="<?= base_url() ?>assets/home/img/portfolio/02-thumbnail.jpg" alt="">
              <div class="details mt-2">
                <h3>                  
                  <a href="<?= base_url() ?>home/publikasi/pekerjaan"><h4>Data Pekerjaan</h4></a>
                </h3>
                <p>Data Pekerjaan Desa Tlogorejo</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker">
            <img class="img-fluid" src="<?= base_url() ?>assets/home/img/portfolio/03-thumbnail.jpg" alt="">
              <div class="details mt-2">
                <h3>                  
                  <a href="<?= base_url() ?>home/publikasi/pendidikan"><h4>Data Pendidikan</h4></a>
                </h3>
                <p>Data Penddikan Tlogorejo</p>
                <div class="social">
              </div>
            </div>
          </div>
          
        </div>

      </div>

      <br><br>
    </section>



    <!--==========================
      Subscribe Section
    ============================-->
    <section id="subscribe">
      <div class="container wow fadeInUp mt-3 mb-3 p-3">
        
      </div>
    </section>

    <!--==========================
      Contact Section
    ============================-->
    <section id="hubungiKami" class="section-bg wow fadeInUp mt-3 mb-3 p-3">

      <div class="container">

        <div class="section-header">
          <h2>Hubungi Kami</h2>
          <p>Sistem Informasi Satu Data Desa Tlogorejo</p>
        </div>

        <div class="form">
          <div id="sendmessage">Sampaikan aspirasi anda dengan mengisi form berikut :</div>
          <?= $this->session->flashdata('message'); ?>
          <div id="errormessage"></div>
          <form action="<?=base_url() ?>home/prosesAspirasi" method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="<?= set_value('nama') ?>"/>
                <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat" value="<?= set_value('alamat') ?>"/>
                <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="form-row">              
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= set_value('email') ?>"/>
                <?= form_error('email', '<small class="text-danger">', '</small>') ?>
              </div>
              <div class="form-group col-md-6">                
                <div class="form-group">
                  <label class="radio-inline h5 mt-2 ml-2"  for="Jk">
                    <input type="radio" name="jk" value="Laki-Laki" checked> Laki-Laki
                  </label>
                  <label class="radio-inline h5 mt-2 ml-2" for="Jk">
                    <input type="radio" name="jk" value="Perempuan" class="ml-2"> Perempuan
                  </label>
                </div>
                <?= form_error('jk', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
            <div class="form-group">
              <!-- <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value="<?= set_value('subject') ?>"/> -->

              <select class="form-control" id="subject" name="subject">
                <option>Pertanyaan</option>
                <option>Komentar</option>
                <option>Aspirasi</option>
              </select>
              <?= form_error('subject', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="aspirasi" rows="5" placeholder="Tuliskan Aspirasi Anda"></textarea>              
              <?= form_error('aspirasi', '<small class="text-danger">', '</small>') ?>
            </div>
            <small class="text-danger">*Aspirasi bisa berupa Komentar, Pertanyaan, atau pernyataan terkait aplikasi ini, tindak lanjut aspirasi akan ditindak lanjuti lewat email!!!</small>
            <div class="text-center"><button type="submit" class="btn btn-primary float-right mb-3"><i class="fas fa-send"></i> Kirim</button></div>
          </form>

        </div>
        <br><br>

      </div>
    </section><!-- #contact -->

  </main>
<?php $this->load->view('home/_partial/footer') ?>