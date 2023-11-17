@extends('admin.includes.base')

@section('title','Dashboard - Lista posts')

@push('select2-css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{url('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

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
            <h1 class="m-0">Lista de posts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Posts</li>
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
                    <div class="card-header d-flex justify-content-end">                      
                      <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">Crear Post</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <!-- NEW TABLE WITH PRIME VUE -->
                        <div id="app">
                          <post-table></post-table>
                        </div>
                      <!--<table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->title }}</td>
                                    <td class="d-flex">
                                      <div class="mr-5">
                                        <a href="{{ route("posts.edit",$p->slug) }}" title="Editar post" target="_blank"><i class="fas fa-pencil-alt"></i></a>
                                      </div>
                                      <div>
                                        <a href="{{ route("posts.show",$p->slug) }}" title="Ver post" target="_blank"><i class="far fa-eye"></i></a>
                                      </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                      </table>-->
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

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form action="{{ route('posts.store')}}" method="POST">
        @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Creacion de post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">         
                <div>
                  <div class="form-group">
                    <label for="postName">Titulo del post</label>
                    <input type="text" id="postName" class="form-control" name="title">
                  </div>
                  <div class="form-group">
                    <label for="postCategory">Categoria del post</label>
                    <select id="postCategory" class="select2" multiple="multiple" data-placeholder="Seleccione una categoria" style="width: 100%;" name="post_category_id[]">   
                        @foreach ( $postcats as $pcats)
                          <option value="{{ $pcats->id }}">{{ $pcats->name }}</option>
                        @endforeach   
                    </select>     
                  </div>
                  <div class="form-group">
                    <label for="postAuthor">Autor post</label>
                    <select id="postAuthor" class="form-control" name="author_id">
                       <option value="" selected>Seleccionar un autor</option>
                        @foreach ( $authors as $a)
                        <option value="{{ $a->id }}">{{ $a->firstname }} {{ $a->lastname }}</option>
                        @endforeach   
                    </select>
                  </div>             
                </div>     
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Crear post</button>
            </div>
          </div>
      </form>
    </div>
  </div>
<!-- End Modal -->

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

@push('select2-js')
<!-- Select2 -->
<script src="{{ url('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $(function () {
  //Initialize Select2 Elements
  $('.select2').select2()
});
</script>
@endpush

@push('test-prime-vue')
@vite('resources/js/app.js')
@endpush

