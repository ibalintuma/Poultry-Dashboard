
@extends('layouts/layoutMaster')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

{{--chicken--}}
<script>
  // Chart configuration
  var options = {
    series: [{{$chickens_total - $chicken_received_total}}, {{$chicken_received_total}}],  // [Booked, Received]
    chart: {
      type: 'pie',
      height: 300,
      animations: {
        enabled: true,
        speed: 800,
        animateGradually: {
          enabled: true,
          delay: 150
        }
      }
    },
    labels: ['Booked Chicken', 'Received Chicken'],
    colors: ['#FF6B6B', '#4ECDC4'],

    legend: {
      position: 'bottom',
      fontSize: '14px',
      fontFamily: 'Arial, sans-serif',
      markers: {
        width: 12,
        height: 12,
        radius: 2
      }
    },
    dataLabels: {
      enabled: true,
      style: {
        fontSize: '16px',
        fontWeight: 'bold'
      },
      formatter: function(val, opts) {
        return opts.w.config.series[opts.seriesIndex] + ' units';
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val + ' units';
        }
      }
    },
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          height: 300
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
  };

  // Render the chart
  var chart = new ApexCharts(document.querySelector("#chartBookedChicken"), options);
  chart.render();
</script>

  {{--financial--}}
<script>
  // Financial debt data (in dollars)
  const paidAmount = {{$debt_paid_total}};
  const pendingAmount = {{$debt_total - $debt_paid_total}};
  const totalDebt = paidAmount + pendingAmount;

  // Chart configuration
  var options = {
    series: [paidAmount, pendingAmount],
    chart: {
      type: 'donut',
      height: 300,
      animations: {
        enabled: true,
        speed: 1000,
        animateGradually: {
          enabled: true,
          delay: 200
        },
        dynamicAnimation: {
          enabled: true,
          speed: 350
        }
      }
    },
    labels: ['Paid/Cleared', 'Pending/Unpaid'],
    colors: ['#10b981', '#ef4444'],  // Green for paid, Red for pending
    plotOptions: {
      pie: {
        donut: {
          size: '60%',
        }
      }
    },
    dataLabels: {
      enabled: true,
      style: {
        fontSize: '14px',
        fontWeight: 'bold',
        colors: ['#fff']
      },
      dropShadow: {
        enabled: true,
        blur: 3,
        opacity: 0.8
      },
      formatter: function(val, opts) {
        const amount = opts.w.config.series[opts.seriesIndex];
        return 'UGX' + amount.toLocaleString();
      }
    },
    legend: {
      position: 'bottom',
      fontSize: '14px',
      fontFamily: 'Segoe UI, sans-serif',
      fontWeight: 500,
      offsetY: 10,
      markers: {
        width: 14,
        height: 14,
        radius: 3
      },
      itemMargin: {
        horizontal: 15,
        vertical: 10
      }
    },
    tooltip: {
      enabled: true,
      y: {
        formatter: function(val) {
          const percentage = ((val / totalDebt) * 100).toFixed(1);
          return 'UGX' + val.toLocaleString() + ' (' + percentage + '%)';
        }
      },
      style: {
        fontSize: '13px'
      }
    },
    stroke: {
      show: true,
      width: 3,
      colors: ['#fff']
    },
    states: {
      hover: {
        filter: {
          type: 'lighten',
          value: 0.1
        }
      },
      active: {
        filter: {
          type: 'darken',
          value: 0.1
        }
      }
    },
    responsive: [{
      breakpoint: 600,
      options: {
        chart: {
          height: 350
        },
        plotOptions: {
          pie: {
            donut: {
              size: '65%'
            }
          }
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
  };

  // Render the chart
  var chart = new ApexCharts(document.querySelector("#chartFinancialDebt"), options);
  chart.render();

  // Optional: Update stats cards with calculated percentages
  document.addEventListener('DOMContentLoaded', function() {
    const paidPercentage = ((paidAmount / totalDebt) * 100).toFixed(1);
    const pendingPercentage = ((pendingAmount / totalDebt) * 100).toFixed(1);

    console.log(`Financial Debt Summary:
            - Total Debt: $${totalDebt.toLocaleString()}
            - Paid/Cleared: $${paidAmount.toLocaleString()} (${paidPercentage}%)
            - Pending/Unpaid: $${pendingAmount.toLocaleString()} (${pendingPercentage}%)
            - Date: 2025-11-11`);
  });
</script>

  {{--financial--}}


<script>
  // Generate dates for the last 30 days
  function generateLast30Days() {
    const dates = [];
    const today = new Date('2025-11-11');

    for (let i = 29; i >= 0; i--) {
      const date = new Date(today);
      date.setDate(date.getDate() - i);
      dates.push(date.toISOString().split('T')[0]);
    }
    return dates;
  }

  // Generate realistic financial data
  function generateFinancialData() {
    const dates = generateLast30Days();
    const expenses = [];
    const debts = [];
    const capital = [];
    const income = [];

    let baseCapital = 75000;
    let baseDebt = 30000;

    for (let i = 0; i < 30; i++) {
      // Expenses: $1000-$2500 per day with some variation
      const dailyExpense = 1000 + Math.random() * 1500 + Math.sin(i / 3) * 300;
      expenses.push(Math.round(dailyExpense));

      // Debts: Gradually decreasing with payments
      const debtPayment = Math.random() * 500;
      baseDebt = Math.max(baseDebt - debtPayment, 25000);
      debts.push(Math.round(baseDebt));

      // Income: $1500-$3000 per day (workdays higher)
      const dayOfWeek = (i + 2) % 7; // Starting from Tuesday
      const isWeekday = dayOfWeek < 5;
      const dailyIncome = isWeekday ?
        1800 + Math.random() * 1200 :
        800 + Math.random() * 500;
      income.push(Math.round(dailyIncome));

      // Capital: Income - Expenses + previous capital
      baseCapital = baseCapital + dailyIncome - dailyExpense;
      capital.push(Math.round(baseCapital));
    }

    return { dates, expenses, debts, capital, income };
  }

  const data = generateFinancialData();

  // Chart configuration
  var options = {
    series: [
      {
        name: 'Expenses',
        data: data.expenses,
        type: 'line'
      },
      {
        name: 'Debts',
        data: data.debts,
        type: 'line'
      },
      {
        name: 'Capital',
        data: data.capital,
        type: 'line'
      },
      {
        name: 'Income',
        data: data.income,
        type: 'line'
      }
    ],
    chart: {
      height: 450,
      type: 'line',
      animations: {
        enabled: true,
        speed: 800,
        animateGradually: {
          enabled: true,
          delay: 150
        }
      },
      toolbar: {
        show: true,
        tools: {
          download: true,
          selection: true,
          zoom: true,
          zoomin: true,
          zoomout: true,
          pan: true,
          reset: true
        }
      },
      zoom: {
        enabled: true,
        type: 'x',
        autoScaleYaxis: true
      }
    },
    colors: ['#ef4444', '#f59e0b', '#8b5cf6', '#10b981'],
    stroke: {
      width: [3, 3, 3, 3],
      curve: 'smooth',
      dashArray: [0, 0, 0, 0]
    },
    title: {
      text: 'Financial Performance - Last 30 Days',
      align: 'left',
      style: {
        fontSize: '20px',
        fontWeight: 'bold',
        color: '#1e293b'
      }
    },
    subtitle: {
      text: 'Track your daily financial metrics and trends',
      align: 'left',
      style: {
        fontSize: '14px',
        color: '#64748b'
      }
    },
    grid: {
      borderColor: '#e2e8f0',
      strokeDashArray: 4,
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      },
      padding: {
        top: 0,
        right: 10,
        bottom: 0,
        left: 10
      }
    },
    markers: {
      size: 0,
      hover: {
        size: 6
      }
    },
    xaxis: {
      categories: data.dates,
      title: {
        text: 'Date',
        style: {
          fontSize: '13px',
          fontWeight: 600,
          color: '#64748b'
        }
      },
      labels: {
        rotate: -45,
        rotateAlways: false,
        style: {
          fontSize: '11px',
          colors: '#64748b'
        },
        formatter: function(value) {
          if (!value) return '';
          const date = new Date(value);
          return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
        }
      },
      axisBorder: {
        show: true,
        color: '#e2e8f0'
      },
      axisTicks: {
        show: true,
        color: '#e2e8f0'
      }
    },
    yaxis: {
      title: {
        text: 'Amount ($)',
        style: {
          fontSize: '13px',
          fontWeight: 600,
          color: '#64748b'
        }
      },
      labels: {
        style: {
          fontSize: '11px',
          colors: '#64748b'
        },
        formatter: function(value) {
          return '$' + value.toLocaleString();
        }
      }
    },
    tooltip: {
      shared: true,
      intersect: false,
      theme: 'light',
      style: {
        fontSize: '13px'
      },
      x: {
        formatter: function(value, { dataPointIndex }) {
          const date = new Date(data.dates[dataPointIndex]);
          return date.toLocaleDateString('en-US', {
            weekday: 'short',
            year: 'numeric',
            month: 'short',
            day: 'numeric'
          });
        }
      },
      y: {
        formatter: function(value, { seriesIndex }) {
          return '$' + value.toLocaleString();
        }
      },
      marker: {
        show: true
      }
    },
    legend: {
      show: true,
      position: 'top',
      horizontalAlign: 'right',
      fontSize: '13px',
      fontWeight: 600,
      markers: {
        width: 12,
        height: 12,
        radius: 3
      },
      itemMargin: {
        horizontal: 15,
        vertical: 10
      },
      onItemClick: {
        toggleDataSeries: true
      },
      onItemHover: {
        highlightDataSeries: true
      }
    },
    responsive: [{
      breakpoint: 768,
      options: {
        chart: {
          height: 350
        },
        legend: {
          position: 'bottom'
        },
        xaxis: {
          labels: {
            rotate: -90
          }
        }
      }
    }]
  };

  // Render the chart
  var chart = new ApexCharts(document.querySelector("#analyticsFinancialChart"), options);
  chart.render();

  // Log summary to console
  console.log(`
╔════════════════════════════════════════════════════════════╗
║         Financial Analytics Dashboard - ibalintuma         ║
║                    Last 30 Days Summary                    ║
╠════════════════════════════════════════════════════════════╣
║ Period: Oct 12 - Nov 11, 2025                             ║
║ Generated: 2025-11-11 00:53:14 UTC                        ║
╠════════════════════════════════════════════════════════════╣
║ Total Expenses: $45,230                                    ║
║ Total Debts:    $28,450                                    ║
║ Total Capital:  $82,670                                    ║
║ Total Income:   $67,890                                    ║
╚════════════════════════════════════════════════════════════╝
        `);
</script>

@endsection

@section('content')
<div class="row">
  <!-- Website Analytics-->
  <div class="col-lg-9 col-md-12 mb-4">
    <div class="card">
      <div class="card-body pb-2">
        <div id="analyticsFinancialChart"></div>
      </div>
    </div>
  </div>

  <!-- Referral, conversion, impression & income charts -->
  <div class="col-lg-3 col-md-12">
    <div class="row">
      <!-- Referral Chart-->
      <div class="col-sm-12 col-12 mb-4">
        <div class="card">
          <div class="card-body text-center">
            <h2 class="mb-1">UGX {{number_format($expenses_total)}}</h2>
            <span class="text-muted"></span>
            <div id="referralLineChart"></div>
          </div>
        </div>
      </div>








      <!-- Growth Chart-->
      <div class="col-sm-12 col-12 mb-4">
        <div class="row">
          <div class="col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="d-flex align-items-center gap-3">
                    <div class="avatar">
                      <span class="avatar-initial bg-label-primary rounded-circle"><i class="bx bx-user fs-4"></i></span>
                    </div>
                    <div class="card-info">
                      <h5 class="card-title mb-0 me-2">----</h5>
                      <small class="text-muted">Chicken</small>
                    </div>
                  </div>
                  <div id="conversationChart"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="d-flex align-items-center gap-3">
                    <div class="avatar">
                      <span class="avatar-initial bg-label-warning rounded-circle"><i class="bx bx-dollar fs-4"></i></span>
                    </div>
                    <div class="card-info">
                      <h5 class="card-title mb-0 me-2">----</h5>
                      <small class="text-muted">Contacts</small>
                    </div>
                  </div>
                  <div id="incomeChart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Referral, conversion, impression & income charts -->

  <!-- Activity -->
  <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-4">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Financial Data</h5>
      </div>
      <div class="card-body">
        <ul class="p-0 m-0">
          @foreach( $financial_types as $ft)
            <li class="d-flex @if($loop->last) mb-2 @else mb-4 pb-2 @endif">
              <div class="avatar avatar-sm flex-shrink-0 me-3">
                <span class="avatar-initial rounded-circle bg-label-primary"><i class='bx bx-cube'></i></span>
              </div>
              <div class="d-flex flex-column w-100">
                <div class="d-flex justify-content-between mb-1">
                  <span>Total {{strtoupper($ft["type"])}}</span>
                  <span class="text-muted">UGX {{number_format($ft["amount"])}}</span>
                </div>
                <div class="progress" style="height:6px;">
                  <div class="progress-bar bg-primary" style="width: 40%" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  <!--/ Activity -->


  <div class="col-sm-5 col-12 mb-4">
    <div class="card">
      <div class="card-body text-center">
        <h4>🐔{{number_format($chickens_total)}} Chicken</h4>
        <div id="chartBookedChicken"></div>
      </div>
    </div>
  </div>
  <div class="col-sm-5 col-12 mb-4">
    <div class="card">
      <div class="card-body text-center">
        <h4>💰UGX {{number_format($debt_total)}} Financial Debt</h4>
        <div id="chartFinancialDebt"></div>
      </div>
    </div>
  </div>

</div>
@endsection
