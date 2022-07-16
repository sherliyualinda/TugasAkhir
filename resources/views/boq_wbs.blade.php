<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman BOQ WBS</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>


<body style="background: lightgray">
    @include('nav_barMar')
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-header text-center"><h2>BOQ</h2></div>
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
                                    @foreach ($parent->children as $child)
                                        @if($child->totalHarga > 0)
                                        <tr>
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{$child->text}}</td>
                                            <td>{{number_format($child->totalHarga)}}
                                                @php
                                                    $total += $child->totalHarga
                                                @endphp
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
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
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>