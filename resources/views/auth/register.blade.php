@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="h_name" class="col-md-4 col-form-label text-md-right">{{ __('H_Name') }}</label>

                            <div class="col-md-6">
                                <input id="h_name" type="text" class="form-control @error('h_name') is-invalid @enderror" name="h_name" value="{{ old('h_nome') }}" required autocomplete="h_name">

                                @error('h_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="f_no" class="col-md-4 col-form-label text-md-right">{{ __('F No.') }}</label>

                            <div class="col-md-6">
                                <input id="f_no" type="text" class="form-control @error('f_no') is-invalid @enderror" name="f_no" value="{{ old('h_nome') }}" required autocomplete="f_no">

                                @error('f_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tracks" class="col-md-4 col-form-label text-md-right">{{ __('Tracks') }}</label>
                                <?php 
                                    $path = public_path('tracks');
                                    $files = File::files($path);
                                    $tracks = [];
                                    foreach ($files as $key => $file) {
                                        $tracks[$key] = $file->getRelativePathname();
                                        // dd($file->getRelativePathname());
                                    }
                                ?>
                            <div class="col-md-6">
                                <select class="browser-default custom-select" name="audio">
                                    <option value="audio.mp3" selected>Select the track</option>
                                    @foreach($tracks as $track)
                                    <option value="{{$track}}">{{$track}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_master" id="is_master" {{ old('is_master') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="is_master">
                                        {{ __('create user with master control') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
