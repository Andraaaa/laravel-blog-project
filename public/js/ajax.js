$(document).ready(function(){
    $.ajax({
        type: 'GET',
        url: baseUrl + 'ajax/nesto',
        success: function(data, xhr){
            console.log(data);

            console.log(xhr);
            showAnketa(data);
        } ,
        error: function(xhr, status, error){
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
    $('body').on('click', '.showResult', function(){
        $.ajax({
            type: 'GET',
            url: baseUrl + '/ajax/rezultat',
            success: function(data, xhr){
                console.log(data);
                console.log(xhr);
                $('#result').html(data);
            },
            error: function(xhr, status, error){
                console.log(xhr);
                console.log(status);
                console.log(error);

            }
        });
    });
    function showAnketa(data){
        var anketaHtml =
            "<h2 class='card-title'>Glasanje</h2><p class='card-text'>Najbolja liga na svetu:</p>"+
            "<form name='glasanje' method='POST' action='"+baseUrl+"ajax/anketa/glas'>";


        $.each(data, function(key, value){
            anketaHtml +=
                '<p><input type="radio" value='+value.id_anketa+' name="anketa"/>&nbsp&nbsp'+value.naziv+'<br/></p>';

        },
        anketaHtml+='<button type="submit" class="btn btn-success showResult" >Glasaj</button></form>'

    );
        $('#anketa').html(anketaHtml);
    }
    
