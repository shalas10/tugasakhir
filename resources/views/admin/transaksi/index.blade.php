@extends('layouts.app')
@section('title', 'Dashboard - Admin')
@section('contentAdmin')
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Transaksi Cuci Mobil</h4>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!--end row-->
        {{-- <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive-custom">
                            <table id="datatable" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Kategori Mobil</th>
                                        <th class="text-center">Nama Pemesan</th>
                                        <th class="text-center">No Telp</th>
                                        <th class="text-center">Nama Mobil</th>
                                        <th class="text-center">No Plat Mobil</th>
                                        <th class="text-center">Tanggal Pesanan</th>
                                        <th class="text-center">Karyawan</th>
                                        <th class="text-center">Status Booking</th>
                                        <th class="text-center">Status Bayar</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->kategoriMobil->kategori_mobil }}</td>
                                            <td class="text-center text-capitalize">{{ $item->user->name }}</td>
                                            <td class="text-center">{{ $item->no_telp_pemesan }}</td>
                                            <td class="text-center">{{ $item->nama_mobil }}</td>
                                            <td class="text-center">{{ $item->no_plat_mobil }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d-m-Y') }} ||
                                                {{ $item->jam_pesan }}</td>

                                            <td class="text-center text-capitalize">
                                                @if ($item->karyawan_id == null)
                                                    <button type="button" class="btn btn-info text-light me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit2{{ $item->id }}">
                                                        Pilih Karyawan
                                                    </button>
                                                @else
                                                    {{ $item->karyawan->name }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($item->status_pesan == 'PENDING')
                                                    <span class="badge bg-warning text-light">Menunggu Cucian</span>
                                                @elseif ($item->status_pesan == 'PROCESS')
                                                    <span class="badge bg-primary text-light">Sedang Dicuci</span>
                                                @elseif ($item->status_pesan == 'SUCCESS')
                                                    <span class="badge bg-success text-light">Pencucian Selesai</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($item->status_bayar == 'UNPAID')
                                                    <span class="badge bg-warning text-light">Belum Bayar</span>
                                                @elseif ($item->status_bayar == 'PAID')
                                                    <span class="badge bg-success text-light">Sudah Bayar</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-between">
                                                    <button type="button"
                                                        class="btn btn-sm btn-warning text-light me-2 mr-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit{{ $item->id }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('transaction-booking.destroy', $item->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger me-2">Delete</button>
                                                    </form>
                                                    <a href="https://api.whatsapp.com/send?phone=85314005779"
                                                        target="_blank" class="btn btn-sm btn-success">WhatsApp</a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}


        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="my-3">
                            <a href="{{ route('booking-cuci.exportCSV') }}" class="btn btn-primary">
                                <i class="fa fa-file-excel-o mr-1"></i> Export CSV
                            </a>
                        </div>
                        <div class="table-responsive">
                            <div class="table-responsive-sm">
                                <table id="datatable" class="table table-bordered table-striped" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Kategori Mobil</th>
                                            <th class="text-center">Nama Pemesan</th>
                                            <th class="text-center">Nama Mobil</th>
                                            <th class="text-center">No Plat Mobil</th>
                                            <th class="text-center">Tanggal Pesanan</th>
                                            <th class="text-center">Rating</th>
                                            <th class="text-center">Status Booking</th>
                                            <th class="text-center">Status Bayar</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $item->kategoriMobil->kategori_mobil }}</td>
                                                <td class="text-center text-capitalize">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#show{{ $item->id }}">
                                                        <u>{{ $item->user->name }}</u>
                                                        <span class="show-button">Show</span>
                                                    </a>
                                                </td>
                                                <td class="text-center">{{ $item->nama_mobil }}</td>
                                                <td class="text-center">{{ $item->no_plat_mobil }}</td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d-m-Y') }} ||
                                                    {{ $item->jam_pesan }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->rating)
                                                        @for ($i = 1; $i <= $item->rating; $i++)
                                                            <span class="fa fa-star checked text-warning"></span>
                                                        @endfor
                                                    @else
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ratingModal{{ $item->id }}"><i
                                                                class="fa fa-star"></i> Beri
                                                            Rating</button>
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    @if ($item->status_pesan == 'PENDING')
                                                        <span class="badge bg-warning text-light p-2">Menunggu Cucian</span>
                                                    @elseif ($item->status_pesan == 'PROCESS')
                                                        <span class="badge bg-primary text-light p-2">Sedang Dicuci</span>
                                                    @elseif ($item->status_pesan == 'SUCCESS')
                                                        <span class="badge bg-success text-light p-2">
                                                            <i class="fa fa-check-square"></i> Pencucian Selesai
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->status_bayar == 'UNPAID')
                                                        <span class="badge bg-warning text-light p-2">
                                                            <i class="fa fa-warning"></i> Belum Bayar
                                                        </span>
                                                    @elseif ($item->status_bayar == 'PAID')
                                                        <span class="badge bg-success text-light p-2">
                                                            <i class="fa fa-check-square"></i> Sudah Bayar
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                                        data-bs-target="#modal{{ $item->id }}">
                                                        <i class="fa fa-navicon"></i> Action
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- Modal Edit --}}
    @include('admin.transaksi.edit')
    @include('admin.transaksi.show')
    @include('admin.transaksi.rating')

    {{-- Modal Action --}}
    <!-- Modal -->

    @foreach ($bookings as $item)
        <div class="modal fade" id="modal{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Transaksi Cuci Mobil</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('transaction-booking.sendWhatsapp', $item->id) }}"
                                class="btn btn-success btn-lg text-light w-100 my-2" target="_blank">
                                <i class="fa fa-whatsapp"></i> WhatsApp
                            </a>
                            <a href="{{ route('transaction-booking.pdf', $item->id) }}"
                                class="btn btn-primary btn-lg text-light w-100 my-2" target="_blank">
                                <i class="fa fa-file-pdf-o"></i> Kwitansi
                            </a>
                            <button class="btn btn-warning btn-lg text-light w-100 my-2" data-bs-dismiss="modal"
                                data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('transaction-booking.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-lg text-white w-100 my-2">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    @endforeach




@endsection


@push('style')
    <style>
        .custom-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        }

        .custom-select:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }

        .custom-select:disabled {
            background-color: #e9ecef;
            opacity: 1;
        }
    </style>

    <style>
        .table-responsive-custom {
            overflow-x: auto;
        }

        .table-responsive-custom table {
            width: 100%;
            min-width: 750px;
            /* Sesuaikan dengan lebar tabel jika diperlukan */
        }
    </style>

    <style>
        .text-center.text-capitalize a {
            position: relative;
            display: inline-block;
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }

        .text-center.text-capitalize a::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #333;
            transform: scaleX(0);
            transform-origin: left center;
            transition: transform 0.3s;
        }

        .text-center.text-capitalize a:hover {
            color: #0077ff;
        }

        .text-center.text-capitalize a:hover::before {
            transform: scaleX(1);
        }

        .text-center.text-capitalize a .show-button {
            position: absolute;
            top: calc(100% + 10px);
            left: 50%;
            transform: translateX(-50%);
            background-color: #0077ff;
            color: #fff;
            padding: 8px 16px;
            border-radius: 4px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .text-center.text-capitalize a:hover .show-button {
            opacity: 1;
            visibility: visible;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.raty/latest/jquery.raty.css">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/starability-css/starability-minified.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> --}}

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/starability-all/dist/starability-all.min.css"> --}}
@endpush

@push('script')
    <script src="{{ url('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('bootstrap5-3/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.raty/latest/jquery.raty.js"></script>

    <script>
        $(document).ready(function() {
            $('option[value=""]').css('display', 'none');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#rating').raty({
                starType: 'i',
                starOn: 'fas fa-star',
                starOff: 'fas fa-star-o',
                readOnly: false
            });
        });
    </script>
@endpush
