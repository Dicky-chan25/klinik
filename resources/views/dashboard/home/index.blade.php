@extends('dashboard-layout.main')

@section('dashboard')
<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pasien Hari ini</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">2 Orang</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendaftar Pasien</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">100 Orang</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Transaksi Hari Ini</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 0.00</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Billing</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 300.000</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Content Row -->

<div class="row">

  <!-- Area Chart -->
  <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Transaksi Pasien</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Kelompokkan :</div>
            <a class="dropdown-item" href="#">Hari Ini</a>
            <a class="dropdown-item" href="#">Minggu Ini</a>
            <a class="dropdown-item" href="#">Bulan Ini</a>
            <a class="dropdown-item" href="#">Semua</a>
          </div>
        </div>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-area">
          <canvas id="myAreaChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Pie Chart -->
  <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Kategori Umur Pasien</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Kelompokkan :</div>
            <a class="dropdown-item" href="#">Hari Ini</a>
            <a class="dropdown-item" href="#">Minggu Ini</a>
            <a class="dropdown-item" href="#">Bulan Ini</a>
            <a class="dropdown-item" href="#">Semua</a>
          </div>
        </div>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
          <canvas id="myPieChart"></canvas>
        </div>
        <div class="mt-4 text-center small">
          <span class="mr-2">
            <i class="fas fa-circle text-primary"></i> Umur Dibawah 12 Tahun
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-success"></i> Umur 12 - 50 Tahun
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-info"></i> Di atas 50 Tahun
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-lg-6 mb-4">

    {{-- <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
      </div>
      <div class="card-body">
        <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0"
            aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40"
            aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0"
            aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0"
            aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
        <div class="progress">
          <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
            aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div> --}}

    <div class="row">
      {{-- <div class="col-xl-8">
        <!-- Account details card-->
        <div class="card mb-4">
          <div class="card-header">Account Details</div>
          <div class="card-body">
            <form>
              <!-- Form Group (username)-->
              <div class="mb-3">
                <label class="small mb-1" for="inputUsername">Username (how your name will appear to other
                  users on the site)</label>
                <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username"
                  value="username">
              </div>
              <!-- Form Row-->
              <div class="row gx-3 mb-3">
                <!-- Form Group (first name)-->
                <div class="col-md-6">
                  <label class="small mb-1" for="inputFirstName">First name</label>
                  <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name"
                    value="Valerie">
                </div>
                <!-- Form Group (last name)-->
                <div class="col-md-6">
                  <label class="small mb-1" for="inputLastName">Last name</label>
                  <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name"
                    value="Luna">
                </div>
              </div>
              <!-- Form Row        -->
              <div class="row gx-3 mb-3">
                <!-- Form Group (organization name)-->
                <div class="col-md-6">
                  <label class="small mb-1" for="inputOrgName">Organization name</label>
                  <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name"
                    value="Start Bootstrap">
                </div>
                <!-- Form Group (location)-->
                <div class="col-md-6">
                  <label class="small mb-1" for="inputLocation">Location</label>
                  <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location"
                    value="San Francisco, CA">
                </div>
              </div>
              <!-- Form Group (email address)-->
              <div class="mb-3">
                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address"
                  value="name@example.com">
              </div>
              <!-- Form Row-->
              <div class="row gx-3 mb-3">
                <!-- Form Group (phone number)-->
                <div class="col-md-6">
                  <label class="small mb-1" for="inputPhone">Phone number</label>
                  <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number"
                    value="555-123-4567">
                </div>
                <!-- Form Group (birthday)-->
                <div class="col-md-6">
                  <label class="small mb-1" for="inputBirthday">Birthday</label>
                  <input class="form-control" id="inputBirthday" type="text" name="birthday"
                    placeholder="Enter your birthday" value="06/10/1988">
                </div>
              </div>
              <!-- Save changes button-->
              <button class="btn btn-primary" type="button">Save changes</button>
            </form>
          </div>
        </div>
      </div> --}}
    </div>

    <!-- Color System -->
    <div class="row">
      <div class="col-lg-6 mb-4">
        <div class="card bg-primary text-white shadow">
          <div class="card-body">
            Primary
            <div class="text-white-50 small">#4e73df</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card bg-success text-white shadow">
          <div class="card-body">
            Success
            <div class="text-white-50 small">#1cc88a</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card bg-info text-white shadow">
          <div class="card-body">
            Info
            <div class="text-white-50 small">#36b9cc</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card bg-warning text-white shadow">
          <div class="card-body">
            Warning
            <div class="text-white-50 small">#f6c23e</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card bg-danger text-white shadow">
          <div class="card-body">
            Danger
            <div class="text-white-50 small">#e74a3b</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card bg-secondary text-white shadow">
          <div class="card-body">
            Secondary
            <div class="text-white-50 small">#858796</div>
          </div>
        </div>
      </div>
    </div>

  </div>

  {{-- <div class="col-lg-6 mb-4">

    <!-- Illustrations -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
      </div>
      <div class="card-body">
        <div class="text-center">
          <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
        </div>
        <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow"
            href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that
          you can use completely free and without attribution!</p>
        <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
      </div>
    </div>

    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
      </div>
      <div class="card-body">
        <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor
          page performance. Custom CSS classes are used to create custom components and custom utility
          classes.</p>
        <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap
          framework, especially the utility classes.</p>
      </div>
    </div>

  </div> --}}
</div>
@endsection