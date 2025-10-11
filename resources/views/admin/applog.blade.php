@extends('layouts.main')
@section('title', 'App logs')

@section('body')
    <x-sidebar />
    <x-nav />

    <div class="mdb-page-content page-intro bg-white">
        <div class="container py-3 ">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <div class="card mt-5 mb-3 shadow-md">
                        <div class="card-header">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <h4 class="font-weight-bold text-nowrap"> <i class="fa fa-bug-slash"></i> Error logs</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <x-error />
                                <table tdata class="table table-sm table-condensed table-hover table-striped"
                                    style="width: 100%">
                                    <thead>
                                        <th>ID</th>
                                        <th>Data</th>
                                        <th>Date</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footer />

    @endsection

    @section('js-code')
        @include('files.datatable-js')

        <script>
            $(function() {
                var dtResult = (new DataTable('[tdata]', {
                    searching: false,
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('applog', ['datatable' => '']) }}",
                    },
                    order: [
                        [0, "desc"]
                    ],
                    columnDefs: [{
                            targets: 0,
                            width: '1%'
                        },
                        {
                            targets: 2,
                            width: '1%'
                        },
                    ],
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'data',
                            name: 'data',
                        },
                        {
                            data: 'date',
                            name: 'date',
                            class: 'text-nowrap text-right'
                        },
                    ]
                }));
            });
        </script>
    @endsection
