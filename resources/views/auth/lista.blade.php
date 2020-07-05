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
                <p>
                <a href="/logout" class="btn btn-sm btn-secondary">Sair</a>
                <a href="/painel?s=carrro" class="btn btn-sm btn-secondary">Voltar para busca</a>
                </p>
            </div>
        </div>
    <table border="1" cellspacing="5px" cellpadding="5px">
    <tr>
    <td>ID</td>
    <td>Título</td>
    <td>URL</td>
    <td>Ação</td>
    </tr>
<?php
    $sql = DB::table('artigos')
    ->select('id', 'titulo', 'link')
    ->orderBy('titulo', 'ASC')
    ->get();

    foreach ($sql as $lista) {
        $id = $lista->id;
        $titulo = $lista->titulo;
        $link = $lista->link;
            
            echo "<tr>";
            print_r("<td>".$id."</td>");
            print_r("<td>".$titulo."</td>");
            print_r("<td><a href='".$link."' target='_blank'>".$link."</a></td>");
            echo "<td><a href='/delete/$id' class='btn btn-sm btn-secondary'>DELETE</a></td>";
            echo "</tr>";
    }
        
?>
    </table>

    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>     
</body>
</html>
