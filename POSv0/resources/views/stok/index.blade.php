@extends('layouts.template')

@section('content')

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <div class="row">
                    <div class="dropdown mr-2">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="importExportDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Import / Export
                        </button>
                        <div class="dropdown-menu" aria-labelledby="importExportDropdown">
                            <button class="dropdown-item" onclick="modalAction('{{ url('/stok/import') }}')">
                                Import Stok
                            </button>
                            <a class="dropdown-item" href="{{ url('/stok/export_excel') }}">
                                <i class="fa fa-file-excel"></i> Export to Excel
                            </a>
                            <a class="dropdown-item" href="{{ url('/stok/export_pdf') }}" target="_blank">
                                <i class="fa fa-file-pdf"></i> Export to PDF
                            </a>
                        </div>
                    </div>

                    <button onclick="modalAction('{{ url('/stok/create_ajax') }}')" class="btn btn-primary mr-2">Tambah
                        Data</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-2">
                    <select id="filter_tahun" class="form-control">
                        <option value="">Semua Tahun</option>
                        @for ($year = date('Y'); $year >= 2020; $year--)
                            <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>
                                {{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="filter_bulan" class="form-control">
                        <option value="">Semua Bulan</option>
                        @php
                            $bulanIndonesia = [
                                1 => 'Januari',
                                2 => 'Februari',
                                3 => 'Maret',
                                4 => 'April',
                                5 => 'Mei',
                                6 => 'Juni',
                                7 => 'Juli',
                                8 => 'Agustus',
                                9 => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember',
                            ];
                            $currentMonth = date('m');
                        @endphp
                        @foreach ($bulanIndonesia as $num => $nama)
                            <option value="{{ sprintf('%02d', $num) }}" {{ $num == $currentMonth ? 'selected' : '' }}>
                                {{ $nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="mb-3">
                <div id="total_harga" class="d-flex justify-content-start align-items-center p-3 col-2
                    bg-white border border-primary rounded shadow-sm text-primary font-weight-bold
                    h5" style="transition: all 0.3s ease;">
                    Total Harga: Rp 0
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Jumlah</th>
                        <th>Harga Total</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Supplier</th>
                        <th>User Pembuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true">
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $('#filter_tahun, #filter_bulan').on('change', function() {
            tableStok.ajax.reload();
        });

        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        function formatDateTimeManual(dateString) {
            const date = new Date(dateString);

            const pad = (n) => n.toString().padStart(2, '0');

            const day = pad(date.getDate());
            const month = pad(date.getMonth() + 1); // Month is zero-indexed
            const year = date.getFullYear();
            const hours = pad(date.getHours());
            const minutes = pad(date.getMinutes());

            return `${day}/${month}/${year} ${hours}:${minutes}`;
        }

        var tableStok;
        $(document).ready(function() {
            tableStok = $('#table_stok').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/stok/list') }}",
                    type: "POST",
                    dataType: "json",
                    data: function(d) {
                        d.level_id = $('#level_id').val();
                        d.tahun = $('#filter_tahun').val();
                        d.bulan = $('#filter_bulan').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "item",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "stok_jumlah",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "harga_total",
                        className: "",
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return '<span style="text-align: right; display: inline-block;">' +
                                new Intl.NumberFormat('id-ID').format(data) +
                                '</span>';
                        }
                    },

                    {
                        data: "keterangan",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "stok_tanggal",
                        className: "text-center",
                        orderable: true,
                        searchable: true,
                        render: function(data) {
                            return formatDateTimeManual(data);
                        }
                    },
                    {
                        data: "supplier_nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },

                    {
                        data: "user_nama",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "aksi",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }
                ],
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();

                    var totalHarga = api.column(3).data().reduce(function(a, b) {
                        return a + b;
                    }, 0);

                    $('#total_harga').text('Total Harga: Rp ' + new Intl.NumberFormat('id-ID').format(totalHarga));
                }
            });
        });
    </script>
@endpush
