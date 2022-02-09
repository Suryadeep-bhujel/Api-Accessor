@extends("accessor::layout.app")
@section(config('access_config.extends_name'))
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('accesskey.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Access Key List</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header ">
                <div class="row">
                    <div class="col-lg-10">
                        <i class="fas fa-table me-1"></i>
                        Access Key List
                    </div>
                    <div class="col-lg-2 text-right">
                        <a href="{{ route('access_keys.create') }}" class="btn btn-primary btn-sm">Add New Access Key</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>API KEY</th>
                            <th>Created date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>API KEY</th>
                            <th>Created date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if (isset($keys) && $keys->count())
                            @foreach ($keys as $key => $api_key_item)
                                {{-- @dd($api_key_item->id) --}}
                                <tr>
                                    <td>{{ $api_key_item->title }}</td>
                                    <td>{{ $api_key_item->type == 1 ? 'LIVE key' : 'TEST Key' }}</td>
                                    <td>{{ $api_key_item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <input type="password" value="{{ $api_key_item->key }}"
                                            class="form-control form-control-sm" readonly
                                            onclick="copyToClipboard({{ $api_key_item->id }})">
                                        <span class="btn btn-sm  changeType">
                                            <span class="fa fa-eye"></span>
                                        </span>
                                    </td>
                                    <td>{{ $api_key_item->created_at }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('access_keys.edit', $api_key_item->id) }}"
                                            class="btn btn-info btn-sm">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                        <form action="{{ route('access_keys.destroy', $api_key_item->id) }}"
                                            class="" method="post">
                                            @method("DELETE")
                                            <button class="btn btn-danger btn-sm">
                                                <span class="fa fa-trash "></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        function copyToClipboard(element) {
            alert(element);
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(element).select();
            document.execCommand("copy");
            $temp.remove();
        }
        $("body").on('click', ".changeType", function() {
          
            $(this).parent('td ').find("input").attr("type", 'text');
        })
    </script>
@endsection
