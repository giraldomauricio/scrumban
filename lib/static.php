<?
// This function converts numbers in money format
function money($number)
{
	return "$".number_format($number/100,2);
}
/**
* @author Mauricio Giraldo
* @desc This function redirects the user via JS
* @version 1.0 06/14/2010
*/
function jsheader($location)
{
    $location = str_replace("Location: ","", $location);
	print "<script>\n";
	print "window.location = \"".$location."\";\n";
	print "</script>\n";
}
/**
* @author Mauricio Giraldo
* @desc This function creates a JavaScript alert
* @version 1.0 06/14/2010
*/
function alert($text)
{
	print "<script>\n";
	print "alert(\"".$text."\");\n";
	print "</script>\n";
}
function renderPDF($id,$mode)
{
	$pdf = new FPDI();
	
	$db_catalogue_pages = new catalogue_pages;
	$db_catalogue_pages->get_one_catalogue_pages($id);
	$db_catalogue_pages->load();
	$template_id = $db_catalogue_pages->get_pag_template();
	
	$template = new catalogue_templates;

	$template->getOne($template_id);
	$template->load();

	$pdf->addPage("Landscape","Letter");

	$db_catalogue_objects = new catalogue_objects;
	$db_catalogue_objects->get_all($id);

	$pdf->SetFont('Arial','',14);

	$pdf->Image("pdftemplates/".$template->get_tem_file().".jpg",0,0);
	while($db_catalogue_objects->load())
	{
		$var = explode("_",$db_catalogue_objects->get_obj_var());
		if($var[0] == "image")
		{
			if(file_exists($db_catalogue_objects->field->obj_image)) $pdf->Image($db_catalogue_objects->field->obj_image,($db_catalogue_objects->field->obj_posx*0.353),($db_catalogue_objects->field->obj_posy*0.353),"50","50");
		}
		$pdf->SetXY($db_catalogue_objects->field->obj_posx*0.353,($db_catalogue_objects->field->obj_posy*0.35) + 60);
		$pdf->Write(5,$db_catalogue_objects->field->obj_text);
	}

	$db_catalogue_objects->close();
	$db_catalogue_pages->close();
	//if($mode=="I") $pdf->Output("page_".$id.".pdf", "I");
	//else $pdf->Output("pages/page_".$id.".pdf", "F");
	$pdf->Output("pages/page_".$id.".pdf", "F");
	
}
?>