<?php
include 'conexion.php';
require ('
	');

class PDF extends FPDF
{
	//Creando una cabecera
	function Header()
	{
		$this->Image('../img/conalep.png', 10,10,30);
		//Establecer Tamaño
		$this->setFont('Arial','B',12);
		$this->Text(45,20,'Colegio Nacional de Educacion Profesional Tecnica');
		$this->Text(90,24,'Formato de citas');

	} //Funcion

}//de la clase

//Crear el objeto para llamar a los metodos

$pdf= new PDF();
$pdf->AddPage(); //agregar pagina
$pdf->setFont('Arial','B',10);

//Puedes agregar el contenido de citas, por ejemplos:
$pdf->Text(10, 50, 'Contenido de la cita');
$pdf->Text(90,27,"Formato para el cliente");
//dibujar un triangulo
$pdf->Rect(10,50,180,30,'D');
$pdf->Rect(10,82,180,30,'D');
$pdf->Line(15,112,15,150);
$pdf->Line(15,100,150,100);



//Limpiar el bufer antes de enviar el pdf
ob_end_clean();
//Mandar al navegador el archivo
$pdf->Output("formato1.pdf", "I");//D=Descargar , I=En linea
 

?> //cerramos el PHP