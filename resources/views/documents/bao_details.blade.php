<!-- Form thêm mới Báo -->
<form method="post" action="{{ route('bao.them-moi') }}">
    @csrf
    <!-- Các trường dữ liệu của Báo -->
    <!-- Ví dụ: -->
    <input type="text" name="ma_tai_lieu" placeholder="Mã tài liệu">
    <input type="text" name="ten_nha_xuat_ban" placeholder="Tên nhà xuất bản">
    <input type="number" name="so_ban_phat_hanh" placeholder="Số bản phát hành">
    <input type="date" name="ngay_phat_hanh" placeholder="Ngày phát hành">
    <!-- ... các trường dữ liệu khác của Báo -->
    <button type="submit">Thêm Báo</button>
</form>
