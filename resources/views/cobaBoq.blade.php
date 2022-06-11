<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Peralatan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
	
        @include('nav_barMar')
		<body style="background: lightgray">
<form action="proses.php" method="POST">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">                        
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kegiatan</th>
                                <th scope="col">Durasi</th>
                                <th scope="col">Tanggal Mulai</th>
                                <th>
                                    kelola
                                </th>
                                <!-- <th scope="col">QTY</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total Harga</th> -->
                              </tr>
                            </thead>
                            <tbody>
							<tr>
							</tr>
                            <?php
                            session_start();
                            $conn 	= mysqli_connect('localhost', 'root', '', 'diessnie');
                            $sql 	= "SELECT b.harga, b.qty,b.satuan, b.totalHarga, text, duration,start_date, t.parent, t.id FROM tasks t JOIN lahans l on t.id_lahan =l.id JOIN boq b on t.id = b.id_task";
                            $query 	= mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_assoc($query))
                            {

                                $tmp[$row['id']]['text'] = $row['text'];

                                if ($row['parent'] == 0) {
                                    $data[$row['id']] = &$tmp[$row['id']];
                                } 
                                else {
                                    $tmp[$row['parent']]['child'][$row['id']] = &$tmp[$row['id']];
                                }
                            }

                            function build_cat($array, $child = false, $index=0) {
                                
                                $html = '<ul>';
                                foreach ($array as $arr) {

                                    $html .= '<li>' . $arr['text'];
                                    if (key_exists('child', $arr)) {
                                        $html .= build_cat($arr['child'], true);
                                    }
                                    $html .= '</li>' . "\r\n";
                                }
                                $html .= '</ul>';
                                return $html;
                            }

                            echo build_cat($data);
                            ?>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>
</html>