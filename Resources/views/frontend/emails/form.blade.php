@extends(View::exists('email.plantilla')?'email.plantilla':'marketplace::frontend.emails.mainlayout')
@php
@endphp
@section('content')
  <div id="contend-mail" class="p-3">
    <h1>Solisitud de servicio -  {{$data->service}}</h1>
    <br>
    <div style="margin-bottom: 5px">
     <strong>Nombre: </strong> {{$data->service}} <br/>
      <strong>Correo: </strong> {{$data->email}} <br/>
       <strong>Servicio: </strong> {{$data->service}} <br/>
       <strong>Notas: </strong> {{$data->message}} <br/>
    </div>
  </div>
@stop