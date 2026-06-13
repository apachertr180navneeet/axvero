@extends('frontend.layouts.app')
@section('meta_title', 'Payment Failed')
@section('content')

     <div class="alert alert-danger text-center mt-3">
        @if(isset($errorMessage))
           <h1 style="color:red;">{{ $errorMessage }}</h1>
        @endif
    </div>

@endsection

