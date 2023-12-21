<!DOCTYPE html>
<html>
<head>
    <title>Form nhập giá trị</title>
</head>
<body>
    <form action="{{ route('cookie.save') }}" method="POST">
        @csrf
        <input type="text" name="value1" placeholder="Nhập giá trị 1">
        <input type="text" name="value2" placeholder="Nhập giá trị 2">
        <button type="submit">Lưu vào Cookie</button>
    </form>
</body>
</html>
