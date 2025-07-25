// Objetos personalizados
class Proyecto {
    constructor(nombre, descripcion) {
        this.nombre = nombre;
        this.descripcion = descripcion;
    }

    render() {
        return `
            <div class="card mb-2">
                <div class="card-body">
                    <strong>${this.nombre}</strong><br>${this.descripcion}
                </div>
            </div>
        `;
    }
}

class Evento {
    constructor(nombre, fecha) {
        this.nombre = nombre;
        this.fecha = fecha;
    }

    render() {
        return `
            <div class="card mb-2">
                <div class="card-body">
                    <strong>${this.nombre}</strong><br>${this.fecha}
                </div>
            </div>
        `;
    }
}

class Donacion {
    constructor(monto) {
        this.monto = monto;
    }

    static total = 0;

    static agregarDonacion(monto) {
        Donacion.total += monto;
        document.getElementById("donation-total").textContent = `$${Donacion.total}`;
        mostrarNotificacion(`¡Gracias por donar $${monto}!`, "info");
    }
}

// Mostrar proyectos al cargar
function mostrarProyectos() {
    const contenedor = document.getElementById("projects-container");
    proyectos.forEach(p => {
        contenedor.innerHTML += p.render();
    });
}

mostrarProyectos();

// Filtrar eventos
function search() {
    const query = document.getElementById("events").value.toLowerCase();
    const resultados = eventos.filter(e => e.nombre.toLowerCase().includes(query));
    const container = document.getElementById("results-container");
    container.innerHTML = resultados.length
        ? resultados.map(e => e.render()).join("")
        : '<div class="alert alert-warning">No se encontraron eventos.</div>';
}

// Donar dinero
function donate() {
    const input = document.getElementById("donation-amount");
    const monto = parseFloat(input.value);
    if (isNaN(monto) || monto <= 0) {
        alert("Por favor, ingrese un monto válido.");
        return;
    }
    Donacion.agregarDonacion(monto);
    input.value = "";
}

// Mostrar notificaciones tipo Bootstrap
function mostrarNotificacion(mensaje, tipo = "info") {
    const lista = document.getElementById("notifications-list");
    const alertDiv = document.createElement("div");
    alertDiv.className = `alert alert-${tipo}`;
    alertDiv.textContent = mensaje;
    lista.appendChild(alertDiv);
}

// Simular notificaciones automáticas
setTimeout(() => {
    mostrarNotificacion("¡Nuevo logro desbloqueado: 1000 beneficiarios!", "success");
}, 5000);

setTimeout(() => {
    mostrarNotificacion("¡Campaña de invierno lanzada!", "warning");
}, 10000);
