<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <title>JSP Page</title>
    </head>
    <body>
        <div class="container">
            <h1>Usuarios</h1>  
            <a class="btn btn-success" href="Controlador?accion=add"> Agregar Nuevo </a>
            <br>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">N°ID</th>
                        <th class="text-center">Tipo ID</th>
                        <th class="text-center">Nombres</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Celular</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <td class="text-center"><%= per.getNroID() %></td>
                        <td class="text-center"><%= per.getTipoID()%></td>
                        <td class="text-center"><%= per.getNombres()%></td>
                        <td class="text-center"><%= per.getCorreo()%></td>
                        <td class="text-center"><%= per.getCelular()%></td>
                        <td>
                            <a class="btn btn-warning" href="Controlador?accion=editar&nroID=<%= per.getNroID() %>"> Editar</a>
                            
                            <a class="btn btn-danger" href="Controlador?accion=eliminar&nroID=<%= per.getNroID() %>">Remove</a>
                        </td>
                    </tr>
                    <%}%>
                </tbody>
            </table>

        </div>
    </body>
</html>