  function simpleFilter(varToValidate){
    if(varToValidate != "" && varToValidate != null){
      return true;
    }
    return false;
  }

  $("#regist").on("submit", async function(e){
    e.preventDefault();
    $("#registButton").attr("disabled", "disabled");
    $("#registButton").val("Envando Datos...");
    let data = getFiles();
        data = getFormData("regist",data);
    const result = await makeRegist(data);
    manageRegistResponse(result);
  });

  async function makeRegist(data){
    try{
      $("#registButton").val("Registrando...");
      const response = await fetch(url + 'procedures/registStudent', {
        method: 'POST',
        body: data
      });
      
      if(response.ok){
        return await response.json();
      }else{
        throw new Error("Error al procesar los datos enviados");
      }
    }catch(e){
      console.log(e);
    }
  }

  function manageRegistResponse(res){
    if(res != null){
      if(res.success){
        swal({
          "title": "!Registro Exitoso!",
          "text": "Te has registrado exitosamente, seras redireccionad@ a la página de inicio.",
          "icon": "success",
          "button": "ok"
        }).then( () => {
          window.location = res.onSuccessEvent;
        });
      }else{
        $("#registButton").removeAttr("disabled");
        $("#registButton").val("Registrar");
        console.log(res.errors);
        swal({
          "title": "Error de registro",
          "text": res.messages,
          "icon": "error",
          "button": "ok"
        });
      }
    }else{
      throw new Error("Hubo un error al intentar registrarte");
    }
  }

  function getFiles(){
    var idFiles=document.getElementById("file");
    // Obtenemos el listado de archivos en un array
    var archivos = idFiles.files;
    // Creamos un objeto FormData, que nos permitira enviar un formulario
    // Este objeto, ya tiene la propiedad multipart/form-data
    var data=new FormData();
    // Recorremos todo el array de archivos y lo vamos añadiendo all
    // objeto data
    // Al objeto data, le pasamos clave,valor
    data.append("photo",archivos[0]);
    return data;
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

  const swiper = new Swiper('.swiper-container', {
    simulateTouch:false,
    pagination: {
      el: '.swiper-pagination',
      type: 'progressbar',
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

  $("#letChange").on("click", function(){
    $("#grade").removeAttr("readonly");
    $("#group").removeAttr("readonly");
  });

  async function getData(type,college_id){
    try{
      const response = await fetch(Generalconfig.url + "procedures/get" + type + "/" + college_id);
      if(response.ok){
        return await response.json(); 
      }else{
        throw new Error("Error al cargar datos de este colegio");
      }
    }catch(e){
      console.log(e);
    }

    return null;
  }

  function putSubjects(subjects){
    if(subjects.success){
      $("#subject").empty();
      subjects.data.forEach( subject => {
        $("#subject").append(`
          <option value="${subject.id}">${subject.name}</option>
        `);
      });
    }else{
      swal({
        "title": "Error de carga de datos",
        "text": "Ocurrio un error al cargar las asignaturas: " + subjects.errors,
        "icon": "error",
        "button": ["Oh noo!"]
      });
    }
  }

  function putProfesors(profesors){
    if(profesors.success){
      $("#profesor").empty();
      profesors.data.forEach( profesor => {
        $("#profesor").append(`
          <option value="${profesor.rfc}">${profesor.name}</option>
        `);
      });
    }else{
      swal({
        "title": "Error de carga de datos",
        "text": "Ocurrio un error al cargar los profesores: " + profesors.errors,
        "icon": "error",
        "button": ["Oh noo!"]
      });
    }
  }


  $("#college").on("change", async function (){
    const college_id = $(this).val();
    const subjects = await getData("Subjects",college_id);
    putSubjects(subjects);
    const profesors = await getData("Profesors", college_id);
    putProfesors(profesors);
  });

  $("#subject").on("change", async function(){
    const college_id = $("#college").val();
    if(college_id != ""){
      const subject_id = $(this).val();
      const profesors = await getData("Profesors", college_id + "/" + subject_id);
      putProfesors(profesors);
    }else{
      swal({
        "title": "Primero debes seleccionar un colegio",
        "icon": "warning",
        "button": "ok"
      });
    }
  });

  document.getElementById("file").onchange = function(e) {
    let reader = new FileReader();
    
    reader.onload = function(){
      let preview = document.getElementById('preview'),
          image = document.createElement('img');

      image.src = reader.result;
      
      preview.innerHTML = '';
      preview.append(image);
    };
  
    reader.readAsDataURL(e.target.files[0]);
    $("#photoName").html(e.target.files[0].name);
  }
