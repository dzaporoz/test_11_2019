@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <h1 class="card-header">{{ __('Editing client information') }}</h1>

                    <div class="card-body">
                        <form method="POST" action="{{ route('client.update', ['client' => $client->id]) }}">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">

                                <div class="col-md-3">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', isset($client->name) ? $client->name : '') }}" required autocomplete="surname">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <label for="surname" class="col-form-label text-md-right">{{ __('Surname') }}</label>
                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname', isset($client->surname) ? $client->surname : '') }}" required autocomplete="surname">

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <label for="date-of-birth" class="col-form-label text-md-right">{{ __('Date of birth') }}</label>
                                    <input id="date-of-birth" type="date" class="form-control @error('date-of-birth') is-invalid @enderror" name="date-of-birth" value="{{ old('date-of-birth', isset($client->{'date-of-birth'}) ? $client->{'date-of-birth'} : '') }}" required autocomplete="email">

                                    @error('date-of-birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', isset($client->email) ? $client->email : '') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-5">
                                    <label for="phone-number" class="col-form-label text-md-right">{{ __('Phone number') }}</label>
                                    <input id="phone-number" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="format: XXX-XXX-XXXX" class="form-control @error('phone-number') is-invalid @enderror" name="phone-number" value="{{ old('phone-number', isset($client->{'phone-number'}) ? $client->{'phone-number'} : '') }}" required autocomplete="phone-number">

                                    @error('phone-number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">

                                <div class="col-md-6">
                                    <label for="address" class="col-form-label text-md-right">{{ __('Address') }}</label>
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', isset($client->address) ? $client->address : '') }}" required autocomplete="address">

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <label for="country" class="col-form-label text-md-right">{{ __('Country') }}</label>
                                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country', isset($client->country) ? $client->country : '') }}" required autocomplete="country">

                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <label for="trading-account-number" class="col-form-label text-md-right">{{ __('Trading account number') }}</label>
                                    <input type="text" class="form-control" value="{{ $client->{'trading-account-number'} }}" disabled>
                                </div>

                                <div class="col-md-4">
                                    <label for="balance" class="col-form-label text-md-right">{{ __('Balance') }}</label>
                                    <input type="text" class="form-control" value="{{ $client->balance }}" disabled>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <label for="open-trades" class="col-form-label text-md-right">{{ __('Open trades') }}</label>
                                    <input type="text" class="form-control" value="{{ $client->{'open-trades'} }}" disabled>
                                </div>

                                <div class="col-md-4">
                                    <label for="close-trades" class="col-form-label text-md-right">{{ __('Close trades') }}</label>
                                    <input type="text" class="form-control" value="{{ $client->{'close-trades'} }}" disabled>
                                </div>

                            </div>

                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update client data') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('user.index') }}">{{__('<< Return to client list')}}</a>
            </div>
        </div>
    </div>
@endsection
