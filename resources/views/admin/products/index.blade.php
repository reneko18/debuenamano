@extends('admin.includes.base')

@section('title','Dashboard - Lista de Productos')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        @if(session()->has('flash'))
            <div class="alert alert-success"><p>{{ session('flash') }}</p></div>
        @endif
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Lista de Productos</h1>
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
                      <h3 class="card-title">DataTable with minimal features & hover style</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>SKU</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->sku }}</td>
                                    <td>$ {{ number_format($p->price,0,',', '.') }}</td>
                                    <td>
                                      <div>
                                        <a href="{{ route("product.show",$p->id) }}" title="Ver producto" target="_blank"><i class="fas fa-eye"></i></a>
                                      </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>SKU</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                      </table>
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

  @push('script-datatables')
  <!-- DataTables  & Plugins -->
    <script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ url('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ url('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ url('adminlte/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{ url('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ url('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Page specific script -->
<script>
    $(function () {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  @endpush
@endsection

