<div class="container mt-5">
    <img src="https://pbs.twimg.com/profile_images/1572276450384031744/BgupiF9y_400x400.jpg" alt="Logo" class="img-fluid mb-4 mx-auto d-block" style="max-width: 200px;">
    <h1 class="text-center mb-4">Salas</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($salas)): ?>
                    <tr>
                        <td colspan="2" class="text-center">No hay salas disponibles.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($salas as $sala): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($sala['nombre']); ?></td>
                            <td>
                                <a href="<?php echo site_url('dashboard/sala/' . $sala['id']); ?>" class="btn btn-primary" data-toggle="tooltip" title="Ingresar a la sala">
                                    <i class="fas fa-sign-in-alt"></i> Ingreso
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Enlace a Bootstrap y Font Awesome -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Scripts para Tooltip -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
