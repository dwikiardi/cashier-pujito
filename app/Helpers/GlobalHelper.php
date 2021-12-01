<?php

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

function afterDiscount($price, $discount)
{
    $result = $price - (($price*$discount)/100);
    return convertToRupiah($result);
}

function saleThisMonth()
{
    $date = date('Y-m');
    $sold = TicketSold::with('ticket')->whereBetween('sale_date', [$date . '-01', $date . '-31'])->get();
    $total = 0;
    foreach($sold as $sold){
        $total += $sold->ticket->price - ($sold->ticket->price*($sold->discount/100));
    }

    return convertToRupiah($total);
}

function saleLastMonth()
{
    $datestring= date('Y-m', strtotime('first day of last month'));
    $date=date_create($datestring);
    $lastMonth = $date->format('Y-m');

    $sold = TicketSold::with('ticket')->whereBetween('sale_date', [$lastMonth . '-01', $lastMonth . '-31'])->get();
    $total = 0;
    foreach($sold as $sold){
        $total += $sold->ticket->price - ($sold->ticket->price*($sold->discount/100));
    }

    return convertToRupiah($total);
}

function username()
{
    return auth()->user()->role->name == 'Admin' ? auth()->user()->admin->name 
                                                : (auth()->user()->role->name == 'Manager' ? auth()->user()->manager->name : auth()->user()->community->name);
}

function globalTicketSold()
{
    return TicketSold::count();
}

function globalBeforeDiscount()
{
    $total = 0;
    $sold = TicketSold::with('ticket')->get();
    foreach($sold as $sold){
        $total += $sold->ticket->price;
    }
    return convertToRupiah($total);
}

function globalDiscount()
{
    $total = 0;
    $sold = TicketSold::with('ticket')->get();
    foreach($sold as $sold){
        $total += $sold->ticket->price*($sold->discount/100);
    }
    return convertToRupiah($total);
}

function globalNetto()
{
    $total = 0;
    $sold = TicketSold::with('ticket')->get();
    foreach($sold as $sold){
        $total += $sold->ticket->price - ($sold->ticket->price*($sold->discount/100));
    }
    return convertToRupiah($total);
}

function saleByMonth($date)
{

    $sold = TicketSold::with('ticket')->whereBetween('sale_date', [$date . '-01', $date . '-31'])->get();
    $total = 0;
    foreach($sold as $sold){
        $total += $sold->ticket->price - ($sold->ticket->price*($sold->discount/100));
    }

    return convertToRupiah($total);
}
?>
