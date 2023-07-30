@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<!-- <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> -->
    <!-- <img src="/images/logo.png" class="logo" alt="logo" width="140" height="30"style="margin-top: 15px;"> -->

@else
{{ $slot }}
@endif
</a>
</td>
</tr>
