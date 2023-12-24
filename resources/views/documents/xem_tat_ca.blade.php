<!-- resources/views/thu_viens/xem_tat_ca.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Xem Tất Cả Thông Tin Thư Viện</title>
</head>
<body>
<h1>Danh Sách Tài Liệu trong Thư Viện</h1>

<h2>Sách</h2>
<ul>
    @foreach($tatCaTaiLieu['sach'] as $sach)
        <li>{{ $sach->ten_sach }} - {{ $sach->ten_tac_gia }}</li>
    @endforeach
</ul>

<h2>Tạp Chí</h2>
<ul>
    @foreach($tatCaTaiLieu['tapChi'] as $tapChi)
        <li>{{ $tapChi->ten_tap_chi }} - {{ $tapChi->so_phat_hanh }}</li>
    @endforeach
</ul>

<h2>Báo</h2>
<ul>
    @foreach($tatCaTaiLieu['bao'] as $bao)
        <li>{{ $bao->ten_bao }} - {{ $bao->ngay_phat_hanh }}</li>
    @endforeach
</ul>
</body>
</html>
