@extends('layouts.main')

@section('content')
  <div class="mt-5 py-5">
    <div class="container">
      <h2 class="sec-title center">Clients Loan Details</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">clientid</th>
              <th scope="col">num_of_payment</th>
              <th scope="col">first_payment_date</th>
              <th scope="col">last_payment_date</th>
              <th scope="col">loan_amount</th>
            </tr>
          </thead>
          <tbody>
            @if ($loanDetails->count())
            @php
                $i = 1;
            @endphp
              @foreach ($loanDetails as $val)
              <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$val->clientid}}</td>
                <td>{{$val->num_of_payment}}</td>
                <td>{{$val->first_payment_date}}</td>
                <td>{{$val->last_payment_date}}</td>
                <td>{{$val->loan_amount}}</td>
              </tr>
              @endforeach
            @else
                <tr>
                  <td colspan="6">
                    <div class="text-center">
                      <img src="{{asset('assets/img/no-data.svg')}}" alt="no data" class="img-fluid" width="600px">
                    </div>
                  </td>
                </tr>
            @endif
     
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
