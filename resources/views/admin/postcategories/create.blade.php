@extends('admin.includes.base')

@section('title','Dashboard - Crear categoria de post')

@push('dropzone-js-css')
    <!-- Dropzone JS-->
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Crear categoria de post</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Crear categoria de post</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="{{ route('postcategories.store')}}" method="post">
          @csrf
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="categoryName">Nombre de la categoria</label>
                <input type="text" id="categoryName" class="form-control" name="name">
              </div>
              <button type="submit" class="btn btn-lg btn-primary">Crear categoria</button>
            </div>
          </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

