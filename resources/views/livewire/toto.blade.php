<td>
                                     
    <select wire:model="selectedStartTime"  name="timetable[{{ $i }}][start_time]" class="form-control">
      <option value="">Select Start Time</option> 
      @foreach ($startTimes as $startTime)
      <option {{ (old('timetable[' . $i . '][start_time]', $value['start_time']) == {{ $startTime }}) ? 'selected' : '' }} value="{{ $startTime }}">{{ $startTime }}</option>
     @endforeach
    </select>
  </td>
  <td>
    
    <select  name="timetable[{{ $i }}][end_time]" class="form-control">
      <option value="">Select End Time </option> 
      @foreach ($endTimes as $endTime)
            <option {{ (old('timetable[' . $i . '][end_time]', $value['end_time']) == {{ $endTime }}) ? 'selected' : '' }}  value="{{ $endTime }}">{{ $endTime }}</option>
        @endforeach
      
    </select>
  </td>
