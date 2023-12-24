<!-- Form thêm mới Sách -->
<form method="post" action="{{ route('sach.them-moi') }}">
    @csrf
    <!-- Các trường dữ liệu của Sách -->
    <!-- Ví dụ: -->
    <input type="text" name="ma_tai_lieu" placeholder="Mã tài liệu">
    <input type="text" name="ten_nha_xuat_ban" placeholder="Tên nhà xuất bản">
    <input type="number" name="so_ban_phat_hanh" placeholder="Số bản phát hành">
    <input type="text" name="ten_tac_gia" placeholder="Tên tác giả">
    <input type="number" name="so_trang" placeholder="Số trang">
    <!-- ... các trường dữ liệu khác của Sách -->
    <button type="submit">Thêm Sách</button>
</form>
