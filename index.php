<?php
// if($_SERVER['SERVER_NAME']!='kartu.tito.finance'){
// 	header("location: https://kartu.tito.finance".$_SERVER['REQUEST_URI']);
// 	die();
// }
$domain = $_SERVER['SERVER_NAME'];
$nama = preg_replace("/[^a-zA-Z0-9 ]+/", "", urldecode($_GET['nama']));
$kartu = preg_replace("/[^a-zA-Z0-9 ]+/", "", urldecode($_GET['kartu']));
$tipe = preg_replace("/[^a-zA-Z0-9 ]+/", "", urldecode($_GET['tipe']));
if (empty($nama)) {
    $nama = "iBNuX";
}
if (strlen($nama) > 24)
    $nama = substr($nama, 0, 24);
$md5 = md5(strtoupper($nama.$kartu.$tipe));
$path = "images/$md5.jpg";

if(!empty($kartu)){
    $kartu = FormatCreditCard($kartu);
}

function FormatCreditCard($cc) {
    // REMOVE EXTRA DATA IF ANY
    $cc = str_replace(array('-', ' '), '', $cc);

    // GET THE CREDIT CARD LENGTH
    $cc_length = strlen($cc);


    $newCreditCard = substr($cc, -4);

    for ($i = $cc_length - 5; $i >= 0; $i--) {
        // ADDS HYPHEN HERE
        if ((($i + 1) - $cc_length) % 4 == 0) {
            $newCreditCard = ' ' . $newCreditCard;
        }
        $newCreditCard = $cc[$i] . $newCreditCard;
    }

    // RETURN THE FINAL FORMATED AND MASKED CREDIT CARD NO
    return $newCreditCard;
}
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
    <meta property="og:url" content="https://<?= $domain ?>/?nama=<?= urlencode($nama) ?>">
    <meta property="og:title" content="<?= $nama ?> terdaftar sebagai Nasabah Tito Finance">
    <meta property="og:description" content="Kartu Hutang tanpa jaminan, cicilan seingetnya, bebas riba, bebas masalah, tak harap kembali bagai sang mentari menyinari dunia">
    <meta property="og:image" content="https://<?= $domain ?>/<?= $path ?>">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://<?= $domain ?>/?nama=<?= urlencode($nama) ?>">
    <meta property="twitter:title" content="<?= $nama ?> terdaftar sebagai Nasabah Tito Finance">
    <meta property="twitter:description" content="Kartu Hutang tanpa jaminan, cicilan seingetnya, bebas riba, bebas masalah, tak harap kembali bagai sang mentari menyinari dunia">
    <meta property="twitter:image" content="https://<?= $domain ?>/<?= $path ?>">

</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v9.0&appId=123678251107430&autoLogAppEvents=1" nonce="gddqRT0a"></script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="https://tito.finance/">Tito Finance Tbk.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="btn btn-outline-success my-2 my-sm-0" href="https://tito.finance/">Kembali</a>
            </form>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 mt-4">
                <form>
                    <label>Nama Anda?</label><br>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="nama" value="<?= $nama ?>" class="form-control" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tipe Kartu</label>
                        <select class="form-control" name="tipe">
                        <option value="1"<?= ($tipe==1)?' selected':'' ?>>Red Diamond</option>
                        <option value="2"<?= ($tipe==2)?' selected':'' ?>>Neo Diamond</option>
                        <option value="3"<?= ($tipe==3)?' selected':'' ?>>Platinum</option>
                        <option value="4"<?= ($tipe==4)?' selected':'' ?>>Plutonium</option>
                        <option value="5"<?= ($tipe==5)?' selected':'' ?>>Uranium</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="kartu" maxlength="19" value="<?= $kartu ?>" class="form-control" placeholder="Opsional Custom Nomor Kartu">
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-block btn-primary">Daftar</button>
                        </div>
                    </div>
                </form>
                <input type="text" class="form-control mt-4" readonly onclick="this.select()" value="https://<?= $domain ?>/?nama=<?= urlencode($nama) ?>">
                <div class=" mt-4">klik kartu untuk diunduh
                    <a href="img.php?nama=<?= urlencode($nama) ?>&kartu=<?= $kartu ?>&tipe=<?= $tipe ?>&dl"><img src="img.php?nama=<?= urlencode($nama) ?>&kartu=<?= $kartu ?>&tipe=<?= $tipe ?>" alt="Tito Kartu" class="img-fluid rounded"></a>
                    <a class="twitter-share-button" href="https://twitter.com/intent/tweet?url=<?= urlencode("https://<?=$domain?>/?nama=" . $nama) ?>&text=<?= urlencode("saya terdaftar sebagai Nasabah Tito Finance") ?>">Tweet</a>
                    <br>
                    <div class="fb-share-button" data-href="https://<?= $domain ?>/?nama=<?= urlencode($nama) ?>" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode("https://<?=$domain?>/?nama=" . $nama) ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Bagikan</a></div>
                </div><br>
            </div>
            </div>
                <script async="async" data-cfasync="false" src="//b73uszzq3g9h.com/f0bac50c5e9823f2123542e412e3d384/invoke.js"></script>
                <div id="container-f0bac50c5e9823f2123542e412e3d384"></div>
        <div class="row">
            <div class="col-sm-6 offset-sm-3 mt-4">
                <br>
                Terdaftar<br>
                <img src="ojk.png" alt="ojk" class="img-fluid">
                <hr>
                <!-- Place this tag where you want the button to render. -->
                <a class="github-button" href="https://github.com/ibnux/TitoFinanceCard" data-icon="octicon-star" data-size="large" aria-label="Star ibnux/TitoFinanceCard on GitHub">Star</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
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
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>