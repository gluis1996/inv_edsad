$(document).ready(function () {

    llenado_ticket_total();
    llenado_equipo_sede_total();

    function llenado_equipo_sede_total() {
        const data = {
            dash_total_equipo_sede: 'dash_total_equipo_sede',
        }

        $.post("Assets/ajax/Ajax.DashBoard.php", data,
            function (response) {
                console.log(response);


                // Selecciona el contenedor donde deseas insertar los elementos
                const container = document.querySelector('.contenedor_totales');

                // Limpia el contenido anterior
                container.innerHTML = '';

                // Asegurarse de que la respuesta es un objeto JSON
                const jsonData = JSON.parse(response);

                // Definir los colores
                const colors = ['bg-danger', 'bg-warning', 'bg-info', 'bg-success'];

                // Iterar sobre el array "data"
                jsonData.data.forEach((item, index) => {
                    const div = document.createElement('div');
                    div.className = 'col-md-3 col-sm-6 col-12';

                    // Asignar un color basado en el índice
                    const colorClass = colors[index % colors.length];

                    div.innerHTML = `
                <div class="info-box">
                    <span class="info-box-icon ${colorClass}"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">${item.nombres}</span>
                        <span class="info-box-number">${item.cantidad_equipos}</span>
                    </div>
                </div>
            `;

                    container.appendChild(div);
                });

            }
        );
    }



    function llenado_ticket_total() {
        const data = {
            dash_total_ticket: 'dash_total_ticket',
        }

        $.post("Assets/ajax/Ajax.DashBoard.php", data,
            function (response) {
                // console.log(response);
                var j = JSON.parse(response);
                let i = 0;

                while (i < j.data.length) {
                    const item = j.data[i];
                    if (item.status == 'Total') {
                        $("#ticket_total").text(item.cantidad);
                    } else if (item.status === 'abierto') {
                        $("#ticket_abiertos").text(item.cantidad);
                    } else if (item.status === 'en proceso') {
                        $("#ticket_en_proceso").text(item.cantidad);
                    } else if (item.status === 'cerrado') {
                        $("#ticket_cerrado").text(item.cantidad);
                    }
                    i++;
                }
            }
        );
    }


    

});
