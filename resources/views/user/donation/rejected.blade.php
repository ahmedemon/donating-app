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
                    <h4 class="card-title">Donation List | Rejected</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm yajra-datatable">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Point</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Shipping Address</th>
                                    <th>Images</th>
                                    <th>Used Duration</th>
                                    <th>Status</th>
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
                ajax: "{{ route('donation.rejected') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
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
                        data: 'point',
                        name: 'point'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
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
                        data: 'images',
                        name: 'images'
                    },
                    {
                        data: 'used_duration',
                        name: 'used_duration'
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
                        name: 'action'
                    }
                ]
            });

        });
    </script>
@endpush