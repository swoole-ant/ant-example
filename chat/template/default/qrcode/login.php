<?php

use ZPHP\Common\Route;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>扫码登录</title>
</head>
<body>
<p id="msg">未登录</p>
<p id="img">
    <img src="http://qr.liantu.com/api.php?text=<?= urlencode(Route::makeUrl('qrcode', 'wx', ['code' => $data['code']])); ?>">
</p>
<script type="text/javascript">
    var ws = new WebSocket("<?=$data['ws_url']?>?code=<?=$data['code']?>");
    ws.onopen = function (evt) {
        console.log('onopen');
        console.log(evt);
    }

    ws.onmessage = function (evt) {
        console.log(evt);
        var data = JSON.parse(evt.data);
        if (data.code) {
            alert(data.msg);
        } else {
            document.getElementById('msg').innerHTML = "欢迎您! " + data.data.name;
            window.location.href = "<?=Route::makeUrl('qrcode', 'chat', ['code' => $data['code']])?>";
        }
    }

    ws.onclose = function (evt) {
        console.log('onclose');
        console.log(evt);
    }

    ws.onerror = function (evt) {
        console.log('onerror');
        console.log(evt);
    }
</script>
</body>
</html>