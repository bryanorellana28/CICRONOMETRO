<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Paquete</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php $this->load->view('templates/sidebar'); ?>
    <div class="container">
        <h1 class="mt-5">Crear Paquete</h1>
        <?php echo validation_errors(); ?>
        <form action="<?php echo site_url('paquetes/store'); ?>" method="post">
            <div class="form-group">
                <label for="nombre">Nombre del Paquete</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
            </div>
            <div class="form-group">
                <label for="precio_por_hora">Precio por Hora</label>
                <input type="number" step="0.01" class="form-control" id="precio_por_hora" name="precio_por_hora" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Paquete</button>
        </form>
    </div>
</body>
</html>
