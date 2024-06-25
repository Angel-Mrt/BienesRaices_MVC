document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkMode();
});

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    //console.log(prefiereDarkMode.matches)

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function () {
    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');

        //Para que el modo elegido se quede guardado en local-storage
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('modo-oscuro','true');
        } else {
            localStorage.setItem('modo-oscuro','false');
        }
        
    });

    //Obtenemos el modo del color actual
    if (localStorage.getItem('modo-oscuro') === 'true') {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name = "contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
    
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    
    navegacion.classList.toggle('mostrar');
    
    // if (navegacion.classList.contains('mostrar')) {
    //     navegacion.classList.remove('mostrar');
    // } else {
    //     navegacion.classList.add('mostrar');
    // }
}
function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');
    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = ` 
            <br>
            <input id="telefono" type="tel" placeholder="Tu telefono" name="contacto[telefono]" required>

            <p> Elija la fecha y la hora para la llamada </p>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]" required>

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]" required>

        `;
    } else {
        contactoDiv.innerHTML = `
            <br>
            <input id="email" type="text" placeholder="Tu email" name="contacto[email]" required>
        `;
    }

    //contactoDiv.textContent = 'Diste CLick';
}

function visualizarImagen(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function() {
        var preview = document.getElementById('previewImagen');
        var imagenExistente = document.getElementById('imagen_existente');
        
        if (imagenExistente) {
            imagenExistente.style.display = 'none'; // Ocultar la imagen existente si existe
        }

        if (!preview.querySelector('img')) {
            // Si no hay una imagen de previsualización, la creamos
            var img = document.createElement('img');
            img.className = 'imagen-small';
            preview.appendChild(img);
        }

        preview.querySelector('img').src = reader.result;
    }

    reader.readAsDataURL(input.files[0]);
}

