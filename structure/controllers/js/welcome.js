class Welcome {

    /**
     * 
     * @param { JSON } campusElements 
     */
    constructor (campusElements){
        this._campusElements = campusElements;
    
        const buttonCampus = $(`#${this._campusElements.button}`);
        const that = this;

        buttonCampus.on("click", function (){
            const campus = $(`#${that._campusElements.input}`).val();
            buttonCampus.val("Registrando...");
            buttonCampus.attr("disabled", "disabled");
            const result = Welcome.setCampus(campus).then( res => {

                buttonCampus.val("Listo");
                buttonCampus.removeAttr("disabled");

                if(res === false || !res.success){
                    alert("No se logro registrar el plantel, intenta de nuevo");
                }else{
                    $(`#${that._campusElements.window}`).css("display", "none");
                    Welcome.printPhoto(res.data);
                    Welcome.printCampusName(res.data, "lalala", that._campusElements.window);
                }
            });
        });
    }

    static selectSchool (element){
        $(`#${element}`).css("display", "block");
    }

    static async setCampus (campus) {
        const availableCampus = config.campus.registredCampus;
        const coincided = availableCampus.some( available => {
            return available === parseInt(campus);
        });
        if(coincided){
            const url = `${config.url}login/setUserSchool/${campus}`;
            // const data = JSON.stringify({campus: campus});
            try{
                const response = await fetch(url);
                if(response.ok){
                    const jsonResponse = await response.json();
                    return jsonResponse;
                }else{
                    console.log(`Error: ${response}`);
                    throw new Error("Request failed!");
                }
            }catch(error){
                console.log(error);
            }
        }else{
            //logic for the case when dosen't match with some campus
            console.log("something went wrong");
            return false;
        }
    }

    static printPhoto(campus){
        const width = config.campus.logo[`p${campus}`].width;
        const height = config.campus.logo[`p${campus}`].height;

        if($("#plantelLogo").length){
            $("#plantelLogo").remove();
        }

        $("#displayLogos").append(`
            <img 
                id="plantelLogo" 
                class="ljhi" 
                src="${config.url}resources/images/p${campus}/logo_blanco.png" 
                style="width:${width}%;height:${height}%;" alt="prepa ${campus}" 
                title="Prepa ${campus}"
            >
        `);
    }

    static printCampusName(id, name, element){
        $("#displayName").html(`
            <p>Prepa ${id} ${name}<p>
            <a onclick="Welcome.selectSchool('${element}');">¿No es tu plantel? Cambialo</a>
        `);
    }
}








// const open_window_regist = (id, title, text, where, input_config) => {
//     return {
//         id,
//         title,
//         text,
//         where,
//         input_config,
//         get htmlFormat() {
//             return `<div class="float_window" id="${this.id}">
//                         <div class="margin">
//                             <button id="close" onclick="close_window('${this.id}');">X</button>
//                             <center><h2>${this.title}</h2></center>
//                             <p>${this.text}</p>
//                             <form action="${this.where}" method="POST" class="form">
//                                     <div class="form-group">
//                                         <label for="${this.input_config.name.id}">${this.input_config.label.id}</label>
//                                         <input type="text" name="${this.input_config.name.id}" id="${this.input_config.name.id}" class="form-control" maxlength="${this.input_config.max}" required>
//                                     </div>
//                                     <div class="form-group">
//                                         <label for="${this.input_config.name.pass}">${this.input_config.label.pass}</label>
//                                         <input type="password" name="${this.input_config.name.pass}" id="${this.input_config.name.pass}" class="form-control" required>
//                                     </div>
//                                     <center>
//                                         <button type="submit" id="sendRegist" class="btn btn-primary">Entrar</button>
//                                     </center>
//                             </form>
//                         </div>
//                     </div>`;
//         }
//     };
// };

// const open_window_prof = () => {
//     const prof_window = open_window_regist(
//         'form_prof',
//         'Registro para profesores',
//         'Introdusca su RFC (id) además de su contraseña para poder entrar al sistema.',
//         Generalconfig.url + 'registro/registrarProfesor',
//         {
//             name: {
//                 id: 'rfc',
//                 pass: 'user_key'
//             },
//             label: {
//                 id: 'RFC',
//                 pass: 'Contraseña'
//             },
//             max: 4
//         }
//     );
//     $("#form_prof_regist").attr("disabled", "disabled");
//     $("body").append(prof_window.htmlFormat);
// };

// const open_window_alumno = () => {
//     const alumno_window = open_window_regist(
//         'form_alumno',
//         'Registro para alumnos',
//         'Introduce tu número de cuenta y tu contraseña para ingresar al sistema.',
//         Generalconfig.url + 'registro/registrarAlumno',
//         {
//             name: {
//                 id: 'nocta',
//                 pass: 'user_key'
//             },
//             label: {
//                 id: 'Número de cuenta',
//                 pass: 'Contraseña'
//             },
//             max: 9
//         }
//     );
//     console.log("ejecutado");
//     $("#form_alumno_regist").attr("disabled", "disabled");
//     $("body").append(alumno_window.htmlFormat);
// };

// const close_window = id => { 
//     $('#' + id).remove();
//     $("#" + id + "_regist").removeAttr("disabled");
// };

// /**
//  * function that prints the campus logo
//  * @param id la id del plantel
// */
// const printFoto = id => {

//     let width, height;

//     switch (id.toString()) {
//         case '2':
//             width = 17; height = 4;
//             break;
//         case '8':
//             width = 20; height = 15;
//             break;
//         default:
//             width = 20; height = 15;
//             break;
//     }

//     if($("#plantelLogo").length){
//         $("#plantelLogo").remove();
//     }

//     $("#displayLogos").append(`
//         <img id="plantelLogo" class="ljhi" src="${Generalconfig.url}resources/images/p${id}/logo_blanco.png" style="width:${width}%;height:${height}%;" alt="prepa ${id}" title="Prepa ${id}">
//     `);
// };

// const printName = (id, name) => {
//     $("#displayName").html(`
//         <p>Prepa ${id} ${name}<p>
//         <a onclick="selectSchool();">¿No es tu plantel? Cambialo</a>
//     `);
// };

// const selectSchool = () => {
//     $("body").append(`
//         <div id="seleccionar_plantel">
//             <div class="window">
//                 <div class="margen">
//                     <h3>Selecciona tu plantel</h3>
//                     <form action="#" method="POST" id="form_plantel">
//                         <div class="form-group">
//                             <select name="plantel" id="plantel" class="form-control" required>
//                                     <option value="">Selecciona tu plantel</option>
//                                     <option value="1">No. 1 "Gabino Barreda"</option>
//                                     <option value="2">No. 2 "Erasmo Castellanos Quinto"</option>
//                                     <option value="3">No. 3 "Justo Sierra"</option>
//                                     <option value="4">No. 4 "Vidal Castañeda y Nájera"</option>
//                                     <option value="5">No. 5 "José Vasconcelos"</option>
//                                     <option value="6">No. 6 "Antonio Caso"</option>
//                                     <option value="7">No. 7 "Ezequiel A. Chávez"</option>
//                                     <option value="8">No. 8 "Miguel E. Schulz"</option>
//                                     <option value="9">No. 9 "Pedro de Alba"</option>
//                             </select>
//                         </div>
//                         <div class="form-group">
//                                 <button id="registrarPlantel" class="btn btn-primary" type="submit">Listo</button>
//                         </div>
//                     </form>
//                 </div>
//             </div>
//         </div>
//     `);
//     $("#form_plantel").bind("submit", function (e) {
//         e.preventDefault();
//         const boton = $("#registrarPlantel");
//         $.ajax({
//             type: 'POST',
//             url: Generalconfig.url + 'login/setUserSchool',
//             data: $(this).serialize(),
//             dataType: "JSON",
//             beforeSend: function () {
//                 boton.attr('disabled', 'disabled');
//                 boton.val('Registrando...');
//             },
//             success: function (plantel) {
//                 $('#seleccionar_plantel').remove();
//                 printFoto(plantel.id);
//                 printName(plantel.id, plantel.name);
//             },
//             error: function (e) {
//                 swal({
//                     title: 'Error',
//                     text: 'No se logro registrar el plantel.',
//                     icon: 'error',
//                     button: ':('
//                 });
//                 boton.removeAttr('disabled');
//                 console.log(e.responseText);
//             }
//         });
//         return false;
//     });
// };

// $(document).ready(function () {
//     selectSchool();
//     $(".eleccion").click(function () {

//         let valor = $(this).val();

//         if (valor == 'alumno') {
//             $("#div1").css("display", "block");
//             $("#div2").css("display", "none");
//         } else if (valor == 'profesor') {
//             $("#div1").css("display", "none");
//             $("#div2").css("display", "block");
//         }
//     });
// });

// const botones = document.querySelectorAll(".btn-group.btn:not(#o)");

// botones.forEach(boton => {
//     boton.addEventListener("click", function () {
//         $(".btn-group.btn:not(#o)").css("color", "#fff");
//         $(this).css('color', 'orange');
//     });
// });

// const formularios = document.querySelectorAll('.FR');

// formularios.forEach( form => {

//     form.addEventListener('submit', function (e) {

//         e.preventDefault();
//         const tipo = this.dataset.tipo;
//         const boton = $("#" + tipo + "-button");

//         $.ajax({
//             url: $(this).attr('action'),
//             type: "POST",
//             data: $(this).serialize(),
//             dataType: 'JSON',
//             beforeSend: function () {
//                 boton.val("Verificando...");
//                 boton.attr("disabled", "disabled");
//             },
//             complete: function () {
//                 boton.val("Iniciar Sesión");
//                 boton.removeAttr("disabled");
//             },
//             success: function (loginResult) {
//                 console.log(loginResult);
//                 if (loginResult.success) {
//                     window.location = loginResult.onSuccessEvent;
//                 } else {
//                     const event = loginResult.onErrorEvent;
//                     if(event && event != null){
//                         if(event == "open_window_alumno"){
//                             open_window_alumno();
//                         }else if(event == "open_window_prof"){
//                             open_window_prof();
//                         }
//                         swal({
//                             title: "Usuario no Registrado",
//                             text: "Favor de registrarse antes de ingresar",
//                             button: "ok"
//                         });
//                     }
                    
//                     $("#debug").html(`<div class="alert alert-danger">${loginResult.message}</div>`);
//                 }
//             },
//             error: function () {
//                 swal({
//                     title: "Error",
//                     text: "No se logro hacer la conexión con el servidor",
//                     icon: "error",
//                     button: ":("
//                 });
//             }
//         });
//         return false;
//     });
// });