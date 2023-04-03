<?php

use App\Models\Bill;
use App\Models\Sale;
use App\Models\TicketSold;

function convertDate($date, $printDate = false)
{
    //explode / pecah tanggal berdasarkan tanda "-"
    $exp = explode("-", $date);

    $day = array(
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $month = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    // return $exp[2] . ' ' . $month[(int)$exp[1]] . ' ' . $exp[0];

    $split       = explode('-', $date);
    $convertDate = $split[2] . ' ' . $month[(int)$split[1]] . ' ' . $split[0];

    if ($printDate) {
        $num = date('N', strtotime($date));
        return $day[$num] . ', ' . $convertDate;
    }
    return $convertDate;
}

function convertToRupiah($jumlah)
{
    return 'Rp. ' . number_format($jumlah, 0, '.', '.');
}


function username()
{
    return auth()->user()->name;
}

function birthday($place, $date)
{
    return $place . ', ' . convertDate($date);
}

function saleThisMonth()
{
    $date = date('Y-m');
    $bills = Bill::whereBetween('date', [$date . '-01', $date . '-31'])->get();
    $transaction_success = 0;
    foreach ($bills as $bill)
    {
        if($bill->is_paid == true) {
            $transaction_success += $bill->customer->customer_bandwidth->package->price;
        }
    }

    return convertToRupiah($transaction_success);
}

function saleLastMonth()
{
    $datestring= date('Y-m', strtotime('first day of last month'));
    $date=date_create($datestring);
    $lastMonth = $date->format('Y-m');

    $bills = Bill::whereBetween('date', [$lastMonth . '-01', $lastMonth . '-31'])->with('customer')->get();
    $transaction_success = 0;
    foreach ($bills as $bill)
    {
        if($bill->is_paid == true) {
            $transaction_success += $bill->customer->customer_bandwidth->package->price;
        }
    }

    return convertToRupiah($transaction_success);
}
?>
