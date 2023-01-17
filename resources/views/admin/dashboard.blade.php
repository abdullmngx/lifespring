@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid general-widget">
    <div class="row">
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-primary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="users"></i></div>
              <div class="media-body"><span class="m-0">Total Students</span>
                <h4 class="mb-0 counter">{{ $data['count_students'] }}</h4><i class="icon-bg" data-feather="users"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-secondary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="users"></i></div>
              <div class="media-body"><span class="m-0">Total Staff</span>
                <h4 class="mb-0 counter">{{ $data['count_staff'] }}</h4><i class="icon-bg" data-feather="users"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-primary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="book"></i></div>
              <div class="media-body"><span class="m-0">Total Subjects</span>
                <h4 class="mb-0 counter">{{ $data['count_subjects'] }}</h4><i class="icon-bg" data-feather="book"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden border-0">
          <div class="bg-primary b-r-4 card-body">
            <div class="media static-top-widget">
              <div class="align-self-center text-center"><i data-feather="align-justify"></i></div>
              <div class="media-body"><span class="m-0">Sections</span>
                <h4 class="mb-0 counter">{{ $data['count_sections'] }}</h4><i class="icon-bg" data-feather="align-justify"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      @foreach ($forms as $form)
      <div class="col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="mb-3 text-center"><h4>{{ $form->name }}</h4></div>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <h4>{{ $form->total_boys }}</h4>
                        <p>Boys</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <h4>{{ $form->total_girls }}</h4>
                        <p>Girls</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <h4>{{ $form->total_students }}</h4>
                        <p>Total</p>
                    </div>
                </div>
            </div>
        </div>
      </div>
      @endforeach

      <div class="col-xl-7">
        <div class="card o-hidden">
          <div class="card-header pb-0">
            <h5>Male to Female Ratio</h5>
          </div>
          <div class="bar-chart-widget">
            <div class="bottom-content card-body">
              <div class="row">
                <div class="col-12">
                  <div class="p-3">
                    <div class="load text-center">
                        <p>Please..wait</p>
                    </div>
                    <div id="chart-widget4"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- Container-fluid Ends-->
  @endsection

  @section('scripts')
    <script>
        $.ajax({
            url: '/api/dashboard/chart',
            type: 'GET',
            success: res => 
            {
                $('.load').hide()
                var sections = res.sections;
                var boys = res.boys;
                var girls = res.girls;
                var options = {
                series: [{
                    name: 'Boys',
                    data: boys
                }, {
                    name: 'Girls',
                    data: girls
                } ],
                    chart: {
                    type: 'bar',
                    height: 360
                },
                plotOptions: {
                    bar: {
                    horizontal: false,
                    columnWidth: '50%',
                    endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: sections,
                },
                yaxis: {
                    title: {
                    text: 'Students'
                    }
                },
            
                fill: {
                    opacity: 1,
                    colors: [vihoAdminConfig.primary, vihoAdminConfig.secondary],
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.4,
                        inverseColors: false,
                        opacityFrom: 0.9,
                        opacityTo: 0.8,
                        stops: [0, 100]
                    }
                },  
                colors: [vihoAdminConfig.primary, vihoAdminConfig.secondary],
                tooltip: {
                    y: {
                    formatter: function (val) {
                        return val
                    }
                    }
                }
            };

            var chartlinechart4 = new ApexCharts(document.querySelector("#chart-widget4"), options);
            chartlinechart4.render();
            }
        })
    </script>
@endsection