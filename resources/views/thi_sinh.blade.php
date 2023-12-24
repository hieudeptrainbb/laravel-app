<!-- resources/views/sinh-vien/tat-ca.blade.php -->

@if(isset($sinhViens))
    @if($sinhViens->isNotEmpty())
        <table>
            <thead>
            <tr>
                <th>Số báo danh</th>
                <th>Họ tên</th>
                <th>Địa chỉ</th>
                <th>Khối thi</th>
                <th>Mức ưu tiên</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sinhViens as $sinhVien)
                <tr>
                    <td>{{ $sinhVien->so_bao_danh }}</td>
                    <td>{{ $sinhVien->ho_ten }}</td>
                    <td>{{ $sinhVien->dia_chi }}</td>
                    <td>{{ $sinhVien->khoi_thi }}</td>
                    <td>{{ $sinhVien->muc_uu_tien }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Không có sinh viên nào được tìm thấy.</p>
    @endif
@else
    <p>Không có sinh viên nào được tìm thấy.</p>
@endif
