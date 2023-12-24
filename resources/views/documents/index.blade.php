<!DOCTYPE html>
<html>
<head>
    <title>Chi Tiết Sách</title>
</head>
<body>
<h1>Chi Tiết Sách</h1>
<p>Mã Tài Liệu Sách: {{ $dataSach['ma_tai_lieu'] }}</p>
<p>Tên Nhà Xuất Bản Sách: {{ $dataSach['ten_nha_xuat_ban'] }}</p>
<!-- Các thông tin khác của sách -->
<hr>
<h1>Chi Tiết Tạp Chí</h1>
<p>Mã Tài Liệu Tạp Chí: {{ $dataTapChi['ma_tai_lieu'] }}</p>
<p>Tên Nhà Xuất Bản Tạp Chí: {{ $dataTapChi['ten_nha_xuat_ban'] }}</p>
<!-- Các thông tin khác của tạp chí -->
<hr>
<h1>Chi Tiết Báo</h1>
<p>Mã Tài Liệu Báo: {{ $dataBao['ma_tai_lieu'] }}</p>
<p>Tên Nhà Xuất Bản Báo: {{ $dataBao['ten_nha_xuat_ban'] }}</p>
<!-- Các thông tin khác của báo -->
</body>
</html>
