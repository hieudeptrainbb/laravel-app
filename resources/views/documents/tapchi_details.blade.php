<!-- Form thêm mới Tạp chí -->
<form method="post" action="{{ route('tap-chi.them-moi') }}">
    @csrf
    <!-- Các trường dữ liệu của Tạp chí -->
    <!-- Ví dụ: -->
    <input type="text" name="ma_tai_lieu" placeholder="Mã tài liệu">
    <input type="text" name="ten_nha_xuat_ban" placeholder="Tên nhà xuất bản">
    <input type="number" name="so_ban_phat_hanh" placeholder="Số bản phát hành">
    <input type="number" name="so_phat_hanh" placeholder="Số phát hành">
    <input type="text" name="thang_phat_hanh" placeholder="Tháng phát hành">
    <!-- ... các trường dữ liệu khác của Tạp chí -->
    <button type="submit">Thêm Tạp chí</button>
</form>
