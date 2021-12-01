<table class="table table-hover table-striped" id="tableTicket">
    <thead>
        <th>No</th>
        <th>Title</th>
        <th>Harga</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        @foreach ($tickets as $ticket)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$ticket->title}}</td>
            <td>{{convertToRupiah($ticket->price)}}</td>
            <td>{{$ticket->description}}</td>
            <td class="text-center">
                <button class="btn btn-success btn-round mr-2 btn-edit" data-id="{{$ticket->id}}"
                    data-title="{{$ticket->title}}"><i class="fa fa-pencil-alt fa-1x" aria-hidden="true"></i></button>
                <button class="btn btn-danger btn-round btn-delete" data-id="{{$ticket->id}}"><i
                        class="fa fa-trash fa-1x" aria-hidden="true"></i></button>
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