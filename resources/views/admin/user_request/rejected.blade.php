@extends('layouts.admin.app', ['pageTitle'=>$headerTitle])
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/vendor/datatables/css/jquery.dataTables.min.css') }}">
    <style>
        #DataTables_Table_0_wrapper label {
            color: white !important;
        }

        .dataTables_wrapper .dataTables_info {
            color: white !important;
        }

    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $headerTitle }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm yajra-datatable">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>User Information</th>
                                    <th>Image</th>
                                    <th>Current Balance</th>
                                    <th>Lost Balance</th>
                                    <th>Sale</th>
                                    <th>Purchase</th>
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
                ajax: "{{ route('admin.user-request.rejected.request') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'user_info',
                        name: 'user_info',
                        orderable: false,
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                    },
                    {
                        data: 'current_balance',
                        name: 'current_balance',
                        orderable: false,
                    },
                    {
                        data: 'total_purchased_balance',
                        name: 'total_purchased_balance',
                        orderable: false,
                    },
                    {
                        data: 'total_sale',
                        name: 'total_sale',
                        orderable: false,
                    },
                    {
                        data: 'total_purchased',
                        name: 'total_purchased',
                        orderable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                    }
                ]
            });

        });
    </script>
@endpush
