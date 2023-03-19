<div>
  <div class="mt-10 text-center text-2xl text-gray-700 font-bold">
    <h1>LIST OF ASSETS</h1>
  </div>
  <table id="example" class="table-auto mt-5" style="width:100%">
    <thead class="font-normal">
      <tr>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">SERIAL NUMBER
        </th>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">NAME</th>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">DESCRIPTION
        </th>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">PRICE</th>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">CATEGORY</th>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">DONOR</th>
      </tr>
    </thead>
    <tbody class="">
      @foreach ($assets as $item)
        <tr>
          <td class="border text-gray-600  px-3 py-1">{{ $item->serial_number }}</td>
          <td class="border text-gray-600  px-3 py-1">{{ $item->name }}
          </td>
          <td class="border text-gray-600  px-3 py-1">{{ $item->description }}
          </td>
          <td class="border text-gray-600  px-3 py-1"> &#8369;{{ number_format($item->price, 2) }}
          </td>
          <td class="border text-gray-600 uppercase  px-3 py-1">{{ $item->category->name }}
          </td>
          <td class="border text-gray-600 uppercase  px-3 py-1">{{ $item->donor->fullname ?? 'N/A' }}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
