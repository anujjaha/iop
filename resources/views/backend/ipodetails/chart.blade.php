@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? 'Edit - '. $repository->moduleTitle : 'Edit')


@section('page-header')

@endsection

@include('backend.includes.datatable-asset')

@section('content')
<style>
    .PROFIT {
        color: green;
    }

    .LOSS {
        color: red;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

 <div class="card card-primary">
    <div class="card-header">
        Monthly Income and Expense Report
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group row row">
                    <label for="name" class="col-lg-5 control-label">Total Profit:</label>
                    <div class="col-lg-7">
                        {!! $totalProfit !!}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group row row">
                    <label for="name" class="col-lg-5 control-label">Total Expense:</label>
                    <div class="col-lg-7">
                        {!! $totalExpense !!}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group row row">
                    <label for="name" class="col-lg-5 control-label">Net:</label>
                    <div class="col-lg-7">
                        {!! $totalProfit - $totalExpense !!}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group row row">
                    <label for="name" class="col-lg-5 control-label">Accounts:</label>
                    <div class="col-lg-7">
                        {!! $totalAccounts !!}
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="containerx">
          
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Month</th>
                  <th>Income (₹)</th>
                  <th>Expense (₹)</th>
                  <th>Net (₹)</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @if($months)
                    @foreach($months as $month)
                        @php
                            $profit = ($chartData[$month]??0) - ($monthlyExpense[$month] ?? 0);
                            $status = $profit > 0 ? 'PROFIT' : 'LOSS';
                            $isBold = $profit > 0 ? '' : 'text-bold';
                        @endphp
                        <tr class="profit-row">
                          <td>{!! $month !!}</td>
                          <td>{!! $chartData[$month] ?? 0 !!}</td>
                          <td>{!! $monthlyExpense[$month] ?? 0 !!}</td>
                          <td class="profit-text {!! $isBold !!}">{!! $profit !!}</td>
                          <td class="profit-text {!! $status !!}">{!! $status !!}</td>
                        </tr>
                    @endforeach
                @endif
              </tbody>
              <tfoot>
                @php
                    $totalPl = $totalProfit - $totalExpense
                @endphp
                <tr>
                  <th>-</th>
                  <th>{!! $totalProfit !!}</th>
                  <th>{!! $totalExpense !!}</th>
                  <th>{!! $totalPl !!}</th>
                  <th>{!! $totalPl > 0 ? '<span class="profit-text PROFIT"/>PROFIT</span>' : '<span class="profit-text LOSS"/>LOSS</span>' !!}</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
               
            </div>
        </div>

        <h2>Monthly Income vs Expense (Jan - Mar 2025)</h2>
  <canvas id="incomeExpenseChart" width="700" height="400"></canvas>

        
    </div>

    <div class="card-footer">
        <div class="clearfix"></div>
    </div>
</div>



{{ Form::close() }}
@endsection


@section('after-scripts')
<script>
    const ctx = document.getElementById('incomeExpenseChart').getContext('2d');
    const data = {
      labels: {!! json_encode(($months)) !!},
      datasets: [
        {
          label: 'Profit',
          data: {!! json_encode(array_values($chartData)) !!},
          backgroundColor: 'rgba(54, 162, 235, 0.7)',
          barThickness: 10,
        },
        {
          label: 'Investment',
          data: {!! json_encode(array_values($monthlyExpense)) !!},
          backgroundColor: 'rgba(255, 99, 132, 0.7)',
          barThickness: 10,
        }
      ]
    };

    const config = {
      type: 'bar',
      data: data,
      options: {
        plugins: {
          legend: {
            position: 'top'
          },
          datalabels: {
            anchor: 'end',
            align: 'top',
            color: '#000',
            font: {
              weight: 'bold'
            },
            formatter: (value) => `₹ ${value}`
          }
        },
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Amount (INR)'
            }
          }
        }
      },
      plugins: [ChartDataLabels]
    };

    new Chart(ctx, config);
  </script>
@endsection