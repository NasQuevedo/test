jQuery("document").ready(function() {
    read();
});

/** var errors
 * 
 * Almacena en un arreglo los errores de cada campo
 */
var errors = [
    'El campo Nombres es requerido',
    'El campo Apellidos es requerido',
    'El campo Edad es requerido',
    'el campo Fecha de Ingreso es requerido',
];

const message = jQuery('#message');

/**
 * funcion send
 * 
 * Valida si el usuario esta creando o editando para enviar al controlador correspondiente
 * 
 * @returns 
 */
const send = () => {
    const userId = document.getElementById('user-id').value;

    const inputs = document.getElementsByClassName('input');
    let validated = validate(inputs);  

    if (validated) {
        if (userId !== '') {
            update(userId, inputs);
            return true;
        }

        create(inputs);
        return true;
    }

    return false;
}


/**
 * funcion clean
 * 
 * Limpia el formulario
 */
const clean = () => {
    jQuery("#user-id").val("");
    jQuery("#name").val("");
    jQuery("#last-name").val("");
    jQuery("#age").val("");
    jQuery("#start-date").val("");
    jQuery("#comment").val("");
}

/**
 * funcion create
 * 
 * Envia la informacion al controlador create para inserta un nuevo empleado
 * 
 * @param {*} inputs 
 * @returns 
 */
const create = (inputs) => {
    const name = inputs[0].value;
    const lastName = inputs[1].value;
    const age = inputs[2].value;
    const startDate = inputs[3].value;
    const comments = inputs[4].value;

    jQuery.ajax({
        url: './controller/create.php',
        method: 'POST',
        type: 'json',
        dataType: 'json',
        data: {
            action: "create",
            name,
            lastName,
            age,
            startDate,
            comments
        },
        success: (response) => {
            if (response.code === 200) {
                message.html(response.message);
                message.addClass('success');
                read();
            } else {
                message.html(response.message);
                message.addClass('error');
            }
        }
    });

    return true;
    
}

/**
 * funcion validate
 * 
 * Valida cada uno de los campos del formulario para verificar que el usuario los haya diligenciado
 * 
 * @param {*} inputs 
 * @returns 
 */
const validate = (inputs) => {
    for (let i=0; i<inputs.length; i++) {
        if (inputs[i].value === '' && inputs[i].name !== 'comment') {
            message.html(errors[i]);
            message.addClass('error');
            return false;
        }
    }

    return true;
}

/**
 * funcion read
 * 
 * Obtiene la información de todos los empleados por medio del controlador read
 */
const read = () => {
    jQuery.ajax({
        url: "./controller/read.php",
        method: "GET",
        type: "json",
        dataType: "json",
        data: {
            action: "read_all"
        },
        success: response => {
            if (response.code === 200) {
                const tbody = jQuery("#table-content");
                let html = '';
                response.records.forEach(item => {
                    html += "<tr>";
                    html += "<td>" + item.id + "</td>";
                    html += "<td>" + item.nombres + "</td>"; 
                    html += "<td>" + item.apellidos + "</td>";
                    html += "<td>" + item.edad + "</td>";
                    html += "<td>" + item.fecha_ingreso + "</td>";
                    html += "<td>" + item.comentarios + "</td>";
                    html += "<td><i class='bi bi-pencil-square' onclick='readById("+ item.id +")'></i></td>";
                    html += "<td><i class='bi bi-trash3' onclick='del(" + item.id + ")'></i></td>";
                    html += "<tr>";
                });

                tbody.html(html);
            }
        }
    });
}

/**
 * funcion readById
 * 
 * Obtiene la información del empleado por medio de su id a travez del controlador read_by_id
 *
 *  @param {*} id 
 */
const readById = (id) => {
    jQuery.ajax({
        url: "./controller/read_by_id.php",
        method: "GET",
        type: "json",
        dataType: "json",
        data: {
            action: "read_by_id",
            id
        },
        success: response => {
            console.log(response);
            if (response.code === 200) {
                jQuery("#user-id").val(response.record.id);
                jQuery("#name").val(response.record.nombres);
                jQuery("#last-name").val(response.record.apellidos);
                jQuery("#age").val(response.record.edad);
                jQuery("#start-date").val(response.record.fecha_ingreso);
                jQuery("#comment").val(response.record.comentarios);
            }
        }
    });
}

/**
 * funcion update
 * 
 * Envia la informacion del empleado junto con su id al controlador update para actualizar
 * 
 * @param {*} id 
 * @param {*} inputs 
 * @returns 
 */
const update = (id, inputs) => {
    const name = inputs[0].value;
    const lastName = inputs[1].value;
    const age = inputs[2].value;
    const startDate = inputs[3].value;
    const comments = inputs[4].value;

    jQuery.ajax({
        url: './controller/update.php',
        method: 'POST',
        type: 'json',
        dataType: 'json',
        data: {
            action: "update",
            id,
            name,
            lastName,
            age,
            startDate,
            comments
        },
        success: (response) => {
            if (response.code === 200) {
                message.html(response.message);
                message.addClass('success');
                read();
            } else {
                message.html(response.message);
                message.addClass('error');
            }
        }
    });

    return true;
}

/**
 * funcion del
 * 
 * Envia el id del empleado al controlador delete para hacer eliminacion logica
 * 
 * @param {*} id 
 */
const del = (id) => {
    jQuery.ajax({
        url: "./controller/delete.php",
        method: "POSt",
        type: "json",
        dataType: "json",
        data: {
            "action": "delete",
            id
        },
        success: response => {
            if (response.code === 200) {
                read();
            }
        }
    });
}