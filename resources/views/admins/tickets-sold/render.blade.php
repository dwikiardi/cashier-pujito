<table class="table table-hover table-striped" id="tableTicket">
    <thead>
        <th>No</th>
        <th>Tanggal Terjual</th>
        <th>Subtotal</th>
        <th>Diskon</th>
        <th>Total (setelah diskon)</th>
        <th>Dijual Oleh</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        @foreach ($sold as $sold)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{convertDate($sold->sale_date, true)}}</td>
            <td>{{convertToRupiah($sold->ticket->price)}}</td>
            <td>{{$sold->discount}} %</td>
            <td>{{afterDiscount($sold->ticket->price, $sold->discount)}}</td>
            <td>{{$sold->soldBy->name}}</td>
            <td class="text-center">
                <button class="btn btn-success btn-round mr-2 btn-edit" data-id="{{$sold->id}}"
                    data-title="{{$sold->title}}"><i class="fa fa-pencil-alt fa-1x" aria-hidden="true"></i></button>
                <button class="btn btn-danger btn-round btn-delete" data-id="{{$sold->id}}"><i class="fa fa-trash fa-1x"
                        aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function () {
    $('#tableTicket').DataTable({
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
});
</script>