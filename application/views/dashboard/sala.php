<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Sala</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #contenedor {
            margin: 10px auto;
            width: 100%;
            max-width: 540px;
        }
        .reloj {
            display: inline-block;
            font-size: 80px;
            font-family: Courier, sans-serif;
            color: #363431;
            width: 100px;
        }
        .disabled {
            pointer-events: none;
            opacity: 0.5;
        }
        @media screen and (max-width: 768px) {
            .reloj {
                font-size: 40px;
                width: 60px;
            }
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h3 class="text-center display-4 mt-4">Sala: <?= $sala['nombre']; ?></h3>
    <form id="formulario">
        <div class="form-group">
            <label for="cliente">Cliente:</label>
            <select id="cliente" class="form-control">
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['id']; ?>"><?= $cliente['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="paquete">Paquete:</label>
            <select id="paquete" class="form-control">
                <?php foreach ($paquetes as $paquete): ?>
                    <option value="<?= $paquete['id']; ?>" data-precio="<?= $paquete['precio_por_hora']; ?>">
                        <?= $paquete['nombre']; ?> (Q<?= $paquete['precio_por_hora']; ?>/hora)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="modo">Modo:</label>
            <select id="modo" class="form-control">
                <option value="cronometro">Cronómetro</option>
                <option value="cuenta_regresiva">Cuenta Regresiva</option>
            </select>
        </div>
        <div id="tiempo-group" class="form-group" style="display: none;">
            <label for="tiempo">Tiempo (en minutos):</label>
            <input type="number" id="tiempo" class="form-control" min="1">
        </div>
    </form>

    <div id="contenedor" class="text-center">
        <div class="reloj" id="Horas">00</div>
        <div class="reloj">:</div>
        <div class="reloj" id="Minutos">00</div>
        <div class="reloj">:</div>
        <div class="reloj" id="Segundos">00</div>
        <br>
        <input type="button" class="btn btn-success" id="inicio" value="Iniciar" onclick="inicio();">
        <input type="button" class="btn btn-danger" id="parar" value="Detener" onclick="parar();" disabled>
        <input type="button" class="btn btn-warning" id="continuar" value="Reanudar" onclick="continuar();" disabled>
        <input type="button" class="btn btn-secondary" id="reinicio" value="Reiniciar" onclick="reinicio();" disabled>
        <input type="button" class="btn btn-info" id="liberar" value="Liberar Sala" onclick="liberarSala();">
    </div>

    <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-secondary mt-3">Regresar</a></div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
let control;
let segundos = 0;
let minutos = 0;
let horas = 0;
let tiempoRestante = 0;
let modoSeleccionado;

document.getElementById("modo").addEventListener("change", function() {
    const modo = this.value;
    document.getElementById("tiempo-group").style.display = (modo === "cuenta_regresiva") ? "block" : "none";
    reinicio();
});

document.addEventListener("DOMContentLoaded", function() {
    const salaId = "<?= $sala['id']; ?>";
    const estadoGuardado = JSON.parse(localStorage.getItem("estado_sala_" + salaId));

    if (estadoGuardado) {
        segundos = estadoGuardado.segundos || 0;
        minutos = estadoGuardado.minutos || 0;
        horas = estadoGuardado.horas || 0;
        tiempoRestante = estadoGuardado.tiempoRestante || 0;

        if (estadoGuardado.estado === "iniciado") {
            const tiempoTranscurrido = Math.floor((Date.now() - estadoGuardado.ultimaActualizacion) / 1000);
            if (estadoGuardado.modo === "cuenta_regresiva") {
                tiempoRestante = Math.max(0, tiempoRestante - tiempoTranscurrido);
                if (tiempoRestante <= 0) {
                    clearInterval(control);
                    Swal.fire({
                        title: 'Tiempo agotado',
                        text: 'El tiempo de la cuenta regresiva ha terminado.',
                        icon: 'info',
                        confirmButtonText: 'Aceptar'
                    });
                    desbloquearFormulario();
                    return; // No iniciar si el tiempo ya ha terminado
                }
            } else {
                segundos += tiempoTranscurrido;
                while (segundos >= 60) {
                    segundos -= 60;
                    minutos++;
                }
                while (minutos >= 60) {
                    minutos -= 60;
                    horas++;
                }
            }
        }

        document.getElementById("modo").value = estadoGuardado.modo;
        document.getElementById("tiempo").value = Math.floor(tiempoRestante / 60);

        document.getElementById("Segundos").innerHTML = (segundos < 10 ? "0" : "") + segundos;
        document.getElementById("Minutos").innerHTML = (minutos < 10 ? "0" : "") + minutos;
        document.getElementById("Horas").innerHTML = (horas < 10 ? "0" : "") + horas;

        if (estadoGuardado.estado === "iniciado") {
            control = setInterval(estadoGuardado.modo === "cronometro" ? cronometro : cuentaRegresiva, 1000);
            bloquearFormulario();
        }
    }
});

function guardarEstadoSala(estado) {
    const salaId = "<?= $sala['id']; ?>";
    const estadoActual = {
        estado: estado,
        segundos: segundos,
        minutos: minutos,
        horas: horas,
        tiempoRestante: tiempoRestante,
        modo: document.getElementById("modo").value,
        ultimaActualizacion: Date.now()
    };
    localStorage.setItem("estado_sala_" + salaId, JSON.stringify(estadoActual));
}

function bloquearFormulario() {
    document.getElementById("formulario").classList.add("disabled");
    document.getElementById("inicio").disabled = true;
    document.getElementById("liberar").disabled = false;
    document.getElementById("parar").disabled = false;
    document.getElementById("reinicio").disabled = false;
    document.getElementById("continuar").disabled = false;
}

function desbloquearFormulario() {
    document.getElementById("formulario").classList.remove("disabled");
    document.getElementById("inicio").disabled = false;
    document.getElementById("liberar").disabled = true;
}

function liberarSala() {
    const salaId = "<?= $sala['id']; ?>";
    const paqueteSeleccionado = document.getElementById("paquete").selectedOptions[0];
    const precioPorHora = parseFloat(paqueteSeleccionado.getAttribute("data-precio"));
    let tiempoTotalEnHoras;

    const modoSeleccionado = document.getElementById("modo").value;

    if (modoSeleccionado === "cuenta_regresiva") {
        const minutosPantalla = parseInt(document.getElementById("Minutos").textContent, 10);
        const segundosPantalla = parseInt(document.getElementById("Segundos").textContent, 10);
        const tiempoTotalEnSegundos = (minutosPantalla * 60) + segundosPantalla;
        tiempoTotalEnHoras = (document.getElementById("tiempo").value * 60 - tiempoTotalEnSegundos) / 3600;
    } else if (modoSeleccionado === "cronometro") {
        const horasPantalla = parseInt(document.getElementById("Horas").textContent, 10);
        const minutosPantalla = parseInt(document.getElementById("Minutos").textContent, 10);
        const segundosPantalla = parseInt(document.getElementById("Segundos").textContent, 10);
        const tiempoTotalEnSegundos = (horasPantalla * 3600) + (minutosPantalla * 60) + segundosPantalla;
        tiempoTotalEnHoras = tiempoTotalEnSegundos / 3600;
    }

    const costoTotal = precioPorHora * tiempoTotalEnHoras;

    Swal.fire({
        title: 'Resumen',
        text: `El costo total es: $${costoTotal.toFixed(2)}`,
        icon: 'info',
        confirmButtonText: 'Aceptar'
    });

    // Limpiar el estado en localStorage
    localStorage.removeItem("estado_sala_" + salaId);
    reinicio();
}

function cronometro() {
    segundos++;
    while (segundos >= 60) {
        segundos -= 60;
        minutos++;
    }
    while (minutos >= 60) {
        minutos -= 60;
        horas++;
    }

    document.getElementById("Segundos").innerHTML = (segundos < 10 ? "0" : "") + segundos;
    document.getElementById("Minutos").innerHTML = (minutos < 10 ? "0" : "") + minutos;
    document.getElementById("Horas").innerHTML = (horas < 10 ? "0" : "") + horas;

    guardarEstadoSala("iniciado");
}

function cuentaRegresiva() {
    if (tiempoRestante <= 0) {
        clearInterval(control);
        Swal.fire({
            title: 'Tiempo agotado',
            text: 'El tiempo de la cuenta regresiva ha terminado.',
            icon: 'info',
            confirmButtonText: 'Aceptar'
        });
        desbloquearFormulario();
        return;
    }

    tiempoRestante--;
    const horasRestantes = Math.floor(tiempoRestante / 3600);
    const minutosRestantes = Math.floor((tiempoRestante % 3600) / 60);
    const segundosRestantes = tiempoRestante % 60;

    document.getElementById("Segundos").innerHTML = (segundosRestantes < 10 ? "0" : "") + segundosRestantes;
    document.getElementById("Minutos").innerHTML = (minutosRestantes < 10 ? "0" : "") + minutosRestantes;
    document.getElementById("Horas").innerHTML = (horasRestantes < 10 ? "0" : "") + horasRestantes;

    guardarEstadoSala("iniciado");
}

function inicio() {
    modoSeleccionado = document.getElementById("modo").value;
    if (modoSeleccionado === "cuenta_regresiva") {
        const tiempoIngresado = parseInt(document.getElementById("tiempo").value, 10);
        if (isNaN(tiempoIngresado) || tiempoIngresado <= 0) {
            Swal.fire({
                title: 'Error',
                text: 'Por favor, ingresa un tiempo válido.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            return;
        }
        tiempoRestante = tiempoIngresado * 60;
        control = setInterval(cuentaRegresiva, 1000);
    } else {
        control = setInterval(cronometro, 1000);
        tiempoInicial = Date.now();
    }
    guardarEstadoSala("iniciado");
    bloquearFormulario();
}

function parar() {
    clearInterval(control);
    guardarEstadoSala("detenido");
}

function continuar() {
    const estadoGuardado = JSON.parse(localStorage.getItem("estado_sala_" + "<?= $sala['id']; ?>"));
    if (estadoGuardado) {
        if (estadoGuardado.modo === "cronometro") {
            control = setInterval(cronometro, 1000);
        } else {
            control = setInterval(cuentaRegresiva, 1000);
        }
        guardarEstadoSala("iniciado");
    }
}

function reinicio() {
    clearInterval(control);
    segundos = 0;
    minutos = 0;
    horas = 0;
    tiempoRestante = 0;
    document.getElementById("Segundos").innerHTML = "00";
    document.getElementById("Minutos").innerHTML = "00";
    document.getElementById("Horas").innerHTML = "00";
    desbloquearFormulario();
}

</script>
</body>
</html>
