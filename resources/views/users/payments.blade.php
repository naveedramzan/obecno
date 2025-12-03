@extends('company-admin')
@section('content')
   
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <div class="body-content">
        <div class="overview-content-wrapper">
            <div class="dashboard-section">
                <div class="dashboard-content">
                    <div class="page-header" style="margin-bottom: 32px; width: 100%; max-width: 1200px; margin-left: auto; margin-right: auto; padding: 0 16px; box-sizing: border-box;">
                        <h1 class="page-title" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 24px; line-height: 1.5em; color: #192839;">
                            Payments & Subscriptions
                        </h1>
                        <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #545861; margin-top: 8px;">
                            View your subscription history and payment details
                        </p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success" style="margin-bottom: 24px; padding: 12px 16px; background-color: #D1E7DD; color: #0F5132; border-radius: 8px; border: 1px solid #BADBCC; width: 100%; max-width: 1200px; margin-left: auto; margin-right: auto; padding-left: 16px; padding-right: 16px; box-sizing: border-box;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error" style="margin-bottom: 24px; padding: 12px 16px; background-color: #F8D7DA; color: #842029; border-radius: 8px; border: 1px solid #F5C2C7; width: 100%; max-width: 1200px; margin-left: auto; margin-right: auto; padding-left: 16px; padding-right: 16px; box-sizing: border-box;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="payments-container" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 16px; box-sizing: border-box;">
                        <div class="payments-card" style="width: 100%; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 16px; padding: 32px; box-sizing: border-box;">
                            
                            <div class="company-info" style="margin-bottom: 32px; padding-bottom: 24px; border-bottom: 1px solid #E3E7EB;">
                                <h2 style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 20px; line-height: 1.5em; color: #192839; margin-bottom: 8px;">
                                    Company: {{ $defaultCompany->title }}
                                </h2>
                                <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; line-height: 1.5em; color: #545861;">
                                    Subscription history and payment records
                                </p>
                            </div>

                            @if($invoices->count() > 0)
                                <div class="payments-table-container" style="overflow-x: auto;">
                                    <table class="payments-table" style="width: 100%; border-collapse: collapse;">
                                        <thead>
                                            <tr style="background-color: #F7F9FA; border-bottom: 2px solid #E3E7EB;">
                                                <th style="padding: 16px; text-align: left; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; color: #192839; white-space: nowrap;">
                                                    Package
                                                </th>
                                                <th style="padding: 16px; text-align: left; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; color: #192839; white-space: nowrap;">
                                                    Discount
                                                </th>
                                                <th style="padding: 16px; text-align: left; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; color: #192839; white-space: nowrap;">
                                                    Invoice Date
                                                </th>
                                                <th style="padding: 16px; text-align: left; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; color: #192839; white-space: nowrap;">
                                                    Expiry Date
                                                </th>
                                                <th style="padding: 16px; text-align: right; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; color: #192839; white-space: nowrap;">
                                                    Amount
                                                </th>
                                                <th style="padding: 16px; text-align: left; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; color: #192839; white-space: nowrap;">
                                                    Payment Status
                                                </th>
                                                <th style="padding: 16px; text-align: left; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; color: #192839; white-space: nowrap;">
                                                    Payment Details
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($invoices as $invoice)
                                                <tr style="border-bottom: 1px solid #E3E7EB; transition: background-color 0.2s ease;">
                                                    <td style="padding: 16px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; color: #192839;">
                                                        {{ $invoice->subscriptionPlan->title ?? 'N/A' }}
                                                    </td>
                                                    <td style="padding: 16px; font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; color: #545861;">
                                                        @if($invoice->any_discount > 0)
                                                            <span style="color: #0ED574; font-weight: 500;">
                                                                {{ number_format($invoice->any_discount, 2) }}
                                                            </span>
                                                            @if($invoice->discount)
                                                                <br><span style="font-size: 12px; color: #545861;">({{ $invoice->discount->title ?? $invoice->discount->code ?? '' }})</span>
                                                            @endif
                                                        @else
                                                            <span style="color: #B8BCC8;">No discount</span>
                                                        @endif
                                                    </td>
                                                    <td style="padding: 16px; font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; color: #545861;">
                                                        {{ $invoice->invoice_date ? $invoice->invoice_date->format('M d, Y') : 'N/A' }}
                                                    </td>
                                                    <td style="padding: 16px; font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; color: #545861;">
                                                        @if($invoice->expiry_date)
                                                            @php
                                                                $isExpired = $invoice->expiry_date->isPast();
                                                                $isExpiringSoon = $invoice->expiry_date->isFuture() && $invoice->expiry_date->diffInDays(now()) <= 7;
                                                            @endphp
                                                            <span style="color: {{ $isExpired ? '#DC3545' : ($isExpiringSoon ? '#FFC107' : '#545861') }};">
                                                                {{ $invoice->expiry_date->format('M d, Y') }}
                                                            </span>
                                                            @if($isExpired)
                                                                <br><span style="font-size: 12px; color: #DC3545;">Expired</span>
                                                            @elseif($isExpiringSoon)
                                                                <br><span style="font-size: 12px; color: #FFC107;">Expiring Soon</span>
                                                            @endif
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td style="padding: 16px; text-align: right; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; color: #192839;">
                                                        @if($invoice->final_payable)
                                                            {{ number_format($invoice->final_payable, 2) }}
                                                        @elseif($invoice->total_amount)
                                                            {{ number_format($invoice->total_amount, 2) }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td style="padding: 16px;">
                                                        @if($invoice->payment)
                                                            @php
                                                                $status = strtolower($invoice->payment->payment_status ?? '');
                                                                $statusColors = [
                                                                    'completed' => '#0ED574',
                                                                    'paid' => '#0ED574',
                                                                    'success' => '#0ED574',
                                                                    'pending' => '#FFC107',
                                                                    'processing' => '#FFC107',
                                                                    'failed' => '#DC3545',
                                                                    'cancelled' => '#DC3545',
                                                                    'refunded' => '#6C757D',
                                                                ];
                                                                $statusColor = $statusColors[$status] ?? '#545861';
                                                            @endphp
                                                            <span style="display: inline-block; padding: 4px 12px; background-color: {{ $statusColor }}20; color: {{ $statusColor }}; border-radius: 999px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 12px; text-transform: capitalize;">
                                                                {{ $invoice->payment->payment_status ?? 'Unknown' }}
                                                            </span>
                                                        @else
                                                            <span style="display: inline-block; padding: 4px 12px; background-color: #F7F9FA; color: #545861; border-radius: 999px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 12px;">
                                                                Not Paid
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td style="padding: 16px; font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; color: #545861;">
                                                        @if($invoice->payment)
                                                            <div style="display: flex; flex-direction: column; gap: 4px;">
                                                                @if($invoice->payment->payment_method)
                                                                    <span><strong>Method:</strong> {{ ucfirst($invoice->payment->payment_method) }}</span>
                                                                @endif
                                                                @if($invoice->payment->transaction_id)
                                                                    <span><strong>Transaction ID:</strong> {{ $invoice->payment->transaction_id }}</span>
                                                                @endif
                                                                @if($invoice->payment->payment_date)
                                                                    <span><strong>Date:</strong> {{ $invoice->payment->payment_date->format('M d, Y') }}</span>
                                                                @endif
                                                                @if($invoice->payment->amount)
                                                                    <span><strong>Amount:</strong> {{ number_format($invoice->payment->amount, 2) }}</span>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <span style="color: #B8BCC8;">No payment details</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="pagination-container" style="margin-top: 32px; display: flex; justify-content: center; align-items: center;">
                                    {{ $invoices->links() }}
                                </div>
                            @else
                                <div style="padding: 48px; text-align: center; background-color: #F7F9FA; border-radius: 8px;">
                                    <i class="fas fa-receipt" style="font-size: 48px; color: #B8BCC8; margin-bottom: 16px;"></i>
                                    <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #545861; margin: 0;">
                                        No subscription history found.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <style>
    .payments-table tbody tr:hover {
        background-color: #F7F9FA;
    }

    .payments-table-container {
        border-radius: 8px;
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .payments-table-container {
            overflow-x: auto;
        }
        
        .payments-table {
            min-width: 800px;
        }
    }
  </style>
@endsection

