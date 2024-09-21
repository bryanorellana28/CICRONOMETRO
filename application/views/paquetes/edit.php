<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paquete</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Paquete</h1>

        <?php echo validation_errors(); ?>

        <form action="<?php echo site_url('paquetes/update/'.$paquete['id']); ?>" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo set_value('nombre', $paquete['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" class="form-control"><?php echo set_value('descripcion', $paquete['descripcion']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="precio_por_hora">Precio por Hora</label>
                <input type="number" step="0.01" name="precio_por_hora" class="form-control" value="<?php echo set_value('precio_por_hora', $paquete['precio_por_hora']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
