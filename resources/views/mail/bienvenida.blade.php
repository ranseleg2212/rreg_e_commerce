<style type="text/css">
    body,
    html,
    .body {
        background: #f3f3f3 !important;
    }

    .container.header {
        background: #f3f3f3;
    }

    .body-border {
        border-top: 8px solid #663399;
    }
</style>
<!-- move the above styles into your custom stylesheet -->

<spacer size="16"></spacer>

<container class="header">
    <row>
        <columns>
            <center>
                <h1 class="text-center">Bienvenido a Marleny's Home</h1>
            </center>
        </columns>
    </row>
</container>

<container class="body-border">
    <row>
        <columns>

            <spacer size="32"></spacer>

            <center>
                <img src="{{ asset('logomarleny.png') }}" width="200" height="200">
            </center>

            <spacer size="16"></spacer>

            <h4>Hola {{ $data['name'] }}!</h4>
            <p><strong>¡Bienvenido/a!</strong><br>
                Estamos encantados de tenerte como parte de nuestra comunidad. Esperamos que disfrutes de todos los
                beneficios que ofrecemos y que encuentres todo lo que necesitas en nuestra plataforma.<br>
                No dudes en ponerte en contacto con nosotros si necesitas ayuda o si tienes alguna sugerencia para
                mejorar nuestra plataforma. ¡Gracias por unirte a nosotros!
            </p>
            <center>
                <menu>
                    <item><a href="mailto:marlenyshome1@gmail.com">Email</a></item>
                    <item><a href="https://www.instagram.com/marleny_home1/">Instagram</a></item>
                    <item><a href="tel:8297993862">829-799-3862</a></item>
                </menu>
            </center>
        </columns>
    </row>
    <spacer size="16"></spacer>
</container>
