<?php
require('fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        global $title,$sub,$sub2;
        $this->Image('logo.png',135,10,26);
        $this->SetFont('Helvetica','',24);
        $this->SetTextColor(244,67,54);
        $titleCenter = $this->GetStringWidth($title)+6;
        $subCenter = $this->GetStringWidth($sub)+6;
        $sub2Center = $this->GetStringWidth($sub2)+6;
        $this->SetX((295-$titleCenter)/2);
        $this->Cell($titleCenter,60,$title,0,1,'C');
        $this->SetFont('Helvetica','',10);
        $this->SetX((295-$subCenter)/2);
        $this->Cell($subCenter,-35,strtoupper($sub),0,1,'C');
        $this->Ln(15);
        $this->SetX((295-$sub2Center)/2);
        $this->Cell($sub2Center,15,strtoupper($sub2),0,1,'C');
        $this->Ln(0);
        $this->SetFillColor(244,67,54);
        $this->Cell(277,0.1,'',0,1,'C',true);
        $this->Ln(5);
    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Helvetica','B',8);
        $this->SetTextColor(244,67,54);
        $this->Cell(0,10,'SCOREDUINO | '.$this->PageNo(),0,0,'C');
    }
function FancyTable($header, $data,$type,$col="")
{
    global $numset;
    $this->SetFillColor(244,67,54);
    $this->SetTextColor(255);
    $this->SetDrawColor(255,255,255);
    $this->SetLineWidth(.3);
    $this->SetFont('Helvetica','',10);
    // Header
    switch ($type) {
        case 'user': $w = array(7,54, 84, 84, 24, 24); break;
        case 'sports': $w = array(7,90,90,90); break;
        case 'teams': $w = array(7,90,90,90); break;
        case 'leagues': $w = array(7,135,135); break;
        case 'matches': $w = array(7,54,54,54,54,54); break;
        case 'matchmain': 
        $size = (270/$col);
        $w = array(7);
        for($x = 1; $x <= $col; $x++){
                array_push($w,$size);
        }
        break;
        default:break;
    }
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],10,strtoupper($header[$i]),1,0,'C',true);
    $this->Ln();
    $this->SetFillColor(255,228,226);
    $this->SetTextColor(244,67,54);
    $this->SetFont('');
    // Data
    $fill = false;
    $x = 1;
    foreach($data as $row)
    {
        $this->SetFont('Helvetica','',11);
            $this->Cell($w[0],10,'','LR',0,'L',$fill);
            switch ($type) {
                case 'user':
                            $this->Cell($w[1],10,$row[0],'LR',0,'L',$fill);
                            $this->Cell($w[2],10,$row[1].' '.substr($row[2],0,1).'. ','LR',0,'L',$fill);
                            $this->Cell($w[3],10,$row[3],'LR',0,'L',$fill);
                            $this->Cell($w[4],10,$row[4],'LR',0,'L',$fill);
                            $this->Cell($w[5],10,$row[5],'LR',0,'L',$fill);
                    break;
                    case 'sports':
                            $this->Cell($w[1],10,$row[0],'LR',0,'L',$fill);
                            $this->Cell($w[2],10,$row[1].' minute'.(($row[1] > 1)?'s':''),'LR',0,'L',$fill);
                            $this->Cell($w[3],10,$row[2].' session'.(($row[2] > 1)?'s':''),'LR',0,'L',$fill);
                    break;
                    case 'teams':
                            $this->Cell($w[1],10,$row[0],'LR',0,'L',$fill);
                            $this->Cell($w[2],10,$row[1],'LR',0,'L',$fill);
                            $this->Cell($w[3],10,$row[2],'LR',0,'L',$fill);
                    break;
                    case 'leagues':
                            $this->Cell($w[1],10,$row[0],'LR',0,'L',$fill);
                            $this->Cell($w[2],10,$row[1],'LR',0,'L',$fill);
                    break;
                    case 'matches':
                            $dateTime = new DateTime($row[4]);
                            $team1 = (is_null($row[6])? 0 :$row[6]);
                            $team2 = (is_null($row[7])? 0 :$row[7]);
                            $this->Cell($w[1],10,$row[0].' VS '.$row[1],'LR',0,'L',$fill);
                            $this->Cell($w[2],10,$row[2].' - '.$row[3],'LR',0,'L',$fill);
                            $this->Cell($w[3],10,$row[5],'LR',0,'L',$fill);
                            $this->Cell($w[4],10,$dateTime->format('m/d/Y').' '.$dateTime->format('h:i A'),'LR',0,'L',$fill);

                            $this->Cell($w[5],10,($row[8] == "Finished")? $team1.' - '.$team2 : $row[8],'LR',0,'L',$fill);
                    break;
                    case 'matchmain':
                            for ($x=1, $y = 0; $x<= $col; $x++, $y++) { 
                            $this->Cell($w[$x],10,is_null($row[$y])?'0':$row[$y],'LR',0,'L',$fill);
                            }
                    break;
                default: break;
            }
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
    function ChapterTitle($num, $label)
    {
        $this->SetFont('Arial','',12);
        $this->SetFillColor(200,220,255);
        $this->Cell(0,10,"Chapter $num : $label",0,1,'L',true);
        $this->Ln(4);
    }

    function ChapterBody($file)
    {
        $txt = file_get_contents($file);
        $this->SetFont('Helvetica','',12);
        $this->MultiCell(0,5,$txt);
        $this->Ln();
        $this->SetFont('','I');
        $this->Cell(0,5,'(end of excerpt)');
    }

    function PrintChapter($num, $title, $file)
    {
        $this->AddPage();
        $this->ChapterTitle($num,$title);
        $this->ChapterBody($file);
    }
    //haha
        function WriteHTML($html)
        {
            // HTML parser
            $html = str_replace("\n",' ',$html);
            $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
            foreach($a as $i=>$e)
            {
                if($i%2==0)
                {
                    // Text
                    if($this->HREF)
                        $this->PutLink($this->HREF,$e);
                    else
                        $this->Write(5,$e);
                }
                else
                {
                    // Tag
                    if($e[0]=='/')
                        $this->CloseTag(strtoupper(substr($e,1)));
                    else
                    {
                        // Extract attributes
                        $a2 = explode(' ',$e);
                        $tag = strtoupper(array_shift($a2));
                        $attr = array();
                        foreach($a2 as $v)
                        {
                            if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                                $attr[strtoupper($a3[1])] = $a3[2];
                        }
                        $this->OpenTag($tag,$attr);
                    }
                }
            }
        }

        function OpenTag($tag, $attr)
        {
            // Opening tag
            if($tag=='B' || $tag=='I' || $tag=='U')
                $this->SetStyle($tag,true);
            if($tag=='A')
                $this->HREF = $attr['HREF'];
            if($tag=='BR')
                $this->Ln(5);
        }

        function CloseTag($tag)
        {
            // Closing tag
            if($tag=='B' || $tag=='I' || $tag=='U')
                $this->SetStyle($tag,false);
            if($tag=='A')
                $this->HREF = '';
        }

        function SetStyle($tag, $enable)
        {
            // Modify style and select corresponding font
            $this->$tag += ($enable ? 1 : -1);
            $style = '';
            foreach(array('B', 'I', 'U') as $s)
            {
                if($this->$s>0)
                    $style .= $s;
            }
            $this->SetFont('',$style);
        }
}
