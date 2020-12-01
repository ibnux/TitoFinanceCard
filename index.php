<?php
$nama = preg_replace("/[^a-zA-Z0-9 ]+/", "", urldecode($_GET['nama']));
if (empty($nama)) {
    $nama = "iBNuX";
}
if (strlen($nama) > 24)
    $nama = substr($nama, 0, 24);
$md5 = md5(strtoupper($nama));
$path = "images/$md5.jpg";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title><?= $nama ?> - Nasabah Tito Finance</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="title" content="<?= $nama ?> terdaftar sebagai Nasabah Tito Finance">
    <meta name="description" content="Kartu Hutang tanpa jaminan, cicilan seingetnya, bebas riba, bebas masalah, tak harap kembali bagai sang mentari menyinari dunia">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://titofinance.ibnux.com/?nama=<?= urlencode($nama) ?>">
    <meta property="og:title" content="<?= $nama ?> terdaftar sebagai Nasabah Tito Finance">
    <meta property="og:description" content="Kartu Hutang tanpa jaminan, cicilan seingetnya, bebas riba, bebas masalah, tak harap kembali bagai sang mentari menyinari dunia">
    <meta property="og:image" content="https://titofinance.ibnux.com/<?= $path ?>">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://titofinance.ibnux.com/?nama=<?= urlencode($nama) ?>">
    <meta property="twitter:title" content="<?= $nama ?> terdaftar sebagai Nasabah Tito Finance">
    <meta property="twitter:description" content="Kartu Hutang tanpa jaminan, cicilan seingetnya, bebas riba, bebas masalah, tak harap kembali bagai sang mentari menyinari dunia">
    <meta property="twitter:image" content="https://titofinance.ibnux.com/<?= $path ?>">

</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v9.0&appId=123678251107430&autoLogAppEvents=1" nonce="gddqRT0a"></script>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 mt-4">
                <form>
                    <div class="form-row">
                        <div class="col">
                            <label>Nama Anda?</label><br>
                            <input type="text" name="nama" value="<?= $nama ?>" class="form-control" placeholder="Nama">
                        </div>
                        <div class="col-3">
                            &nbsp;<br>
                            <button type="submit" class="btn btn-block btn-primary">Daftar</button>
                        </div>
                    </div>
                </form>
                <input type="text" class="form-control mt-4" readonly onclick="this.select()" value="https://titofinance.ibnux.com/?nama=<?= urlencode($nama) ?>">
                <a class="twitter-share-button" href="https://twitter.com/intent/tweet?url=<?= urlencode("https://titofinance.ibnux.com/?nama=" . $nama) ?>&text=<?= urlencode("saya terdaftar sebagai Nasabah Tito Finance") ?>">Tweet</a>
                <div class="fb-share-button" data-href="https://titofinance.ibnux.com/?nama=<?= urlencode($nama) ?>" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode("https://titofinance.ibnux.com/?nama=" . $nama) ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Bagikan</a></div>
                <br>
                <div class=" mt-4">klik kartu untuk diunduh
                    <a href="img.php?nama=<?= urlencode($nama) ?>&dl"><img src="img.php?nama=<?= urlencode($nama) ?>" class="img-fluid rounded"></a>
                </div><br><br>
                Terdaftar<br>
                <img src="ojk.png" alt="ojk" class="img-fluid">
                <hr>
                <!-- Place this tag where you want the button to render. -->
                <a class="github-button" href="https://github.com/ibnux/TitoFinanceCard" data-icon="octicon-star" data-size="large" aria-label="Star ibnux/TitoFinanceCard on GitHub">Star</a>
            </div>
        </div>
    </div>
    <script>
        window.twttr = (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0],
                t = window.twttr || {};
            if (d.getElementById(id)) return t;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);

            t._e = [];
            t.ready = function(f) {
                t._e.push(f);
            };

            return t;
        }(document, "script", "twitter-wjs"));
    </script>
    <script type='text/javascript' src='//b73uszzq3g9h.com/a2/9e/e5/a29ee57969d0a0b8544467d412f53770.js'></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>