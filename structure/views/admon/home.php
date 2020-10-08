<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("structure/views/head.php"); ?>
    <title>Administración</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= constant("URL") ?>resources/stylesheet/admon.css">
    <script src="<?= constant("URL") ?>resources/frameworks/bootstrap/bootstrap.min.js"></script>
</head>
<body>
    <div class="webpage">
        <header id="menu">
            <ul class="nav_logos">
                <li><a href="www.unam.mx" target="_blank"><img class="logo" src="<?= constant("URL") ?>resources/images/escudounam_blanco.png" alt="UNAM"></a></li>
                <li><img class="logo" src="<?= constant("URL") ?>resources/images/jovenesblanco.png" alt="UNAM"></li>
                <li><a href="prepa8.unam.mx" target="_blank"><img class="logo" src="<?= constant("URL") ?>resources/images/leopardos.png" alt="UNAM"></a></li>
            </ul>
            <span>Administrador</span>
            <button class="btn" onclick="show()">
                <i class="fa fa-bars fa-2x fa-sm"></i>
            </button>
            <section id="movibleSection">
                <a class="button-href" href="#"><button><i class="fas fa-home"></i> Inicio</button></a>
                <a class="button-href" href="<?= constant("URL") ?>goout"><button><i class="fas fa-sign-out-alt"></i> Salir</button></a>
            </section>
        </header>
        <section id="aperture" class="profesor">
            <h1>Jóvenes Hacía la Investigación en Ciencias Experimentales <?= strftime( "%Y" ) ?> <br><span style="font-size:1.8rem;">Sección administrativa</span></h1>
        </section>
        <div id="app">
            <aside>
                <table class="table">
                    <thead>
                        <tr>
                        <th>
                            <h5>Menú</h5>
                        </th>
                        </tr>
                    </thead>
                    <tr class="option" data-option="CDP">
                        <td><i class="fas fa-chart-bar"></i> conscentrado de alumnos y profesores</td>
                    </tr>
                    <tr class="option" data-option="DE">
                        <td><i class="fas fa-chart-bar"></i> Datos estadisticos</td>
                    </tr>
                    <tr class="option" data-option="BU">
                        <td><i class="fas fa-search"></i> Busqueda de usuarios</td>
                    </tr>
                    <tr class="option" data-option="BU">
                        <td><i class="fas fa-user-minus"></i> Baja de usuarios</td>
                    </tr>
                    <tr class="option" data-option="RP">
                        <td><i class="fas fa-landmark"></i> Registro de planteles</td>
                    </tr>
                </table>
                <input type="button" id="setScreen" onclick="setScreen()" class="btn btn-secondary" style="margin:4%;" value="Fijar pantalla">
            </aside>
            <div id="CDP" class="window" style="display:block;">
                <h3>Concentrado de alumnos</h3>
                <br>
                <div class="form-group">
                    <label for="campusConcentrated">Selecciona un plantel:</label>
                    <select name="campusConcentrated" id="campusConcentrated" class="form-control" required>       
                        <option value="">Seleccionar...</option>
                        <option value="t">Todos los planteles</option>
                        <?php 
                            foreach($this->registeredCampus as $campus){
                                echo "<option value='". $campus["plantel"] .",". $campus["nombre"] ."'>". $campus["plantel"] . ". " . $campus["nombre"] ."</option>";
                            }
                        ?>                    
                    </select>
                </div>
                <div class="col-md-12">
                    <p class="instructions" style="text-align:justify;">
                    Nota: La tabla de <b>profesores y alumnos</b> es construida por un programa que consulta
                    a todos los profesores inscritos para luego relacionarlos con los alumnos bajo
                    su nombre, por lo que los alumnos registrados con profesores que aún no esten inscritos,
                    no apareceran en la tabla <b>Profesores y alumnos</b>.</p>
                </div>
                <br>
                <div id="concentrated" class="row col-md-12">
                    <div class="col-md-6">
                        <h4>Alumnos registrados</h4>
                        <button class="btn btn-primary" onclick="tableToExcel('registeredStudents', 'registeredStudents.xls')"><i class="fas fa-file-download"></i>  Descargar tabla de alumnos</button>
                        <br>
                        <div class="tab-container">
                            <table id="registeredStudents" class="table">
                                <thead id="registeredStudents_header">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>No. de cuenta<th>
                                    </tr>
                                </thead>
                                <tbody id="registeredStudents_dataSection">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Profesores y alumnos registrados</h4>
                        <button class="btn btn-primary" onclick="tableToExcel('registeredStudentsAndProf', 'registeredStudentsAndProf.xls')"><i class="fas fa-file-download"></i>  Descargar tabla de profesores y alumnos</button>
                        <br>
                        <div class="tab-container">
                            <table id="registeredStudentsAndProf" class="table">
                                <thead id="registeredStudentsAndProf_header">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>RFC / No. de cuenta<th>
                                    </tr>
                                </thead>
                                <tbody id="registeredStudentsAndProf_dataSection">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br><br><br>
            </div>
            <div id="DE" class="window">
                <h3>Datos estadisticos</h3>
                <div class="statistics-table">
                    <header class="table-head">
                        Datos generales
                    </header>
                    <table id="generalData" class="table table-md table-bordered text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Plantel</th>
                                <th>Alumnos inscritos</th>
                                <th>Profesores inscritos</th>
                                <th>participantes totales</th>
                            </tr>
                        </thead>
                        <tbody id="statisticsSection">
                        </tbody>
                    </table>
                </div>
                <div class="downloadSection">
                    <span><b>Descarga esta tabla</b></span>
                    <button class="btn btn-primary btn-md" onclick="tableToExcel('generalData', 'statistics.xls')">Descargar</button>
                </div>
                <div class="col-md-12">
                        <header class="table-head">
                            Registrados por turno
                            (alumnos y profesores)
                        </header>
                        <table id="generalData" class="table table-md table-bordered text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Plantel</th>
                                    <th>Matutino</th>
                                    <th>Vespertino</th>
                                    <th>Mixto</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="statisticsByTurnSection">
                            </tbody>
                        </table>
                </div>
                <div class="col-md-12">
                    <header class="table-head">
                        Alumnos registrados por año escolar
                    </header>
                </div>
                <br><br><br>
            </div>
            <div id="BU" class="window">
                <h3>Busqueda de usuarios</h3>
                <div class="explorer input-group mb-3">
                    <input id="query" type="text" class="form-control" placeholder="Busca algún estudiante o profesor" aria-label="busqueda">
                    <div class="input-group-append">
                        <button class="input-group-text" id="query-button" style="padding:0 50%;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                - Busqueda avanzada
                                </button>
                            </h2>
                        </div>
                        <form id="advanced" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body row">
                                <div class="col-md-12 instructions">
                                    <p>Escribe el dato que necesitas buscar en la sección de arriba y configura los campos de abajo finalmente da click en el botón azul de busqueda.</pr>
                                    <br><br>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="campus">plantel</label>
                                        <select id="campus" name="campus" class="form-control">
                                            <option value="all">Todos los planteles</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="turn">Turno</label>
                                        <select id="turn" name="turn" class="form-control">
                                            <option value="2">Ambos turnos</option>
                                            <option value="0">Matutino</option>
                                            <option value="1">Vespertino</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="dataType">Tipo de dato</label><br>
                                        <input type="checkbox" id="dataType1" class="dataType" name="dataType" value="name" checked> Nombre<br>
                                        <input type="checkbox" id="dataType2" class="dataType" name="dataType" value="nocta"> No. de cuenta<br>
                                        <input type="checkbox" id="dataType3" class="dataType" name="dataType" value="rfc"> RFC<br>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kind">Tipo de usuario</label>
                                        <select id="kind" name="kind" class="form-control">
                                            <option value="both">Ambos</option>
                                            <option value="profesor">Profesor</option>
                                            <option value="student">Alumno</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="grade">Grado</label>
                                        <select id="grade" name="grade" class="form-control">
                                            <option value="4">4°</option>
                                            <option value="5">5°</option>
                                            <option value="6">6°</option>
                                        </select>
                                    </div>
                                    <br><br>
                                    <div class="form-group">
                                        <button id="advancedSearch" class="btn btn-primary btn-block">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="results">
                    <img class="loader" src="<?= constant("URL") ?>resources/images/gifs/8.gif">
                </div>
                <br><br><br>
            </div>
            <div id="RP" class="window">
                <h3>Registro de planteles</h3>
                <p>Este proceso habilitara el sistema para el plantel que registre, se deberan de ingresar 2</p>
                <form id="registCampus" method="POST">
                    <h4>Datos del plantel</h4>
                    <br>
                    <div class="form-group">
                        <label for="campus">Plantel</label>
                        <select name="campus" id="campus" class="form-control" required>       
                            <?php 
                                foreach($this->campus as $campus){
                                    echo "<option value='". $campus["id"] ."'>". $campus["id"] . ". " . $campus["name"] ."</option>";
                                }
                            ?>                    
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="califTable">Tabla de estudiantes</label>
                        <input type="file" name="califTable" id="califTable" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="horariosTable">Tabla de profesores</label>
                        <input type="file" name="horariosTable" id="horariosTable" class="form-control-file">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" id="registButton" class="btn btn-primary btn-block" value="Registrar plantel">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include_once("structure/views/footer.php"); ?>
    <script src="<?= constant("URL") ?>resources/frameworks/particles.min.js"></script>
    <script type="text/javascript" src="<?= constant("URL") ?>resources/js/excelExport.js"></script>
    <script>

        particlesJS.load('aperture', Generalconfig.url + 'resources/assets/particles.json', function() {
            console.log('callback - particles.js config loaded');
        });
        
        let state = false;

        function show(){
            $(document).ready(function(){
                if(!state){
                    $("#movibleSection").css({"right":"0"});
                    // $(".container-own").css({"opacity": "0.9"});
                    state = true;
                }else{
                    $("#movibleSection").css({"right":"-100vw"});
                    // $(".container-own").css({"opacity": "1"});
                    state = false;
                }
            });
        }

        const windows = document.querySelectorAll(".option");
        windows.forEach( window => {
            window.addEventListener("click", function (){
                const option = this.dataset.option;
                $(".window").css("display", "none");
                $(`#${option}`).css("display", "block");
                //button
                $(".option").css({"background": "transparent", "color": "#fff"});
                $(this).css({"background": "#fff", "color": "#222"});
            });
        });

        async function getGeneralStatisticsData(){
            try{
                const response = await fetch(Generalconfig.url + "admon/countGeneralData");
                if(response.ok){
                    return await response.json();
                }else{
                    throw new Error("hubo un error al caragar los datos generales");
                }
            }catch(e){
                console.log(e);
            }
        }

        function printTable(data, id){
            d = Object.values(data);
            d.forEach(plantel => {
                id.append(`
                    <tr>
                        <td></td>
                        <td>${plantel.plantel}</td>
                        <td>${plantel.students}</td>
                        <td>${plantel.profesors}</td>
                        <td>${plantel.students + plantel.profesors}</td>
                    </tr>
                `);
            });
        }

        function manageResponse(res){
            if(res != null){
                if(res.success){
                    console.log(res.messages);
                    printTable(res.data, $("#statisticsSection"));

                    const data = Object.values(res.data);
                    let totalStudents = 0, totalProfesors = 0, totalCampus = 0;

                    data.forEach( d =>{
                        totalStudents += d.students;
                        totalProfesors += d.profesors;
                        totalCampus++;
                    });

                    $("#statisticsSection").append(`
                        <tr>
                            <td>Total</td>
                            <td style="background:#3626a7;color:#fff;">${totalCampus}</td>
                            <td style="background:#3626a7;color:#fff;">${totalStudents}</td>
                            <td style="background:#3626a7;color:#fff;">${totalProfesors}</td>
                            <td style="background:#3626a7;color:#fff;">${totalStudents + totalProfesors}</td>
                        </tr>
                    `);
                }else{
                    console.log(res.errors);
                    swal({
                        "title": "Error al cargar los datos estadisticos",
                        "text": res.messages,
                        "icon": "error",
                        "button": "ok"
                    });
                }
            }else{
                throw new Error("Hubo un error al intentar Actualizar tus datos");
            }
        }

        async function loadData(){
            const data = await getGeneralStatisticsData();
            manageResponse(data);
        }

        loadData();

        async function makeSearch(query){
            try{
                const request = await fetch(Generalconfig.url + 'admon/searcher', {
                    method: "post",
                    body: query
                });

                if(request.ok){
                    return await request.json();
                }else{
                    throw new Error("Falló la busqueda");
                }
            }catch(e){
                console.log(e);
            }
        } 

        $("#query-button").on("click", async function(e){
            const words = $("#query").val();
            if(words.replace(" ", "") != "" && e.keyCode != 32){
                let form = new FormData();
                    form.append("query", words);
                    form = getFormData("advanced", form);
                const data = await makeSearch(form);
                console.log(data);
            }
        });
        
        $("#advanced").on("submit", async function (e){
            e.preventDefault();

            // let types = [];
            // const dataType = document.querySelectorAll(".dataType");

            // dataType.forEach( dt => {
            //     if(dt.checked){
            //         types.push(dt.value);
            //     }
            // });

            // types = types.reduce((old, current) => {
            //     return old + "," + current;
            // });

            const query = $("#query").val();
            let form = new FormData(this);
                form.append("query", query);
                form = getFormData("advanced", form);
            const data = await makeSearch(form);
            console.log(data);
        });

        for(let i = 1; i < 10; i++){
            $("#id").append(`<option value="${i}">${i}</option>`);
        }



        //Aplicacón para registrar un campus
        let steps = 1;
        //Cachar el evento de envio del formulari de registro
        $("#registCampus").bind("submit", async function (e){
            //anular redireccionamiento
            e.preventDefault();

            //create a window with the status of the process
            openReport();
            //paso 0: crear base de datos
            const campus = new FormData(this);
            const createDataBaseResponse = await makeRegist(campus, "createDataBase");
            updateReport(createDataBaseResponse);
            if(createDataBaseResponse != null && createDataBaseResponse.success){
                //paso 1: capturar base de datos de alumnos
                let formCalifTable = new FormData();
                const califTable = document.getElementById("califTable");
                const califTableFile = califTable.files;

                    formCalifTable.append("califTable", califTableFile[0]);
                    formCalifTable = getFormData("registCampus", formCalifTable);

                const califTableRegistResponse = await makeRegist(formCalifTable, "registCalifTable");//reciviendo respuesta 1
                //manejar la respuesta de la petición
                updateReport(califTableRegistResponse);
                //paso 2: Evaluar la situación del prosceso de registro de la tabla
                if(califTableRegistResponse != null && califTableRegistResponse.success){
                    let formHorarios = new FormData();
                    const horariosTable = document.getElementById("horariosTable");
                    const horariosTableFile = horariosTable.files;
                    
                        formHorarios.append("horariosTable", horariosTableFile[0]);
                        formHorarios = getFormData("registCampus", formHorarios);

                    const horariosTableRegistResponse = await makeRegist(formHorarios, "registHorariosTable");
                    updateReport(horariosTableRegistResponse);
                    if(horariosTableRegistResponse != null && horariosTableRegistResponse.success){
                        const makeFolders = await makeRegist(campus, "makeFolders");
                        updateReport({
                            messages: [
                                "Creando carpetas para el plantel"
                            ]
                        });
                        updateReport(makeFolders);
                        if(makeFolders != null && makeFolders.success){

                            const campus = new FormData(this);
                            updateReport({
                                    messages: [
                                        "Resolviendo algunos detalles extra..."
                                    ]
                            });
                            updateReport({
                                messages: [
                                    "Creando las tablas para registro de alumnos y profesores..."
                                ]
                            });

                            const makeTables = await makeRegist(campus, "makeTables");
                            updateReport(makeTables);
                            if(makeTables != null && makeTables.success){
                                updateReport({
                                    messages:[
                                        "Realizando ultimos ajustes..."
                                    ]
                                });
                                const finalDetails = await makeRegist(campus, "setRegistered");
                                updateReport(finalDetails);
                                swal({
                                    title:"Proceso Finalizado",
                                    text: "Ha finalizado el proceso de registro, en la pantalla se muestra el estatus del registro",
                                    button: "Yei!"
                                }).then( () => {
                                    $("#reportButton").removeAttr("disabled");
                                });
                            }else{
                                throw new Error("No se lograron crear las tablas correctamente");
                            }
                        }else{
                            throw new Error("No se lograron crear las carpetas para las fotografias.");
                        }
                    }else{
                        throw new Error("Hubo un error al intentar registrar la tabla de profesores en la base de datos.");
                    }
                }else{
                    throw new Error("Hubo un error al intentar registrar la tabla de estudiantes en la base de datos.");
                }
            }else{
                throw new Error("No se logro crear la base de datos");
            }

            updateReport({
                messages: [
                    "Fin del proceso..."
                ]
            });
            
            unset(steps);
        });

        function openReport(){
            $("body").append(`
                <div class="adjuster">
                    <div id="report">
                        <div class="col-md-12">
                            <center><img class="loader" src="${Generalconfig.url}resources/images/gifs/1.gif"></center>
                            <h3>Estatus del registro</h3>
                            <br>
                        </div>
                        <div id="updateReportSection" class="col-md-12"></div>
                        <br>
                        <divclass="col-md-12">
                            <input type="button" id="reportButton" class="btn btn-primary" onclick="closeReport()" value="Terminar" disabled="disabled">
                        </div>
                    </div>
                </div>
            `);
        }

        function closeReport(){
            location.reload();
        }

        function updateReport(data){
            console.log(data);
            let response = data.messages;
            for(let i = 0; i < Object.keys(response).length; i++){
                $("#updateReportSection").append(`
                    <p>${steps}. ${response[i]}</p>
                `);
                steps++;
            }
            $("#updateReportSection").animate({ scrollTop: $("#updateReportSection").prop("scrollHeight")}, 1000);
        }

        async function makeRegist(data, method){
            try{
                console.log(Generalconfig.url + "admon/" + method);
                const response = await fetch(Generalconfig.url + "admon/" + method, {
                    method: "post",
                    body: data
                });

                if(response.ok){
                    return await response.json();
                }else{
                    throw new Error("Hubo un error al intentar registrar el plantel. Contacte al administrador para más información");
                }
            }catch(e){
                console.log(e);
            }
        }

        function manageResponseRegist(res){
            console.log(res);
        }
        
        function getFormData(id,data){
            $("#"+id).find("input,select").each(function(i,v) {
                if(v.type!=="file") {
                    if(v.type==="checkbox" && v.checked===true) {
                        data.append(v.name,"on");
                    }else{
                        data.append(v.name,v.value);
                    }
                }
            });
            return data;
        }

        async function makeConsult(data, mode, method){
            try{
                const response = await fetch(Generalconfig.url + "admon/" + method + "/" + data + "/" + mode);

                if(response.ok){
                    return await response.json();
                }else{
                    throw new Error("Hubo un error al intentar obtener los concentrados de alumnos");
                }
            }catch(e){
                console.log(e);
            }
        }

        $("#campusConcentrated").on("change", async function(){
            if($(this).val() != ""){
                let mode = "s", campusName, campus = "x";
                
                if($(this).val() == "t"){
                    campusName = "Todos los planteles";
                    mode = "t";
                }else{
                    let data = $(this).val();
                    data = data.split(",")
                    campus = data[0];
                    const name = data[1];
                    campusName = `Plantel ${campus} ${name}`;
                }

                const students = await makeConsult(campus, mode, "getAllTheStudents");
                const stdAndProf = await makeConsult(campus, mode, "getAllTheProfesorsAndStudents");

                $("#registeredStudents_header").empty().append(`
                    <tr>
                        <th colspan="2">${campusName}</th>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <th>No. de cuenta<th>
                    </tr>
                `);

                $("#registeredStudentsAndProf_header").empty().append(`
                    <tr>
                        <th colspan="2">${campusName}</th>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <th>RFC / No. de cuenta<th>
                    </tr>
                `);

                if(validate(students)){
                    if(mode == "s"){
                        createTables(students);
                    }else{
                        createComplexTables(students);
                    }
                }else{
                    $("#registeredStudents_dataSection").empty();
                }

                if(validate(stdAndProf)){
                    if(mode == "s"){
                        createTablesPS(stdAndProf);
                    }else{
                        createComplexTablesPS(stdAndProf);
                    }
                }else{
                    $("#registeredStudentsAndProf_dataSection").empty();
                }
            }
        });

        function validate(data){
            if(data != null){
                if(data.success){
                    return true;
                }else{
                    console.log(data);
                    swal({
                        title: "Error al obtener el concentrado de alumnos",
                        text: data.messages,
                        icon: "error",
                        button: "ok"
                    });
                    return false;
                }
            }else{
                swal({
                    title: "Error al obtener el concentrado de alumnos",
                    text: "Hubo una falla mientras se intentaba obtener los registros de los alumnos y profesores.",
                    icon: "error",
                    button: "ok"
                });
                return false;
            }
        }

        function createTables(data){
            const students = data.data;
            const table = $("#registeredStudents_dataSection");
            table.empty();
            students.forEach( std => {
                let nocta = std.nocta;
                let name = std.nombre;
                let row = `<tr>
                    <td>${name}</td>
                    <td>${nocta}</td>
                </tr>`;
                table.append(row);
            });
        }

        function createTablesPS(data){
            const profesors = data.data;
            const table = $("#registeredStudentsAndProf_dataSection");
            table.empty();
            profesors.forEach( p => {
                let name = p.nombre;
                let rfc = p.rfc;
                let row = `<tr style="background:gray;">
                    <td colspan="2"><b>${name}</b></td>
                    <td><b>${rfc}</b></td>
                </tr>`;

                table.append(row);

                let students = p.students;

                students.forEach( std => {
                    let nocta = std.nocta;
                    let name = std.nombre;
                    let row = `<tr>
                        <td>${name}</td>
                        <td>${nocta}</td>
                    </tr>`;
                    table.append(row);
                });
            });
        }

        function createComplexTables(data){
            const campus = data.data;
            const table = $("#registeredStudents_dataSection");
            table.empty();
            campus.forEach( c => {
                let finalCampusTable = "";
                const campusName = "Plantel " + c.campus;
                finalCampusTable += `<tr><td colspan="2" style="background:gray;"><b>${campusName}</b></td><tr>`;
                const students = c.students;
                students.forEach( std => {
                    const name = std.nombre;
                    const nocta = std.nocta;
                    finalCampusTable += `
                        <tr>
                            <td>${name}</td>
                            <td>${nocta}</td>
                        </tr>
                    `;
                });
                table.append(finalCampusTable);
            });
        }

        function createComplexTablesPS(data){
            const campus = data.data;
            const table = $("#registeredStudentsAndProf_dataSection");
            table.empty();
            campus.forEach( c => {
                let finalCampusTable = "";
                const campusName = "Plantel " + c.campus;
                finalCampusTable += `<tr><td colspan="3" style="background:gray;"><b>${campusName}</b></td><tr>`;

                const profesors = c.data;
                profesors.forEach( p => {
                    let name = p.nombre;
                    let rfc = p.rfc;
                    finalCampusTable += `<tr style="background:rgba(0,0,0,0.2);">
                        <td colspan="2"><b>${name}</b></td>
                        <td><b>${rfc}</b></td>
                    </tr>`;

                    let students = p.students;

                    students.forEach( std => {
                        let nocta = std.nocta;
                        let name = std.nombre;
                        finalCampusTable += `<tr>
                            <td>${name}</td>
                            <td>${nocta}</td>
                        </tr>`;
                    });
                });

                table.append(finalCampusTable);
            });
        }

        let screenFlag = false;

        function setScreen(){
            if(!screenFlag){
                $('html, body').animate({
                    scrollTop: $(`#app`).offset().top
                }, 1000);
                $("body").css("overflow", "hidden");
                $("#setScreen").val("Soltar pantalla");
                $("#app").css("height", "100vh");
                $(".window").css("max-height", "100vh");
                screenFlag = true;
            }else{
                $("body").css("overflow", "auto");
                $("#setScreen").val("Fijar pantalla");
                $("#app").css("height", "150vh");
                $(".window").css("max-height", "150vh");
                screenFlag = false;
            }
        }

        $(document).ready(async function(){
            try{
                const request = await fetch(Generalconfig.url + "admon/countAllByTurn");
                if(request.ok){
                    const data = await request.json();

                    if(data != null && data.success){
                        const campus = data.data;
                        const table = $("#statisticsByTurnSection");
                        let cCont = 0, mCont = 0, vCont = 0, mixCont = 0, finCont = 0;

                        campus.forEach( c => {
                            const id = c.campus;
                            const name = c.nombre;
                            const totals = c.totales;
                            const matutino = totals.matutino;
                            const vespertino = totals.vespertino;
                            const mixto = totals.mixto;

                            const final = matutino + vespertino + mixto;

                            cCont ++;
                            mCont+= matutino;
                            vCont += vespertino;
                            mixCont += mixto;
                            finCont += final;

                            table.append(`
                                <tr>
                                    <td></td>
                                    <td>${id}</td>
                                    <td>${matutino}</td>
                                    <td>${vespertino}</td>
                                    <td>${mixto}</td>
                                    <td>${final}</td>
                                </tr>
                            `);
                        });

                        table.append(`
                            <tr>
                                <td>Total</td>
                                <td style="background:#3626a7;color:#fff;">${cCont}</td>
                                <td style="background:#3626a7;color:#fff;">${mCont}</td>
                                <td style="background:#3626a7;color:#fff;">${vCont}</td>
                                <td style="background:#3626a7;color:#fff;">${mixCont}</td>
                                <td style="background:#3626a7;color:#fff;">${finCont}</td>
                            </tr>
                        `);
                    }else{
                        console.log(data);
                        swal({
                            title: "Error al cargar datos estadisticos",
                            text: "No se logro obtener el contéo de alumnos y profesores por turno.",
                            icon: "error",
                            button: "ok"
                        });
                    }

                }else{
                    throw new Error("No se logro obtener el contéo de alumnos y profesores por turno.");
                }
            }catch(e){
                console.log(e);
            }
        });
            
    </script>
</body>
</html>