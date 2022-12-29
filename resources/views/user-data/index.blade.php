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
                        {{ __('List Data User') }}
                </div>

                <!-- <div class="card-body">
                    <div class="my-1">
                        <a href="{{url('user-data/create')}}" class="btn btn-success btn-times">  
                            <span class="text">Tambah Data</span>
                        </a>   
                            
                    </div>
                </div> -->
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
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @foreach ($data as $dt)
                            <tbody>
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{$dt->name}}</td>
                                    <td>{{$dt->email}}</td>
                                    <td>{{$dt->status}}</td>
                                    <td>
                                        @if ($dt->level == 1)
                                            Admin
                                        @elseif($dt->level == 2)
                                            Finance
                                        @elseif($dt->level == 3)
                                            Support
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('user-data/edit/'.$dt->id) }}" class="btn btn-primary mb-2">  
                                            <i class="fa fa-edit"></i>
                                            Edit 
                                        </a>
                                        <a href="{{ url('user-data/delete/'.$dt->id) }}" class="btn btn-danger mb-2">  
                                            <i class="fa fa-times"></i>
                                            Hapus
                                        </a>
                                        
                                    </td>
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
