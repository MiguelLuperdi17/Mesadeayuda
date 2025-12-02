//ACTUALIZAR FOTO

$(function() {
    var window_focus;
    $(window).focus(function() {
        window_focus = true;
    }).blur(function() {
        window_focus = false;
    });
 
    $( ".archivo" ).bind( "click", function() {
        $(".gif").show();
        var loopFocus = setInterval(function() {
            if (window_focus) {
                clearInterval(loopFocus);
                if ($(".archivo").val() === ''){
                    $(".gif").hide();
                }else{
                    var url = "/foto_perfil";
                    var data = new FormData(document.getElementById("fileinfo"));
                    $.ajax({
                        method: 'POST',
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: data,
                        dataType:'html',
                        enctype: 'multipart/form-data',
                        url: url,
                        success: function (response) {
                            $(".card-img-top").attr("src", response);
                            $('#ajax-alert').addClass('alert-info').show(function(){
                                $(this).html("Actualizado Correctamente");
                            });
                            $(".alerta").fadeTo(2000, 500).slideUp(500, function(){
                                $(".alerta").slideUp(10000);
                            });
                        }
                    });
                    $(".gif").hide();
                }
            }
        }, 500);
    });
});

//ACTUALIZAR DATOS
$('#actualizar_informacion').on('submit', function(e) {
    // evito que propague el submit
    e.preventDefault();
    $(".gif_2").show();
    // agrego la data del form a formData
    var formData = new FormData(this);
    formData.append('_token', $('input[name=_token]').val());
    $.ajax({
        type:'POST',
        url: '/actualizar_datos',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
            $(".gif_2").hide();
            $('#a_name').html(data.name+' '+data.surnames); 
            $('#a_user').html(data.username); 
            $('#a_email').html(data.email); 
            $('#a_movil').html(data.movil); 
            $('#ajax-alert').addClass('alert-info').show(function(){
                $(this).html("Actualizado Correctamente");
            });
            $(".alerta").fadeTo(2000, 500).slideUp(500, function(){
                $(".alerta").slideUp(10000);
            });
        },
        error: function(jqXHR, text, error){
            $(".gif_2").hide();
            $('#ajax-alert').addClass('alert-info').show(function(){
                $(this).html('Ocurrio un error');
            });
            $(".alerta").fadeTo(2000, 500).slideUp(500, function(){
                $(".alerta").slideUp(10000);
            });
        }
    });
});