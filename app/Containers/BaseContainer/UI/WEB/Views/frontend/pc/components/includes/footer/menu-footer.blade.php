@if (isset($footerMenus[0]))
    @foreach ($footerMenus[0] as $footerMenuLvl1)
        <div class="col-md-4 col-lg-3">
            <h3>{{ $footerMenuLvl1->desc_lang->name }}</h3>
            @if (isset($footerMenus[$footerMenuLvl1->id]))
                <ul>
                    @foreach ($footerMenus[$footerMenuLvl1->id] as $footerMenuLvl2)
                        <li>
                            <a href="{{ $footerMenuLvl2->menu_link }}">
                                {{ $footerMenuLvl2->desc_lang->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endforeach
@endif
