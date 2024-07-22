@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Dev')
<img src="https://as1.ftcdn.net/v2/jpg/05/09/17/46/1000_F_509174694_a8jxmbhzeDgJOu0VYNQwDZC61xjZWCtJ.jpg" 
class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
