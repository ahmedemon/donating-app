@extends('layouts.user.app', ['pageTitle'=>'Sponsors'])
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
            @foreach($sponsor_items as $item)
                <div class="col-md-3">
                    <div class="card rounded-0">
                        <div class="card-body p-0 justify-content-center">
                            <img class="w-100" height="300" src="{{ asset('storage/sponsor_item/' . $item->image) }}" alt="">
                            <div class="card-footer">
                                <div class="card-title text-white">
                                    {{ $item->title }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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