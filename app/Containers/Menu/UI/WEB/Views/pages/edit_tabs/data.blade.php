<div class="card card-accent-primary">
    <div class="card-header card-accent-success" id="headingTwo">
        {{ __('menu::menu.detail_info') }}
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="">{{ __('menu::menu.display') }}</label>
            <select name="status" class="form-control">
                @foreach ($menuStatus as $alias => $statusId)
                    @if ($statusId != config('menu-container.status.old_delete'))
                        <option value="{{ $statusId }}" @if (optional($data)->status == $statusId) selected @endif>
                            {{ __('menu::menu.' . $alias) }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">{{ __('menu::menu.sort') }}</label>
            <input type="number" name="sort_order" min="0" maxlength="2" class="form-control"
                value="{{ old('sort_order', optional($data)->sort_order) }}" />
        </div>

        <div class="form-group">
            <label for="">Routing / URL</label>
            <select name="link" id="link" class="form-control select2">
                <option value="">--Chọn--</option>
                @foreach ($routeCollection as $r)
                    @php($routeName = $r->getName())
                        <option value="{{ $routeName }}" @if (old('link', optional($data)->link) == $routeName) selected @endif>
                            @if (!\StringLib::startsWith($routeName,'web_') && !empty(\FunctionLib::getUrlFromRoute($routeName)))
                                URL: {{ \FunctionLib::getUrlFromRoute($routeName) }} - {{$routeName}} - {{ implode(',', $r->methods) }}
                            @else
                                Route: {{ $routeName }} - {{ implode(',', $r->methods) }}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Link tự nhập (Extra Link)</label>
                <input  type="text" 
                        class="form-control" 
                        name="extra_link" 
                        placeholder="Link tự nhập"
                        value="{{ optional($data)->extra_link }}"
                >
            </div>

            <fieldset class="border p-2">
                <legend class="w-auto px-2 font-xl">{{ __('menu::menu.menu_type') }}</legend>
                <div class="form-group">
                    <label for="">{{ __('menu::menu.menu_type') }}:</label>
                    <select name="type" id="type" class="form-control" onchange="return getMenuTreeByType(this, '#pid')">
                        @if (!empty($menuTypes))
                            <option value="">-- {{ __('menu::menu.choose_type_menu') }} --</option>
                            @foreach ($menuTypes as $typeId => $typeText)
                                <option value="{{ $typeId }}" @if (optional($data)->type == $typeId) selected @endif>
                                    {{ $typeText }}
                                </option>
                            @endforeach
                        @else
                            <option value="">Không có loại menu</option>
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="">{{ __('menu::menu.parent_menu') }}:</label>
                    <select name="pid" id="pid" class="form-control">
                        <option value="0">-- {{ __('menu::menu.choose_parent_menu') }} --</option>
                        {!! $menuTree !!}
                    </select>
                </div>
            </fieldset>

            <fieldset class="border p-2 mt-3">
                <legend class="w-auto px-2 font-xl">{{ __('menu::menu.other_info') }}</legend>

                <div class="form-group">
                    <label for="">{{ __('menu::menu.icon') }}:</label>
                    <input type="text" name="icon" class="form-control" value="{{ optional($data)->icon }}">
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="no_follow" class="custom-control-input" id="customCheck1" value="1" @if (optional($data)->no_follow == 1) checked @endif />
                    <label class="custom-control-label" for="customCheck1">{{ __('menu::menu.no_follow') }}</label>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="newtab" class="custom-control-input" id="customCheck2" value="1" @if (optional($data)->newtab == 1) checked @endif>
                    <label class="custom-control-label" for="customCheck2">{{ __('menu::menu.newtab') }}</label>
                </div>
            </fieldset>
        </div>
    </div>
