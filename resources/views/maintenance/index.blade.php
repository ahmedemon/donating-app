@extends('maintenance.layout')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/json/formatter/json-formatter.css') }}">
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-10 col-sm-10 col-md-5">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title py-0 mb-0">Maintenance</h4>
                </div>
                <div class="card-body px-3">
                    <div class="row">
                        @include('maintenance.action', ['action' => 'cacheClear', 'name' => 'Clear Cache'])
                        @include('maintenance.action', ['action' => 'optimizeClear', 'name' => 'Optimize Cache'])
                        @include('maintenance.action', ['action' => 'viewClear', 'name' => 'View Cache'])
                        @include('maintenance.action', ['action' => 'routeClear', 'name' => 'Route Cache'])
                        @include('maintenance.action', ['action' => 'configClear', 'name' => 'Config Cache'])
                        @include('maintenance.action', ['action' => 'clearCompiled', 'name' => 'Clear Compiled'])
                        @include('maintenance.action', ['action' => 'clearResetTokens', 'name' => 'Flush Reset Tokens'])
                        @include('maintenance.action', ['action' => 'cronJob', 'name' => 'Run Cron Job'])
                        @include('maintenance.action', ['action' => 'migrate', 'name' => 'Migrate Database'])
                        @include('maintenance.action', ['action' => 'databaseBackup', 'name' => 'Database Backup'])
                    </div>
                </div>
            </div>
        </div>
        <div class="col-10 col-sm-10 col-md-7">
            <div class="card h-100">
                <div class="card-header text-center">
                    <h4 class="card-title py-0 mb-0">Output</h4>
                </div>
                <div class="card-body p-0 h-100">
                    <div class="bg-dark text-success p-2 rounded-bottom h-100">
                        <pre id="output" data-output="null">Nothing happend yet!</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Launch static backdrop modal
    </button> --}}

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Error / Exception</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="font-size: 12px">
                    ...
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div> --}}
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{ asset('backend/json/formatter/json-formatter.umd.js') }}"></script>
    <script>
        $(function() {
            const output = (string) => $('#output').text(string);

            $('form').on('submit', function(e) {
                e.preventDefault();
                $this = $(this);

                output('Processing...');
                $.ajax({
                    url: $this.attr('action'),
                    type: 'POST',
                    data: $this.serialize(),
                    success: function(response) {
                        output(response);
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);

                        $('#staticBackdrop').modal('show');
                        const formatter = new JSONFormatter(JSON.parse(xhr.responseText));
                        $('#staticBackdrop .modal-body').html(formatter.render());
                    }
                });
            });

            $('[data-bs-dismiss="modal"]').on('click', function() {
                $('#staticBackdrop').modal('hide');
            });
        })
    </script>
@endpush
