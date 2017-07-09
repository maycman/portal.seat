$(document).ready(function ()
{
    //Implementación de juego de clases
    var pag = location.href.substring(location.href.lastIndexOf('=')+1,location.href.lastIndexOf(''));
    if (pag=='http://localhost/portalseat/')
    {
        $("#home").attr("class", "active");
    }
    else if (pag=='loginCitas')
    {
        $("#citas").attr("class", "active");
    }
    else
    {
        $("#"+pag).attr("class", "active");
    }


    //  Ajax Login
    $('#enviar').click(function(){
        var user = $("#nick").val();
        var password = $("#passwd").val();
        if ($.trim(user).length>0 && $.trim(password).length>0)
        {
            $.ajax({
                url: "loginCitas.php",
                method: "POST",
                data: {nick:user, passwd:password},
                cache: false,
                beforeSend:function(){
                    $("#enviar").html("<span class='glyphicon glyphicon-refresh'></span> Cargando...");
                },
                success:function(data){
                    if (data==1)
                    {
                        $("#enviar").html("<span class='glyphicon glyphicon-ok'></span> Listo");
                        $(location).attr("href","index.php?p=citas");
                    }
                    else
                    {
                        $("#result").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Contraseña y/o Usuario Incorrecto, Intenta otra vez</div>');
                        $("#enviar").html("<span class='glyphicon glyphicon-open'></span> Entrar");
                        $('#logi')[0].reset();
                    }
                }
            });
        }
        else
        {
            $("#result").html('<div class="alert alert-dismissible alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>No ha ingresado ningún valor</strong></div>');
        }
    });
    $('#dates').datetimepicker({
        format: 'L'
    });  
    $('#time').datetimepicker({
        format: 'LT'
    });
    //$('#telefonoCL');
    //countdown("contador");
});
/*function countdown(id)
   {
        var fecha=new Date('2016','10','23','11','27','00')
        var hoy=new Date()
        var dias=0
        var horas=0
        var minutos=0
        var segundos=0
        if (fecha>hoy)
        {
            var diferencia=(fecha.getTime()-hoy.getTime())/1000
            dias=Math.floor(diferencia/86400)
            diferencia=diferencia-(86400*dias)
            horas=Math.floor(diferencia/3600)
            diferencia=diferencia-(3600*horas)
            minutos=Math.floor(diferencia/60)
            diferencia=diferencia-(60*minutos)
            segundos=Math.floor(diferencia)
            document.getElementById(id).innerHTML='Quedan ' + horas + ' Horas, ' + minutos + ' Minutos, ' + segundos + ' Segundos';
            if (dias>0 || horas>0 || minutos>0 || segundos>0)
            {
                setTimeout("countdown(\"" + id + "\")",1000);
            }
            else
            {
            	alert("Aqui hace algo");
            }
        }
        else
        {
            document.getElementById('restante').innerHTML='Quedan ' + dias + ' D&iacute;as, ' + horas + ' Horas, ' + minutos + ' Minutos, ' + segundos + ' Segundos';
        }
    }*/
function format(input)
{
    var num = input.value.replace(/\./g,'');
    if(!isNaN(num))
    {
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        input.value = num;
    }
    else
    {
        alert('Solo se permiten numeros');
        input.value = input.value.replace(/[^\d\.]*/g,'');
    }
}