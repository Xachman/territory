<?php
Configure::write('CakePdf', [
        'engine' => 'CakePdf.WkHtmlToPdf',
        'margin' => [
            'bottom' => 15,
            'left' => 50,
            'right' => 30,
            'top' => 45
        ],
        'orientation' => 'landscape',
        'download' => true
    ]);