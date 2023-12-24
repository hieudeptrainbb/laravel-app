<form action="{{ route('them-sinh-vien') }}" method="POST">
    @csrf
    <!-- Các trường dữ liệu của sinh viên -->
    <input type="text" name="so_bao_danh" placeholder="Số báo danh">
    <input type="text" name="ho_ten" placeholder="Họ tên">
    <input type="text" name="dia_chi" placeholder="Địa chỉ">
    <input type="text" name="khoi_thi" placeholder="Khối thi">
    <input type="text" name="muc_uu_tien" placeholder="Mức ưu tiên">
    <button type="submit">Thêm mới sinh viên</button>
</form>
