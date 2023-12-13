@extends('admin.includes.base')

@section('title','Dashboard - Editar post')

@push('dropzone-js-css')
    <!-- Dropzone JS-->
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Editar post</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Editar post</li>
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
              <form action="{{ route('posts.update',$post->slug)}}" method="post">
                @csrf
                @method('PUT')  
              
                    <div class="form-group">
                      <label for="postName">Titulo del post</label>
                      <input type="text" id="postName" class="form-control" name="title" value="{{ $post->title }}">
                    </div>
                    <div class="form-group">
                      <label for="postCategory">Categoria del post</label>
                      <select id="postCategory" class="select2" multiple="multiple" data-placeholder="Seleccione una categoria" style="width: 100%;" name="post_category_id[]">   
                          @foreach ( $postcats as $p)
                            <option value="{{ $p->id }}" {{ $post->postcategories->contains('id', $p->id) ? 'selected' : '' }}>{{ $p->name }}</option>
                          @endforeach   
                      </select>     
                    </div>
                    <div class="form-group">
                      <label for="postAuthor">Autor post</label>
                      <select id="postAuthor" class="form-control" name="author_id">
                          @foreach ( $authors as $a)
                          <option value="{{ $a->id }}" {{ $a->id === $post->author_id ? 'selected' : '' }}>{{ $a->firstname }} {{ $a->lastname }}</option>
                          @endforeach   
                      </select>
                    </div>
                    <div id="container-editor" class="mb-2">
                      <label for="postcontent">Contenido post</label>
                          <textarea id="editor" name="content">{{ $post->content }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="metaTitle">Meta Title</label>
                      <input type="text" id="metaTitle" class="form-control" name="meta_title" value="{{ $post->meta_title }}">
                    </div>
                    <div class="form-group">
                      <label for="metaDescription">Meta Description</label>
                      <textarea id="metaDescription" class="form-control" name="meta_description">{{ $post->meta_description }}</textarea>
                    </div>

                    @isset($post->main_img)
                    <div class="form-group mb-5">
                        <label for="captionImg">Leyenda de la imagen</label>
                        <input type="text" id="captionImg" class="form-control" name="caption_img" value="{{ $post->caption_img }}">
                    </div>
                    @endisset 

                    <button type="submit" class="btn btn-lg btn-primary">Editar post</button>

            
              </form>
            </div>
            <div class="col-6">
                  <div class="mb-3">
                      <label for="imagen">Imagen principal del post</label>            
                      <div class="dropzone mb-4"></div>   
                  </div> 
                  @isset($post->main_img)
                    <form method="POST" action="{{route('mainimage.destroy', $post)}}">
                        @csrf
                        @method('DELETE')                        
                        <div class="col-3">
                            <button class="btn btn-danger btn-supp" title="Borrar la imagen"><i class="fas fa-times"></i></button>
                            <img class="img-fluid uploaded-image" src="{{asset($post->main_img)}}" alt="imagen de perfil">
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

@push('ckeditor')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>
<script>
// This sample still does not showcase all CKEditor&nbsp;5 features (!)
            // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
            CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',                
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',   
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                ckfinder: {
                    // Configure the CKFinder plugin
                    uploadUrl: '{{ route('image.upload') }}?_token={{ csrf_token() }}',
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration

                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced'
                ]
            });
</script>
@endpush

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

@push('dropzone-js')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script type="text/javascript">
          Dropzone.autoDiscover = false;      
          var myDropzone = new Dropzone('.dropzone',{
          url: '/post/{{$post->id}}/photo', 
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
