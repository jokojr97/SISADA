  <?php $this->load->view('home/_partial/publikasi_header') ?>
  <main id="main" class="main-page  ">

    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
      <div class="container">
        <div class="section-header">
          <h2>Data Kependudukan Desa Tlogorejo</h2>
          <p>Sistem Informasi Satu Data Desa Tlogorejo.</p>
        </div>
        <div class="row">
          <div class="col-md-7">
            <div class="border p-3 mt-3">
              <!-- &nbsp<br><br><br><br><br><br><br><br> -->
              <div id="grafik1"></div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="border p-3 mt-3">
              <!-- &nbsp<br><br><br> -->
              <div id="grafik2"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="mt-3 pt-3">
              <br>
              <h3><b>Data Penduduk Desa Tlogorejo</b></h3>
              <hr>
            </div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr class="bg-primary text-white text-center">
                  <th scope="col">No</th>
                  <th scope="col">Nama Dusun</th>
                  <th scope="col">Jumlah Penduduk</th>
                  <th scope="col">Laki-Laki</th>
                  <th scope="col">Perempuan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row" class="text-center">1</th>
                  <td>Dusun A</td>
                  <td class="text-center">789</td>
                  <td class="text-center">455</td>
                  <td class="text-center">245</td>
                </tr>
                <tr>
                  <th scope="row" class="text-center">2</th>
                  <td>Dusun B</td>
                  <td class="text-center">786</td>
                  <td class="text-center">234</td>
                  <td class="text-center">456</td>
                </tr>
                <tr>
                  <th scope="row" class="text-center">3</th>
                  <td>Dusun C</td>
                  <td class="text-center">908</td>
                  <td class="text-center">546</td>
                  <td class="text-center">345</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </section>

  </main>
  <?php $this->load->view('home/_partial/publikasi_footer') ?>
  <?php $this->load->view('home/_partial/highchart') ?>
