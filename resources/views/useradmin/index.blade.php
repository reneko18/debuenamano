@extends('includes.baseform')
@section('title')
Admin Usuario - De Buena Mano
@endsection

@section('content')
<section class="container-fluid p-pages pb-5">
    <div class="container mx-auto">
        <div class="col-8">
            <h2>Panel de administración</h2>
            <p>Curabitur placerat risus nec orci viverra porttitor. Integer facilisis lacus non ex sodales lobortis. Phasellus facilisis pulvinar ex, ut pretium eros vehicula.</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-1">
                <a href="" data-bs-toggle="modal" data-bs-target="#modalImageProfil" title="Modificar la imagen de perfil" class="overlay-img-profil">
                    <div id="profil-img" class="col-lg-3 col-sm-3 position-relative">              
                        <img src="{{ asset("/img/icon-profil.png")}}" alt="imagen de perfil" class="img-profile">       
                    </div>
                </a>
            </div>
            <div class="col-4 align-self-center">
                <h2>{{ $user->name }} {{ $user->lastname }}</h2>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid">
    <div class="container mx-auto">
        <div id="app">
            <admin-user :user-id="{{ $user->id }}" :user-slug="'{{ $user->slug }}'"/>
        </div>
    </div>
</section>
  <!-- Modal Image Profil -->
  <div class="modal fade" id="modalImageProfil" tabindex="-1" aria-labelledby="exampleModalLabelCov" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelCov">Agregar una foto de perfil</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-regular fa-circle-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body pl-0">
                    <form id="form-img">
                    <div class="panel panel-primary">          
                        <div class="row">
                        <div class="col-md-4 text-center">
                            <div id="image-profil" style="width:250px"></div>              
                        </div>
                        <div class="col-md-4" style="padding-top:30px;">
                
                        </div>
                
                        <div class="col-md-4 d-flex flex-column justify-content-center">
                            <input type="file" id="upload-profil" required>                              
                        </div>
                    </div> 
                                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>              
                        <a class="btn btn-make result-profil">Adjuntar tu imagen</a>
                    </div>
                    </form>
                </div>
            </div>
        </div> 
    </div> 

@endsection

{{-- @push('img-profil')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $uploadProfil = $('#image-profil').croppie({
        url: "{{ asset('/img/profil-default-crop.jpg')}}" ,
        enableExif: true,
        viewport: {
            width: 400,
            height: 400,
            type: 'square'
        },
        boundary: {
            width: 500,
            height: 500
        }
      });

  $('#upload-profil').on('change', function() {
    var readerProfil = new FileReader();
    readerProfil.onload = function(e) {
        $uploadProfil.croppie('bind', {
            url: e.target.result
        }).then(function() {
            console.log('jQuery bind complete');
        });
    }
    readerProfil.readAsDataURL(this.files[0]);
  });

  $('.result-profil').on('click', function(ev) {
        //new code
        var image = $('#upload-profil').val()
        if(image == ''){
            toastr.error("Veuillez ajouter une image",'Erreur');
        }else{
            $uploadProfil.croppie('result',{
            type: 'canvas',
            size: 'viewport',
          }).then(function(resp){
              $.ajax({
                url: "/profil/{{ $user->id }}/imageprofil",
                type: "POST",
                data: {
                    "image": resp,                      
                    "id": "{{ $user->id }}",
                },
                success: function(data) {                        
                  var res = data;
                  if(res==8){
                      toastr.error("Sorry! There is an error",'Error');
                    }else if(res==9){
                      toastr.error("Please upload a file",'Error');
                    }else{
                    toastr.success(data,'Update');
                    $('#form-img')[0].reset();    
                  }
                  location.reload(true);                   
                }
              });
          });        
        }       

  });
    
@endpush --}}