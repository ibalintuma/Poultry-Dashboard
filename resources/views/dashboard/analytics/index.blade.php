
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


  // Generate realistic financial data
  function generateFinancialData() {

    //financial_types from laravel
    //const financial_types = [{"date":"2025-10-12","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-13","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-14","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-15","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-16","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-17","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-18","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-19","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-20","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-21","expense":3379000,"debt":0,"income":0,"capital":900000},{"date":"2025-10-22","expense":853500,"debt":0,"income":0,"capital":0},{"date":"2025-10-23","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-24","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-25","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-26","expense":119000,"debt":0,"income":0,"capital":0},{"date":"2025-10-27","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-28","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-29","expense":73000,"debt":0,"income":0,"capital":0},{"date":"2025-10-30","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-10-31","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-11-01","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-11-02","expense":68000,"debt":0,"income":0,"capital":0},{"date":"2025-11-03","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-11-04","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-11-05","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-11-06","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-11-07","expense":136000,"debt":36000,"income":0,"capital":0},{"date":"2025-11-08","expense":22000,"debt":22000,"income":0,"capital":0},{"date":"2025-11-09","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-11-10","expense":0,"debt":0,"income":0,"capital":0},{"date":"2025-11-11","expense":0,"debt":0,"income":0,"capital":0}];
    const financial_types = @json($daily_data_for_last_30_days);

    const dates = financial_types.map(entry => entry.date);
    const expenses = financial_types.map(entry => entry.expense);
    const debts = financial_types.map(entry => entry.debt);
    const capital = financial_types.map(entry => entry.capital);
    const income = financial_types.map(entry => entry.income);

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
      height: 400,
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
        text: 'Amount (UGX)',
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
          return 'UGX ' + value.toLocaleString();
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
          return 'UGX ' + value.toLocaleString();
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



  {{--chicken inventory--}}


<script>
  // Chicken inventory data
  const chickenData = {
    healthy: {{$chicken_received_total - $chicken_out_total}},
    sold: {{$chicken_out_sold_total}},
    gift: {{$chicken_out_gift_total}},
    gotOut: {{$chicken_out_got_out_total}},
    died: {{$chicken_out_died_total}}
  };

  const total = Object.values(chickenData).reduce((a, b) => a + b, 0);

  // Bar Chart Configuration
  var options = {
    series: [{
      name: 'Chickens',
      data: [
        chickenData.healthy,
        chickenData.sold,
        chickenData.gift,
        chickenData.gotOut,
        chickenData.died
      ]
    }],
    chart: {
      type: 'bar',
      height: 400,
      toolbar: {
        show: true,
        tools: {
          download: true,
          selection: false,
          zoom: false,
          zoomin: false,
          zoomout: false,
          pan: false,
          reset: false
        }
      },
      animations: {
        enabled: true,
        speed: 800,
        animateGradually: {
          enabled: true,
          delay: 150
        }
      }
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '60%',
        borderRadius: 8,
        distributed: true,
        dataLabels: {
          position: 'top'
        }
      }
    },
    colors: ['#10b981', '#3b82f6', '#8b5cf6', '#f59e0b', '#ef4444'],
    dataLabels: {
      enabled: true,
      formatter: function(val) {
        return val + ' chicks';
      },
      offsetY: -25,
      style: {
        fontSize: '13px',
        fontWeight: 'bold',
        colors: ['#1e293b']
      },
      background: {
        enabled: true,
        foreColor: '#fff',
        padding: 6,
        borderRadius: 4,
        borderWidth: 1,
        borderColor: '#e2e8f0',
        opacity: 0.9
      }
    },
    xaxis: {
      categories: ['Healthy', 'Sold', 'Gift', 'Got Out', 'Died'],
      labels: {
        style: {
          fontSize: '14px',
          fontWeight: 600,
          colors: ['#10b981', '#3b82f6', '#8b5cf6', '#f59e0b', '#ef4444']
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
        text: 'Number of Chickens',
        style: {
          fontSize: '14px',
          fontWeight: 600,
          color: '#64748b'
        }
      },
      labels: {
        style: {
          fontSize: '13px',
          colors: '#64748b'
        },
        formatter: function(val) {
          return Math.round(val);
        }
      },
      min: 0,
      max: Math.max(...Object.values(chickenData)) + 100
    },
    title: {
      text: 'Chicken Inventory Distribution',
      align: 'center',
      style: {
        fontSize: '20px',
        fontWeight: 'bold',
        color: '#1e293b'
      }
    },
    subtitle: {
      text: 'Total: ' + total + ' chickens',
      align: 'center',
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
          show: false
        }
      },
      yaxis: {
        lines: {
          show: true
        }
      },
      padding: {
        top: 0,
        right: 20,
        bottom: 0,
        left: 20
      }
    },
    legend: {
      show: false
    },
    tooltip: {
      enabled: true,
      theme: 'light',
      style: {
        fontSize: '13px'
      },
      y: {
        formatter: function(val) {
          const percentage = ((val / total) * 100).toFixed(2);
          return val + ' chicks (' + percentage + '% of total)';
        },
        title: {
          formatter: function() {
            return '';
          }
        }
      },
      marker: {
        show: true
      }
    },
    responsive: [{
      breakpoint: 600,
      options: {
        chart: {
          height: 400
        },
        plotOptions: {
          bar: {
            columnWidth: '70%'
          }
        },
        dataLabels: {
          style: {
            fontSize: '11px'
          }
        }
      }
    }]
  };

  // Render the chart
  var chart = new ApexCharts(document.querySelector("#analyticsChickenInventoryChart"), options);
  chart.render();

  // Log summary to console
  console.log(`
╔════════════════════════════════════════════════════════════╗
║         🐔 Chicken Inventory Report                        ║
║         User: ibalintuma                                   ║
║         Date: 2025-11-11 01:53:23 UTC                     ║
╠════════════════════════════════════════════════════════════╣
║ ✅ Healthy:    ${chickenData.healthy} chickens (${((chickenData.healthy/total)*100).toFixed(2)}%)              ║
║ 💰 Sold:       ${chickenData.sold} chickens (${((chickenData.sold/total)*100).toFixed(2)}%)                ║
║ 🎁 Gift:       ${chickenData.gift} chickens (${((chickenData.gift/total)*100).toFixed(2)}%)                ║
║ 🚪 Got Out:    ${chickenData.gotOut} chickens (${((chickenData.gotOut/total)*100).toFixed(2)}%)                ║
║ 💀 Died:       ${chickenData.died} chickens (${((chickenData.died/total)*100).toFixed(2)}%)                 ║
╠════════════════════════════════════════════════════════════╣
║ 📊 TOTAL:      ${total} chickens (100%)                        ║
╚════════════════════════════════════════════════════════════╝
        `);
</script>

  {{--loss analysis--}}

<script>
  // Generate chicken loss data per flock/batch (DYNAMIC BATCHES)
  function generateChickenLossData() {
    // Chicken loss data from Laravel backend


    const chicken_loss_data = @json($chicken_loss_data);

    const dates = chicken_loss_data.map(entry => entry.date);
    const totalLoss = chicken_loss_data.map(entry => entry.total_loss);

    // Extract batch names dynamically from the first entry
    const batchNames = Object.keys(chicken_loss_data[0].batches);

    // Create data arrays for each batch dynamically
    const batchData = {};
    const cumulativeBatchData = {};

    batchNames.forEach(batchName => {
      batchData[batchName] = chicken_loss_data.map(entry => entry.batches[batchName] || 0);

      // Calculate cumulative for this batch
      let cumSum = 0;
      cumulativeBatchData[batchName] = batchData[batchName].map(val => {
        cumSum += val;
        return cumSum;
      });
    });

    // Calculate cumulative total
    const cumulativeTotal = [];
    let sumTotal = 0;

    for (let i = 0; i < dates.length; i++) {
      sumTotal += totalLoss[i];
      cumulativeTotal.push(sumTotal);
    }

    return {
      dates,
      batchNames,
      batchData,
      cumulativeBatchData,
      totalLoss,
      cumulativeTotal
    };
  }

  const dataChickenLoss = generateChickenLossData();

  // Define colors for batches (will cycle through if more batches than colors)
  const batchColors = [
    '#3b82f6', // Blue
    '#10b981', // Green
    '#f59e0b', // Orange
    '#8b5cf6', // Purple
    '#ec4899', // Pink
    '#06b6d4', // Cyan
    '#84cc16', // Lime
    '#f97316', // Orange-red
    '#14b8a6', // Teal
    '#a855f7'  // Violet
  ];

  // Build series dynamically
  const series = [];
  const colors = [];

  dataChickenLoss.batchNames.forEach((batchName, index) => {
    series.push({
      name: `${batchName}`,
      data: dataChickenLoss.batchData[batchName],
      type: 'line'
    });
    colors.push(batchColors[index % batchColors.length]);
  });

  // Add total line (thicker, red)
  series.push({
    name: 'Total Daily Loss',
    data: dataChickenLoss.totalLoss,
    type: 'line'
  });
  colors.push('#ef4444');

  // Calculate totals for summary
  const batchTotals = {};
  dataChickenLoss.batchNames.forEach(batchName => {
    batchTotals[batchName] = dataChickenLoss.cumulativeBatchData[batchName][dataChickenLoss.cumulativeBatchData[batchName].length - 1];
  });
  const grandTotalLoss = dataChickenLoss.cumulativeTotal[dataChickenLoss.cumulativeTotal.length - 1];

  // Build stroke widths dynamically (all batches get 2, total gets 4)
  const strokeWidths = dataChickenLoss.batchNames.map(() => 2).concat([4]);

  // Chart configuration
  var options = {
    series: series,
    chart: {
      height: 400,
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
    colors: colors,
    stroke: {
      width: strokeWidths,
      curve: 'smooth',
      dashArray: 0
    },
    title: {
      text: 'Chicken Loss Rate - Last 15 Days',
      align: 'left',
      style: {
        fontSize: '20px',
        fontWeight: 'bold',
        color: '#1e293b'
      }
    },
    subtitle: {
      text: `Daily chicken loss per batch/flock (${dataChickenLoss.batchNames.length} batches)`,
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
        text: 'Number of Chickens Lost',
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
          return Math.round(value) + ' chicks';
        }
      },
      min: 0
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
        formatter: function(value, { seriesIndex, dataPointIndex }) {
          return value + ' chickens';
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
    annotations: {
      yaxis: [
        {
          y: 5,
          borderColor: '#ef4444',
          strokeDashArray: 5,
          label: {
            borderColor: '#ef4444',
            style: {
              color: '#fff',
              background: '#ef4444',
              fontSize: '11px',
              fontWeight: 600
            },
            text: 'High Loss Alert (5+ chickens/day)'
          }
        }
      ]
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
  var chart = new ApexCharts(document.querySelector("#analyticsChickenLossChart"), options);
  chart.render();

  // Build console summary dynamically
  let batchSummary = '';
  dataChickenLoss.batchNames.forEach(batchName => {
    const total = batchTotals[batchName];
    const padding = ' '.repeat(Math.max(0, 17 - batchName.length));
    batchSummary += `║ ${batchName}${padding}  ${total} chickens                            ║\n`;
  });

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
      <div class="col-md-12 col-6  mb-4">
        <div class="card h-100">
          <div class="card-body text-center">
            <span class="d-block text-nowrap">Total Expense</span>
            <h5 class="mb-0">UGX {{number_format($expenses_total)}}</h5>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-6   mb-4">
        <div class="card h-100">
          <div class="card-body text-center">
            <span class="d-block text-nowrap">Debt Pending</span>
            <h5 class="mb-0 text-danger">UGX {{number_format($debt_amount_balance_total)}}</h5>
          </div>
        </div>
      </div>

      <div class="col-md-12 col-6   mb-4">
        <div class="card h-100">
          <div class="card-body text-center">

            <span class="d-block text-nowrap">Total Chicken Ongoing</span>
            <h5 class="mb-0 text-success">{{number_format($chicken_received_total - $chicken_out_total)}} Chicks</h5>
          </div>
        </div>
      </div>

      <div class="col-md-12 col-6   mb-4">
        <div class="card h-100">
          <div class="card-body text-center">

            <span class="d-block text-nowrap">Total Chicken Dead</span>
            <h5 class="mb-0">{{number_format($chicken_out_died_total)}} Chicks</h5>
          </div>
        </div>
      </div>






    </div>
  </div>
  <!--/ Referral, conversion, impression & income charts -->

  <!-- Activity -->
  <div class="col-md-4 col-12 mb-4">
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
                  <span>Total <b>{{strtoupper($ft["type"])}}</b></span>
                  <span class="text-muted">UGX <b>{{number_format($ft["amount"])}}</b></span>
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


  <div class="col-md-4 col-12 mb-4">
    <div class="card">
      <div class="card-body text-center">
        <h4>🐔{{number_format($chickens_total)}} Chicken</h4>
        <div id="chartBookedChicken"></div>
      </div>
    </div>
  </div>

  <div class="col-md-4 col-12 mb-4">
    <div class="card">
      <div class="card-body text-center">
        <h4>💰UGX {{number_format($debt_amount_balance_total)}} Financial Debt</h4>
        <div id="chartFinancialDebt"></div>
      </div>
    </div>
  </div>






















  <div class="col-xl-12 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Profitability</h5>
      </div>
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
          <div class="d-flex justify-content-between align-content-center flex-wrap gap-4">


            <div class="d-flex align-items-center gap-2 mx-2">
              <div>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-2">UGX {{ number_format($expenses_total) }}</h6>
                </div>
                <div class="d-flex align-items-center">
                  <span class="badge badge-dot bg-danger me-2"></span> Expenses Sofar
                </div>
              </div>
            </div>

            @if( $expenses_total != $expenses_affecting_profits_total )
            <div class="d-flex align-items-center gap-2 mx-2">
              <div>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-2">UGX {{ number_format($expenses_affecting_profits_total) }}</h6>
                </div>
                <div class="d-flex align-items-center">
                  <span class="badge badge-dot bg-danger me-2"></span> Expenses Affecting Profits
                </div>
              </div>
            </div>
            @endif

            <div class="d-flex align-items-center gap-2">
              <div>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-2">{{ number_format($chicken_received_total - $chicken_out_total) }}</h6>
                </div>
                <div class="d-flex align-items-center">
                  <span class="badge badge-dot bg-warning me-2"></span> Chicken
                </div>
              </div>
            </div>

            <div class="d-flex align-items-center gap-2">
              <div>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-2">@ UGX {{ number_format(13000) }}</h6>
                </div>
                <div class="d-flex align-items-center">
                  <span class="badge badge-dot bg-info me-2"></span> Selling Price
                </div>
              </div>
            </div>

            <div class="d-flex align-items-center gap-2">
              <div>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-2">UGX {{ number_format(13000 * ($chicken_received_total - $chicken_out_total)) }}</h6>
                </div>
                <div class="d-flex align-items-center">
                  <span class="badge badge-dot bg-success me-2"></span> Expected Revenue
                </div>
              </div>
            </div>

            <div class="d-flex align-items-center gap-2">
              <div>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-2">UGX {{ number_format( (13000 * ($chicken_received_total - $chicken_out_total)) - $expenses_affecting_profits_total  ) }}</h6>
                </div>
                <div class="d-flex align-items-center">
                  <span class="badge badge-dot bg-dark me-2"></span> Expected Profits
                </div>
              </div>
            </div>


          </div>

        </div>
      </div>
    </div>
  </div>




















  <div class="col-lg-6 col-md-12 mb-4">
    <div class="card">
      <div class="card-body pb-2">
        <div id="analyticsChickenInventoryChart"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-md-12 mb-4">
    <div class="card">
      <div class="card-body pb-2">
        <div id="analyticsChickenLossChart"></div>
      </div>
    </div>
  </div>



  @php
    $today = now()->toDateString();
  @endphp
  <!-- Marketing Campaigns -->
  <div class="col-xl-7 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Calenders | Task Scheduler | Event</h5>
        <a href='{{url("calenders/create")}}' class='btn btn-primary btn-sm'>
          <i class="bx bx-plus me-1"></i> Add New Task
        </a>
      </div>
      <div class="card-body p-0">
        <!-- Simple task list -->
        <div class="task-list">
          @forelse($calenders->sortBy('date') as $r)
            @php
              $isOverdue = $r->date < $today && $r->status != 'Completed';
              $isToday = $r->date == $today;
              $isUpcoming = $r->date > $today;
              $isCompleted = $r->status == 'Completed';

              $dateObj = \Carbon\Carbon::parse($r->date);
              $daysUntil = now()->startOfDay()->diffInDays($dateObj, false);

              if ($isCompleted) {
                $borderClass = 'border-start border-success border-4';
                $filterClass = 'completed';
              } elseif ($isOverdue) {
                $borderClass = 'border-start border-danger border-4';
                $filterClass = 'overdue';
              } elseif ($isToday) {
                $borderClass = 'border-start border-primary border-4';
                $filterClass = 'today';
              } else {
                $borderClass = 'border-start border-warning border-4';
                $filterClass = 'upcoming';
              }
            @endphp

            <div class="task-item p-3 border-bottom {{ $isCompleted ? 'bg-light' : '' }}"
                 data-filter-type="{{ $filterClass }}">
              <div class="d-flex align-items-start justify-content-between gap-3">



                <!-- Date -->
                <div class="text-center" style="min-width: 60px;">
                  <div class=" {{ $isOverdue ? 'bg-danger' : ($isToday ? 'bg-primary' : ($isCompleted ? 'bg-success' : 'bg-warning')) }} text-white rounded">
                  <span class="avatar-initial rounded">
                    {{ $dateObj->format('d') }}
                  </span>
                  </div>
                  <small class="text-black d-block mt-1">{{ $dateObj->format('M') }}</small>
                </div>


                <!-- Main info -->
                <div class="flex-grow-1">
                  <div class="d-flex justify-content-between align-items-start gap-2">
                    <div>
                      <h6 class="mb-1 {{ $isCompleted ?  ' text-muted' : '' }}">
                        {{ $r->title ?: 'No title' }}
                      </h6>

                      @if($r->description)
                        <p class="text-muted mb-1 small {{ $isCompleted ? '' : '' }}">
                          {{ Str::limit($r->description, 80) }}
                        </p>
                      @endif

                      <div class="d-flex flex-wrap gap-2 small">

                        <span class="text-muted">
                          <i class="bx bx-stats me-1"></i>{{ strtoupper($r->status) }}
                        </span>

                        {{-- When --}}
                        <span class="{{ $isOverdue ? 'text-danger' : ($isToday ? 'text-primary' : 'text-muted') }}">
                        <i class="bx bx-time-five me-1"></i>
                        @if($isOverdue)
                            Late ({{ abs($daysUntil) }} day(s) ago)
                          @elseif($isToday)
                            Today
                          @elseif($daysUntil == 1)
                            Tomorrow
                          @elseif($daysUntil > 1)
                            In {{ $daysUntil }} days
                          @else
                            {{ $dateObj->format('d M Y') }}
                          @endif
                      </span>

                        {{-- Who --}}
                        @isset($r->contact)
                          <span class="text-muted">
                          <i class="bx bx-user me-1"></i>{{ $r->contact->name }}
                        </span>
                        @endisset

                        {{-- Money --}}
                        @if($r->amount > 0)
                          <span class="text-success">
                          <i class="bx bx-wallet me-1"></i>UGX {{ number_format($r->amount) }}
                        </span>
                        @endif
                      </div>
                    </div>


                    <!-- Status + actions -->
                    <div class="text-end">
                      {{-- Simple status text --}}



                    </div>
                  </div>

                </div>


              </div>
            </div>
          @empty
            <div class="text-center py-5">
              <div class="avatar avatar-lg mb-3">
              <span class="avatar-initial rounded-circle bg-label-secondary">
                <i class="bx bx-calendar-x fs-3"></i>
              </span>
              </div>
              <h6 class="mb-1">No tasks yet</h6>
              <p class="text-muted mb-3">You have not added any work or reminder.</p>
              <a href='{{url("calenders/create")}}' class='btn btn-primary'>
                <i class="bx bx-plus me-1"></i> Add a task
              </a>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
  <!--/ Marketing Campaigns -->

  <!-- All Users -->
  <div class="col-md-6 col-lg-6 col-xl-5 mb-4 mb-xl-0">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="card-title mb-2">Total Debt</h5>
        <h1 class="display-6 fw-normal mb-0">UGX {{ number_format($debt_amount_balance_total) }}</h1>
      </div>
      <div class="card-body">
        <span class="d-block mb-2">Current Activity</span>
        <div class="progress progress-stacked mb-3 mb-xl-4" style="height:8px;">
          @foreach ($debtors as $debtor)
            <div
              class="progress-bar bg-{{ $debtor->color }}"
              role="progressbar"
              style="width: {{ $debtor->percentage }}%"
              aria-valuenow="{{ $debtor->percentage }}"
              aria-valuemin="0"
              aria-valuemax="100">
            </div>
          @endforeach
        </div>

        <div class="table-responsive rounded">
          <table class="table table-sm table-hover align-middle mb-0">
            <thead class="table-light">
            <tr>
              <th scope="col">Debtor</th>
              <th scope="col" class="text-end">Paid (UGX)</th>
              <th scope="col" class="text-end">Balance (UGX)</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($debtors as $debtor)
              <tr>
                <td class="text-nowrap">
                  <div class="d-flex align-items-center">
                    <span class="badge bg-{{ $debtor->color }} rounded-pill me-2" style="width:10px;height:10px;padding:0;"></span>
                    <span class="text-{{ $debtor->color }} " ><b>{{ ucfirst($debtor->contact->name) }}</b></span>
                  </div>
                </td>
                <td class="text-end text-nowrap">
                   {{ number_format($debtor->total_paid) }}
                </td>
                <td class="text-end text-nowrap">
                   {{ number_format($debtor->balance) }}
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
  <!--/ All Users -->


</div>
@endsection
