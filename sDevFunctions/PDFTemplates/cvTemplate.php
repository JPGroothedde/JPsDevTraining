<?php
/**
 * Created by PhpStorm.
 * User: Johan Griesel (Stratusolve (Pty) Ltd)
 * Date: 2017/02/18
 * Time: 10:07 AM
 */
$Person = Person::QuerySingle(QQ::Equal(QQN::Person()->Id, 1));

    $DisplayString = '<page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 12pt">';
    $DisplayString.= '<table>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td colspan="2"><h1>Curriculum Vitae of '.$Person->FirstName.' '.$Person->Surname.'</h1></td>';
    $DisplayString.= '</tr>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td>ID Number </td>';
    $DisplayString.= '<td>: '.$Person->IDPassportNumber.'</td>';
    $DisplayString.= '</tr>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td>Date Of Birth</td>';
    $DisplayString.= '<td>: '.$Person->DateOfBirth.'</td>';
    $DisplayString.= '</tr>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td>Languages</td>';
    $DisplayString.= '<td></td>';
    $DisplayString.= '</tr>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td>Marital Status</td>';
    $DisplayString.= '<td></td>';
    $DisplayString.= '</tr>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td>Nationality</td>';
    $DisplayString.= '<td></td>';
    $DisplayString.= '</tr>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td>Ethinic Group</td>';
    $DisplayString.= '<td>: '.$Person->EthnicGroup.'</td>';
    $DisplayString.= '</tr>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td>Cell No</td>';
    $DisplayString.= '<td></td>';
    $DisplayString.= '</tr>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td>E-mail Address</td>';
    $DisplayString.= '<td></td>';
    $DisplayString.= '</tr>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td>Alternative Number</td>';
    $DisplayString.= '<td>: '.$Person->AlternativeTelephoneNumber.'</td>';
    $DisplayString.= '</tr>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td>Address</td>';
    $DisplayString.= '<td>: '.$Person->CurrentAddress.'</td>';
    $DisplayString.= '</tr>';
    $DisplayString.= '</table>';
    $DisplayString.= '</page>';

    $DisplayString.= '<page pageset="old">';
    $DisplayString.= '<table>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td colspan="2"><h3>Employment History</h3></td>';
    $DisplayString.= '</tr>';
    $EmploymentArray = EmploymentHistory::QueryArray(QQ::Equal(QQN::EmploymentHistory()->PersonObject->Id, 1));
    if ($EmploymentArray) {
        foreach($EmploymentArray as $Employment) {
            $DisplayString.= '<tr>';
            $DisplayString.= '<td>'.$Employment->EmployerName.'</td>';
            $DisplayString.= '<td>'.$Employment->PeriodStartDate .' - '.$Employment->PeriodEndDate.'</td>';
            $DisplayString.= '</tr>';
            $DisplayString.= '<tr>';
            $DisplayString.= '<td>'.$Employment->Title.'</td>';
            $DisplayString.= '</tr>';
            $DisplayString.= '<tr>';
            $DisplayString.= '<td>'.$Employment->Duties.'</td>';
            $DisplayString.= '</tr>';
        }
    }
    $DisplayString.= '</table>';
    $DisplayString.= '<table>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td colspan="2"><h3>Education</h3></td>';
    $DisplayString.= '</tr>';
    $EducationArray = Education::QueryArray(QQ::Equal(QQN::Education()->PersonObject->Id, 1));
    if ($EducationArray) {
        foreach($EducationArray as $Education) {
            $DisplayString.= '<tr>';
            $DisplayString.= '<td>'.$Education->Institution.'</td>';
            $DisplayString.= '</tr>';
            $DisplayString.= '<tr>';
            $DisplayString.= '<td>'.$Education->StartDate.' - '.$Education->EndDate.'</td>';
            $DisplayString.= '</tr>';
            $DisplayString.= '<tr>';
            $DisplayString.= '<td>'.$Education->Qualification.'</td>';
            $DisplayString.= '</tr>';
        }
    }
    
    $DisplayString.= '</table>';
    $DisplayString.= '</page>';
    
    $DisplayString.= '<page pageset="old">';
    $DisplayString.= '<table>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td colspan="2"><h3>Skills</h3></td>';
    $DisplayString.= '</tr>';
    $SkillsArray = PersonSkillsTag::QueryArray(QQ::Equal(QQN::PersonSkillsTag()->PersonObject->Id, 1));
    if ($SkillsArray) {
        foreach($SkillsArray as $Skill) {
            $DisplayString.= '<tr>';
            $DisplayString.= '<td>'.$Skill->SkillTag.'</td>';
            $DisplayString.= '</tr>';
        }
    }
    
    $DisplayString.= '</table>';
    $DisplayString.= '<table>';
    $DisplayString.= '<tr>';
    $DisplayString.= '<td colspan="2"><h3>References</h3></td>';
    $DisplayString.= '</tr>';
    $ReferenceArray = Reference::QueryArray(QQ::Equal(QQN::Reference()->PersonObject->Id, 1));
    if ($ReferenceArray) {
        foreach($ReferenceArray as $Reference) {
            $DisplayString.= '<tr>';
            $DisplayString.= '<td>'.$Reference->FirstName.' '.$Reference->Surname.'</td>';
            $DisplayString.= '</tr>';
            $DisplayString.= '<tr>';
            $DisplayString.= '<td>'.$Reference->Relationship.'</td>';
            $DisplayString.= '</tr>';
            $DisplayString.= '<tr>';
            $DisplayString.= '<td>'.$Reference->TelephoneNumber.'</td>';
            $DisplayString.= '</tr>';
        }
    }
    
    $DisplayString.= '</table>';
    $DisplayString.= '</page>';
echo $DisplayString;
?>
<style>
    table {
        width: 100%;
    }
    td {
        width: 50%;
        height: 10px;
    }
</style>
