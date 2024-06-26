<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @php
                $logo = asset(setting('dark_logo'));
                $app_name = setting('app_name');
            @endphp
            @if (setting('app_logo_type') == 'image')
                <img src="{{ $logo }}" class="logo" alt="{{ $app_name }}">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
