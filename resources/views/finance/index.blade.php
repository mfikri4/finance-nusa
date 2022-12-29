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
                        {{ __('Finance') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama User</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            @if (auth()->user()->level == 1)
                                @foreach ($data as $dt => $id_user)
                                <tbody>
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{$id_user->name}}</td>
                                        <td>
                                            <a href="{{ url('financea/ewallet/'. $id_user->id ) }}" class="btn btn-success mb-2">  
                                                E-Wallet
                                            </a>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                                @endforeach
    
                            @elseif(auth()->user()->level == 2)
                            <tbody>
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$data->name}}</td>
                                    <td>
                                        <a href="{{ url('fin/wlt/'. $data->id ) }}" class="btn btn-success mb-2">  
                                            E-Wallet
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            @elseif(auth()->user()->level == 3)

                            <tbody>
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$data->name}}</td>
                                    <td>
                                        <a href="{{ url('finances/ewlt/'. $data->id ) }}" class="btn btn-success mb-2">  
                                            E-Wallet
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
