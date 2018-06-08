<?php
$data = array_map('str_getcsv', file('vehicle-info.csv'));
array_shift($data);

$yearParam = htmlspecialchars($_GET["year"]);
$makeParam = htmlspecialchars($_GET["make"]);
$modelParam = htmlspecialchars($_GET["model"]);

$yearData = [];   //dateYear 0
$makeData = [];   //strMake  1
$modelData = [];  //strModel 2

foreach($data as $csv_row){
    if(!in_array($csv_row[0],$yearData)){ array_push($yearData,$csv_row[0]);}
    
    if($yearParam == $csv_row[0]){
        $makeName = str_replace(" ","-",$csv_row[1]);
        if(!in_array($makeName,$makeData)){ array_push($makeData,$makeName);}
        
        if($makeParam == $makeName){
            if(!in_array($csv_row[2],$modelData)){ array_push($modelData,$csv_row[2]);}
        }
    }   
        
}

sort($makeData);
sort($modelData);

$yearOpt = '<select id="vehicleYear"><option value="">Select Year</option>';   
$makeOpt = '<select id="vehicleMake"><option value="">Select Make</option>';   
$modelOpt = '<select id="vehicleModel"><option value="">Select Model</option>'; 

foreach($yearData as $opt){
    $selected = "";
    if($opt == $yearParam){$selected = "selected";}
    $yearOpt .= '<option value="'.$opt.'" '.$selected.'>'.$opt.'</option>';
}
foreach($makeData as $opt){
    $selected = "";
    if($opt == $makeParam){$selected = "selected";}
    $makeOpt .= '<option value="'.$opt.'" '.$selected.'>'.$opt.'</option>';
}
foreach($modelData as $opt){
    $selected = "";
    if($opt == $makeParam){$selected = "selected";}
    $modelOpt .= '<option value="'.$opt.'" '.$selected.'>'.$opt.'</option>';
}

$yearOpt .= '</select>';
$makeOpt .= '</select>';
$modelOpt .= '</select>';

$modx->setPlaceholders(array(
   'year' => $yearOpt,
   'make' => $makeOpt,
   'model' => $modelOpt
),'csv.');
