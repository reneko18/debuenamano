@extends('admin.includes.base')

@section('title','Dashboard - Lista de Productos Test')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Estado de pagos</h1>
            <p>Curabitur placerat risus nec orci viverra porttitor. Integer facilisis lacus non ex sodales lobortis. Phasellus facilisis pulvinar ex, ut pretium eros vehicula.</p>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Productos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title"></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div id="app">
                        <admin-view/>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @push('test-prime-vue')
  @vite('resources/js/app.js')
  @endpush
@endsection


