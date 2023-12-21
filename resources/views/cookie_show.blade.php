<!DOCTYPE html>
<html>
<head>
    <title>Hiển thị giá trị từ Cookie</title>
</head>
<body>
    <p>Giá trị 1: {{ request()->cookie('value1') }}</p>
    <p>Giá trị 2: {{ request()->cookie('value2') }}</p>
</body>
</html>
