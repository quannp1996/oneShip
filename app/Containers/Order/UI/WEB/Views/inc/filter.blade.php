<li class="nav-item ml-auto">
    <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#modalOrderFilter">
        <i class="fa fa-filter"></i> Bộ lọc
    </a>
</li>

<!-- Modal -->
<div class="modal fade" id="modalOrderFilter" role="dialog" aria-labelledby="modalOrderFilterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg mw-90" role="document">
        <div class="modal-content">
            <div class="modal-body">
              @include('order::inc.forms.filter-form',['search_data' => $search_data])
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
