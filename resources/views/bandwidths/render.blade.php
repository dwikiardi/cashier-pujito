<table class="table table-hover" id="tableBandwidth">
    <thead>
        <th>No</th>
        <th>Nama</th>
        <th>IP Radio</th>
        <th>IP Access</th>
        <th>Bandwidth</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($bandwidths as $bandwidth)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$bandwidth->customer->name}}</td>
            <td>{{$bandwidth->ip_radio}}</td>
            <td>{{$bandwidth->ip_access}}</td>
            <td>{{$bandwidth->package->bandwidth}} MBps</td>
            <td class="text-center">
                <button class="btn btn-info btn-round mr-2 btn-edit" data-id="{{$bandwidth->id}}"><i
                        class="fa fa-pencil-alt fa-1x" aria-hidden="true"></i></button>
                <button class="btn btn-danger btn-round btn-delete" data-id="{{$bandwidth->id}}"><i
                        class="fa fa-trash fa-1x" aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('#tableBandwidth').DataTable({
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