@extends('layouts2.main')

@section('title', 'BOQ WBS')

@section('content') 
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-header text-center"><h2>Anggaran Awal</h2></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Uraian Pekerjaan</th>
                                <th scope="col">Jumlah Harga</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                    $total = 0;
                                @endphp
                                @foreach ($history as $parent)
                                @if ($parent->parent == 0)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$parent->text}}</td>
                                        <td>{{number_format($parent->totalHarga)}}
                                            @php
                                                $total += $parent->totalHarga
                                            @endphp
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-right h5">Total</td>
                                    <td class="h5">{{number_format($total)}}</td>
                                </tr>
                            </tbody>
                          </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary"> < Kembali</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>

@endsection