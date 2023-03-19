<div>
  <div class="mt-10 text-center text-2xl text-gray-700 font-bold">
    <h1>BLACKLISTED EMPLOYEE</h1>
  </div>
  <table id="example" class="table-auto mt-5" style="width:100%">
    <thead class="font-normal">
      <tr>

        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">FULLNAME</th>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">DEPARTMENT
        </th>
        <th class="border text-left px-2 text-sm font-medium text-gray-500 py-2">DATE
        </th>

      </tr>
    </thead>
    <tbody class="">
      @foreach ($blacklisted as $item)
        <tr>
          <td class="border text-gray-600  px-3 py-1">{{ $item->employeeInformation->firstname }}</td>
          <td class="border text-gray-600  px-3 py-1">{{ $item->employeeInformation->department->name }}
          </td>
          <td class="border text-gray-600  px-3 py-1">{{ $item->updated_at->format('M d, Y') }}
          </td>

        </tr>
      @endforeach
    </tbody>
  </table>
</div>
