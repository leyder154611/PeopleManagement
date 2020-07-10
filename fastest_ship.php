<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastest Ship</title>
    <!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1 class='mx-auto'>Fastest Ship</h1>
        </div>
        <div class="row p-5 m-5">
            <div class="col-4 offset-4">
                <input type="number" class="form-control" placeholder="Cantidad de Pasajeros"><br>
                <button id='getUser' class="btn btn-success">Buscar</button>
            </div>
            
        </div>
        <div class="row" id='data'>
            
        </div>
    </div>
    
</body>
</html>
<script>
    var html = "";
    $(document).ready(function(){

        $('#getUser').click(function(){
            var cantidad = parseInt($('input.form-control').val());
            html = '';
            $('#data').html('');
            var ship = [];

            for(var i = 1; i<5; i++)
            {
                $.ajax({
                    url: 'http://swapi.dev/api/starships?page='+i,
                    dataType: 'json',
                    success: function(data) {                      
                        
                        var dato = data.results.find(element => element.passengers > cantidad && element.consumables.includes('day') == false);
                        if(dato != undefined)
                        {
                            if(ship.length == 0)
                            {
                                ship.push(dato);
                                html = `<div class="card mx-auto" style="width: 18rem;">
                                        <div class="card-body" style='font-size:11px'>
                                            <p class="card-text"><b class='text-info'>Nombre:</b> `+ship[0].name+`<br/>
                                            <b>Pasajeros:</b> `+ship[0].passengers+`<br/>
                                            <b>Dias:</b> <span class='text-info'>`+ship[0].consumables+`</span><br/>
                                            <b>Modelo:</b> `+ship[0].model+`</p>
                                        </div>
                                    </div>`;
                                $('#data').html(html);
                            }
                                
                        }
                    }
                });       
            }

            

            setTimeout(function(){ if(html == '') $('#data').html('No se encuentra coincidencia'); }, 1500);
        
        });
    });
   
    
</script>
