@extends('includes.baseform')
@section('title')
Admin Usuario - De Buena Mano
@endsection

@section('content')
<section class="container-fluid">
    <div class="container mx-auto">
        <div class="col-8">
            <h2>Panel de administración</h2>
            <p>Curabitur placerat risus nec orci viverra porttitor. Integer facilisis lacus non ex sodales lobortis. Phasellus facilisis pulvinar ex, ut pretium eros vehicula.</p>
        </div>
    </div>
</section>
<section class="container-fluid">
    <div class="container mx-auto">
        <div id="app">
            <admin-user/>
        </div>
    </div>
</section>

@endsection