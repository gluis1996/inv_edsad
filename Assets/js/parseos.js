// Enlaza la función convertirAMayusculas al evento oninput del campo de texto
document.getElementById('Mac').oninput = function() {
  // Convierte el valor a mayúsculas
  this.value = this.value.replace(/\s/g, '').toUpperCase();
};
document.getElementById('Caja').oninput = function() {
  // Convierte el valor a mayúsculas
  this.value = this.value.replace(/\s/g, '').toUpperCase();
  
};

document.getElementById('Borne').oninput = function() {
  // Convierte el valor a mayúsculas
  this.value = this.value.replace(/\s/g, '').toUpperCase();
};

document.getElementById('Precinto').oninput = function() {
  // Convierte el valor a mayúsculas
  this.value = this.value.replace(/\s/g, '').toUpperCase();
};

document.getElementById('os').oninput = function() {
  // Convierte el valor a mayúsculas
  this.value = this.value.replace(/\s/g, '').toUpperCase();
};
document.getElementById('codAbonado').oninput = function() {
  // Convierte el valor a mayúsculas
  this.value = this.value.replace(/\s/g, '').toUpperCase();
};
document.getElementById('codAcceso').oninput = function() {
  // Convierte el valor a mayúsculas
  this.value = this.value.replace(/\s/g, '').toUpperCase();
};
