<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<?php
  // $a = $_GET['kode'];
  // $tahun = $_GET['tahun'];
  // $table = "odcbjn_rup".$tahun;
  // $query = $this->db->get_where($table, ['id' =>$a]);
  // foreach ($query->result() as $row) {
  //   $pagu = $row->total_pagu;
  // }
  // $query = $this->db->get_where('odcbjn_lpsescrap', ['id_rup' => $a]);
  // foreach ($query->result() as $row) {
  //   $hps = $row->hps;
  //   $penawaran = $row->harga_penawaran;
  //   $koreksi = $row->harga_terkoreksi;
  //   $negosiasi = $row->hasil_negosiasi;
  // }
  $dusun1 = $rw[1];
  $dusun2 = $rw[2];
  $dusun3 = $rw[3];
  $dusun4 = $rw[4];
  $jumlahl = $l;
  $jumlahp = $p;
  

?>
<script type="text/javascript">
 var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'grafik1',
            type: 'column'
         },   
         title: {
            text: 'Grafik Kependudukan Tahun 2019'
         },
         credits: {
          enabled: false
         },
         xAxis: {
            categories: ['Jiwa']
         },
         yAxis: {
            title: {
               text: 'Data Penduduk'
            }
         },
              series:             
            [
            
                  {
                      name: 'RW 1',
                      data: [<?= $dusun1 ?>]
                  },
                  {
                      name: 'RW 2',
                      data: [<?= $dusun2 ?>]
                  },
                  {
                      name: 'RW 3',
                      data: [<?= $dusun3 ?>]
                  },
                  {
                      name: 'RW 4',
                      data: [<?= $dusun4 ?>]
                  }
            ]
      });
   }); 
</script>

<!-- l/p chart -->

<script type="text/javascript">
var jumlahl = <?= $jumlahl ?>;
var jumlahp = <?= $jumlahp ?>;
var Lainnya = 0;
$('#grafik2').highcharts({
 chart: {

  type: 'pie',
  marginTop: 80
 },
 credits: {
  enabled: false
 },
 title: {
  text: 'Jumlah Penduduk'
 },
 subtitle: {
  text: 'TAHUN 2019'
 },
 xAxis: {
  categories: ['Data Penduduk Dusun A'],
  labels: {
   style: {
    fontSize: '10px',
    fontFamily: 'Verdana, sans-serif'
   }
  }
 },
 legend: {
  enabled: true
 },
 plotOptions: {
   pie: {
     allowPointSelect: true,
     cursor: 'pointer',
     dataLabels: {
       enabled: true
     },
     showInLegend: true
   }
 },
 series: [{
   'name':'Jumlah Penduduk',
   'data':[
     ['Laki-Laki',jumlahl],
     ['Perempuan',jumlahp]
   ]
 }]
});

</script>
