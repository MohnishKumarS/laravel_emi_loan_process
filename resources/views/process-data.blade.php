@extends('layouts.main')

@section('content')
  <div class="mt-5 py-5">
    <div class="container">
      {{-- <h2 class="sec-title center">Clients Loan Details</h2> --}}

      <div class="text-center">
        <a href="{{url('process-emi')}}" class="btn-main">Process Data</a>
      </div>
      
    </div>
  </div>
@endsection
