
    function registroUsuario()
    {
        // Validamos nombre
        var nombre = $("#regUsuario").val();
        if(nombre != "")
        {
            var expresion = /^[a-zA-ZñÑ ]*$/;
            if(!expresion.test(nombre))
            {
                $("#regUsuario").parent().before('<div class="alert alert-warning"><strong>No se permiten numeros ni caracteres especiales</strong></div>');
                return false;
            }
        }
        else{
            $("#regUsuario").parent().before('<div class="alert alert-warning"><strong>Campo nombre es olbligatorio</strong></div>');
            return false;
        }
        // validamos email
        var email = $("#regEmail").val();
        if(email != "")
        {
            var expresion = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
            if(!expresion.test(email))
            {
                $("#regUsuario").parent().before('<div class="alert alert-warning"><strong>Escriba un email Valido</strong></div>');
                return false;
            }
        }
        else{
            $("#regUsuario").parent().before('<div class="alert alert-warning"><strong>Campo email es olbligatorio</strong></div>');
            return false;
        }

        // validamos contrasena

        var password = $("#regPassword").val();
        if(password != "")
        {
            var expresion = /^[a-zA-Z0-9]*$/
            if(!expresion.test(password))
            {
                $("#regPassword").parent().before('<div class="alert alert-warning"><strong>Escriba una contraseña Valida sin caracteres especiales</strong></div>');
                return false;
            }
        }
        else{
            $("#regUsuario").parent().before('<div class="alert alert-warning"><strong>Campo contraseña es olbligatorio</strong></div>');
            return false;
        }
        
        var politicas = $("#regPoliticas:checked").val();
        // Validar politicas de privacidad

        if(politicas != "on")
        {
            $("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>Debe aceptar los terminos de uso y politicas de privacidad</strong></div>');
            return false;
        }
        return true;
    }




