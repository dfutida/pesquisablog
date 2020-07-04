<?php
    use Sunra\PhpSimple\HtmlDomParser;

    $user = DB::table('users')->where('usuario', 'admin')->first();
    $id = $user->id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Dashboard</h1>
                <a href="/logout" class="btn btn-sm btn-secondary">Sair</a>
                <a href="/lista" class="btn btn-sm btn-secondary">Ver posts gravados</a>
                <form action="/painel" method="GET">
                    {{csrf_field()}}
                    <div class="form-group">
                    <label for="busca">Busca</label>
                    <input type="text" name="s" id="s" class="form-control" placeholder="O que você busca?" required>
                    </div>
                    <button type="submit" class="btn btn-sm btn-secondary">Capturar</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
<?php

    if(!empty($_GET['s'])) {
        $link = "https://uplexis.com.br/category/blog/?s=" . str_replace(' ', '%20', $_GET['s']);
    } else {
        $link = "https://uplexis.com.br/category/blog/";
    }

    $dom = HtmlDomParser::file_get_html( $link );

    $title = array();
    $url = array();
    $res = array();
    $today = date('Y-m-d H:i:s');
    
    foreach($dom->find('div[class=title]') as $v){
        //var_dump($a->attr);
        $title[] = $v->plaintext;
    }
    //print_r($title);

    foreach($dom->find('div[class=col-md-6 d-flex align-items-center justify-content-center] a') as $a){
        //var_dump($a->attr);
        $url[] = $a->href;
    }
    //print_r($url);

    foreach ($dom->find('div[class=wrap-button]') as $element) {
        $links = $element->find('a');
        foreach ($links as $mylink) {
            $res[] = $mylink->href.'<br>';
        }
    }

    $mymerge = array_merge($url, $res);

    $array_final = array_combine($title, $mymerge);
    //print_r($array_final);

    echo "<form action='/painel' method='GET'>";

    for ($i = 0; $i <  count($array_final); $i++) {
        $titulo=key($array_final);
        $url=$array_final[$titulo];
        if ($url<> ' ') {
           echo $titulo."<br><a href=".$url.">".$url."</a><br>";

           DB::table('artigos')->insert([
           'id_usuario' => $id,
           'titulo' => trim( $titulo ),
           'link' => $url,
           'created_at' => $today,
           'updated_at' => $today,
           ]);
        
        }
        next($array_final);
    }
    echo "</form>";
?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>     
</body>
</html>
