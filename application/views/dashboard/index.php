<!-- Contenedor principal con Flexbox -->
<div class="d-flex justify-content-around mt-5">
    <!-- Widget de clima -->
    <div class="card text-center" style="max-width: 300px;">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Clima en <?php echo isset($clima['name']) ? htmlspecialchars($clima['name']) : 'Guatemala'; ?></h5>
        </div>
        <div class="card-body">
            <?php if ($clima): ?>
                <h4 class="display-5">
                    <?php echo round($clima['main']['temp'] - 273.15, 2); ?> °C
                </h4>
                <p class="lead mb-1"><?php echo htmlspecialchars($clima['weather'][0]['description']); ?></p>
                <p class="mb-1"><strong>Humedad:</strong> <?php echo $clima['main']['humidity']; ?>%</p>
                <p class="mb-1"><strong>Viento:</strong> <?php echo $clima['wind']['speed']; ?> m/s</p>
                <img src="http://openweathermap.org/img/wn/<?php echo $clima['weather'][0]['icon']; ?>@2x.png" alt="Clima" class="img-fluid" style="max-width: 50px;" />
            <?php else: ?>
                <p class="text-danger">No se pudo obtener información del clima.</p>
            <?php endif; ?>
        </div>
        <div class="card-footer text-muted">
            Actualizado: <?php echo date('H:i:s', $clima['dt']); ?>
        </div>
    </div>

    <!-- Sección de Salas -->
    <div class="container">
        <img src="https://pbs.twimg.com/profile_images/1572276450384031744/BgupiF9y_400x400.jpg" alt="Logo" class="img-fluid mb-4 mx-auto d-block" style="max-width: 200px;">
        <h1 class="text-center mb-4">Salas</h1>
        
        <div class="card mb-4">
            <div class="card-body">
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
                                            <a href="<?php echo site_url('dashboard/sala/' . $sala['id']); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Ingresar a la sala">
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
        </div>
    </div>
</div>
