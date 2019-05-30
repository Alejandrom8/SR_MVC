
const open_window_regist = (id, title, text, where, input_config) => {
    return {
        id,
        title,
        text,
        where,
        input_config,
        get htmlFormat ( ) {
            return `<div class="float_window" id="${this.id}">
                                <div class="margin">
                                    <button id="close" onclick="close_window('${this.id}');">X</button>
                                    <center><h2>${this.title}</h2></center>
                                    <p>${this.text}</p>
                                    <form action="${this.where}" method="POST" class="form">
                                            <div class="form-group">
                                                <label for="${this.input_config.name.id}">${this.input_config.label.id}</label>
                                                <input type="text" name="${this.input_config.name.id}" id="${this.input_config.name.id}" class="form-control" maxlength="${this.input_config.max}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="${this.input_config.name.pass}">${this.input_config.label.pass}</label>
                                                <input type="password" name="${this.input_config.name.pass}" id="${this.input_config.name.pass}" class="form-control" required>
                                            </div>
                                            <center>
                                                <button type="submit" id="sendRegist" class="btn btn-primary">Entrar</button>
                                            </center>
                                    </form>
                                </div>
                            </div>`;
            }
    };
};
const open_window_prof = () => {
const prof_window =	open_window_regist(
                                            'form_prof',
                                            'Registro para profesores',
                                            'Introdusca su RFC (id) además de su contraseña para poder entrar al sistema.',
                                            'controllers/login/profesor.php',
                                            {
                                                name: {
                                                    id: 'rfc',
                                                    pass: 'user_key'
                                                },
                                                label:{
                                                    id: 'RFC',
                                                    pass: 'Contraseña'
                                                },
                                                max: 4
                                            }
                                        );

$("body").append(prof_window.htmlFormat);
};

const open_window_alumno = () => {
const alumno_window =	open_window_regist(
                                            'form_alumno',
                                            'Registro para alumnos',
                                            'Introduce tu número de cuenta y tu contraseña para ingresar al sistema.',
                                            'controllers/login/alumno.php',
                                            {
                                                name: {
                                                    id: 'numcont',
                                                    pass: 'user_key'
                                                },
                                                label:{
                                                    id: 'Número de cuenta',
                                                    pass: 'Contraseña'
                                                },
                                                max: 9
                                            }
                                        );

$("body").append(alumno_window.htmlFormat);
};

const close_window = id => {
$('#'+id).remove();
};

const printFoto = (p) => {
let width, height;

switch(p){
    case '2':
        width = 17; height = 5;
        break;
    case '8':
        width = 20; height = 15;
        break;
    default:
        width = 20; height = 15, p = 8;
        break;
}

$("#displayLogos").append(`
    <img class="ljhi" src="resources/images/p${p}/logo_blanco.png" style="width:${width}%;height:${height}%;">
`);
};

const selectSchool = () => {
$("body").append(`
    <div id="seleccionar_plantel">
        <div class="window">
            <div class="margen">
                <h3>Selecciona tu plantel</h3>
                <form action="'config/config.php'" method="POST" id="form_plantel">
                    <div class="form-group">
                        <select name="plantel" id="plantel" class="form-control" required>
                                <option value="">Selecciona tu plantel</option>
                                <option value="1">No. 1 "Gabino Barreda"</option>
                                <option value="2">No. 2 "Erasmo Castellanos Quinto"</option>
                                <option value="3">No. 3 "Justo Sierra"</option>
                                <option value="4">No. 4 "Vidal Castañeda y Nájera"</option>
                                <option value="5">No. 5 "José Vasconcelos"</option>
                                <option value="6">No. 6 "Antonio Caso"</option>
                                <option value="7">No. 7 "Ezequiel A. Chávez"</option>
                                <option value="8">No. 8 "Miguel E. Schulz"</option>
                                <option value="9">No. 9 "Pedro de Alba"</option>
                        </select>
                    </div>
                    <div class="form-group">
                            <button id="registrarPlantel" class="btn btn-primary" type="submit">Listo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
`);
$("#form_plantel").bind("submit", function (){
        const boton = $("#registrarPlantel");
        $.ajax({
            type: 'POST',
            url: 'http://localhost/SR_MVC/welcome/setUserSchool',
            data: $(this).serialize(),
            beforeSend: function (){
                boton.attr('disabled', 'disabled');
                boton.val('Registrando...');
            },
            success: function (plantel){
                $('#seleccionar_plantel').remove();
                printFoto(plantel);
            },
            error: function (){
                swal({
                    title: 'Error',
                    text: 'No se logro registrar el plantel',
                    icon: 'error',
                    button: ':('
                });
                boton.removeAttr('disabled');
            }
        });
        return false;
});
};

$(document).ready(function(){
selectSchool();
});

const botones = document.querySelectorAll(".btn-group.btn:not(#o)");
botones.forEach( boton => {
boton.addEventListener("click", function (){
    $(".btn-group.btn:not(#o)").css("color", "#fff");
    $(this).css('color', 'orange');
});
});


const formularios = document.querySelectorAll('.FR');
formularios.forEach(form => {
form.addEventListener('submit', () => {
    const tipo = this.dataset.tipo;
    const boton = ("#" + tipo + "-button");
    const configAjax = {
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        dataType: 'JSON',
        beforeSend: function () {
            boton.val("Verificando...");
            boton.attr("disabled", "disabled");
        },
        complete: function () {
            boton.val("Inicia Sesión");
            boton.removeAttr("disabled");
        },
        success: function (dataJson) {
            console.log(dataJson);
        },
        error: function () {
            swal({
                title: "Error",
                text: "No se logro hacer la conexión con el servidor",
                icon: "error",
                button: ":("
            });
        }
    };

    $.ajax(configAjax);
});
});

$(document).ready(function(){
    $(".eleccion").click(function(evento){

        var valor = $(this).val();

        if(valor == 'alumno'){
            $("#div1").css("display", "block");
            $("#div2").css("display", "none");
        }else if(valor == 'profesor'){
            $("#div1").css("display", "none");
            $("#div2").css("display", "block");
        }
});
});
