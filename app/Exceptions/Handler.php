<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable; // Certifique-se de importar Throwable aqui

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception) // Alterado para usar Throwable
    {
        // Se for uma exceção HTTP
        if ($this->isHttpException($exception)) {
            return response()->json([
                'error' => 'Ocorreu um erro na sua solicitação.',
                'code' => $exception->getStatusCode(), // Código do erro
            ], $exception->getStatusCode());
        }

        // Exceções específicas que você pode querer tratar
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response()->json([
                'error' => 'Recurso não encontrado.',
            ], 404);
        }

        // Exceção de validação
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
                'error' => 'Dados de entrada inválidos.',
                'messages' => $exception->validator->errors(), // Erros de validação
            ], 422);
        }

        // Para todas as outras exceções, retornar uma mensagem genérica
        return response()->json([
            'error' => 'Erro inesperado. Tente novamente mais tarde.',
            'message' => env('APP_ENV') === 'local' ? $exception->getMessage() : null, // Mostrar detalhes apenas em local
        ], 500);
    }
}
