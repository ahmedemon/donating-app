@extends('layouts.user.app', ['pageTitle'=>$headerTitle])
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
                                    <th>Product</th>
                                    {{-- <th>User</th> --}}
                                    <th>Status</th>
                                    <th>Owner Approval</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="border-0">
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
                ajax: "{{ route('buyer-request.pending.request') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'product',
                        name: 'product'
                    },
                    // {
                    //     data: 'user',
                    //     name: 'user'
                    // },
                    {
                        data: 'admin_approval',
                        name: 'admin_approval'
                    },
                    {
                        data: 'owner_approval',
                        name: 'owner_approval'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });

        });
    </script>
@endpush
