<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture #{{ $facture->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-details {
            margin-bottom: 30px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #f5f5f5;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Facture #{{ $facture->id }}</h1>
    </div>

    <div class="invoice-details">
        <p><strong>Client:</strong> {{ $facture->client->name }}</p>
        <p><strong>Date:</strong> {{ $facture->invoice_date->format('d/m/Y') }}</p>
        <p><strong>Commande #:</strong> {{ $facture->order->id }}</p>
    </div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Commande #{{ $facture->order->id }}</td>
                <td>${{ number_format($facture->total_amount, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="total">
        <p>Total: ${{ number_format($facture->total_amount, 2) }}</p>
    </div>
</body>
</html> 