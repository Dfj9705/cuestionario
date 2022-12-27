<?php
//call main fpdf file
require('../fpdf/fpdf.php');

//create new class extending fpdf class
class PDF_MC_Table extends FPDF {

// variable to store widths and aligns of cells, and line height
var $widths;
var $aligns;
var $lineHeight;


//Set the array of column widths
function SetWidths($w){
    $this->widths=$w;
}



//Set the array of column alignments
function SetAligns($a){
    $this->aligns=$a;
}

//Set line height
function SetLineHeight($h){
    $this->lineHeight=$h;
}

//Calculate the height of the row
function Row($data, $fill, $border)
{
    // number of line
    $nb=0;

    // loop each data to find out greatest line number in a row.
    for($i=0;$i<count($data);$i++){
        // NbLines will calculate how many lines needed to display text wrapped in specified width.
        // then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    }
    
    //multiply number of line with line height. This will be the height of current row
    $h=$this->lineHeight * $nb;

    //Issue a page break first if needed
    $this->CheckPageBreak($h);

    //Draw the cells of current row 
    for($i=0;$i<count($data);$i++)
    {
        // width of the current col
        $w=$this->widths[$i];
        // alignment of the current col. if unset, make it left.
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        if($border == true){

            $this->Rect($x,$y,$w,$h);
        }
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a, $fill);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //calculate the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

function Rotate($angle,$x=-1,$y=-1)
{
    if($x==-1)
        $x=$this->x;
    if($y==-1)
        $y=$this->y;
    if($this->angle!=0)
        $this->_out('Q');
    $this->angle=$angle;
    if($angle!=0)
    {
        $angle*=M_PI/180;
        $c=cos($angle);
        $s=sin($angle);
        $cx=$x*$this->k;
        $cy=($this->h-$y)*$this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
    }
}

function RotatedText($x,$y,$txt,$angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}


function Header()
    {
        // $fechaactual = date("d/m/Y h:i:s");
        // $this->SetFont('Arial','B',14);
        // $this->SetTextColor(206,36,0);
        // $this->Cell(0,10,utf8_decode('RESERVADO'),0,1,'C');
        // $this->SetTextColor(0,0,0);
        // // $this->Cell(80);
        // $this->Cell(0,5,utf8_decode('DIRECCIÓN DE RELACIONES CIVILES Y MILITARES'),0,1,'C');
        // // $this->Cell(80);
        // $this->SetFont('Arial','',8);
        // // $this->Cell(0,5,utf8_decode("GENERADO POR: ".$_SESSION["nombreUser"]),0,1,'C');
        // // $this->Cell(80);
        // $this->Cell(0,5,utf8_decode("FECHA DE GENERACIÓN: ".$fechaactual),0,1,'C');
        // $this->Ln(2);
    
    }

    function comprobarAlto(){
        return $this->PageBreakTrigger - $this->GetY() < 75; 
    }

    // Pie de página
    function Footer()
    {
        
        // $this->SetY(-25);

       
        // $this->SetFont('Arial','B',8);
       
        // // $this->Cell(80);
        // $this->Cell(0,10,utf8_decode('HOJA ').$this->PageNo().' DE {nb}',0,1,'C');
        // $this->SetFont('Arial','B',16);
        // // $this->Cell(80);
        // $this->SetTextColor(206,36,0);
        // $this->Cell(0,10,utf8_decode('RESERVADO'),0,1,'C');
    }
}
?>
