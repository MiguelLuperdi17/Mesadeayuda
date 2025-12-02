<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->
<script src="{{ asset('/template/vendors/popper/popper.min.js') }}"></script>
<script src="{{ asset('/template/vendors/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('/template/vendors/anchorjs/anchor.min.js') }}"></script>
<script src="{{ asset('/template/vendors/is/is.min.js') }}"></script>
<script src="{{ asset('/template/vendors/fontawesome/all.min.js') }}"></script>
<script src="{{ asset('/template/vendors/lodash/lodash.min.js') }}"></script>
<script src="{{ asset('/template/vendors/list.js/list.min.js') }}"></script>
<script src="{{ asset('/template/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('/template/vendors/dayjs/dayjs.min.js') }}"></script>
<script src="{{ asset('/template/assets/js/phoenix.js') }}"></script>
<!--<script src="{{ asset('/template/echarts/echarts.min.js') }}"></script>-->
<script src="https://cdn.jsdelivr.net/npm/echarts@5.3.3/dist/echarts.min.js"></script>


<script>
    // Muestra el mensaje de la sesión flash en la alerta
    var flashMessage = "{{ Session::get('flash_message') }}";
    var alertClass = "{{ Session::get('alert-class') }}";

    if (flashMessage !== '') {
        var ajaxAlert = document.getElementById('ajax-alert');
        ajaxAlert.innerHTML = flashMessage;
        ajaxAlert.style.display = 'block';
        ajaxAlert.classList.add(alertClass);

        // Oculta la alerta después de 5 segundos
        setTimeout(function() {
            ajaxAlert.style.display = 'none';
        }, 5000);
    }
</script>
<script>
$(function()
{
    $('#cliente').submit(function( event ) {
    /*Previene que el form se envien*/
    //   event.preventDefault();
    /* Muestra el gif*/
    $('.loader').show();
    /* deshabilita el boton para que no se envien muchas peticiones*/
    $('.btn').addClass( 'disabled' );
        });
});
</script>
<script>
$(function()
{
    $('.cliente').submit(function( event ) {
    /*Previene que el form se envien*/
    //   event.preventDefault();
    /* Muestra el gif*/
    $('.loader').show();
    /* deshabilita el boton para que no se envien muchas peticiones*/
    $('.btn').addClass( 'disabled' );
        });
});
</script>
{{-- -------------- Final - cliente --------------------------------- --}}
