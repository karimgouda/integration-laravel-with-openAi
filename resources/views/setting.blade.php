@extends('layouts.master')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .form-section {
            padding: 50px 0;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
        }
    </style>
@endpush

@section('content')
    <div class="form-section">
        <div class="container">
            <div class=" bg-light p-5 rounded">
                <h2 class="text-center mb-4">Settings</h2>
                <form action="{{route('setting.updateSetting')}}" method="post">
                    @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <label for="openAi" class="my-2"> OpenAi Api Key <span class="text-danger">*</span></label>
                        <input type="text" id="openAi" value="{{(isset($settings) ? $settings->openai_api_secret : old('openai_api_secret'))}}" class="form-control" name="openai_api_secret">
                        @error('openai_api_secret')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="Model" class="my-2"> OpenAi Model <span class="text-danger">*</span></label>
                       <select class="form-select" id="Model" name="openai_model">
                           <option value="gpt-3.5-turbo" {{(old('openai_model',$settings->openai_model) == "gpt-3.5-turbo" ? "selected" :"")}}>gpt-3.5-turbo</option>
                           <option value="text-davinci-003" {{(old('openai_model',$settings->openai_model) == "text-davinci-003" ? "selected" :"")}}>text-davinci-003</option>
                           <option value="gpt-4" {{(old('openai_model',$settings->openai_model) == "gpt-4" ? "selected" :"")}}>gpt-4</option>
                       </select>
                        @error('openai_model')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="Temperature" class="my-2"> Temperature <span class="text-danger">*</span></label>
                        <input type="number" value="{{(isset($settings) ? $settings->oai_temp : old('oai_temp'))}}" id="Temperature" class="form-control" name="oai_temp">
                        @error('oai_temp')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="Tokens" class="my-2"> Tokens <span class="text-danger">*</span></label>
                        <input type="number" id="Tokens" value="{{(isset($settings) ? $settings->oai_token : old('oai_token'))}}" class="form-control" name="oai_token">
                        @error('oai_token')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                    <button class="btn btn-primary mt-4 w-25">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
