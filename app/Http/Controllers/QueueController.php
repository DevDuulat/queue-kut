<?php

namespace App\Http\Controllers;

use App\Enums\QueueType;
use App\Http\Requests\StoreQueueRequest;
use App\Models\Queue;
use App\Services\QueueService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class QueueController extends Controller
{
    public function index()
    {
        $curators = Cache::remember('curators', 3600, function () {
            $response = Http::get(config('services.curators.url'));
            return $response->successful() ? $response->json() : [];
        });

        return view('queue.index', compact('curators'));
    }

    public function store(StoreQueueRequest $request, QueueService $service)
    {
        $data = $request->validated();

        $result = $service->create($data);

        if ($result['exists']) {
            return back()
                ->with('error', 'Заявка с таким ИНН или номером документа уже существует')
                ->withInput();
        }

        session(['queue_ticket_data' => $result['payload']]);

        return redirect()->back()
            ->with('popup', true)
            ->with('popup_data', $result['payload']);
    }


    public function downloadTicket()
    {
        $data = session('queue_ticket_data');

        if (!$data) {
            return redirect()->back()->with('error', 'Данные талона не найдены');
        }

        $pdf = Pdf::loadView('pdf.queue_ticket', ['data' => $data]);
        return $pdf->download('queue_ticket_'.$data['queue_number'].'.pdf');
    }
}
