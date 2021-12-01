<table class="table table-hover" id="tableStaff">
    <thead>
        <th>No</th>
        <th></th>
        <th>Nama Admin</th>
        <th>Alamat</th>
        <th>No. Telp</th>
        <th>Tempat & Tgl Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Status</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        @foreach ($staffs as $staff)
        <tr class="{{$staff->status == false ? 'bg-light-danger' : '' }}">
            <td>{{$loop->iteration}}</td>
            <td><img src="{{asset($staff->user->image)}}" height="100px"></td>
            <td>{{$staff->name}}</td>
            <td>{{$staff->address}}</td>
            <td>{{$staff->phone}}</td>
            <td>{{$staff->place_of_birth}}, {{convertDate($staff->date_of_birth)}}</td>
            <td>{{$staff->gender == 1 ? 'Laki - Laki' : 'Perempuan'}}</td>
            <td>{{$staff->status == 1 ? 'Aktis' : 'Non-aktif'}}</td>
            <td class="text-center">
                @if ($staff->status == true)
                <button class="btn btn-danger btn-round btn-change-status" data-id="{{$staff->id}}"
                    data-status="false"><i class="fa fa-ban fa-1x" aria-hidden="true"></i></button>
                @else
                <button class="btn btn-info btn-round mr-2 btn-change-status" data-id="{{$staff->id}}"
                    data-status="true"><i class="fa fa-check-circle fa-1x" aria-hidden="true"></i></button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function () {
    $('#tableStaff').DataTable({
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