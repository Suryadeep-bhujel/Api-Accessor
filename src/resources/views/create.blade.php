@extends("accessor::layout.app")
@section(config('access_config.extends_name'))
    <style>
        .alert-sm {
            font-size: 13px;
            padding: 5px 10px;
            color: red;
        }

    </style>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>

        <form action="{{ $route }}" method="post" class="row">
            @csrf
            @if(isset($keyInfo))
                @method("PUT")
            @endif
            <div class="col-lg-6 offset-lg-3">
                {{-- @dump(@$errors)
                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <div class="row form-group mb-2">

                    <label for="title" class="col-lg-3">
                        <strong>Api Access Key Title <span>*</span></strong>
                    </label>
                    <div class="col-lg-7">
                        <div class="input-group">
                            {!! Form::text('title', old('title') ?? @$keyInfo->title, ['class' => 'form-control form-control-sm', 'placeholder' => 'API Access key Title']) !!}

                            {{-- <div class="input-append">dsfjkl</div> --}}
                        </div>
                        @error('title')
                            <div class="alert alert-danger alert-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group mb-2">
                    <label for="type" class="col-lg-3"> <strong> Access Use for <span>*</span></strong></label>
                    <div class="col-lg-7">
                        <div class="input-group">
                            {!! Form::select('type', ['1' => 'Live Access Key', '0' => 'Test Access Key'], old('type') ?? @$keyInfo->type, ['class' => 'form-control form-control-sm', 'placeholder' => '--- Select Anyone ---']) !!}

                        </div>
                        @error('type')
                            <div class="alert alert-danger alert-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group mb-2">
                    <label for="status" class="col-lg-3"> <strong> Access Key Status <span>*</span></strong></label>
                    <div class="col-lg-7">
                        <div class="input-group">

                            {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status') ?? @$keyInfo->status, ['class' => 'form-control form-control-sm', 'placeholder' => '--- Select Anyone ---']) !!}
                        </div>
                        {{-- <div class=""><small class="text-info">By default the access key expired within  </small></div> --}}
                        @error('status')
                            <div class="alert alert-danger alert-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-10 text-right" style="text-align: right">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
