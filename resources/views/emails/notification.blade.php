<!DOCTYPE html>
<html>

<head>
    <title>Email Notification</title>
</head>

<body>

    <center>
        <h2 style="padding: 23px;background: #e0addea1;border-bottom: 6px rgb(231, 119, 188) solid;">
            Notifikasi Status Transaksi
        </h2>
    </center>

    <p>Hi, {{ $name }}</p>
    <p>Nomor Transaksi: <strong>{{ $id_transaksi }}</strong><p>
    <p>{{ $content }}</p>

    <strong>Terima kasih</strong>

</body>

</html>