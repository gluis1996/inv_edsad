function generateProfileImage(initial, imgId) {
    // Crear un canvas temporal
    const canvas = document.createElement('canvas');
    canvas.width = 100;
    canvas.height = 100;
    const context = canvas.getContext('2d');

    // Color de fondo
    context.fillStyle = '#3498db';
    context.fillRect(0, 0, canvas.width, canvas.height);

    // Configuración de la letra
    context.fillStyle = '#ffffff';
    context.font = '50px Arial';
    context.textAlign = 'center';
    context.textBaseline = 'middle';

    // Dibujar la letra en el centro del lienzo
    context.fillText(initial, canvas.width / 2, canvas.height / 2);

    // Convertir el canvas a una imagen
    const dataURL = canvas.toDataURL();

    // Insertar la imagen en el HTML
    const imgElement = document.getElementById(imgId);
    imgElement.src = dataURL;
}

// Ejecutar después de que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Obtener la inicial del usuario
    const usuario = $("#usuario_sesion").text();
    const inicial = usuario.charAt(0).toUpperCase();
        
    // Llama a la función con la inicial del usuario y el ID del elemento img
    generateProfileImage(inicial, 'user-image');
});
