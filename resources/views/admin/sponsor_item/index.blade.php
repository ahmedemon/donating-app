@extends('layouts.admin.app', ['pageTitle'=>'Sponsors'])
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/vendor/datatables/css/jquery.dataTables.min.css') }}">
    <style>
        #DataTables_Table_0_wrapper label {
            color: white !important;
        }

    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $headerTitle }}</h4>
                        <a href="{{ route('admin.sponsor-item.create') }}" class="btn btn-sm btn-secondary">Add New</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm yajra-datatable">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Reward Point</th>
                                        <th>Description</th>
                                        <th>Shipping Address</th>
                                        <th>Image</th>
                                        <th>Sponsored By</th>
                                        <th>Status</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-bordered">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function noticeDelete(elem) {
            event.preventDefault();
            if (confirm('Are you sure? You want to delete ( ' + elem.dataset.name + ' )')) {
                document.getElementById('delete-form-' + elem.dataset.id).submit();
            }
        }
    </script>
@endsection
@push('js')
    <script src="{{ asset('backend/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });
            $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url()->current() }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'reward_point',
                        name: 'reward_point'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'shipping_address',
                        name: 'shipping_address'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'sponsored_by',
                        name: 'sponsored_by'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        button: true,
                        button: true
                    },
                ]
            });

        });
    </script>
@endpush