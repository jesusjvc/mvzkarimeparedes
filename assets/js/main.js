ScrollReveal({ reset: false });

// Configuración para el resto del contenido
// --------------------------------------------
var headers = {
    duration: 2000,
    origin: "top",
    distance: "400px",
    easing: "cubic-bezier(0.5, 0, 0, 1)",
    rotate: {
      x: 20,
      z: -10
    }
	/*delay: 75,
	duration: 1000,
	opacity: 0,
	distance: "50%",
	origin: "bottom",
	easing: "ease-in-out"*/
}

var parrafos = {
    delay: 75,
	duration: 1500,
	opacity: 0,
	distance: "50%",
	origin: "top",
	reset: true
}

var imagen = {
    origin: "bottom",
    distance: "20px",
    duration: 1000,
    delay: 650,
    scale: 1,
}
var enlaces = {
    origin: "bottom",
    distance: "20px",
    duration: 700,
    delay: 550,
    scale: 0,
}


// Generales

ScrollReveal().reveal('h2', headers);
ScrollReveal().reveal('section h3', headers);
ScrollReveal().reveal('section .box', parrafos);

ScrollReveal().reveal('section iframe', headers);

//sr.reveal('section p', parrafos);
ScrollReveal().reveal('section picture', imagen);
ScrollReveal().reveal('section source', imagen);
ScrollReveal().reveal('section img', imagen);

//ScrollReveal().reveal('section a', enlaces);
ScrollReveal().reveal('section div', enlaces);
ScrollReveal().reveal('section td', enlaces);
ScrollReveal().reveal('section li', parrafos);