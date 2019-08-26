<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("structure/views/head.php"); ?>
    <title>Administración</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= constant('CONFIG')["url"] ?>resources/stylesheet/admon.css">
    <script src="<?= constant("CONFIG")["url"] ?>resources/frameworks/bootstrap/bootstrap.min.js"></script>
</head>
<body>
    <div class="webpage">
        <header id="menu">
            <ul class="nav_logos">
                <li><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/escudounam_blanco.png" alt="UNAM"></li>
                <li><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/jovenesblanco.png" alt="UNAM"></li>
                <li><img class="logo" src="<?= constant("CONFIG")["url"] ?>resources/images/leopardos.png" alt="UNAM"></li>
            </ul>
            <span>Administrador</span>
            <button class="btn" onclick="show()">
                <i class="fa fa-bars fa-2x fa-sm"></i>
            </button>
            <section id="movibleSection">
                <a class="button-href" href="#"><button><i class="fas fa-home"></i> Inicio</button></a>
                <a class="button-href" href="<?= constant("CONFIG")["url"] ?>goout"><button><i class="fas fa-sign-out-alt"></i> Salir</button></a>
            </section>
        </header>
        <div id="app">
            <aside>
                <table class="table">
                    <thead>
                        <th>
                            <h5>Menú</h5>
                        </th>
                    </thead>
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
            </aside>
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
                    <span><b>Descargar esta tabla</b></span>
                    <button class="btn btn-primary btn-md" onclick="tableToExcel('generalData', 'statistics.xls')">Descargar</button>
                </div>
                <div></div>
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
                                        <input type="checkbox" id="dataType1" class="dataType" name="dataType" value="name"> Nombre<br>
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
                    <img class="loader" src="<?= constant("CONFIG")["url"] ?>resources/images/gifs/8.gif">
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
    <script type="text/javascript" src="<?= constant("CONFIG")["url"] ?>resources/js/excelExport.js"></script>
    <script>
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

        $("#query").on("keyup", async function(e){
            const words = $(this).val();
            if(words.replace(" ", "") != "" && e.keyCode != 32){
                const data = await makeSearch(JSON.stringify({"query" : words}));
                //REPARAR: no se envia la información
                console.log(data);
            }
        });

        $("#query-button").on("click", async function(){
            const words = $("#query").val();
            if(words.replace(" ", "") != "" && e.keyCode != 32){
                const data = await makeSearch(JSON.stringify({"query" : words}));
                console.log(data);
            }
        });
        
        $("#advanced").on("submit", async function (e){
            e.preventDefault();

            let types = [];
            const dataType = document.querySelectorAll(".dataType");

            dataType.forEach( dt => {
                if(dt.checked){
                    types.push(dt.value);
                }
            });

            types = types.reduce((old, current) => {
                return old + "," + current;
            });

            const input = $("<input>")
                            .attr("type", "hidden")
                            .attr("id", "type")
                            .attr("name", "type").val(types);
            $(this).append(input);

            const form = new FormData(this);

            const data = await makeSearch(form);
            console.log(data);
            $("#type").remove();
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
                    const campus = new FormData(this);
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
            
    </script>
</body>
</html>