<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        SampleIgnoreException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
                // disini kita bisa kirim error ke telegram, email, slack atau lainnya yang memungkinkan anda mendapatkan notifikasi
    
                $data = array(
                    'chat_id' => 586909683,
                    'text' => $e->getMessage()
                );
        
                $ch = curl_init('https://api.telegram.org/bot6691525318:AAHdoJ5qu5_DDMvZupVZF7mKdKlw49wzkgU/sendMessage');
        
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
                $result = curl_exec($ch);
        
                if (curl_errno($ch)) {
                    echo 'Error: ' . curl_error($ch);
                }
        
                curl_close($ch);

        });

        // custom page error
        $this->renderable(function (SampleIgnoreException $validationException){
            return response("Bad Request", 400);
        });


    }
}
