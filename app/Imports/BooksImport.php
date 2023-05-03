<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Notifications\ExcelImportHasFailedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\ImportFailed;
use Maatwebsite\Excel\Validators\ValidationException;

class BooksImport implements ToModel, 
                            SkipsEmptyRows, 
                            WithBatchInserts, 
                            WithChunkReading, 
                            ShouldQueue, 
                            WithEvents,
                            WithValidation
{
    public $importedBy;

    public function __construct(User $importedBy)
    {
        $this->importedBy = $importedBy;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category = Category::firstOrCreate([
            'title' => $row[2]
        ]);

        return new Book([
            'title' => $row[0],
            'author' => $row[1], 
            'category_id' => $category->id,
        ]);
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string|max:255',
            '1' => 'required|string|max:255',
            '2' => 'required|string|max:255',
            '3' => 'nullable|string|max:1000',
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => 'title',
            '1' => 'author',
            '2' => 'category',
            '3' => 'description',
        ];
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function(ImportFailed $event) {
                $e = $event->getException();
                $message = $e->getMessage();

                if ($e instanceof ValidationException) {
                    $failures = $e->failures();
    
                    $message = '';
                    foreach ($failures as $failure) {
                        $row = $failure->row();
                        $error = $failure->errors()[0];

                        $message .= "Row: $row -> $error \n";
                    }
                }

                $this->importedBy->notify(new ExcelImportHasFailedNotification($message));
            }     
        ];
    }
}
