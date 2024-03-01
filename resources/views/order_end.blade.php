@extends('includes.baseform')
@section('title')
  Detalles de la orden - De Buena Mano
@endsection
@section('content')
<section class="container-fluid p-pages">
    <div class="container">
        <h2>Pantalla Compra finalizada con detalle</h2> 
        <h2>Nº orden de compra : {{ $resp->getBuyOrder() }}</h2>
        <p><span>getVci()</span>{{$resp->getVci()}}</p>
        <p><span>getAmount()</span>{{$resp->getAmount()}}</p>
        <p><span>getStatus()</span>{{$resp->getStatus()}}</p>
        <p><span>getBuyOrder()</span>{{$resp->getBuyOrder()}}</p>
        <p><span>getSessionId()</span>{{$resp->getSessionId()}}</p>

        <p><span>getCardDetail()</span></p>
        <ul>
            @foreach($resp->getCardDetail() as $detail)
                <li>{{$detail}}</li>
            @endforeach
        </ul>
        
        <p><span>getCardNumber()</span>{{$resp->getCardNumber()}}</p>
        <p><span>getAccountingDate()</span>{{$resp->getAccountingDate()}}</p>
        <p><span>getTransactionDate()</span>{{$resp->getTransactionDate()}}</p>
        <p><span>getAuthorizationCode()</span>{{$resp->getAuthorizationCode()}}</p>
        <p><span>getPaymentTypeCode()</span>{{$resp->getPaymentTypeCode()}}</p>
        <p><span>getResponseCode()</span>{{$resp->getResponseCode()}}</p>
        <p><span>getInstallmentsAmount()</span>{{$resp->getInstallmentsAmount()}}</p>
        <p><span>getInstallmentsNumber()</span>{{$resp->getInstallmentsNumber()}}</p>
        <p><span>getBalance()</span>{{$resp->getBalance()}}</p>
        <p><span>isApproved()</span>{{$resp->isApproved()}}</p>
        
    </div>
</section>
@endsection