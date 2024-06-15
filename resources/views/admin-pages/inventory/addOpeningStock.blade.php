@extends('../layouts/' . $layout)

@section('subhead')
<title>Admin | Inventory List</title>
@endsection

@section('subcontent')
<div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
    <h2 class="mr-auto text-lg font-medium">Inventory List</h2>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="intro-y box mt-5 p-5">
    <div class="scrollbar-hidden overflow-x-auto">
        <div class="overflow-x-auto">
            <form action="{{route('saveOpeingStockData')}}" method="post">
            @csrf
                <table data-tw-merge class="w-full text-left" id="example">
                    <thead data-tw-merge class="">
                        <tr data-tw-merge class="[&amp;amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                            <th data-tw-merge class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                #
                            </th>
                            <th data-tw-merge class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                product Image
                            </th>
                            <th data-tw-merge class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                product Name
                            </th>
                            <th data-tw-merge class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                                Opening Stock
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($Products as $item)
                        <tr data-tw-merge class="[&amp;amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                            <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                {{ $count }}
                            </td>

                            <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                @if ($item->image)
                                <a href="{{ asset($item->image) }}" class="btn btn-info" target="_blank">
                                    <div class="image-fit zoom-in -ml-5 h-10 w-10">
                                        <x-base.tippy class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]" src="{{ asset($item->image) }}" alt="Midone Kanaiya" as="img" content="{{ asset($item->image) }}" />
                                    </div>
                                </a>
                                @else
                                <span class="btn btn-warning">N/A</span>
                                @endif
                            </td>
                            <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                {{ $item->product_name }}
                            </td>
                            <td data-tw-merge class="px-5 py-3 border-b dark:border-darkmode-300">
                                <input type="text" name="opening_stock[{{ $item->id}}]" min='0' 
                                {{-- value="{{$item->GetInventory ? $item->GetInventory->opening_stock : 0}}"> @if ($item->lush == 1) KG @else Unit @endif --}}>
                                {{ $item->volume }}
                            
                            </td>
                        </tr>
                        @php $count++; @endphp
                        @endforeach
                        <!-- Save button row -->
                        <tr>
                            <td colspan="4" class="text-right">
                                <!-- <button class="btn btn-primary">Save</button> -->
                                <x-base.button class="w-24" type="submit" variant="primary">
                                    Save
                                </x-base.button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- END: HTML Table Data -->
@endsection

@once
@push('vendors')
@vite('resources/js/vendor/tabulator/index.js')
@vite('resources/js/vendor/lucide/index.js')
@vite('resources/js/vendor/xlsx/index.js')
@endpush
@endonce



@once
@push('scripts')
{{-- @vite('resources/js/pages/tabulator/index.js') --}}
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script>
      new DataTable('#example', {
                paging: false,
                layout: {
                    topStart: {
                        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
                    }
                }
            });
</script>
@endpush
<script>
    function goToAddCategoriePage() {
        // Redirect to another page when the button is clicked
        window.location.href = "{{ route('addOpeningStock') }}";
    }
</script>
@endonce