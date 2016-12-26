<?php
if( ! function_exists('exportToExcel'))
{
    function exportToExcel($aData, $filename = 'report')
    {
        $keys = array_keys($aData[0]);
        $countKeys = count($keys);

        $objPHPExcel = new \PHPExcel();
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objPHPExcel->getProperties()->setCreator('Prueba');
        $objPHPExcel->setActiveSheetIndex(0);

        // Titulos de columna
        for ($i=0;$i < count($keys);$i++)
        {
            $column = strtoupper(base_convert(10 + $i, 10, 36));
            $objPHPExcel->getActiveSheet()->SetCellValue($column.'1',$keys[$i]);
        }

        $countData = count($aData);

        for ($i=0;$i < $countData;$i++)
        {
            for ($j=0;$j < $countKeys;$j++)
            {
                $column = strtoupper(base_convert(10 + $j, 10, 36));
                $aux = isset($aData[$i][$keys[$j]]) ? $aData[$i][$keys[$j]] : '';
                $objPHPExcel->getActiveSheet()->SetCellValue($column.($i+2),$aux);
            }
        }

        $objPHPExcel->getSecurity()->setLockWindows(true);
        $objPHPExcel->getSecurity()->setLockStructure(true);

        $objSheet = $objPHPExcel->getActiveSheet();

        $objSheet->getStyle('A1:Z1')->getFont()->setBold(true)->setSize(12);

        $excel_file = FILE_PATH . $filename . '_' . date('Ymdhis') . '.xlsx';
        $objWriter->save($excel_file);
    }
}