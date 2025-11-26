<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .ticket { width: 100%; max-width: 600px; margin: auto; border: 1px solid #333; padding: 20px; }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 10px; }
        .row { display: flex; justify-content: space-between; margin-bottom: 5px; }
        .bold { font-weight: bold; }
    </style>
</head>
<body>
<div class="ticket">
    <div class="title">Талон на очередь № {{ $data['queue_number'] }}</div>
    <div class="row"><span>Тип очереди:</span><span>{{ $data['queue_type'] }}</span></div>
    <div class="row"><span>Квартира:</span><span>{{ $data['apartment_type'] }}</span></div>
    <div class="row"><span>Ф.И.О.:</span><span class="bold">{{ $data['full_name'] }}</span></div>
    <div class="row"><span>Телефон:</span><span class="bold">{{ $data['phone_number'] }}</span></div>
    <div class="row"><span>Ежемесячный платёж:</span><span>{{ $data['monthly_payment'] }}</span></div>
    @if($data['down_payment'])
        <div class="row"><span>Первоначальный взнос:</span><span>{{ $data['down_payment'] }}</span></div>
    @endif
    <div class="row"><span>Менеджер:</span><span class="bold">{{ $data['manager'] }}</span></div>
</div>
</body>
</html>
