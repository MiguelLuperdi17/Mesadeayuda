
//ACTUALIZAR CONTRASEÑA
$('#actualizar_informacion').on('submit', function(e) {
    // evito que propague el submit
    e.preventDefault();
    $(".gif_2").show();
    // agrego la data del form a formData
    var formData = new FormData(this);
    formData.append('_token', $('input[name=_token]').val());
    $.ajax({
        type:'POST',
        url: '/actualizar_password',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
            if(data.code === 200) {
                $('#ajax-alert').addClass('alert-info').show(function(){
                    $(this).html(data.success);
                });
                $(".alerta").fadeTo(2000, 500).slideUp(500, function(){
                    $(".alerta").slideUp(10000);
                });
            }
            $(".gif_2").hide();
        },
        error: function(jqXHR, text, error){
            $('#ajax-alert').addClass('alert-info').show(function(){
                $(this).html('Las contraseñas no coinciden');
            });
            $(".alerta").fadeTo(2000, 500).slideUp(500, function(){
                $(".alerta").slideUp(10000);
            });
            $(".gif_2").hide();
        }
    });
});
