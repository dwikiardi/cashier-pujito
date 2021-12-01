<table class="table table-hover" id="tableCommunity">
    <thead>
        <th>No</th>
        <th></th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No. Telp</th>
        <th>Jenis Kelamin</th>
        <th>Status</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        @foreach ($communities as $community)
        <tr class="{{$community->status == false ? 'bg-light-danger' : '' }}">
            <td>{{$loop->iteration}}</td>
            <td><img src="{{asset($community->user->image)}}" height="100px"></td>
            <td>{{$community->name}}</td>
            <td>{{$community->address}}</td>
            <td>{{$community->phone}}</td>
            <td>{{$community->gender == 1 ? 'Laki - Laki' : 'Perempuan'}}</td>
            <td>{{$community->status == 1 ? 'Aktis' : 'Non-aktif'}}</td>
            <td class="text-center">
                @if ($community->status == true)
                <button class="btn btn-danger btn-round btn-change-status" data-id="{{$community->id}}"
                    data-status="false"><i class="fa fa-ban fa-1x" aria-hidden="true"></i></button>
                @else
                <button class="btn btn-info btn-round mr-2 btn-change-status" data-id="{{$community->id}}"
                    data-status="true"><i class="fa fa-check-circle fa-1x" aria-hidden="true"></i></button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function () {
    $('#tableCommunity').DataTable({
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