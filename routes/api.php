<?php

Route::get('/student', 'CaptureTableDataController@getTableData');
Route::post('/form', 'CaptureTableDataController@addDataTable');
Route::get('/download', 'FileController@downloadFile');
Route::get('/readingPDF', 'ReadingPDFController@readingPDF');


