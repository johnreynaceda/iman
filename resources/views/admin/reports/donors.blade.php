<div>
  <div class="mt-10 text-center text-2xl text-gray-700 font-bold">
    <h1>LIST OF DONORS</h1>
  </div>
  <table id="example" class="table-auto mt-5" style="width:100%">
    <thead class="font-normal">
      <tr>
        <th class="border  text-left px-2 text-sm font-medium text-gray-500 py-2">FULLNAME
        </th>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">DONATED ASSETS
        </th>
      </tr>
    </thead>
    <tbody class="">
      @foreach ($donors as $item)
        <tr>
          <td class="border text-gray-600  px-3 py-1">{{ $item->fullname }}</td>
          <td class="border text-gray-600  px-3 py-1">
            @foreach ($item->assets as $asset)
              {{ $asset->name }}
              @if (!$loop->last)
                ,
              @endif
            @endforeach
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
