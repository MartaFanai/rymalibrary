@extends('layouts.admin')

@section('content')
<style type="text/css">
  /* The customcheck */
.customcheck {
    display: block;
    position: relative;
    padding-left: 0px;
    margin-bottom: 8px;
    cursor: pointer;
    font-size: 15px;
    border-radius: 5px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.customcheck input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #ccc;
    border-radius: 5px;
}

/* On mouse-over, add a grey background color */
.customcheck:hover input ~ .checkmark {
    background-color: #ddd;
}

/* When the checkbox is checked, add a blue background */
.customcheck input:checked ~ .checkmark {
    background-color: #a6c4f5;
    border-radius: 3px;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.customcheck input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.customcheck .checkmark:after {
    left: 9px;
    top: 5px;
    width: 7px;
    height: 14px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
.task-body{
  background: #eee;
  padding: 20px;
  display: block;
  position: relative;
  border-radius: 5px;
  border-bottom: solid #fff;
}
.fa-trash{
  color: #eee;
  float: right;
}
.fa-trash:hover{
  background: : red;
}

.fa-autoprefixer{
  color: #yyy;
  float: right;
}
.fa-autoprefixer:hover{
  color: red;
}

.btn-danger{
  font-size:16px; 
  float: right;
  background: #eee;
  border-color: #eee;
  display: inline-block;
  position: relative;
  top: -25px;
}

</style>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $book }}</h3>

                <p>Books</p>
              </div>
              <a href="{{ route('books.create') }}">
              <div class="icon">
                <i class="fas fa-book-medical"></i>
              </div></a>
              <a href="{{ route('viewbook') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $mem }}</h3>

                <p>Members</p>
                <p style="display: inline-block; float: left; top: -17px; position: relative;">Active: {{$active}} &nbsp; &nbsp; <a class="text-white" href="{{ route('inactive', 1) }}">Inactive : {{$inactive}}</a></p>
              </div>
              <a href="{{ route('members.create') }}">
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div></a>
              <a href="{{ route('members.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $user }}</h3>

                <p>Users</p>
              </div>
              @if(auth()->user()->role < 1)
              <a href="{{ route('users.create') }}">
              <div class="icon">
                <i class="fas fa-plus-circle"></i>
              </div></a>
              
              <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @else
              <a class="small-box-footer"> &nbsp; </a>
              @endif
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            @if(count($notRet) == 0)
              <div class="small-box bg-secondary">
            @else
            <div class="small-box bg-danger">
            @endif
              <div class="inner">
                <h3>{{ count($notRet) }}</h3> 

                <p>Books not Returned</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('retBybook') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
       <!--  <?php
        
        for($i=0; $i < count($data); $i++)
          echo $data[$i]->issue.', ';
        ?> -->
        
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-book mr-1"></i>
                  Most Borrowed Books
                </h3>
                @if(count($record))
                <a href="{{ route('record.list') }}" class="small-box-footer float-right">More info <i class="fas fa-arrow-circle-right"></i></a>
                @endif
                <div class="card-tools">
                  
                  
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th width="35%">Book Title</th>
                        <th width="35%">Author</th>
                        <th>Borrowings</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if(count($record))
                      @foreach($record as $rec)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rec->title }}</td>
                        <td>{{ $rec->author->name }}</td>
                        <td>{{ $rec->borrow_count }}</td>
                      </tr>
                      @endforeach
                    @else
                      <tr>
                        <td colspan="4">No Record Found...</td>
                      </tr>
                    @endif
                    </tbody>
                  </table>
                    
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card --> 


            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Register {{date('Y')}}
                </h3>
                <div class="card-tools">
                  <div style="padding: 5px; float: left;">
                   <div style="background: #83ecc8; float: left; width: 10px; height: 24px; color: #83ecc8; "></div>&nbsp;Books</div>
                   <div style="padding: 5px; float: left;">
                     <div style="background: #3b8bba; float: left; padding-left: 10px; width: 10px; height: 24px; color: #3b8bba; "></div>&nbsp;Issue </div>
                  <div style="padding: 5px; float: left;">
                     <div style="background: #c1c7d1; float: left; width: 10px; height: 24px; color: #c1c7d1; "></div>&nbsp;Return</div>
                  
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart1"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas1" height="300" style="height: 300px;"></canvas>                         
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>                         
                  </div>  
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card --> 


          </section>


          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  To Do List
                </h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> Add Task</button>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <?php $no = count($task); ?>
              <div class="card-body">
            @foreach($task as $t)

            <?php
                      $last_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $t->created_at);
                      $current = \Carbon\Carbon::now();
                      $remaining_days = $current->diffInDays($last_date);
                      $statusDate =  $last_date->isBefore($current);

            ?>


           @if( $no != 0 )

              <div class="task-body">
                  <label class="customcheck">{{ $t->content }} &nbsp;
                      <small class="badge badge-info"><i class="far fa-clock"></i> &nbsp;{{ $t->created_at->diffForHumans() }}</small>
                <form action="{{ route('tasks.destroy',$t->id) }}" method="POST">      @csrf
                    @method('DELETE')   
                       <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </form>
                  </label>
              </div>
              @else
                <div class="task-body">
                  <label class="customcheck">
                    No task available.
                  </label>
                </div>
              @endif
            @endforeach
                
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer clearfix">
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> Add Task</button>
              </div> -->
            </div>
            <!-- /.card -->
            
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- The Main Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Enter your task</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            
              <form method="post" action="{{ route('tasks.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="input-group-append">
                    <div class="input-group mb-3 input-group-lg">
                      <input type="text" class="form-control" name="task" placeholder="Enter tasks here..." autocomplete="off">
                      <button class="btn btn-success" type="submit">Go</button>
                    </div>
                  </div>
              </form>
      </div>


    </div>
  </div>
</div>



<script>

  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
     var month = <?php echo json_encode($data); ?>;
     
      
     
    //--------------
    //- AREA CHART -
    //--------------
    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#revenue-chart-canvas1').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
      datasets: [
        {
          label               : 'Total Issue',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [month[0].issue, month[1].issue, month[2].issue, 
                                month[3].issue, month[4].issue, month[5].issue, 
                                month[6].issue, month[7].issue, month[8].issue, 
                                month[9].issue, month[10].issue, month[11].issue]
        },
        {
          label               : 'Total Returned',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [month[0].ret, month[1].ret, month[2].ret, 
                                month[3].ret, month[4].ret, month[5].ret, 
                                month[6].ret, month[7].ret, month[8].ret, 
                                month[9].ret, month[10].ret, month[11].ret]
        },
        {
          label               : 'Books in Library',
          backgroundColor     : 'rgba(131, 236, 200, 1)',
          borderColor         : 'rgba(131, 236, 200, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(131, 236, 200, 1)',
          pointStrokeColor    : '#83ecc8',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [month[0].tot_book, month[1].tot_book, 
                                month[2].tot_book, month[3].tot_book, month[4].tot_book,
                                month[5].tot_book, month[6].tot_book, month[7].tot_book,
                                month[8].tot_book, month[9].tot_book, 
                                month[10].tot_book, month[11].tot_book]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas, { 
      type: 'line',
      data: areaChartData, 
      options: areaChartOptions
    })

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
      type: 'bar', 
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
 

</script>
@endsection
