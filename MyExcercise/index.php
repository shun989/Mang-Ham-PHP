<?php
$customerList = array(
    "1" => array("ten" => "Lộc văn Khôi",
        "ngaysinh" => "1995/11/11",
        "diachi" => "Lạng sơn",
        "anh" => "image/khoi.jpeg"),
    "2" => array("ten" => "Nguyễn văn Trọng",
        "ngaysinh" => "2001/12/03",
        "diachi" => "Lào cai",
        "anh" => "image/trong.jpeg"),
    "3" => array("ten" => "Trần đức Duy",
        "ngaysinh" => "2001/03/01",
        "diachi" => "Việt trì, Phú thọ.",
        "anh" => "image/duy.jpeg"),
    "4" => array("ten" => "Đoàn hồng Quân",
        "ngaysinh" => "1998/12/28",
        "diachi" => "Việt trì, Phú thọ",
        "anh" => "image/quan.jpeg"),
    "5" => array("ten" => "Nguyễn hương Lan",
        "ngaysinh" => "1996/05/05",
        "diachi" => "Hà Nội",
        "anh" => "image/lan.jpeg"),
);

function searchByDate($customers, $from_date, $to_date)
{
    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filtered_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer['ngaysinh']) < strtotime($from_date)))
            continue;
        if (!empty($to_date) && (strtotime($customer['ngaysinh']) > strtotime($to_date)))
            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}

?>

<?php
$from_date = NULL;
$to_date = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filtered_customers = searchByDate($customerList, $from_date, $to_date);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid chartreuse;
    }

    img {
        width: 60px;
    }

    div {
        width: 50%;
        border: 1px solid lightgray;
    }

    div input {
        margin: 10px 10px;
        height: 25px;
    }
</style>
<body>
<table border="0">
    <caption><h1 style="color: blue">Danh sách khách hàng.</h1></caption>
    <form action="" method="post">
        <div>
            From:<input id="from" type="text" name="from" placeholder="yyyy/mm/dd"
                        value="<?php echo isset($from_date) ? $from_date : ''; ?>">
            To:<input id="to" type="text" name="to" placeholder="yyyy/mm/dd"
                      value="<?php echo isset($from_date) ? $from_date : ''; ?>">
            <button id="submit" type="submit">Search</button>
        </div>
    </form>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
    <?php if (count($filtered_customers) === 0): ?>
        <tr>
            <td colspan="5" class="message">Không tìm thấy khách hàng nào</td>
        </tr>
    <?php endif; ?>

    <?php foreach ($filtered_customers as $index => $customer): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $customer['ten']; ?></td>
            <td><?php echo $customer['ngaysinh']; ?></td>
            <td><?php echo $customer['diachi']; ?></td>
            <td>
                <div class="profile"><img src="<?php echo $customer['anh']; ?>"/></div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>