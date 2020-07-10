<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Find</title>
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
            <h1 class='mx-auto'>Fetch Find</h1>
        </div>
        <div class="row p-5 m-5">
            <div class="col-4 offset-4">
                <input type="number" class="form-control"><br>
                <button id='getUser' class="btn btn-success">Buscar mayor a esta edad</button>
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
            const edad = $('input.form-control').val();
            $('#data').html('');
            $.ajax({
                url: 'https://randomuser.me/api/?results=1000&nat=us',
                dataType: 'json',
                success: function(data) {
                    html = '';
                    var personas = [];
                    var persona = [];
                    data.results.forEach(element => 
                    {
                        imagen = element.picture.large;
                        genero = element.gender;
                        nombres_completos = element.name.last+' '+element.name.first;
                        direccion = element.location.state+', '+element.location.city;
                        age = element.dob.age;
                        var object = {"imagen": imagen,"genero": genero,"nombre": nombres_completos,"direccion":direccion,"age":age};
                        personas.push(object);    
                    });
                    persona.push(personas.find(element => element.age > edad));
                    persona.forEach(element => {

                        if(element)
                        {
                            html = `<div class="card mx-auto" style="width: 10rem;">
                                <img src="`+element.imagen+`" class="card-img-top" alt="...">
                                <div class="card-body" style='font-size:11px'>
                                    <p class="card-text"><b class='text-danger'>Edad:</b> `+element.age+`<br/>
                                    <b>Genero:</b> `+element.genero+`<br/>
                                    <b>Nombres:</b> <span class='text-info'>`+element.nombre+`</span><br/>
                                    <b>Dirección:</b> `+element.direccion+`</p>
                                </div>
                            </div>`;
                        }
                       
                    });

                    $('#data').html(html);
                    if(html == '') $('#data').html('no se encuentra con esta Edad');
                }
            });
        
        });
    });
   
    
</script>
