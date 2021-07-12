@section('title', 'Dashboard')

<div>
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
        <h2 class="no-margin-bottom">Dashboard</h2>
        </div>
    </header>

    <!-- Dashboard Counts Section-->
    <section class="dashboard-counts no-padding-bottom">
        <div class="container-fluid">
          <div class="row bg-white has-shadow">
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
              <div class="item d-flex align-items-center">
                <div class="icon bg-violet"><i class="icon-user"></i></div>
                <div class="title"><span>Petugas<br>Aktif</span>
                  <div class="progress">
                    <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                  </div>
                </div>
                <div class="number"><strong>{{ $petugasAktif }}</strong></div>
              </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
              <div class="item d-flex align-items-center">
                <div class="icon bg-red"><i class="icon-padnote"></i></div>
                <div class="title"><span>Penilaian<br>Petugas</span>
                  <div class="progress">
                    <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                  </div>
                </div>
                <div class="number"><strong>{{ $penilaianPetugas }}</strong></div>
              </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
              <div class="item d-flex align-items-center">
                <div class="icon bg-green"><i class="icon-bill"></i></div>
                <div class="title"><span>Penilaian<br>Layanan</span>
                  <div class="progress">
                    <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                  </div>
                </div>
                <div class="number"><strong>{{ $penilaianLayanan }}</strong></div>
              </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
              <div class="item d-flex align-items-center">
                <div class="icon bg-orange"><i class="icon-check"></i></div>
                <div class="title"><span>Jumlah<br>Pengaduan</span>
                  <div class="progress">
                    <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                  </div>
                </div>
                <div class="number"><strong>{{ $jumlahPengaduan }}</strong></div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>
