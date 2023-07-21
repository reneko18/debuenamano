@extends('admin.includes.base')

@section('title','Dashboard - Crear Usuario')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Crear Producto</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Crear Producto</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="{{ route('productos.store') }}" method="post">
          @csrf
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="productName">Nombre del producto</label>
                <input type="text" id="productName" class="form-control" name="name">
              </div>
              <div class="form-group">
                <label for="sku">SKU</label>
                <input type="text" id="sku" class="form-control" name="sku">
              </div> 
              <div class="mb-3">
                <label for="price">Precio</label>            
                <div class="input-group">                 
                  <span class="input-group-text">$</span>              
                  <input type="number" id="price" class="form-control" name="price">                
                </div>
              </div>
              <div class="form-group">
                <label for="description">Descripcion</label>
                <textarea name="description" id="desciption" class="form-control" cols="30" rows="10"></textarea>
              </div>
              <button type="submit" class="btn btn-lg btn-primary">Crear</button>
            </div>
          </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection