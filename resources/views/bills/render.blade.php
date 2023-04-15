@if (count($bills) == 0)
<div class="row align-items-center">
    <div class="col-6 offset-3 mb-3">
        <span class="display-7">Tidak ada data pada bulan ini</span>
    </div>
    <div class="col-6 offset-3 text-center">
        <button type="button" class="btn btn-primary btn-save">
            <span class="fa fa-plus-circle"></span> Buat Pembayaran
        </button>
    </div>
</div>
@else
<table class="table table-hover" id="tableBill">
    <thead>
        <th>No</th>
        <th>Invoice Number</th>
        <th>Nama</th>
        <th>Pembayaran Bulan</th>
        <th>Bandwidth</th>
        <th>Harga</th>
        <th>Print</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($bills as $bill)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$bill->invoice_number}}</td>
            <td>{{$bill->customer->name}}</td>
            <td>{{convertDate($bill->date)}}</td>
            <td>{{$bill->customer->customer_bandwidth->package->bandwidth}} MBps</td>
            <td>
                Rp.
                {{number_format($bill->customer->customer_bandwidth->package->price,0,'.','.')}}
            </td>
            <td class="text-center">
                <div class="form-check form-check-inline">
                    <input type="checkbox" id="printThisCheckBox" class="form-check-input" name="printThisCheckBox[]" data-id="{{$bill->id}}"
                    data-name="{{$bill->customer->name}}" data-date="{{$bill->date}}">
                </div>
            </td>
            <td class="text-center">
                @can('unpaid', $bill)
                <button class="btn btn-info btn-round mr-2 btn-validate" data-id="{{$bill->id}}"><i
                        class="fa fa-check fa-1x" aria-hidden="true"></i></button>
                @endcan
                <button class="btn btn-danger btn-round btn-print" data-id="{{$bill->id}}"
                    data-name="{{$bill->customer->name}}" data-date="{{$bill->date}}"><i class="fa fa-print fa-1x"
                        aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
<script>
    $(document).ready(function () {
        $('#tableBill').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
</script>
