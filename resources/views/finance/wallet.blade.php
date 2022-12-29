@extends('layouts.app')

@section('sidebar')
    @if (auth()->user()->level == 1)
    <li class="nav-item">
        <a class="nav-link" href="{{ url('financea') }}">{{ __('Finance') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('user-data') }}">{{ __('List User') }}</a>
    </li>
    @elseif(auth()->user()->level == 2)
    <li class="nav-item">
        <a class="nav-link" href="{{ url('fin/'. Auth::user()->id ) }}">{{ __('Finance') }}</a>
    </li>
    @elseif(auth()->user()->level == 3)
    <li class="nav-item">
        <a class="nav-link" href="{{ url('finances/'. Auth::user()->id ) }}">{{ __('Finance') }}</a>
    </li>
    @endif
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                        {{ __('Akun E-Wallet') }}
                </div>

                @if (auth()->user()->level == 1)
                <div class="card-body">
                    <div class="my-1">
                        <a href="{{url('financea/currency/'.$idn->id)}}" class="btn btn-success btn-times">  
                            <span class="text">Tambah Currency</span>
                        </a>   
                            
                    </div>
                </div>
                @endif

                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>{{$idn->name}}, Jumlah uang adalah @currency($c_nilai)</h4><br>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama E-Wallet</th>
                                    <th>Nominal</th>
                                @if(auth()->user()->level == 1)
                                    <th>Aksi</th>
                                @endif

                                </tr>
                            </thead>
                            @foreach ($data as $dt)
                            <tbody>
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$dt->name_currency}}</td>
                                    <td>@currency($dt->balance)</td>
                                    @if(auth()->user()->level == 1)
                                    <td>
                                        <a href="{{ url('financea/edit/'.$dt->id_currency) }}" class="btn btn-primary mb-2">  
                                            <i class="fa fa-edit"></i>
                                            Edit 
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                                
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
