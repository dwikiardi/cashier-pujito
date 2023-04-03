<table class="table table-hover" id="tableCustomer">
    <thead>
        <th>No</th>
        <th>Nama</th>
        <th>No. HP</th>
        <th>Alamat</th>
        <th>Foto</th>
        <th>Status</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
        <tr data-toggle="tooltip" data-placement="top"
            title="{{$customer->is_active == 1 ? 'Pelanggan Aktif' : 'Pelanggan Tidak Aktif'}}">
            <td>{{$loop->iteration}}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->phone}}</td>
            <td>{{$customer->address}}</td>
            <td><img src="{{asset($customer->image)}}" width="100px"></td>
            <td>
                <select class="form-control status" id="status" data-id="{{$customer->id}}" data-toggle="tooltip"
                    data-placement="bottom" title="Untuk mengubah status keanggotaan">
                    <option value="1" {{$customer->is_active == 1 ? 'selected' : ''}}>Aktif</option>
                    <option value="0" {{$customer->is_active == 0 ? 'selected' : ''}}>Tidak Aktif
                    </option>
                </select>
            </td>
            <td class="text-center">
                <button class="btn btn-info btn-round mr-2 btn-edit" data-id="{{$customer->id}}"><i
                        class="fa fa-pencil-alt fa-1x" aria-hidden="true"></i></button>
                {{-- <button class="btn btn-danger btn-round btn-delete" data-id="{{$customer->id}}"><i
                        class="fa fa-trash fa-1x" aria-hidden="true"></i></button> --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('#tableCustomer').DataTable({
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