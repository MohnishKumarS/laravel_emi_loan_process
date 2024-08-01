@extends('layouts.main')

@section('content')
    <div class="mt-5 py-5">
        <div class="container-fluid">
            {{-- <h2 class="sec-title center">Clients Loan Details</h2> --}}
            @if (session('success'))
                <div class="container">
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>EMI proceesed!</strong> {{session()->get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                </div>
            @endif
            <div class="text-center">
                <a href="{{ url('process-emi') }}" class="btn-main">Process Data</a>
            </div>

            @if ($emi->isEmpty())
               <div class="container">
                <div class="text-center">
                  <img src="{{asset('assets/img/no-data.svg')}}" alt="no data" class="img-fluid" width="600px">
                </div>
               </div>
            @else
                <div class="my-5 px-3">
                  <h2 class="sec-title center">EMI Details</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%;" width="10%">Client ID</th>
                                    @foreach ($emi->first() as $col => $val)
                                        @if ($col !== 'id' && $col !== 'clientid')
                                            <th scope="col"  style="width: 10%;" width="20%">{{ $col }}</th>
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($emi as $row)
                                    <tr class="text-center">
                                        <th scope="row">{{ $row->clientid }}</th>
                                        @foreach ($row as $col => $val)
                                            @if ($col !== 'id' && $col !== 'clientid')
                                                <td>{{ $val }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif


        </div>
    </div>
    <style>
      tr th,tr td{
        padding: 1rem 0.5rem !important;
      }
    </style>
@endsection
