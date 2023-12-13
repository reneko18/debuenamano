@extends('admin.includes.base')

@section('title','Dashboard - Editar Autor')

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
            <h1 class="m-0">Crear Autor</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Crear Autor</li>
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
                <div class="col-6">
                  <form action="{{ route('authors.update',$author->id) }}" method="post">
                    @csrf
                    @method('PUT')
                  <div class="form-group">
                    <label for="authorFirstName">Nombre del autor</label>
                    <input type="text" id="authorFirstName" class="form-control" name="firstname" value="{{ $author->firstname }}">
                  </div>
                  <div class="form-group">
                    <label for="authorLastName">Apellido del autor</label>
                    <input type="text" id="authorLastName" class="form-control" name="lastname" value="{{ $author->lastname }}">
                  </div> 
                    <button type="submit" class="btn btn-lg btn-primary">Editar autor</button>
                  </form>
                </div>
                
                <div class="col-6">
                        <div class="mb-3">
                            <label for="imagen">Imagen de perfil (Solo 1)</label>            
                            <div class="dropzone mb-4"></div>   
                        </div> 
                        @isset($image)
                          <form method="POST" action="{{route('image.destroy', $image)}}">
                              @csrf
                              @method('DELETE')
                              <input type="hidden" name="image_id" value="{{ $image->id }}">
                              <div class="col-3">
                                  <button class="btn btn-danger btn-supp" title="Borrar la imagen"><i class="fas fa-times"></i></button>
                                  <img class="img-fluid uploaded-image" src="{{asset($image->url)}}" alt="imagen de perfil">
                              </div>                        
                          </form> 
                        @endisset                    
                </div>
                
            </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection


@push('dropzone-js')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script type="text/javascript">
          Dropzone.autoDiscover = false;      
          var myDropzone = new Dropzone('.dropzone',{
          url: '/author/{{$author->id}}/photo', 
          method: 'post',     
          dictDefaultMessage : 'Desplace la imagen',      
          headers: {
          'X-CSRF-TOKEN' : '{{ csrf_token() }}'
          },           
          acceptedFiles : 'image/*', 
          resizeWidth: 1440,            
          paramName : 'image',   
          init: function () {
                this.on('error', function (file, responseText) {              
                      var msgEl = $(file.previewElement).find('.dz-error-message');                    
                      msgEl.text(responseText.message);
                      msgEl.show();                  
                });   
              },
              
              success: function(file, response) 
                  {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                          location.reload();
                    }
                  }
       
        });
  </script>
@endpush

