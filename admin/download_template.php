<?php
require_once __DIR__ . '/auth.php';
// download_template.php
// This file generates and downloads an Excel template for bulk user upload

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="user_upload_template.xlsx"');
header('Cache-Control: max-age=0');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set sheet title
$sheet->setTitle('User Upload Template');

// Set column headers
$headers = ['Name', 'Email', 'Password', 'Department', 'User Type'];
$column = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($column . '1', $header);
    $column++;
}

// Style header row
$headerStyleArray = [
    'font' => [
        'bold' => true,
        'size' => 12,
        'color' => ['rgb' => 'FFFFFF']
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '4472C4']
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ]
];

$sheet->getStyle('A1:E1')->applyFromArray($headerStyleArray);

// Add sample data
$sampleData = [
    ['John Doe', 'john.doe@example.com', 'password123', 'Computer Science', 'student'],
    ['Jane Smith', 'jane.smith@example.com', 'securePass456', 'Electronics', 'student'],
    ['Robert Johnson', 'robert.j@example.com', 'myPassword789', 'Mechanical', 'faculty'],
];

$row = 2;
foreach ($sampleData as $data) {
    $column = 'A';
    foreach ($data as $value) {
        $sheet->setCellValue($column . $row, $value);
        $column++;
    }
    $row++;
}

// Add instructions in a separate sheet
$instructionSheet = $spreadsheet->createSheet();
$instructionSheet->setTitle('Instructions');

$instructions = [
    ['BULK USER UPLOAD INSTRUCTIONS'],
    [''],
    ['Column Requirements:'],
    ['1. Name', 'Full name of the user (minimum 2 characters)'],
    ['2. Email', 'Valid email address (must be unique)'],
    ['3. Password', 'Minimum 8 characters'],
    ['4. Department', 'Must be one of: Computer Science, Electronics, Mechanical, Civil, MBA, MCA'],
    ['5. User Type', 'Must be one of: student, parent, faculty'],
    [''],
    ['Important Notes:'],
    ['• First row must contain headers (do not modify)'],
    ['• All fields are required'],
    ['• Email addresses must be unique'],
    ['• Passwords will be securely encrypted upon upload'],
    ['• Department names are case-sensitive'],
    ['• User types should be lowercase'],
    [''],
    ['Valid Department Values:'],
    ['Computer Science'],
    ['Electronics'],
    ['Mechanical'],
    ['Civil'],
    ['MBA'],
    ['MCA'],
    [''],
    ['Valid User Type Values:'],
    ['student'],
    ['parent'],
    ['faculty'],
];

$instructionRow = 1;
foreach ($instructions as $instruction) {
    $instructionSheet->setCellValue('A' . $instructionRow, $instruction[0]);
    if (isset($instruction[1])) {
        $instructionSheet->setCellValue('B' . $instructionRow, $instruction[1]);
    }
    $instructionRow++;
}

// Style instruction title
$instructionSheet->getStyle('A1')->applyFromArray([
    'font' => [
        'bold' => true,
        'size' => 14,
        'color' => ['rgb' => '1e3c72']
    ]
]);

// Style section headers
$instructionSheet->getStyle('A3')->getFont()->setBold(true);
$instructionSheet->getStyle('A10')->getFont()->setBold(true);
$instructionSheet->getStyle('A17')->getFont()->setBold(true);
$instructionSheet->getStyle('A24')->getFont()->setBold(true);

// Auto-size columns in both sheets
foreach (range('A', 'E') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}
foreach (range('A', 'B') as $col) {
    $instructionSheet->getColumnDimension($col)->setAutoSize(true);
}

// Set active sheet back to the template
$spreadsheet->setActiveSheetIndex(0);

// Generate and output the file
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>