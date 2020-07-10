<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planet By Terrain</title>
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
            <h1 class='mx-auto'>Planet By Terrain</h1>
        </div>
        <div class="row p-5 m-5">
            <div class="col-6 offset-3">                
                <input type="text" class="form-control" placeholder="Tipo de Terreno"><br>
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
            var tipoTerreno = $('input.form-control').val();
            html = '';
            $('#data').html('');
            var planet = [];

            for(var i = 1; i<7; i++)
            {
                $.ajax({
                    url: 'http://swapi.dev/api/planets?page='+i,
                    dataType: 'json',
                    success: function(data) {                      
                        
                        var dato = data.results.find(element => element.terrain.includes(tipoTerreno) == true);
                        if(dato != undefined)
                        {
                            if(planet.length == 0)
                            {
                                planet.push(dato);
                                html = `<div class="card mx-auto" style="width: 18rem;">
                                        <div class="card-body" style='font-size:11px'>
                                            <p class="card-text"><b class='text-info'>Nombre:</b> `+planet[0].name+`<br/>
                                            <b>Terreno:</b> <span class='text-info'> `+planet[0].terrain+`</span><br/>
                                            <b>Gravedad:</b> `+planet[0].gravity+`<br/>
                                            <b>Población:</b> `+planet[0].population+`</p>
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
