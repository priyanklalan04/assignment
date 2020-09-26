@if(count($userdata) !== 0)
    @foreach($userdata as $val)
        <tr id="data_info">
            <td>{{ $val['name'] }} </td>
            <td>{{ $val['created_at'] }} </td>
            <input type="hidden" data-id="{{ $val['id']}}" data-name="{{ $val['name'] }} " data-email="{{ $val['email'] }}"  />    
        </tr>
        
    @endforeach
    <tr class="exam_pagin_link">
        <td colspan="2" align="center">{{ $userdata->links() }}</td>
    </tr>
@else
    <tr><p>No record to be found</p></tr>
@endif
