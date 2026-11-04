<?php
function exportCsv(string $filename, array $headers, array $rows):void{
    if(ob_get_level()){
        ob_end_clean();
    }

    $safename = preg_replace('/[^A-Za-z0-9_\-]/','_',$filename);
    $safename .= '_' .date('Y-m-d_His') . '.csv';
    
    header('Content-Type: text/csv;charset=utf-8');
    header('Content-Disposition: attachment; filename="'.$safename.'"');
    header('Pragma: no cache');
    header('Expires:0');

    $out = fopen('php://output','w');

    fwrite($out, "\xEF\xBB\xBF");

    fputcsv($out, $headers);

    foreach ($rows as $row){
        fputcsv($out, array_values($row));
    }

    fclose($out);

    exit;
}
?>