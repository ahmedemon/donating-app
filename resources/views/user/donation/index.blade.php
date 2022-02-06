@extends('layouts.user.app', ['pageTitle'=>'Donations'])
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
                    <h4 class="card-title">Donation List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm yajra-datatable">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>User</th>
                                    <th>Trnx ID</th>
                                    <th>In</th>
                                    <th>Out</th>
                                    <th>Date</th>
                                    <th>Note</th>
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
                ajax: "{{ route('donations.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'trnx_id',
                        name: 'trnx_id'
                    },
                    {
                        data: 'in',
                        name: 'in'
                    },
                    {
                        data: 'out',
                        name: 'out'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'note',
                        name: 'note'
                    }
                ]
            });

        });
    </script>
@endpush