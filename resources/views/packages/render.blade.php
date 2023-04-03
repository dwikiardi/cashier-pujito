<table class="table table-hover" id="tablePackage">
    <thead>
        <th>No</th>
        <th>Price</th>
        <th>Bandwidth</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($packages as $package)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>Rp. {{number_format($package->price,0,'.','.')}}</td>
            <td>{{$package->bandwidth}} MBps</td>
            <td class="text-center">
                <button class="btn btn-info btn-round mr-2 btn-edit" data-id="{{$package->id}}"><i
                        class="fa fa-pencil-alt fa-1x" aria-hidden="true"></i></button>
                <button class="btn btn-danger btn-round btn-delete" data-id="{{$package->id}}"><i
                        class="fa fa-trash fa-1x" aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('#tablePackage').DataTable({
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