<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Reset Password Page</title>
</head>
<body>
    <h2>User Reset Password Details</h2>
    <h4>Değerli Kullanıcımız : {{ $mailData[0]["name"] }} </h4>
    <p>Parolanızı sıfırlamak için aşağıda gönderilen linke tıklayınız ve yeni şifrenizi belirleyiniz.</p>
    <strong><span>Sıfırlama Parolanız : {{ $mailData[1] }}</span></strong><br>
    <span>Sıfırlama parolanızı girerek yeni şifrenizi oluşturabilirsiniz...</span>
</body>
</html>