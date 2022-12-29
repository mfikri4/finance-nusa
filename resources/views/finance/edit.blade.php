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
                <div class="card-header">{{ __('Edit Nominal') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('financea/edit/'. $data->id_currency) }}">
                        @csrf

                        <input id="id_currency" type="hidden" class="form-control @error('balance') is-invalid @enderror" name="id_currency" required value="{{$data->id_currency}}" autofocus>
                        
                        <div class="row mb-3">
                            <label for="nominal" class="col-md-4 col-form-label text-md-end">{{ __('Nominal') }}</label>

                            <div class="col-md-6">
                                <input id="balance" type="number" class="form-control @error('balance') is-invalid @enderror" name="balance" required autocomplete="balance" value="{{$data->balance}}"  autofocus>
                                @error('balance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit Nominal') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
