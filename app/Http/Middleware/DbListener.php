<?php

namespace App\Http\Middleware;

use App\Models\LogEvent;
use Closure;
use App\Models\LogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Events\QueryExecuted;
use Symfony\Component\HttpFoundation\Response;

class DbListener
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = auth('api')->user()?->id;

        $route = $request->route()->getName();

        $logRequest = LogRequest::create([
            'user_id' => $userId,
            'route' => $route,
            'status' => null,
            'message' => null,
        ]);

        $actions = ['select' => 0, 'insert' => 0, 'update' => 0, 'delete' => 0];
        $logBuffer = [];

        DB::listen(function (QueryExecuted $query) use (&$actions, &$logBuffer, $logRequest) {
            if (str_contains($query->sql, 'log_events') || str_contains($query->sql, 'log_requests')) {
                return;
            }

            $rawSql = $query->toRawSql();
            $sql = trim($rawSql, " \t\n\r\0\x0B\"'");
            $eventType = strtolower(strtok($sql, " "));

            if (isset($actions[$eventType])) {
                $actions[$eventType]++;
            }

            $logBuffer[] = [
                'event_type' => $eventType,
                'sql_query' => $rawSql,
                'time' => $query->time / 1000,
                'log_request_id' => $logRequest->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        $response = $next($request);

        // Теперь SQL-запросы уже выполнены, можно логировать
        if (!empty($logBuffer)) {
            LogEvent::insert($logBuffer);
        }

        // Обновляем лог-запрос с результатами
        $logRequest->update([
            'status' => $response->getStatusCode(),
            'message' => method_exists($response, 'getContent') ? $response->getContent() : null,
            'select_count' => $actions['select'],
            'insert_count' => $actions['insert'],
            'update_count' => $actions['update'],
            'delete_count' => $actions['delete'],
        ]);

        return $response;
    }
}
