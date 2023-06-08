@extends('admin_layout')
@section('admin_content')
    <h1 class="mt-4">Dashboard</h1>

    {{-- @dd($chart) --}}

    <div class="row">
        <div class="col-lg-3 col-6" style="flex: 0 0 25%; max-width: 25%">
            <!-- small box -->
            <div class="small-box bg-info"
                style="
                border-radius: 0.25rem;
                box-shadow: 0 0 1px rgba(0, 0, 0, 0.125),
                  0 1px 3px rgba(0, 0, 0, 0.2);
                display: block;
                margin-bottom: 20px;
                position: relative;
                background-color: #17a2b8 !important;
                color: #fff !important;
              ">
                <div class="inner" style="padding: 10px">
                    <h3
                        style="
                    font-size: 2.2rem;
                    font-weight: 700;
                    margin: 0 0 10px;
                    padding: 0;
                    white-space: nowrap;
                  ">
                        {{ $userCount }}
                    </h3>

                    <p style="font-size: 1rem">New Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"
                        style="
                    position: absolute;
                    right: 15px;
                    font-size: 70px;
                    top: 20px;
                    transition: transform 0.3s linear,
                      -webkit-transform 0.3s linear;
                    color: rgba(0, 0, 0, 0.15);
                  "></i>
                </div>
                <a href="{{ route('export.pdf') }}" class="small-box-footer"
                    style="
                  background-color: rgba(0, 0, 0, 0.1);
                  color: rgba(255, 255, 255, 0.8);
                  display: block;
                  padding: 3px 0;
                  position: relative;
                  text-align: center;
                  text-decoration: none;
                  text-decoration-line: none;
                  text-decoration-thickness: initial;
                  text-decoration-style: initial;
                  text-decoration-color: initial;
                  z-index: 10;
                  color: #fff !important;
                ">More
                    info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6" style="flex: 0 0 25%; max-width: 25%">
            <!-- small box -->
            <div class="small-box bg-info"
                style="
                border-radius: 0.25rem;
                box-shadow: 0 0 1px rgba(0, 0, 0, 0.125),
                  0 1px 3px rgba(0, 0, 0, 0.2);
                display: block;
                margin-bottom: 20px;
                position: relative;
                background-color: #28a745!important;
                color: #fff !important;
              ">
                <div class="inner" style="padding: 10px">
                    <h3
                        style="
                    font-size: 2.2rem;
                    font-weight: 700;
                    margin: 0 0 10px;
                    padding: 0;
                    white-space: nowrap;
                  ">
                        {{ $cateCount }}
                    </h3>

                    <p style="font-size: 1rem">New Categories</p>
                </div>
                <div class="icon">
                    <i class="ion-android-menu"
                        style="
                    position: absolute;
                    right: 15px;
                    font-size: 70px;
                    top: 0px;
                    transition: transform 0.3s linear,
                      -webkit-transform 0.3s linear;
                    color: rgba(0, 0, 0, 0.15);
                  "></i>
                </div>
                <a href="{{ route('category.index') }}" class="small-box-footer"
                    style="
                  background-color: rgba(0, 0, 0, 0.1);
                  color: rgba(255, 255, 255, 0.8);
                  display: block;
                  padding: 3px 0;
                  position: relative;
                  text-align: center;
                  text-decoration: none;
                  text-decoration-line: none;
                  text-decoration-thickness: initial;
                  text-decoration-style: initial;
                  text-decoration-color: initial;
                  z-index: 10;
                  color: #fff !important;
                ">More
                    info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6" style="flex: 0 0 25%; max-width: 25%">
            <!-- small box -->
            <div class="small-box bg-info"
                style="
                border-radius: 0.25rem;
                box-shadow: 0 0 1px rgba(0, 0, 0, 0.125),
                  0 1px 3px rgba(0, 0, 0, 0.2);
                display: block;
                margin-bottom: 20px;
                position: relative;
                background-color: #ffc107!important;
                color: #fff !important;
              ">
                <div class="inner" style="padding: 10px">
                    <h3
                        style="
                    font-size: 2.2rem;
                    font-weight: 700;
                    margin: 0 0 10px;
                    padding: 0;
                    white-space: nowrap;
                  ">
                        {{ $cuisineCount }}
                    </h3>

                    <p style="font-size: 1rem">New Cuisines</p>
                </div>
                <div class="icon">
                    <i class="ion-android-restaurant"
                        style="
                    position: absolute;
                    right: 15px;
                    font-size: 70px;
                    top: 0px;
                    transition: transform 0.3s linear,
                      -webkit-transform 0.3s linear;
                    color: rgba(0, 0, 0, 0.15);
                  "></i>
                </div>
                <a href="{{ route('cuisine.index') }}" class="small-box-footer"
                    style="
                  background-color: rgba(0, 0, 0, 0.1);
                  color: rgba(255, 255, 255, 0.8);
                  display: block;
                  padding: 3px 0;
                  position: relative;
                  text-align: center;
                  text-decoration: none;
                  text-decoration-line: none;
                  text-decoration-thickness: initial;
                  text-decoration-style: initial;
                  text-decoration-color: initial;
                  z-index: 10;
                  color: #fff !important;
                ">More
                    info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6" style="flex: 0 0 25%; max-width: 25%">
            <!-- small box -->
            <div class="small-box bg-info"
                style="
                border-radius: 0.25rem;
                box-shadow: 0 0 1px rgba(0, 0, 0, 0.125),
                  0 1px 3px rgba(0, 0, 0, 0.2);
                display: block;
                margin-bottom: 20px;
                position: relative;
                background-color: #dc3545!important;
                color: #fff !important;
              ">
                <div class="inner" style="padding: 10px">
                    <h3
                        style="
                    font-size: 2.2rem;
                    font-weight: 700;
                    margin: 0 0 10px;
                    padding: 0;
                    white-space: nowrap;
                  ">
                        {{ $postCount }}
                    </h3>

                    <p style="font-size: 1rem">New Posts</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"
                        style="
                    position: absolute;
                    right: 15px;
                    font-size: 70px;
                    top: 20px;
                    transition: transform 0.3s linear,
                      -webkit-transform 0.3s linear;
                    color: rgba(0, 0, 0, 0.15);
                  "></i>
                </div>
                <a href="{{ route('post.index') }}" class="small-box-footer"
                    style="
                  background-color: rgba(0, 0, 0, 0.1);
                  color: rgba(255, 255, 255, 0.8);
                  display: block;
                  padding: 3px 0;
                  position: relative;
                  text-align: center;
                  text-decoration: none;
                  text-decoration-line: none;
                  text-decoration-thickness: initial;
                  text-decoration-style: initial;
                  text-decoration-color: initial;
                  z-index: 10;
                  color: #fff !important;
                ">More
                    info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Area Chart
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                {{-- <div class="card-body"><canvas id="productChart"></canvas></div> --}}

                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>

            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Line Chart
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>

            </div>
        </div>
    </div>

    <script>
        // Định nghĩa biến JavaScript từ dữ liệu PHP
        // var usersData = @json($users);

        // // Xử lý dữ liệu và vẽ biểu đồ
        // var ctx = document.getElementById('myAreaChart').getContext('2d');
        // var chart = new Chart(ctx, {
        //     type: 'area', // Chỉnh sửa thành 'area'
        //     data: {
        //         labels: usersData.map(data => data.month), // Nhãn của trục x
        //         datasets: [{
        //             label: 'Users',
        //             data: usersData.map(data => data.count), // Dữ liệu của trục y
        //             backgroundColor: 'rgba(75, 192, 192, 0.2)',
        //             borderColor: 'rgba(75, 192, 192, 1)',
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });

        // Định nghĩa biến JavaScript từ dữ liệu PHP
        var cuisinesData = @json($cuisines);

        // Xử lý dữ liệu và vẽ biểu đồ
        var ctx = document.getElementById('myBarChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: cuisinesData.map(data => data.month), // Nhãn của trục x
                datasets: [{
                    label: 'Cuisines',
                    data: cuisinesData.map(data => data.count), // Dữ liệu của trục y
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
