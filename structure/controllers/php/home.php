<?php 

require_once("procedures.php");

class Home extends Controller{
    public function __construct(){
        parent::__construct();
        $this->render();
    }

    public function render(){
        $this->view->render("home/index");
    }

    public function student(){
        $this->prepareStudentInfo();
        $this->view->render("home/student");
    }

    public function prepareStudentInfo(){
        $std = new Student();
        
        $photo = $this->model->getphotoPath($this->getUser());

        if($photo->data != null){
            $path = constant("CONFIG")["photoPath"] . "p" . $this->getCampus() . "/" .  $photo->data;
        }else{
            $path = constant('CONFIG')['url'] . "resources/images/defaultPhoto.png";
        }

        $info = $this->model->getAllInfo($this->getUser());
 
        $std->photo = $path;
        $std->name = $this->getUserName();
        $std->accaunt = $this->getUser();

        $extraInfo = $info->data;

        $this->view->uei = $extraInfo;
        $this->view->user = $std;
    }

    public static function stringFormat($std){
        return utf8_decode(strtoupper($std));
    }

    public function getProofOfRegistration($params){

        if($_SESSION['userName'] != "god"){
            if(!App::varValidate($_SESSION['user'],$_SESSION['campus'])){
                $err = new ManageError("Accesso denegado");
                die();
            }
        }

        $res = new ServiceResult();

        $campus = (int) $this->desinfect($params[0]);
        $user = (string) $this->desinfect($params[1]);

        if(App::varValidate($campus, $user)){

            $data = $this->model->get_PDF_Data($campus, $user);

            if($data->success){

                $std = $data->data;

                $procedures = new Procedures();
                $procedures->loadModel('procedures');
                $colName = $procedures->getOneCollege($std->college);
                $subName = $procedures->getOneSubject($std->college, $std->subject);
                $profName = $procedures->getOneProfesor($std->college, $std->subject, $std->profesor);
                
                require_once("structure/controllers/PDF/tFPDF/tfpdf.php");
                require_once("structure/controllers/PDF/pdf/code128.php");

                $pdf = new PDF_Code128('p','mm','letter');
                $pdf->AddPage();

                $width = 110;
                $middle = $width/2;
                $photoPath = constant("CONFIG")["photoPath"] . "p" . $campus . "/" . $std->photo["name"];

                $pdf->image('resources/images/unamN.png',20,18,20);
                $pdf->image('resources/images/jovenes.png', 180, 15, 16);

                $text = utf8_decode('Dirección General de Divulgación de la Ciencia');
                $text2 = utf8_decode('Jovenes Hacia La Investigación');
                $text3 = 'Escuela Nacional Preparatoria Plantel 8, Miguel E. Schulz';
                $text4 = utf8_decode('Comprobante de inscripción al programa');

                $pdf->SetFont('Arial','',10);
                $pdf->text('47','20',$text);
                $pdf->text('47','25',$text2);
                $pdf->text('47','30',$text3);

                $pdf->setLineWidth(0.9);
                $pdf->line('47', '33', '195', '33');

                $pdf->SetFont('Arial','B',12);
                $pdf->text('47','40',$text4);

                $pdf->line('47', '43', '195', '43');

                $pdf->SetFont('Arial','',12);
                $pdf->text('30', '60', "Datos del alumno");
                $pdf->text(115, 60, utf8_decode('Área de interés'));
                $pdf->text(115, 120, 'Fecha de registro');
                $pdf->text(30, 195,  utf8_decode("Dirección"));
                $pdf->text(146, 210, utf8_decode('Fecha de emisión'));
                $pdf->image($photoPath, 30, 70, 35);

                //Labels
                $pdf->setFont('Arial', 'B', 10);

                    //Student data
                    $pdf->text(30, 110, 'Nombre: ');//linea 1
                    $pdf->text(30, 117, 'Fecha de nacimiento: ');
                    $pdf->text(30, 123, utf8_decode('Número de cuenta: '));//linea 3
                    $pdf->text(30, 129, 'Grado: ');//linea 4
                    $pdf->text(30, 135, 'Grupo: ');//linea 5
                    $pdf->text(30, 142, 'Turno: ');//...
                    //plus data
                    $pdf->text(30,150, utf8_decode('Teléfono fijo: '));
                    $pdf->text(30,157, utf8_decode('Teléfono celular: '));
                    $pdf->text(30,164, utf8_decode('Correo electrónico: '));
                    $pdf->text(30,171, utf8_decode('Nombre del padre o tutor: '));

                    $pdf->setLineWidth(0.1);    
                    $pdf->line(30, 182, 195, 182);

                    //Area
                    $pdf->text(115, 70, 'Colegio: ');
                    $pdf->text(115,84, 'Asignatura: ');
                    $pdf->text(115,98, 'Profesor promotor: ');

                    //Address
                    $pdf->text(30,205,'Calle: ');
                    $pdf->text(30,212, 'Colonia: ');
                    $pdf->text(30,219, utf8_decode('Código postal: '));
                    $pdf->text(30,226, utf8_decode('Delegación: '));
                    $pdf->text(30,233,'Cuidad: ');

                //Data
                $pdf->setFont('Arial', '', 10);
                
                    //Student data
                    $pdf->text(50, 110, $this->stringFormat($std->name));//linea 1
                    $pdf->text(69, 117, $std->bornDate);
                    $pdf->text(67, 123, $std->accaunt);//linea 3
                    $pdf->text(48, 129, $this->stringFormat($std->grade . "°"));//linea 4
                    $pdf->text(48, 135, $std->group);
                    $pdf->text(48, 142, $this->stringFormat($std->getStringTurn()));

                    //Plus data
                    $pdf->text(60, 150, $std->phone);
                    $pdf->text(65, 157, $std->mobil);
                    $pdf->text(70, 164, $std->email);
                    $pdf->text(80, 171, $this->stringFormat($std->tutor));

                    //Area
                    $pdf->text(115,77,$this->stringFormat($std->college . " - " . $colName));
                    $pdf->text(115,91,$this->stringFormat($std->subject . " - " . $subName));
                    $pdf->text(115,105,$this->stringFormat($std->profesor . " - " . $profName));

                    //Date
                    $time = strtotime($std->registrationDate);
                    $newTime = date("d/m/Y", $time) . " a las " . date("h:i A", $time) . " horas";
                    $pdf->text(115, 130, $newTime);

                    //Address data
                    $pdf->text(45, 205, $this->stringFormat($std->street));
                    $pdf->text(50, 212, $this->stringFormat($std->colony));
                    $pdf->text(60, 219, $std->postalCode);
                    $pdf->text(55, 226, $this->stringFormat($std->townHall));
                    $pdf->text(50, 233, $this->stringFormat($std->city));


                $pdf->text(146, 220, strftime('%d/%m/%Y'));
                $pdf->Code128(146,225,$std->accaunt,40,10);

                $pdf->Output('Comprobante de registro.pdf','I');

            }else{
                $res->errors = $data->errors;
                $res->messages = "Hubo un error al encontrar los datos de este usuario";
                echo json_encode($res);
            }
        }else{
            $res->errors = "The received data is wrong";
            echo json_encode($res);
        }
    }
}

?>