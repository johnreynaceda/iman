<div>
  <div class="mt-10 text-center text-2xl text-gray-700 font-bold">
    <h1>DAMAGE ASSETS</h1>
  </div>
  <table id="example" class="table-auto mt-5" style="width:100%">
    <thead class="font-normal">
      <tr>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">SERIAL NUMBER
        </th>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">NAME</th>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">BORROWED DATE
        </th>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">EMPLOYEE</th>
      </tr>
    </thead>
    <tbody class="">
      @foreach ($damages as $item)
        <tr>
          <td class="border text-gray-600  px-3 py-1">{{ $item->asset->serial_number }}</td>
          <td class="border text-gray-600  px-3 py-1">{{ $item->asset->name }}
          </td>
          <td class="border text-gray-600  px-3 py-1">{{ $item->created_at->format('M d, Y') }}
          </td>
          <td class="border text-gray-600  px-3 py-1">{{ $item->user->employeeInformation->firstname }}
            {{ $item->user->employeeInformation->lastname }}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
