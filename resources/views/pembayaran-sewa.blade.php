@extends('layouts2.main')

@section('title', 'Pembayaran Sewa')

@section('content') 
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">< Kembali</a>
            <div class="card">
                <div class="card-header">
                    Pilih Metode Pembayaran
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <h4>Pembayaran Transfer</h4>
                        <p>Pembayaran melalui transfer dapat di kirim ke:</p>
                        <ul>
                            <li>Atas Nama: PT Desa Makmur</li>
                            <li>Rekening: BCA</li>
                            <li>Nomor : 19203434</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <h4>Pembayaran COD</h4>
                        <p>Pembayaran dengan sistem COD bisa datang langsung ke kantor Desa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection