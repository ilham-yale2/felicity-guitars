@extends('layout.admin')

@section('title', 'Transaction')

@section('page', 'User Transaction ')

@section('content')
    <div class="col-lg-12">
        <h3 calss="mb-2"> Transaction List</h3>
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                
                <div class="table-responsive mb-4">
                    <style>
                        table .collapse.in {
                            display:table-row;
                        }

                    </style>
                    <table id="zero-config" class="table style-3 table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $b)
                                <tr class="clickable" data-toggle="collapse" id="row1" data-target=".row{{$loop->iteration}}">
                                    <td clas="text-center"><span class="iconify" data-icon="akar-icons:circle-plus"></span></td>
                                    <td class="">
                                        {{$b->user->name}}
                                    </td>
                                    <td>{{ $b->email}}</td>
                                    <td>{{ $b->phone }}</td>
                                    <td>{!!$b->status_badge!!}</td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="{{ route('trade.show', $b->id) }}" class="bs-tooltip"
                                                    data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-edit-2 p-1 br-6 mb-1">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg></a></li>
                                            <li>
                                                <a href="#" onclick="doDelete({{$b->id}}, `{{$b->name}}`)" class="bs-tooltip"
                                                    data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('trade.destroy', ['trade' => $b->id]) }}"
                                                    method="POST" id="form-delete-{{ $b->id }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="collapse row{{$loop->iteration}}">
                                    <td>

                                    </td>
                                    <td colspan="6">
                                        <table class="border-0 w-100">
                                            <tr>
                                                <th>Product</th>
                                                <th>QTY</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                           @foreach ($b->detail as $item)
                                               <tr>
                                                   <td>{{$item->product->name}}</td>
                                                   <td width="10%">{{$item->qty}}</td>
                                                   <td width="20%">Rp. {{number_format($item->price)}}</td>
                                                   <td width="20%">Rp. {{number_format($item->total)}}</td>
                                               </tr>
                                           @endforeach
                                        </table>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if(session()->has('message'))
        <script>
            var type = "{{session()->get('message')['status']}}"
            if(type == 'success'){
                var title = 'Well Done...'
            }else{
                var title = "Oops..."
            }
            setTimeout(() => {
                Swal.fire({
                    icon: type,
                    title: title,
                    text: "{{session()->get('message')['text']}}",
                })
            }, 1000);
        </script>
    @endif
    @php
        $menu = 'trade'
    @endphp
@endsection

@section('script')
    <script>
        function doDelete(id, name) {

            Swal.fire({
                title: `Are you sure to delete this data?`,
                text: 'Deleted data cannot be restored' ,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#form-delete-${id}`).submit()
                }
            });

        }
    </script>
@endsection
