@extends('basecontainer::admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            {!! Form::open(['url' => route('admin_settings_edit_page'), 'files' => true]) !!}

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{!! $error !!}</div>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    {!! session('status') !!}
                </div>
            @endif

            <ul class="nav nav-tabs nav-underline nav-underline-primary mb-3">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#website" role="tab" aria-controls="website"
                       aria-expanded="true"><i class="icon-globe"></i> Website</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                       aria-expanded="false"><i class="icon-phone"></i> Liên hệ</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#intergrate" role="tab" aria-controls="intergrate"
                       aria-expanded="false"><i class="icon-settings"></i>Tích hợp</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#other" role="tab" aria-controls="other"
                       aria-expanded="false"><i class="icon-settings"></i> Khác</a>
                </li>
            </ul>

            <div class="tab-content mb-4">
                @include('settings::admin.settings.components.website')

                @include('settings::admin.settings.components.contact')

                @include('settings::admin.settings.components.intergrated')

                @include('settings::admin.settings.components.other')

            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Cập nhật </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    {!! FunctionLib::addMedia('admin/js/library/tag/jquery.tag-editor.css') !!}
    {!! FunctionLib::addMedia('admin/js/library/uploadifive/uploadifive.css') !!}
@stop

@section('js_bot')
    {!! FunctionLib::addMedia('admin/js/library/tinymce/tinymce.min.js') !!}
    {!! FunctionLib::addMedia('admin/js/library/uploadifive/jquery.uploadifive.min.js') !!}
    {!! FunctionLib::addMedia('admin/js/library/uploadifive/multiupload.js') !!}
    {!! FunctionLib::addMedia('admin/js/library/tag/jquery.caret.min.js') !!}
    {!! FunctionLib::addMedia('admin/js/library/tag/jquery.tag-editor.min.js') !!}
    {!! FunctionLib::addMedia('admin/js/vue.js') !!}

    <script type="text/javascript">
        admin.system.tinyMCE('.__editor', plugins = '', menubar = '', toolbar = '', height = 300);

        $("ul.nav-tabs a").click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        $(document).ready(function () {
            $(".select2").select2({
                width: 'resolve',
            });
            //shop.getDistrict($('#province_id_warehouse').val(), '#district_id_warehouse', {{ @$data['district_id_warehouse'] }})
        });

        shop.updateRoutes = function () {
            shop.ajax_popup('route', 'POST', {}, function (json) {
                console.log(json);
                var html, i;
                html = '<div><b>PUBLIC ROUTES: </b></div>';
                for (i in json.data) {
                    html += '<p>' + json.data[i] + '</p>';
                }
                $('#result').html(html);
                shop.ajax_popup('config/route', 'POST', {}, function (json) {
                    console.log(json);
                    html = '<div><b>ADMIN ROUTES: </b></div>';
                    for (i in json.data) {
                        html += '<p>' + json.data[i] + '</p>';
                    }
                    $('#result').append(html);
                });
            }, {
                baseUrl: ENV.PUBLIC_URL
            });
        };

        shop.getDistrict = function (province_id, dom, district_default = -1) {
            shop.ajax_popup('config/get-district', 'POST', {
                id: province_id
            }, function (json) {
                if (json.error == 0) {
                    var html = '';
                    $.each(json.data, function (index, item) {
                        html += '<option value="' + item.id + '" ' + (district_default == item.id ?
                            ' selected' : '') + '>' + item.Name_VI + '</option>'
                    });
                    $(dom).append(html);
                } else {
                    alert(json.msg);
                }
            });
        };

        function exportJSON(formTable, control) {
            if (!control) {
                //if control is not defined then used the debugger
                control = $("#debugSerialization");
            }

            var ret = [];
            $("tbody tr", formTable).not(".hidden").each(function (index) {
                var item = {};
                var tr = $(this);
                tr.find(":input").not("button").each(function (j) {
                    var curInput = $(this);
                    item[curInput.data("name")] = curInput.val();
                });

                ret.push(item);
            });
            var json = JSON.stringify(ret);
            console.log(json);

            control.val(json);
        }


        function initSortable(formTable) {
            // Sortable Code
            var fixHelperModified = function (e, tr) {
                var $originals = tr.children();
                var $helper = tr.clone();

                $helper.children().each(function (index) {
                    //alert(index);
                    $(this).width($originals.eq(index).width());
                });
                return $helper;
            };

            $("tbody", formTable).sortable({
                helper: fixHelperModified,
                handle: "td:first",
                update: function () {
                    exportJSON(formTable);
                }
            }).disableSelection();

            $("thead", formTable).disableSelection();
        }


        function hydrateFormTable(formTable, data) {
            if (data) {
                try {
                    var parsedJSON = JSON.parse(data);

                    console.log("parsed data is:", parsedJSON);

                    $.each(parsedJSON, function (k, v) {
                        //display the key and value pair
                        //console.log(k, v);
                        addRow(formTable, v);

                    });
                } catch (e) {
                    console.log("error parsing the JSON", e);
                }
            }

        }

        function clearFormTable(formTable) {
            //remove any current rows
            $("tbody tr", formTable).not(".hidden").remove();
        }

        function addRow(formTable, formData) {
            // Dynamic Rows Code

            // Get max row id and set new id
            var newid = 0;
            $.each($("tr", formTable), function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
            });
            newid++;

            var tr = $("<tr></tr>", {
                id: "attr" + newid,
                "data-id": newid
            });

            // loop through each td and create new elements with name of newid
            $.each($("tbody tr:nth(0) td", formTable), function () {
                var cur_td = $(this);

                var children = cur_td.children();

                // add new td and element if it has a nane
                if ($(this).data("name") !== undefined) {
                    var td = $("<td></td>", {
                        "data-name": $(cur_td).data("name")
                    });

                    var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                    c.attr("name", $(cur_td).data("name") + '[' + newid + ']');
                    c.data("name", $(cur_td).data("name"));
                    c.appendTo($(td));
                    td.appendTo($(tr));
                } else {
                    var td = $("<td></td>", {
                        'text': $('tr', formTable).length
                    }).appendTo($(tr));
                }
            });

            //hydrate fields if there's data
            if (formData !== undefined) {
                $.each(formData, function (i, j) {
                    console.log("adding input data:", i, j, $("[data-label]", tr));
                    $("td[data-name=" + i + "] :input", tr).val(j);
                });

            }

            $(tr).appendTo(formTable);

            $(tr).find("td button.row-remove").on("click", function () {
                $(this).closest("tr").remove();
                exportJSON(formTable);
            });

        }


        function initTable(formTable) {
            initSortable(formTable);
            // addRow(formTable);

            //  $(":input", formTable).change(function () {
            //      console.log("there is an update");
            //      exportJSON(formTable, $("#debugSerialization"));
            //   });

            //setup auto-hydrating
            formTable.on('input', function () {
                exportJSON(formTable);
            });
        }

        $(document).ready(function () {

            var formTable = $("#tab_logic");
            var hiddenSerializedData = $("#serializedData");

            $("#rehydrateBtn").click(function () {
                clearFormTable(formTable);
                //add rows with JSON data
                hydrateFormTable(formTable, debugDataField.val());
            });

            //initTable(formTable);

            $("#add_row").on("click", function () {
                addRow(formTable);
            });


        });
    </script>
@stop

@section('js_bot')
    <script type="text/javascript">

    </script>
@stop
