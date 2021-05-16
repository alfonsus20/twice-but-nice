<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
{{-- @if (trim($slot) === 'Laravel') --}}
<img src="file://{{asset('img/'. 'icon.png')}}" alt="logo" style="width: 60px; height:auto;">
{{-- @else --}}
{{-- {{ $slot }} --}}
{{-- @endif --}}
</a>
</td>
</tr>
