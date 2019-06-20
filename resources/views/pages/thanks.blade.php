@extends('layout')

@section('title', '歡迎下次再來')

@section('body-class', 'sticky-footer')

@section('content')

   <div class="thank-you-section">
       <h1>謝謝您的訂購!</h1>
       <div class="spacer"></div>
       <div>
           <a href="{{ url('/') }}" class="button">回首頁</a>
       </div>
   </div>




@endsection