<html  dir="ltr" lang="es" xml:lang="es">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo "<title>".$pagina."</title>";
    ?> 
	<!-- Bootstrap -->
	<link href="bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="https://fontawesome.com/v3.2.1/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
            
 
	<style>
		.content {
			margin-top: 80px;
		}

		html,body{
            height: 100%;
            width: 100%;
        }

        .background-image {
            background-image: url(imagenes/balloon_sky_clouds_flight_91317_1280x720.jpg) ;
            display: block;
            height: 100%;
            width: 100%;
            left: 0;
            position: fixed;
            right: 0;
            z-index: 1;
        }

        label {
            margin-bottom: 0.1em;
            margin-top: 0.1em;
        }
        .container { margin: 50px auto; }
    
        
 	</style>
    <script type="text/javascript">
        let form = new Validation("registrocliente");
        // Validation Functions
        form.requireText("nombre", 5, 20, [" "], []);
        form.requireEmail("email", 4, 30, [" "], []);
    </script>
 
</head>